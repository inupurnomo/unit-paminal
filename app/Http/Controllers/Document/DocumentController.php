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
  public function store(Request $request, string $id)
  {
    DB::beginTransaction();

    try {

      // dd($request->all());
      if ($request->sprin_file) {
        $file_sprin = $this->storeFile($request->sprin_file, 'file/sprin');
        Sprin::create(
          ['dumas_id' => $id, 'valid_until' => $request->sprin_date, 'file' => $file_sprin]
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

  public function arsip(Request $request, string $id)
  {
    $table = $request->table;
    $doc_id = $request->id;

    $tableValue = [
      'nd' => 'nota_dinas',
      'sprin' => 'sprins',
      'bai_saksi' => 'b_a_i_saksis',
      'sp_saksi' => 'pernyataan_saksis',
      'bai_terlapor' => 'b_a_i_terlapors',
      'sp_terlapor' => 'pernyataan_terlapors',
      'lhp' => 'n_d_l_h_p_s',
      'lhg' => 'n_d_l_h_g_s',
    ];

    if (array_key_exists($table, $tableValue)) {
      $tableName = $tableValue[$table];
      $data = DB::table($tableName)->find($id);
    } else {
      return $this->response_json(500, 'Table tidak ditemukan!', null);
    }

    if ($data) {
      $arsip = DB::table($tableName)->where('id', $doc_id)->update([
        'is_archived' => !$data->is_archived,
      ]);
    } else {
      return $this->response_json(500, 'Data tidak ditemukan!', null);
    }

    if ($arsip) {
      return $this->response_json(200, 'Berhasil!', null);
    } else {
      return $this->response_json(500, 'Gagal!', null);
    }
  }
}
