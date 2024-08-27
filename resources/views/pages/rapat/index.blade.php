@extends('layouts/layoutMaster')

@section('title', 'Rapat List - Pages')

@section('vendor-style')
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/select2/select2.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/@form-validation/umd/styles/index.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/quill/katex.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/quill/editor.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/animate-css/animate.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/pages/app-email.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/sweetalert2/sweetalert2.css') }}" />

@endsection

@section('vendor-script')
    <script src="{{ asset('assets/vendor/libs/quill/katex.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/quill/quill.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/moment/moment.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/select2/select2.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/@form-validation/umd/bundle/popular.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/@form-validation/umd/plugin-bootstrap5/index.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/@form-validation/umd/plugin-auto-focus/index.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/cleavejs/cleave.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/block-ui/block-ui.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/cleavejs/cleave-phone.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/sweetalert2/sweetalert2.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/tagify/tagify.js') }}"></script>
@endsection

@section('page-script')
    {{-- <script src="{{asset('assets/js/app-user-list.js')}}"></script> --}}
    <script src="{{ asset('assets/js/forms-pickers.js') }}"></script>
    <script src="{{ asset('js/master.js') }}"></script>
    <script src="{{ asset('js/rapat.js') }}"></script>
@endsection

@section('content')

    <!-- Users List Table -->
    <div class="card">
        <div class="card-header border-bottom">
            <div class="d-flex  justify-content-between">
                <h5 class="card-title">Daftar Rapat</h5>
                <a href="{{ route('rapat.tambah') }}">
                    <button class="btn btn-primary btn-sm">Tambah Rapat</button>
                </a>

            </div>
            <div class="d-flex  align-items-center row py-3 gap-3 gap-md-0">
                <div class="col-md-4 user_role"></div>
                <div class="col-md-4 user_plan"></div>
                <div class="col-md-4 user_status"></div>
            </div>
        </div>
        <div class="card-datatable table-responsive">
            <table class="datatables-rapat table">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Nama Kepailitan</th>
                        <th>Jenis Rapat</th>
                        <th>Tanggal Rapat</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
            </table>
        </div>
        <!-- Offcanvas to add new user -->
    </div>

    <!-- Define Delete Modal outside of the loop -->
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

    <!-- Define Submit Modal outside of the loop -->
    <div class='modal fade' id='submitModal' tabindex='-1' role='dialog' aria-labelledby='submitModalLabel'
        aria-hidden='true'>
        <div class='modal-dialog' role='document'>
            <input type="hidden" id="submitRecordId" value="">
            <div class='modal-content'>
                <div class='modal-header'>
                    <h5 class='modal-title' id='submitModalLabel'>Submit Confirmation</h5>
                    <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                </div>
                <div class='modal-body'>
                    <label for='password'>Enter Your Password:</label>
                    <input type='password' class='form-control mt-2' id='password' name='password' required>
                    <label for='password' class='pesanError d-none mt-2' style='color:white;text-decoration:italic'>Password
                        yang anda masukkan salah</label>
                </div>
                <div class='modal-footer'>
                    <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Cancel</button>
                    <button type='button' class='btn btn-primary' onclick="submitRapat()"
                        id='submitModalConfirmBtn'>Submit</button>
                </div>
            </div>
        </div>
    </div>

@endsection
