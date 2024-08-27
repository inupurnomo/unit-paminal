<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Dumas;
use App\Models\Terlapor;
use App\Models\Witness;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DashboardController extends Controller
{
    public function index() {
      $today = Carbon::today()->format('Y-m-d');
      $data['saksi'] = Witness::where('date', $today)->get();
      $data['terlapor'] = Terlapor::where('date', $today)->get();

      $data['dumas_aktif'] = Dumas::where('is_done', 0)->get()->count();
      $data['dumas_selesai'] = Dumas::where('is_done', 1)->get()->count();
      
      return view('dashboard.index', $data);
    }
    
    public function getJadwal() {
      // Ambil semua data dari Witness dan Terlapor
      $witnessData = [];
      $terlaporData =[];
      $witnessData = Witness::all()->map(function ($item) {
          return [
              'id' => '1'.$item['id'],
              'url' => url('/') . '/dumas/show/' . $item->dumas_id,
              'title' => $item->name,
              'start' => $item['date'],
              'allDay' => true,
              'extendedProps' => [
                  'calendar' => 'Saksi' // Tentukan 'Saksi' jika berasal dari Witness
              ]
          ];
      });
  
      $terlaporData = Terlapor::whereNotNull('date')->get()->map(function ($item) {
          return [
              'id' => '2'.$item['id'],
              'url' => url('/') . '/dumas/show/' . $item->dumas_id,
              'title' => $item->name,
              'start' => $item['date'],
              'allDay' => true,
              'extendedProps' => [
                  'calendar' => 'Terlapor' // Tentukan 'Terlapor' jika berasal dari Terlapor
              ]
          ];
      });

      // dd($witnessData);
  
      // Gabungkan data saksi dan terlapor
      $combinedData = $terlaporData->merge($witnessData)->toArray();
  
      return response()->json($combinedData);
  }
   
}
