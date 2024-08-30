<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Den;
use App\Models\Dumas;
use App\Models\Pangkat;
use App\Models\Unit;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
  public function index()
  {
    $data['user'] = User::findOrFail(Auth::user()->id);
    $data['dumas'] = Dumas::where(['pj_id' => Auth::user()->id, 'is_done' => 0])->count();
    $data['dumas_done'] = Dumas::where(['pj_id' => Auth::user()->id, 'is_done' => 1])->count();

    return view('profile.index', $data);
  }

  public function edit()
  {
    $data['user'] = User::findOrFail(Auth::user()->id);
    $data['pangkat'] = Pangkat::all();

    return view('profile.edit', $data);
  }

  public function update(Request $request)
  {
    $validator = Validator::make($request->all(), [
      'name' => 'required|string',
      'pangkat_id' => 'required',
      'jabatan' => 'required',
    ]);

    if ($validator->fails()) {
      notify()->info($validator->messages());
      return redirect()->back()->withErrors($validator)->withInput();
    }

    $user = User::find(Auth::user()->id);

    if ($request->username != $user->username ) {
      $exists = User::where('username', $request->username)->exists();
        if ($exists) {
            notify()->error('Username sudah ada!');
            return redirect()->back()->withErrors(['username' => 'The username has already been taken.'])->withInput();
        }
    } else {
      $user->username = $request->username;
    }
    $user->name = $request->name;
    $user->pangkat_id = $request->pangkat_id;
    $user->jabatan = $request->jabatan;

    $user->save();

    notify()->success('Profile berhasil diubah!');
    return Redirect::to('/profile');
  }

  public function security()
  {
    return view('profile.security');
  }

  public function changePassword(Request $request)
  {
    $validator = Validator::make($request->all(), [
      'currentPassword' => 'required',
      'password' => 'required|confirmed|max:30',
    ], [
      'password.required' => 'Password tidak boleh kosong',
      'password.confirmed' => 'Password tidak cocok',
      'password.max' => 'Password maksimal 30 karakter',
    ]);

    if ($validator->fails()) {
      return $this->response_json(500, (string)$validator->errors(), null);
    }

    $user = Auth::user();

    // Cek apakah password lama cocok
    if (!Hash::check($request->currentPassword, $user->password)) {
      return $this->response_json(500, 'Password lama salah!', null);
    }

    $change = User::find(Auth::user()->id)->update([
      'password' => bcrypt($request->password),
    ]);

    if ($change) {
      return $this->response_json(200, 'Password berhasil diubah!', null);
    } else {
      return $this->response_json(500, 'Password gagal diubah!', null);
    }
  }
}
