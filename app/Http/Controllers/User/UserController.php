<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Den;
use App\Models\Pangkat;
use App\Models\Unit;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
  /**
   * Redirect to user-management view.
   *
   */
  public function UserManagement()
  {

    $users = User::where('username', '<>', 'administrator')->get();
    $userCount = $users->count();
    $verified = User::whereNotNull('email_verified_at')->get()->count();
    $notVerified = User::whereNull('email_verified_at')->get()->count();
    $usersUnique = $users->unique(['username']);
    $userDuplicates = $users->diff($usersUnique)->count();
    $pangkat = Pangkat::all();
    $role = Role::all();
    $den = Den::all();
    $unit = Unit::all();

    return view('user.index', [
      'totalUser' => $userCount,
      'verified' => $verified,
      'notVerified' => $notVerified,
      'userDuplicates' => $userDuplicates,
      'pangkat' => $pangkat,
      'role' => $role,
      'den' => $den,
      'unit' => $unit,
    ]);
  }

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index(Request $request)
  {
    $columns = [
      1 => 'id',
      2 => 'username',
      3 => 'name',
      4 => 'jabatan',
      5 => 'role',
      6 => 'den',
      7 => 'unit',
    ];

    $search = [];

    $totalData = User::count();

    $totalFiltered = $totalData;

    $limit = $request->input('length');
    $start = $request->input('start');
    $order = $columns[$request->input('order.0.column')];
    $dir = $request->input('order.0.dir');

    if (empty($request->input('search.value'))) {
      $users = User::where('username', '<>', 'administrator')->offset($start)
        ->limit($limit)
        ->orderBy($order, $dir)
        ->get();
    } else {
      $search = $request->input('search.value');

      $users = User::where('username', '<>', 'administrator')->where('id', 'LIKE', "%{$search}%")
        ->orWhere('name', 'LIKE', "%{$search}%")
        ->orWhere('email', 'LIKE', "%{$search}%")
        ->offset($start)
        ->limit($limit)
        ->orderBy($order, $dir)
        ->get();

      $totalFiltered = User::where('id', 'LIKE', "%{$search}%")
        ->orWhere('name', 'LIKE', "%{$search}%")
        ->orWhere('email', 'LIKE', "%{$search}%")
        ->count();
    }

    $data = [];

    if (!empty($users)) {
      // providing a dummy id instead of database ids
      $ids = $start;

      foreach ($users as $user) {
        $nestedData['id'] = $user->id;
        $nestedData['fake_id'] = ++$ids;
        $nestedData['username'] = $user->username;
        $nestedData['name'] = $user->name;
        $nestedData['jabatan'] = $user->jabatan;
        $nestedData['role'] = $user->role_name();
        $nestedData['den'] = $user->den->name;
        $nestedData['unit'] = $user->unit->name;

        $data[] = $nestedData;
      }
    }

    if ($data) {
      return response()->json([
        'draw' => intval($request->input('draw')),
        'recordsTotal' => intval($totalData),
        'recordsFiltered' => intval($totalFiltered),
        'code' => 200,
        'data' => $data,
      ]);
    } else {
      return response()->json([
        'message' => 'Internal Server Error',
        'code' => 500,
        'data' => [],
      ]);
    }
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    //
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    $userID = $request->id;

    if ($userID) {
      // update the value
      $users = User::updateOrCreate(
        ['id' => $userID],
        ['username' => $request->username, 'name' => $request->name, 'pangkat_id' => $request->pangkat_id, 'jabatan' => $request->jabatan, 'den_id' => $request->den_id, 'unit_id' => $request->unit_id],
      );

      if ($users->role_name() != $request->role) {
        $users->removeRole($users->role_name());
        $users->assignRole($request->role);
      } else {
        $users->assignRole($request->role);
      }

      // user updated
      return response()->json('Updated');
    } else {
      // create new one if username is unique
      $username = User::where('username', $request->username)->first();

      if (empty($username)) {
        $users = User::updateOrCreate(
          ['id' => $userID],
          ['username' => $request->username, 'name' => $request->name, 'pangkat_id' => $request->pangkat_id, 'jabatan' => $request->jabatan, 'den_id' => $request->den_id, 'unit_id' => $request->unit_id]
        );

        $users->assignRole($request->role);

        // user created
        return response()->json('Created');
      } else {
        // user already exist
        return response()->json(['message' => "already exits"], 422);
      }
    }
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
    $where = ['id' => $id];

    $users = User::where($where)->with('roles')->first();

    return response()->json($users);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, $id) {}

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    $users = User::where('id', $id)->delete();
  }
}
