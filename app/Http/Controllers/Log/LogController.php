<?php

namespace App\Http\Controllers\Log;

use App\Http\Controllers\Controller;
use App\Models\LogActivity;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Jenssegers\Agent\Agent;
use Rappasoft\LaravelAuthenticationLog\Models\AuthenticationLog as Log;
use Yajra\DataTables\DataTables;

class LogController extends Controller
{
  public function logs()
  {
    $data['page_name'] = 'Authentication Logs';
    $data['users'] = Log::all();
    // dd(Log::all());

    return view('auth.logs', $data);
  }

  public function authList()
  {
    $query = Log::orderBy('id', 'DESC')->get();
    return DataTables::of($query)
      ->addIndexColumn()
      ->addColumn('username', function ($data) {
        return $data->authenticatable->username;
      })
      ->addColumn('role', function ($data) {
        return $data->authenticatable->roles->pluck('name')[0];
      })
      ->addColumn('browser', function ($data) {
        $agent = tap(new Agent, fn($agent) => $agent->setUserAgent($data));
        return $agent->platform() . ' - ' . $agent->browser();
      })
      ->addColumn('login_at', function ($data) {
        return $data->login_at ? Carbon::parse($data->login_at)->diffForHumans() : '-';
      })
      ->addColumn('login_successful', function ($data) {
        return $data->login_successful === true ? 'Yes' : 'No';
      })
      ->addColumn('logout_at', function ($data) {
        return $data->logout_at ? Carbon::parse($data->logout_at)->diffForHumans() : '-';
      })
      ->rawColumns([])
      ->make(true);
  }

  public function LogActivity()
  {
    return view('logs.index');
  }

  public function activityList() {
    $query = LogActivity::orderBy('id', 'DESC')->get();
    return DataTables::of($query)
      ->addIndexColumn()
      ->editColumn('url', function ($data) {
        $html = "<a href='$data->url' target='_blank'>$data->url</a>";
        return $html;
      })
      ->addColumn('user', function ($data) {
        return $data->user->username;
      })
      ->rawColumns(['url'])
      ->make(true);
  }
}
