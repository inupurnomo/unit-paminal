<?php

namespace App\Http\Controllers\Dumas;

use App\Http\Controllers\Controller;
use App\Models\BuktiPendukung;
use App\Models\Den;
use App\Models\Dumas;
use App\Models\DumasStatus;
use App\Models\Evidence;
use App\Models\EvidenceType;
use App\Models\Klarifikasi;
use App\Models\KlarifikasiTerlapor;
use App\Models\LHG;
use App\Models\LHP;
use App\Models\NDGelar;
use App\Models\NDKadiv;
use App\Models\NotaDinas;
use App\Models\PengajuanGelar;
use App\Models\ProgressDumas;
use App\Models\Pulbaket;
use App\Models\RiksaSaksi;
use App\Models\SPHP;
use App\Models\SPHPSecond;
use App\Models\SprinLidik;
use App\Models\StatusType;
use App\Models\Terlapor;
use App\Models\Unit;
use App\Models\User;
use App\Models\Witness;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class DumasController extends Controller
{
  public function index(Request $request)
  {
    $query = $request->q;
    $startDate = $request->start;
    $endDate = $request->end;

    $den = Auth::user()->den_id ?? $request->den;
    $unit = Auth::user()->unit_id ?? $request->unit;

    $data['den'] = Den::all();
    $data['unit'] = Unit::all();

    $data['dumas'] = Dumas::where('is_done', 0)
      ->when($den, function ($query) use ($den) {
        return $query->where('den_id', $den);
      })
      ->when($unit, function ($query) use ($unit) {
        return $query->where('unit_id', $unit);
      })
      ->when($query, function ($queryBuilder, $query) {
        return $queryBuilder->where(function ($subQuery) use ($query) {
          $subQuery->where('pelapor', 'LIKE', '%' . $query . '%')
            ->orWhere('satker', 'LIKE', '%' . $query . '%')
            ->orWhere('perihal', 'LIKE', '%' . $query . '%')
            ->orWhere('dugaan', 'LIKE', '%' . $query . '%')
            ->orWhereHas('nd', function ($nd) use ($query) {
              $nd->where('number', 'LIKE', '%' . $query . '%');
            })
            ->orWhereHas('terlapor', function ($tr) use ($query) {
              $tr->where('name', 'LIKE', '%' . $query . '%');
            })
            ->orWhereHas('pj', function ($pj) use ($query) {
              $pj->where('name', 'LIKE', '%' . $query . '%');
            });
        });
      })
      ->when($startDate && $endDate, function ($query) use ($startDate, $endDate) {
        return $query->whereBetween('tanggal', [$startDate, $endDate]);
      })->orderBy('tanggal', 'desc')->paginate(15);

    return view('dumas.index', $data);
  }

  public function create()
  {
    $den = Auth::user()->den_id;
    $unit = Auth::user()->unit_id;
    $pageConfigs = ['myLayout' => 'horizontal'];
    $user = User::where('username', '<>', 'administrator')
      ->when($den, function ($query) use ($den) {
        return $query->where('den_id', $den);
      })
      ->when($unit, function ($query) use ($unit) {
        return $query->where('unit_id', $unit);
      })->get();
    $den = Den::all();
    $unit = Unit::all();

    return view('dumas.create', ['pageConfigs' => $pageConfigs, 'user' => $user, 'den' => $den, 'unit' => $unit]);
  }

  public function store(Request $request)
  {
    // dd($request->all());
    $validator = Validator::make($request->all(), [
      'nd' => 'required|string',
      'nd_file' => 'required|mimes:pdf',
      'satker' => 'required',
      'tanggal' => 'required',
      'pelapor' => 'required|string',
      'terlapor' => 'required|array',
      'pj_id' => 'required',
    ]);

    if ($validator->fails()) {
      notify()->info($validator->messages());
      return redirect()->back()->withErrors($validator)->withInput();
    }

    DB::beginTransaction();

    try {
      $dumas = Dumas::create([
        'tanggal' => $request->tanggal,
        'pelapor' => $request->pelapor,
        'satker' => $request->satker,
        'perihal' => $request->perihal,
        'dugaan' => $request->dugaan,
        'wujud_perbuatan' => $request->wujud_perbuatan,
        'pj_id' => $request->pj_id,
        'den_id' => $request->den_id ?? auth()->user()->den_id,
        'unit_id' => $request->unit_id ?? auth()->user()->unit_id,
        'insert_user' => Auth::user()->id,
        'update_user' => Auth::user()->id,
      ]);

      $file_nd = $this->storeFile($request->nd_file, 'file/nd');

      $nd = NotaDinas::create([
        'dumas_id' => $dumas->id,
        'number' => $request->nd,
        'file' => $file_nd,
      ]);

      $terlapor = $request->terlapor;
      foreach ($request->terlapor as $key => $value) {
        Terlapor::create([
          'dumas_id' => $dumas->id,
          'name' => $terlapor[$key],
        ]);
      }

      DB::commit();
      if ($dumas && $nd) {
        notify()->success('Dumas berhasil ditambahkan!');
        return Redirect::to('/dumas');
      } else {
        notify()->error('Error');
        return redirect()->back()->withErrors($validator)->withInput();
      }
    } catch (\Throwable $th) {
      throw $th;
      DB::rollBack();
      notify()->error($th->getMessage());
      return redirect()->back()->withErrors($validator)->withInput();
    }
  }

  public function edit(string $id)
  {
    $den = Auth::user()->den_id;
    $unit = Auth::user()->unit_id;

    $data['dumas'] = Dumas::find($id);
    $data['user'] = User::where('username', '<>', 'administrator')
      ->when($den, function ($query) use ($den) {
        return $query->where('den_id', $den);
      })
      ->when($unit, function ($query) use ($unit) {
        return $query->where('unit_id', $unit);
      })->get();
    $data['den'] = Den::all();
    $data['unit'] = Unit::all();

    return view('dumas.edit', $data);
  }

  public function update(Request $request, string $id)
  {
    $data['dumas'] = Dumas::find($id);

    $validator = Validator::make($request->all(), [
      'nd' => 'required|string',
      'tanggal' => 'required',
      'pelapor' => 'required|string',
      'terlapor' => 'array',
      'pj_id' => 'required',
    ]);
    if ($validator->fails()) {
      notify()->info($validator->messages());
      return redirect()->back()->withErrors($validator)->withInput();
    }
    DB::beginTransaction();

    try {
      $dumas = Dumas::find($id);

      $dumas->tanggal = $request->tanggal;
      $dumas->pelapor = $request->pelapor;
      $dumas->date_pelapor = $request->date_pelapor;
      $dumas->perihal = $request->perihal;
      $dumas->dugaan = $request->dugaan;
      $dumas->wujud_perbuatan = $request->wujud_perbuatan;
      $dumas->pj_id = $request->pj_id;

      foreach ($request->terlapor_id as $key => $value) {
        Terlapor::updateOrCreate(
          ['id' => $value],
          ['name' => $request->terlapor_name[$key], 'date' => $request->terlapor_date[$key]]
        );
      }

      if ($request->den_id && $request->unit_id) {
        $dumas->den_id = $request->den_id;
        $dumas->unit_id = $request->unit_id;
      }

      if ($request->nd != $dumas->nd->number) {
        $nd = NotaDinas::where('dumas_id', $id);
        $nd->update([
          'number' => $request->nd,
        ]);
      }

      if ($request->nd_file) {
        $nd = NotaDinas::where('dumas_id', $id)->first();

        $old_nd = $nd->file;

        $file_nd = $this->storeFile($request->nd_file, 'file/nd');

        $nd->update([
          'number' => $request->nd,
          'file' => $file_nd,
        ]);

        $this->deleteFile($old_nd);
      }

      if ($request->witness_id) {
        foreach ($request->witness_id as $key => $value) {
          Witness::updateOrCreate(
            ['id' => $request->witness_id[$key]],
            ['name' => $request->witness_name[$key], 'telephone' => $request->witness_phone[$key], 'date' => $request->witness_date[$key]]
          );
        }
      }

      $update = $dumas->save();

      DB::commit();
      if ($update) {
        notify()->success('Dumas berhasil diupdate!');
        return Redirect::to('/dumas');
      } else {
        notify()->error('Error');
        return redirect()->back()->withErrors($validator)->withInput();
      }
    } catch (\Throwable $th) {
      throw $th;
      DB::rollBack();

      notify()->error($th->getMessage());
      return redirect()->back()->withErrors($validator)->withInput();
    }
  }

  public function show(string $id)
  {
    $data['dumas'] = Dumas::find($id);
    $data['evidence_type'] = EvidenceType::all();
    $data['dumas_status'] = StatusType::all();

    return view('dumas.show', $data);
  }

  public function history(Request $request)
  {
    $query = $request->q;
    $startDate = $request->start;
    $endDate = $request->end;

    $den = Auth::user()->den_id ?? $request->den;
    $unit = Auth::user()->unit_id ?? $request->unit;

    $data['den'] = Den::all();
    $data['unit'] = Unit::all();

    $data['dumas'] = Dumas::where('is_done', 1)
      ->when($den, function ($query) use ($den) {
        return $query->where('den_id', $den);
      })
      ->when($unit, function ($query) use ($unit) {
        return $query->where('unit_id', $unit);
      })
      ->when($query, function ($queryBuilder, $query) {
        return $queryBuilder->where(function ($subQuery) use ($query) {
          $subQuery->where('pelapor', 'LIKE', '%' . $query . '%')
            ->orWhere('satker', 'LIKE', '%' . $query . '%')
            ->orWhere('perihal', 'LIKE', '%' . $query . '%')
            ->orWhere('dugaan', 'LIKE', '%' . $query . '%')
            ->orWhereHas('nd', function ($nd) use ($query) {
              $nd->where('number', 'LIKE', '%' . $query . '%');
            })
            ->orWhereHas('terlapor', function ($tr) use ($query) {
              $tr->where('name', 'LIKE', '%' . $query . '%');
            })
            ->orWhereHas('pj', function ($pj) use ($query) {
              $pj->where('name', 'LIKE', '%' . $query . '%');
            });
        });
      })
      ->when($startDate && $endDate, function ($query) use ($startDate, $endDate) {
        return $query->whereBetween('tanggal', [$startDate, $endDate]);
      })->orderBy('tanggal', 'desc')->paginate(15);

    return view('dumas.history', $data);
  }

  public function markDone(string $id)
  {
    $dumas = Dumas::find($id);

    $done = $dumas->update(['is_done' => !$dumas->is_done]);

    if ($done) {
      if ($dumas->is_done == 1) {
        notify()->success('Dumas ' . $dumas->pelapor . ' ditandai selesai!');
        return Redirect::to('/dumas');
      } else {
        DumasStatus::where('dumas_id', $id)->delete();
        notify()->success('Dumas ' . $dumas->pelapor . ' ditandai belum selesai!');
        return Redirect::to('/dumas/history');
      }
    } else {
      notify()->error('Dumas gagal dihapus!');
      return redirect()->back()->withInput();
    }
  }

  public function destroy(string $id)
  {
    $delete = Dumas::find($id)->delete();

    if ($delete) {
      notify()->success('Dumas berhasil dihapus!');
      return Redirect::to('/dumas');
    } else {
      notify()->error('Dumas gagal dihapus!');
      return redirect()->back()->withInput();
    }
  }

  public function transaction(Request $request, string $id)
  {
    // dd($request->date_pelapor);
    DB::connection();
    try {
      SPHP::updateOrCreate(
        ['dumas_id' => $id],
        ['is_done' => $request->sp2hp2 ? 1 : 0]
      );
      if ($request->date_pelapor) {
        Dumas::find($id)->update([
          'date_pelapor' => $request->date_pelapor
        ]);
      }
      Klarifikasi::updateOrCreate(
        ['dumas_id' => $id],
        ['is_done' => $request->klarifikasi ? 1 : 0]
      );
      SprinLidik::updateOrCreate(
        ['dumas_id' => $id],
        ['is_done' => $request->sprin_lidik ? 1 : 0]
      );
      Pulbaket::updateOrCreate(
        ['dumas_id' => $id],
        ['is_done' => $request->pulbaket ? 1 : 0]
      );
      RiksaSaksi::updateOrCreate(
        ['dumas_id' => $id],
        ['is_done' => $request->riksa_saksi ? 1 : 0]
      );

      // witness
      if ($request->witness_id) {
        foreach ($request->witness_id as $key => $value) {
          Witness::find($value)->update([
            'is_done' => $request->input('witness_value' . $value) ? 1 : 0
          ]);
        }
      }

      BuktiPendukung::updateOrCreate(
        ['dumas_id' => $id],
        ['is_done' => $request->bukti_pendukung ? 1 : 0]
      );

      // evidence transaction
      if ($request->evidence_id) {
        foreach ($request->evidence_id as $key => $value) {
          Evidence::find($value)->update([
            'is_done' => $request->input('evidence_value' . $value) ? 1 : 0
          ]);
        }
      }

      // evidence
      if ($request->evidence_file) {
        foreach ($request->evidence_file as $key => $value) {
          $file_evidence = $this->storeFile($request->evidence_file[$key], 'file/evidences');
          Evidence::create([
            'dumas_id' => $id,
            'type_id' => $request->evidence_type[$key],
            'name' => $request->evidence_name[$key],
            'file' => $file_evidence,
          ]);
        }
      }

      KlarifikasiTerlapor::updateOrCreate(
        ['dumas_id' => $id],
        ['is_done' => $request->klarifikasi_terlapor ? 1 : 0]
      );

      // terlapor
      if ($request->terlapor_id) {
        foreach ($request->terlapor_id as $key => $value) {
          Terlapor::find($value)->update([
            'is_done' => $request->input('terlapor_value' . $value) ? 1 : 0
          ]);
        }
        foreach ($request->terlapor_id as $key => $value) {
          if ($request->input('terlapor_date' . $value)) {
            Terlapor::find($value)->update([
              'date' => $request->input('terlapor_date' . $value)
            ]);
          }
        }
      }

      LHP::updateOrCreate(
        ['dumas_id' => $id],
        ['is_done' => $request->lhp ? 1 : 0]
      );
      PengajuanGelar::updateOrCreate(
        ['dumas_id' => $id],
        ['is_done' => $request->pengajuan_gelar ? 1 : 0]
      );
      NDGelar::updateOrCreate(
        ['dumas_id' => $id],
        ['date' => Carbon::now(), 'is_done' => $request->nd_gelar ? 1 : 0]
      );
      LHG::updateOrCreate(
        ['dumas_id' => $id],
        ['is_done' => $request->lhg ? 1 : 0]
      );
      NDKadiv::updateOrCreate(
        ['dumas_id' => $id],
        ['is_done' => $request->nd_kadiv ? 1 : 0]
      );
      SPHPSecond::updateOrCreate(
        ['dumas_id' => $id],
        ['is_done' => $request->sp2hp2_second ? 1 : 0]
      );
      if ($request->witness) {
        foreach ($request->witness as $key => $value) {
          Witness::create([
            'dumas_id' => $id,
            'name' => $request->witness[$key],
            'telephone' => $request->witness_phone[$key],
            'date' => $request->witness_date[$key],
          ]);
        }
      }
      DB::commit();

      notify()->success('Dumas berhasil diupdate!');
      return redirect()->back();
    } catch (\Throwable $th) {
      throw $th;
      DB::rollBack();

      notify()->error($th->getMessage());
      return redirect()->back()->withErrors($validator)->withInput();
    }
  }

  public function progress(Request $request, string $id)
  {
    $progress = ProgressDumas::create([
      'dumas_id' => $id,
      'value' => $request->progress_value,
    ]);

    if ($progress) {
      notify()->success('Progress berhasil ditambahkan!');
      return redirect()->back();
    } else {
      notify()->error('Progress gagal ditambahkan!');
      return redirect()->back();
    }
  }

  public function deleteProgress(Request $request, string $id)
  {
    $delete = ProgressDumas::find($id)->delete();
    if ($delete) {
      return $this->response_json(200, 'Berhasil!', null);
    } else {
      return $this->response_json(500, 'Gagal!', null);
    }
  }

  public function endDumas(Request $request, string $id)
  {
    DB::beginTransaction();
    try {
      DumasStatus::updateOrCreate(
        ['dumas_id' => $id],
        ['status_id' => $request->status_id, 'catatan' => $request->catatan]
      );

      Dumas::find($id)->update([
        'is_done' => 1,
      ]);

      DB::commit();
      notify()->success('Dumas berhasil ditandai selesai!');
      return Redirect::to('/dumas');
    } catch (\Throwable $th) {
      throw $th;
      DB::rollBack();

      notify()->error($th->getMessage());
      return redirect()->back()->withErrors($validator)->withInput();
    }
  }

  public function deleteWitness(Request $request, string $id)
  {
    $delete = Witness::find($id)->delete();
    if ($delete) {
      return $this->response_json(200, 'Berhasil!', null);
    } else {
      return $this->response_json(500, 'Gagal!', null);
    }
  }

  public function deleteEvidence(Request $request, string $id)
  {
    $data = Evidence::find($id);
    $old_evi = $data->file;

    $delete = Evidence::find($id)->delete();
    if ($delete) {
      $this->deleteFile($old_evi);
      return $this->response_json(200, 'Berhasil!', null);
    } else {
      return $this->response_json(500, 'Gagal!', null);
    }
  }
}
