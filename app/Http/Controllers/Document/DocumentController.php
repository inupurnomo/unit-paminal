<?php

namespace App\Http\Controllers\Document;

use App\Http\Controllers\Controller;
use App\Models\BAISaksi;
use App\Models\BAITerlapor;
use App\Models\NDLHG;
use App\Models\NDLHP;
use App\Models\PernyataanSaksi;
use App\Models\PernyataanTerlapor;
use App\Models\Sprin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DocumentController extends Controller
{
    public function store(Request $request, string $id) {
      DB::beginTransaction();

      try {
        //code...

        if ($request->sprin_file) {
          $file_sprin = $this->storeFile($request->sprin_file, 'file/sprin');
          Sprin::updateOrCreate(
            ['dumas_id' => $id],
            ['valid_until' => $request->sprin_date, 'file' => $file_sprin]
          );
        }

        if ($request->bai_saksi) {
          $file_bai_saksi = $this->storeFile($request->bai_saksi, 'file/saksi/bai');
          BAISaksi::updateOrCreate(
            ['dumas_id' => $id],
            ['file' => $file_bai_saksi]
          );
        }

        if ($request->sp_saksi) {
          $file_sp_saksi = $this->storeFile($request->sp_saksi, 'file/saksi/sp');
          PernyataanSaksi::updateOrCreate(
            ['dumas_id' => $id],
            ['file' => $file_sp_saksi]
          );
        }

        if ($request->bai_terlapor) {
          $file_bai_terlapor = $this->storeFile($request->bai_terlapor, 'file/terlapor/bai');
          BAITerlapor::updateOrCreate(
            ['dumas_id' => $id],
            ['file' => $file_bai_terlapor]
          );
        }

        if ($request->sp_terlapor) {
          $file_sp_terlapor = $this->storeFile($request->sp_terlapor, 'file/terlapor/sp');
          PernyataanTerlapor::updateOrCreate(
            ['dumas_id' => $id],
            ['file' => $file_sp_terlapor]
          );
        }

        if ($request->nd_lhp) {
          $file_nd_lhp = $this->storeFile($request->nd_lhp, 'file/lhp');
          NDLHP::updateOrCreate(
            ['dumas_id' => $id],
            ['file' => $file_nd_lhp]
          );
        }

        if ($request->nd_lhg) {
          $file_nd_lhg = $this->storeFile($request->nd_lhg, 'file/lhg');
          NDLHG::updateOrCreate(
            ['dumas_id' => $id],
            ['file' => $file_nd_lhg]
          );
        }

        DB::commit();
        notify()->success('Dokumen berhasil diunggah!');
        return redirect()->back();
      } catch (\Throwable $th) {
        throw $th;
        notify()->error('Dokumen gagal diunggah!');
        return redirect()->back();
      }
    }
}
