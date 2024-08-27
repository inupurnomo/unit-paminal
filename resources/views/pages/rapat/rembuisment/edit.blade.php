@extends('layouts/layoutMaster')

@section('title', ' Edit Rembuisment - Forms')

@section('vendor-style')
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/select2/select2.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/@form-validation/umd/styles/index.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/animate-css/animate.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/sweetalert2/sweetalert2.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/flatpickr/flatpickr.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/bootstrap-datepicker/bootstrap-datepicker.css') }}" />
    <link rel="stylesheet"
        href="{{ asset('assets/vendor/libs/bootstrap-daterangepicker/bootstrap-daterangepicker.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/jquery-timepicker/jquery-timepicker.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/pickr/pickr-themes.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/tagify/tagify.css') }}" />
    <style>
        .was-validated .form-control:invalid+.select2 .select2-selection {
            border-color: #dc3545 !important;
        }

        .was-validated .form-control:valid+.select2 .select2-selection {
            border-color: #28a745 !important;
        }

        *:focus {
            outline: 0px;
        }
    </style>
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
    <script src="{{ asset('assets/vendor/libs/select2/select2.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/tagify/tagify.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/bootstrap-select/bootstrap-select.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/flatpickr/flatpickr.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/bootstrap-datepicker/bootstrap-datepicker.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/bootstrap-daterangepicker/bootstrap-daterangepicker.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/jquery-timepicker/jquery-timepicker.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/pickr/pickr.js') }}"></script>
@endsection

@section('page-script')
    <script src="{{ asset('assets/js/forms-pickers.js') }}"></script>
    <script src="{{ asset('assets/js/forms-selects.js') }}"></script>
    <script src="{{ asset('assets/js/forms-tagify.js') }}"></script>
    <script src="{{ asset('assets/js/form-layouts.js') }}"></script>
    <script src="{{ asset('js/master.js') }}"></script>
    <script src="{{ asset('js/rembuisment_rapat.js') }}"></script>
    <script>
        function refresh_csrf() {
            console.log('{!! csrf_token() !!}')
            $('#csrf_token').val('{!! csrf_token() !!}')
        }
    </script>

@endsection

