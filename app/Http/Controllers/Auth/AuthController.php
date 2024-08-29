<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session as FacadesSession;
use Yajra\DataTables\Facades\DataTables;

class AuthController extends Controller
{
  public function index()
  {
    $pageConfigs = ['myLayout' => 'blank'];
    return view('auth.login', ['pageConfigs' => $pageConfigs]);
  }

  public function login(Request $request)
  {
    $validator = Validator::make($request->all(), [
      'username' => 'required|string',
      'password' => 'required|string|max:30',
    ], [
      'username.required' => 'Username tidak boleh kosong',
      'password.required' => 'Password tidak boleh kosong',
      'password.max' => 'Password maksimal 30 karakter',
    ]);

    if ($validator->fails()) {
      // dd($validator->customMessages);
      notify()->error('fail');
      return redirect()->back()->withErrors($validator)->withInput();
    }

    $user = User::where('username', $request->username)->first();

    if (!$user) {
      // Jika pengguna tidak ditemukan
      notify()->error('User tidak ditemukan!');

      return redirect()->back()->withErrors($validator)->withInput();
    }
    
    
    if (Hash::check($request->password, $user->password)) {
      $user->update([
        'last_login' => Carbon::now()
      ]);
      Auth::login($user);
      $redirect = '/';
      $data = [
        'redirect' => $redirect
      ];
      
      notify()->success('Login sukses!');
      return Redirect::to('/');
    } else {
      notify()->error('Username atau password salah!');
      return redirect()->back()->withErrors($validator)->withInput();
    }
  }

  public function logout()
  {
    // Auth::logout();
    FacadesSession::flush();
    auth()->logout();
    return redirect('/login');
  }
}
