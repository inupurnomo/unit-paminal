@extends('layouts/layoutMaster')

@section('title', 'Edit User - Pages')

@section('vendor-style')
<link rel="stylesheet" href="{{asset('assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css')}}">
<link rel="stylesheet" href="{{asset('assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css')}}">
<link rel="stylesheet" href="{{asset('assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css')}}">
<link rel="stylesheet" href="{{asset('assets/vendor/libs/select2/select2.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/@form-validation/umd/styles/index.min.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/animate-css/animate.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/sweetalert2/sweetalert2.css')}}" />

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
{{-- <script src="{{asset('assets/js/app-user-list.js')}}"></script> --}}
<script src="{{ asset('assets/js/form-layouts.js') }}"></script>
<script src="{{asset('js/master.js')}}"></script>
<script src="{{asset('js/user.js')}}"></script>
@endsection

@section('content')

    <h4 class="py-3 mb-4">
        <span class="text-muted fw-light">Pengaturan /</span> Edit User
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
                                placeholder="Nama" value="{{ $data->name }}" />
                            <label for="nama_kegiatan">Nama</label>
                        </div>
                        <div class="form-floating form-floating-outline mb-4">
                            <input type="text" class="form-control" id="username" name="username"
                                placeholder="Nama" value="{{ $data->username }}" />
                            <label for="nama_kegiatan">Username / NIK</label>
                        </div>
                        <div class="form-floating form-floating-outline mb-4">
                            <input type="email" class="form-control" id="email" name="email"
                                placeholder="user@user.com" value="{{ $data->email }}" />
                            <label for="nama_kegiatan">Email</label>
                        </div>
                        <div class="form-floating form-floating-outline mb-4">
                            <input type="number" class="form-control" id="phonenumber" name="phonenumber"
                                placeholder="081234567890" value="{{ $data->phonenumber }}" />
                            <label for="phonenumber">No Handphone</label>
                        </div>
                        <div class="form-floating form-floating-outline mb-4">
                            <select id="multicol-country" class="select2 form-select" data-allow-clear="true" required name="role">
                                <option value="">Pilih Role / Bagian</option>
                                @foreach ($roles as $value)
                                <option value="{{ $value->name }}" {{ $data->role[0] == $value->name ? "selected" : "" }}>{{ $value->name }}</option>
                                @endforeach
                            </select>
                            <label for="dobLarge">Role</label>
                        </div>
                        @if ($data->role[0] == 'advokat')
                        <div class="form-floating form-floating-outline mb-4">
                            <select id="multicol-country" class="select2 form-select" data-allow-clear="true" name="kategori">
                                <option value="" disabled>Pilih Jenis Advokat</option>
                                <option value="junior" {{ $data->kategori == 'junior' ? 'selected' : '' }}>Junior</option>
                                <option value="senior" {{ $data->kategori == 'senior' ? 'selected' : '' }}>Senior</option>
                            </select>
                            <label for="dobLarge">Jenis Pengacara</label>
                          </div>
                          @endif
                          <div class="form-floating form-floating-outline mb-4">
                            <input type="file" class="form-control" id="add-client-ktp" name="ktp" required>
                            <label for="add-client-ktp">Foto KTP</label>
                            <div class="mt-2">
                              Current : <img src="/images/user/{{ $data->ktp }}" alt="ktp" height="50" />
                            </div>
                          </div>
                          <div class="form-floating form-floating-outline mb-4">
                            <input type="file" class="form-control" id="add-client-kta" name="kta" required>
                            <label for="add-client-kta">Foto KTA</label>
                            <div class="mt-2">
                              Current : <img src="/images/user/{{ $data->kta }}" alt="kta" height="50" />
                            </div>
                          </div>
                          <div class="form-floating form-floating-outline mb-4">
                            <input type="file" class="form-control" id="add-client-ba" name="berita_acara" required>
                            <label for="add-client-ba">Berita Acara Sumpah</label>
                            <div class="mt-2">
                              Current : <img src="/images/user/{{ $data->berita_acara }}" alt="berita_acara" height="50" />
                            </div>
                        </div>
                        <hr>
                        <h5 class="mb-3">Reset Password</h5> <small class="text-body float-end"></small>
                        <div>
                            <button id="resetPassword" type="button" class="btn btn-danger reset-btn" data-id='{{ $data->id }}' data-name="{{ $data->name }}">Reset Password</button>
                        </div>
                        <hr>
                        
                        <button id="backButton" type="button" class="btn btn-outline-secondary waves-effect mt-4" onclick="window.history.back();">Batal</button>
                        <button id="submitButton" type="submit" kode="{{ $data->id }}" class="btn btn-primary mt-4">Simpan</button>
                      </form>
                </div>
            </div>
        </div>

    </div>

    <div class='modal fade' id='resetModal' tabindex='-1' role='dialog' aria-labelledby='resetModalLabel' aria-hidden='true'>
        <div class='modal-dialog' role='document'>
            <input type="hidden" id="resetRecordId" value="">
            <div class='modal-content'>
                <div class='modal-header'>
                    <h5 class='modal-title' id='deleteModalLabel'>Reset Password Confirmation</h5>
                    <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                </div>
                <div class='modal-body'>
                    Are you sure you want to reset password for this user?
                </div>
                <div class='modal-footer'>
                    <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Cancel</button>
                    <button type='button' class='btn btn-danger' onclick="resetPassword()">Reset</button>
                </div>
            </div>
        </div>
    </div>
@endsection
