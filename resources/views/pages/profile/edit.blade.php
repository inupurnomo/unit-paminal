@extends('layouts/layoutMaster')

@section('title', 'User Profile - Profile')

@section('vendor-style')
<link rel="stylesheet" href="{{asset('assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css')}}">
<link rel="stylesheet" href="{{asset('assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css')}}">
<link rel="stylesheet" href="{{asset('assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css')}}">
<link rel="stylesheet" href="{{asset('assets/vendor/libs/select2/select2.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/@form-validation/umd/styles/index.min.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/animate-css/animate.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/sweetalert2/sweetalert2.css')}}" />
@endsection

<!-- Page -->
@section('page-style')
<link rel="stylesheet" href="{{asset('assets/vendor/css/pages/page-profile.css')}}" />
@endsection


@section('vendor-script')
<script src="{{asset('assets/vendor/libs/moment/moment.js')}}"></script>
<script src="{{asset('assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js')}}"></script>
<script src="{{asset('assets/vendor/libs/select2/select2.js')}}"></script>
<script src="{{asset('assets/vendor/libs/@form-validation/umd/bundle/popular.min.js')}}"></script>
<script src="{{asset('assets/vendor/libs/@form-validation/umd/plugin-bootstrap5/index.min.js')}}"></script>
<script src="{{asset('assets/vendor/libs/@form-validation/umd/plugin-auto-focus/index.min.js')}}"></script>
<script src="{{asset('assets/vendor/libs/cleavejs/cleave.js')}}"></script>
<script src="{{asset('assets/vendor/libs/cleavejs/cleave-phone.js')}}"></script>
<script src="{{asset('assets/vendor/libs/sweetalert2/sweetalert2.js')}}"></script>
@endsection

@section('page-script')
<script src="{{asset('assets/js/app-user-view-account.js')}}"></script>
<script src="{{asset('js/master.js')}}"></script>
<script src="{{asset('js/profile.js')}}"></script>
@endsection

@section('content')
    <h4 class="py-3 mb-4">
    <span class="text-muted fw-light">User Profile /</span> Edit Profile
    </h4>
    <div class="row">
        <div class="col-xl">
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Form Edit User</h5> <small class="text-body float-end"></small>
                </div>
                <div class="card-body">
                    <form class="forms-edit-validation" onsubmit="return false;" novalidate id="formedituser">
                        @csrf
                        @method('PUT')
                        <div class="form-floating form-floating-outline mb-4">
                            <input type="text" class="form-control" id="name" name="name"
                                placeholder="Nama" value="{{ $profile->name }}" />
                            <label for="nama_kegiatan">Nama</label>
                        </div>
                        <div class="form-floating form-floating-outline mb-4">
                            <input type="text" class="form-control" id="username" name="username"
                                placeholder="Nama" value="{{ $profile->username }}" />
                            <label for="nama_kegiatan">Username / NIK</label>
                        </div>
                        <div class="form-floating form-floating-outline mb-4">
                            <input type="email" class="form-control" id="email" name="email"
                                placeholder="user@user.com" value="{{ $profile->email }}" />
                            <label for="nama_kegiatan">Email</label>
                        </div>
                        <div class="form-floating form-floating-outline mb-4">
                            <input type="number" class="form-control" id="phonenumber" name="phonenumber"
                                placeholder="081234567890" value="{{ $profile->phonenumber }}" />
                            <label for="phonenumber">No Handphone</label>
                        </div>
                        <div class="form-floating form-floating-outline mb-4">
                            <select id="multicol-country" class="select2 form-select" data-allow-clear="true" required name="role" disabled>
                                <option value="{{ $profile->role }}">{{ $profile->role }}</option>
                            </select>
                            <label for="dobLarge">Role</label>
                        </div>

                        <hr>
                        <small class="card-text text-uppercase">Change Password</small>
                        <div class="row">
                            <div class="col mt-4">
                                <div class="form-floating form-floating-outline mb-4">
                                    <input type="password" class="form-control"
                                        placeholder="Password" />
                                    <label for="password">Password</label>
                                </div>
                            </div>
                            <div class="col mt-4">
                                <div class="form-floating form-floating-outline mb-4">
                                    <input type="password" class="form-control" id="confirm" name="confirm"
                                        placeholder="Password Confirmation" />
                                    <label for="confirm">Password Confirmation</label>
                                </div>
                            </div>
                        </div>

                        <button id="backButton" type="button" class="btn btn-outline-secondary waves-effect mt-4" onclick="window.history.back();">Batal</button>
                        <button id="submitButton" type="submit" class="btn btn-primary mt-4">Simpan</button>
                      </form>
                </div>
            </div>
        </div>

    </div>

@endsection
