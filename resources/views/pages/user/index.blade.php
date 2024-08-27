@extends('layouts/layoutMaster')

@section('title', 'User List - Pages')

@section('vendor-style')
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/select2/select2.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/@form-validation/umd/styles/index.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/animate-css/animate.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/sweetalert2/sweetalert2.css') }}" />

@endsection

@section('vendor-script')
    <script src="{{ asset('assets/vendor/libs/moment/moment.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/select2/select2.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/@form-validation/umd/bundle/popular.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/@form-validation/umd/plugin-bootstrap5/index.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/@form-validation/umd/plugin-auto-focus/index.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/cleavejs/cleave.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/cleavejs/cleave-phone.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/sweetalert2/sweetalert2.js') }}"></script>
@endsection

@section('page-script')
    <script src="{{ asset('assets/js/form-layouts.js') }}"></script>
    {{-- <script src="{{asset('assets/js/app-user-list.js')}}"></script> --}}
    <script src="{{ asset('js/master.js') }}"></script>
    <script src="{{ asset('js/user.js') }}"></script>
@endsection

@section('content')

    <!-- Users List Table -->
    <div class="card">
        <div class="card-header border-bottom">
            <div class="d-flex  justify-content-between">
                <h5 class="card-title">Daftar User</h5>
                <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modal_buat_user">Tambah
                    User</button>

            </div>
            <div class="d-flex  align-items-center row py-3 gap-3 gap-md-0">
                <div class="col-md-4 user_role"></div>
                <div class="col-md-4 user_plan"></div>
                <div class="col-md-4 user_status"></div>
            </div>
        </div>
        <div class="card-datatable table-responsive">
            <table class="datatables-users table">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Nama</th>
                        <th>Username</th>
                        <th>Role</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
            </table>
        </div>
        <!-- Offcanvas to add new user -->
    </div>

    <div class="modal fade" id="modal_buat_user" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel3">Buat User Baru</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form class="needs-validation" novalidate id="formcreateuser">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col mb-2 mt-2">
                                <div class="form-floating form-floating-outline">
                                    <input type="text" id="nama" class="form-control" placeholder="Enter Name"
                                        name="name" required>
                                    <label for="nameLarge">Nama</label>
                                </div>
                            </div>
                        </div>
                        <div class="row g-2">
                            <div class="col mb-2">
                                <div class="form-floating form-floating-outline">
                                    <input type="number" id="phonenumber" class="form-control" placeholder="No Handphone"
                                        name="phonenumber" required>
                                    <label for="emailLarge">No Handphone</label>
                                </div>
                            </div>
                            <div class="col mb-2">
                                <div class="form-floating form-floating-outline">
                                    <input type="text" id="email" class="form-control" placeholder="Email"
                                        name="email" required>
                                    <label for="emailLarge">Email</label>
                                </div>
                            </div>
                        </div>
                        <div class="row g-2">
                            <div class="col mb-2">
                                <div class="form-floating form-floating-outline">
                                    <input type="text" id="username" class="form-control" placeholder="username / NIK"
                                        name="username" required>
                                    <label for="emailLarge">Username / NIK</label>
                                </div>
                            </div>
                            <div class="col mb-2">
                                <div class="form-floating form-floating-outline">
                                    <select id="role" class="select2 form-select" data-allow-clear="true" required
                                        name="role">
                                        <option value="">Pilih Role / Bagian</option>
                                        @foreach ($roles as $value)
                                            <option value="{{ $value->name }}">{{ $value->name }}</option>
                                        @endforeach
                                    </select>
                                    <label for="role">Role</label>
                                </div>
                            </div>
                        </div>
                        <div class="col mb2 mt-2" id="kategori">
                            <div class="form-floating form-floating-outline">
                                <select name="kategori" id="jenis_pengacara" class="select2 form-select">
                                    <option value="" selected disabled>Pilih Jenis Advokat</option>
                                    <option value="junior">Junior</option>
                                    <option value="senior">Senior</option>
                                </select>
                                <label for="jenis_pengacara" id="label_pengacara">Jenis Advokat</label>
                            </div>
                        </div>
                        <div class="form-floating form-floating-outline mb-2">
                          <input type="file" class="form-control" id="add-client-ktp" name="ktp" required>
                          <label for="add-client-ktp">Foto KTP</label>
                        </div>
                        <div class="form-floating form-floating-outline mb-2">
                          <input type="file" class="form-control" id="add-client-kta" name="kta" required>
                          <label for="add-client-kta">Foto KTA</label>
                        </div>
                        <div class="form-floating form-floating-outline mb-2">
                          <input type="file" class="form-control" id="add-client-ba" name="berita_acara" required>
                          <label for="add-client-ba">Berita Acara Sumpah</label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class='modal fade' id='deleteModal' tabindex='-1' role='dialog' aria-labelledby='deleteModalLabel'
        aria-hidden='true'>
        <div class='modal-dialog' role='document'>
            <input type="hidden" id="deleteRecordId" value="">
            <div class='modal-content'>
                <div class='modal-header'>
                    <h5 class='modal-title' id='deleteModalLabel'>Delete Confirmation</h5>
                    <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                </div>
                <div class='modal-body'>
                    Are you sure you want to delete this record?
                </div>
                <div class='modal-footer'>
                    <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Cancel</button>
                    <button type='button' class='btn btn-danger' onclick="deleteRecord()">Delete</button>
                </div>
            </div>
        </div>
    </div>
@endsection