@section('content')
    <h4 class="py-3 mb-4">
        <span class="text-muted fw-light">Rembuisment /</span> Edit Rembuisment
    </h4>
    <!-- Basic Layout -->
    <div class="row">
        <div class="col-xl">
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Form Rembuisment</h5> <small class="text-body float-end"></small>
                </div>
                <div class="card-body">
                    <form class="forms-edit-validation" onsubmit="return false;" novalidate id="formeditrembuis" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="_token" value="{!! csrf_token() !!}" id="csrf_token"
                            class="form-control" />
                        <div class="row">
                            <div class="col-lg-6 md-12">
                                <div class="form-floating form-floating-outline mb-4 has-validation">
                                    <select id="jenis_rapat" class="select2 form-control" name="jenis_rapat"
                                        data-allow-clear="true" required disabled>
                                        <option value="{{ $rembuisment->type_kepailitan }}">{{ $rembuisment->type_kepailitan }}</option>
                                    </select>
                                    <label for="jenis_rapat">Jenis Agenda</label>
                                    <div class="invalid-feedback">
                                        Please choose a username.
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6 md-12">
                                <div class="form-floating form-floating-outline mb-4">
                                    <select id="kepailitan" class="select2 form-control" name="kepailitan"
                                        data-allow-clear="true" required disabled>
                                        <option value="{{ $rembuisment->kepailitan_nama }}">{{ $rembuisment->kepailitan_nama }}</option>
                                    </select>
                                    <label for="kepailitan">Pilih Kegiatan</label>
                                </div>
                            </div>

                            <div class="col-lg-6 md-12">
                                <div class="form-floating form-floating-outline mb-4">
                                    <select id="agenda" class="select2 form-control" name="id_laporan"
                                        data-allow-clear="true" required disabled>
                                        <option value="{{ $rembuisment->agenda }}">{{ $rembuisment->agenda }}</option>
                                    </select>
                                    <label for="kegiatan">Pilih Agenda</label>
                                </div>
                            </div>
                            <div class="col-lg-6 md-12">
                                <div class="form-floating form-floating-outline mb-4">
                                    <input type="text" class="form-control" id="tempat" name="tempat" readonly
                                        placeholder="Tempat.." value="{{ $rembuisment->agenda_tempat }}" required disabled />
                                    <label for="tempat">Tempat</label>
                                </div>
                            </div>
                            <div class="col-lg-12 md-12">
                                <div class="form-floating form-floating-outline mb-4">
                                    <input type="text" name="tanggal" class="form-control" placeholder="YYYY-MM-DD"
                                        id="tanggal" value="{{ $rembuisment->agenda_tanggal }}" required disabled />
                                    <label for="flatpickr-date">Tanggal</label>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <h5 class="mb-3">Rembuisment</h5> <small class="text-body float-end"></small>
                        <div class="row">
                            <div class="col-lg-4 md-12">
                                <div class="form-floating form-floating-outline mb-4 has-validation">
                                    <select id="nama_kegiatan" class="select2 form-control" name="nama_kegiatan"
                                        data-allow-clear="true" required>
                                        <option value="">Select Kategori</option>
                                        @foreach ($kategori as $value)
                                            <option value="{{ $value->name }}" {{ $rembuisment->nama_kegiatan == $value->name ? 'selected' : '' }}>{{ $value->name }}</option>
                                        @endforeach
                                    </select>
                                    <label for="jenis_laporan">Kategori</label>
                                    <div class="invalid-feedback">
                                        Please choose a category.
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 md-12">
                                <div class="form-floating form-floating-outline mb-4">
                                    <input type="text" name="tanggal_kegiatan" class="form-control"
                                        placeholder="YYYY-MM-DD" id="tanggal_kegiatan" value="{{ $rembuisment->tanggal }}" />
                                    <label for="flatpickr-date">Tanggal</label>
                                </div>
                            </div>
                            <div class="col-lg-4 md-12">
                                <div class="form-floating form-floating-outline mb-4">
                                    <input type="text" class="form-control" id="tempat_kegiatan"
                                        name="tempat_kegiatan" placeholder="Tempat Kegiatan.." value="{{ $rembuisment->tempat }}" />
                                    <label for="tempat">Tempat</label>
                                </div>
                            </div>
                            <div class="form-floating form-floating-outline mb-4">
                                <textarea id="uraian" class="form-control h-px-200" name="uraian" placeholder="Uraian..." rows="200"
                                    cols="20">{{ $rembuisment->uraian }}</textarea>
                                <label for="uraian">Deskripsi</label>
                            </div>
                            <div class="col-lg-6 md-12">
                                <div class="form-floating form-floating-outline mb-4">
                                    <input type="text" class="form-control" id="biaya" name="biaya"
                                        placeholder="Biaya.." value="{{ $rembuisment->biaya }}" />
                                    <label for="tempat">Biaya</label>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-12">
                                <div class="form-floating form-floating-outline mb-4">
                                    <input class="form-control" type="file" id="bukti" name="bukti">
                                    <label for="tempat">Bukti Bayar</label>
                                </div>
                                @if($rembuisment->bukti_bayar)
                                Current: {{ $rembuisment->bukti_bayar }}
                                <div>
                                    <a class="image-link" data-bs-toggle="modal" data-bs-target="#imageModal">
                                        <img src="/file/{{ $rembuisment->bukti_bayar }}" width="200" class="col-md-3" alt="bukti_bayar" />
                                    </a>
                                </div>
                                @endif
                            </div>
                        </div>

                        <button type="button" class="btn btn-danger mt-4" onclick="window.history.back()">Batal</button>
                        <button id="submitButton" type="submit" class="btn btn-primary mt-4" kode="{{ $rembuisment->id }}">Simpan Rembuisment</button>

                    </form>
                </div>
            </div>
        </div>

    </div>

    <div class="modal fade" id="imageModal" tabindex="-1" role="dialog" aria-labelledby="imageModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <img src="" alt="Large Image" id="modalImage" style="width: 100%;">
                </div>
            </div>
        </div>
    </div>
@endsection
