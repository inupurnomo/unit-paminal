<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Dumas;
use App\Models\Terlapor;
use App\Models\Witness;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class DashboardController extends Controller
{
  public function index()
  {
    $den = Auth::user()->den_id;
    $unit = Auth::user()->unit_id;

    $today = Carbon::today()->format('Y-m-d');
    $data['pelapor'] = Dumas::where('date_pelapor', $today)
      ->when($den, function ($query) use ($den, $unit) {
        return $query->where('den_id', $den)
          ->where('unit_id', $unit);
      })
      ->get();
    $data['saksi'] = Witness::where('date', $today)
      ->when($den, function ($query) use ($den, $unit) {
        return $query->whereHas('dumas', function ($q) use ($den, $unit) {
          $q->where('den_id', $den)
            ->where('unit_id', $unit);
        });
      })->get();
    $data['terlapor'] = Terlapor::where('date', $today)
      ->when($den, function ($query) use ($den, $unit) {
        return $query->whereHas('dumas', function ($q) use ($den, $unit) {
          $q->where('den_id', $den)
            ->where('unit_id', $unit);
        });
      })->get();

    $data['dumas_aktif'] = Dumas::where('is_done', 0)
      ->when($den, function ($query) use ($den) {
        return $query->where('den_id', $den);
      })
      ->when($unit, function ($query) use ($unit) {
        return $query->where('unit_id', $unit);
      })->get()->count();
    $data['dumas_selesai'] = Dumas::where('is_done', 1)->get()->count();

    return view('dashboard.index', $data);
  }

  public function getJadwal()
  {
    // Ambil semua data dari Witness dan Terlapor
    $pelaporData = [];
    $witnessData = [];
    $terlaporData = [];

    $pelaporData = Dumas::where('date_pelapor', '<>', '')->get()->map(function ($item) {
      return [
        'id' => '1' . $item['id'],
        'url' => url('/') . '/dumas/show/' . $item->id,
        'title' => $item->pelapor,
        'start' => $item['date_pelapor'],
        'allDay' => true,
        'extendedProps' => [
          'calendar' => 'Pelapor' // Tentukan 'Saksi' jika berasal dari Witness
        ]
      ];
    });

    $witnessData = Witness::all()->map(function ($item) {
      return [
        'id' => '2' . $item['id'],
        'url' => url('/') . '/dumas/show/' . $item->dumas_id,
        'title' => $item->name,
        'start' => $item['date'],
        'allDay' => true,
        'extendedProps' => [
          'calendar' => 'Saksi' // Tentukan 'Saksi' jika berasal dari Witness
        ]
      ];
    });

    $terlaporData = Terlapor::where('date', '<>', '')->get()->map(function ($item) {
      return [
        'id' => '3' . $item['id'],
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
    // $combinedData = $pelaporData->merge($witnessData)->merge($terlaporData)->toArray();
    $combinedData = collect($pelaporData)->merge($witnessData)->merge($terlaporData)->toArray();

    return response()->json($combinedData);
  }
}
