@extends('layouts/layoutMaster')

@section('title', ' Tambah Laporan - Forms')

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
    <script src="{{ asset('assets/vendor/libs/bootstrap-select/bootstrap-select.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/flatpickr/flatpickr.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/bootstrap-datepicker/bootstrap-datepicker.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/bootstrap-daterangepicker/bootstrap-daterangepicker.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/jquery-timepicker/jquery-timepicker.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/pickr/pickr.js') }}"></script>
@endsection

@section('page-script')
    <script src="{{ asset('js/laporan.js') }}"></script>
    <script src="{{ asset('js/master.js') }}"></script>
    <script src="{{ asset('assets/js/forms-pickers.js') }}"></script>
    <script src="{{ asset('assets/js/forms-selects.js') }}"></script>
    <script src="{{ asset('assets/js/form-layouts.js') }}"></script>

@endsection

@section('content')
    <h4 class="py-3 mb-4">
        <span class="text-muted fw-light">Laporan /</span> Tambah Laporan
    </h4>
    <!-- Basic Layout -->
    <div class="row">
        <div class="col-xl">
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Form Laporan</h5> <small class="text-body float-end"></small>
                </div>
                <div class="card-body">
                    <form class="needs-validation" novalidate id="formcreatelaporan" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-lg-6 md-12">
                                <div class="form-floating form-floating-outline mb-4">
                                    <select id="jenis_laporan" class="select2 form-select" name="jenis_laporan"
                                        data-allow-clear="true" required>
                                        <option value="">Pilih Jenis Laporan</option>
                                        <option value="Sidang">Sidang</option>
                                        <option value="Non Sidang">Non Sidang</option>
                                    </select>
                                    <label for="jenis_laporan">Jenis Laporan</label>
                                </div>
                            </div>

                            <div class="col-lg-6 md-12">
                                <div class="form-floating form-floating-outline mb-4">
                                    <select id="kegiatan" class="select2 form-select" name="kegiatan"
                                        data-allow-clear="true" required>
                                    </select>
                                    <label for="kegiatan">Pilih Perkara</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12 md-12">
                                <div class="form-floating form-floating-outline mb-4">
                                    <input type="text" class="form-control" id="judul" name="judul"
                                        placeholder="judul.." required />
                                    <label for="judul">Judul Laporan</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6 md-12">
                                <div class="form-floating form-floating-outline mb-4">
                                    <input type="text" class="form-control" id="agenda" name="agenda"
                                        placeholder="Tempat.." required />
                                    <label for="agenda">Agenda</label>
                                </div>
                            </div>

                            <div class="col-lg-6 md-12">
                                <div class="form-floating form-floating-outline mb-4">
                                    <input type="text" class="form-control" id="tempat" name="tempat"
                                        placeholder="Tempat.." required />
                                    <label for="tempat">Tempat</label>
                                </div>
                            </div>
                        </div>
                        <div class="div-sidang-time row" id="div-sidang-time">
                        </div>
                        <input type="hidden" value="1" id="jumlahuraian">
                        <h5 class="mb-3">Kegiatan 1</h5> <small class="text-body float-end"></small>
                        <div class="row">
                            <div class="col-lg-6 md-12">
                                <div class="form-floating form-floating-outline">
                                    <input type="text" name="tanggal[1]" class="form-control flatpickr-date"
                                        placeholder="YYYY-MM-DD" required />
                                    <label for="flatpickr-date">Tanggal</label>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-12">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="is_sidang" id="flexRadioDefault1"
                                        value="1" required>
                                    <label class="form-check-label" for="flexRadioDefault1">
                                        Tandai Sebagai Kegiatan Sidang
                                    </label>
                                </div>
                            </div>
                            <div class="col-12 md-12 mt-4">
                                <div class="form-floating form-floating-outline mb-4">
                                    <textarea id="uraian_laporan" class="form-control h-px-200" name="uraian_laporan[1]" placeholder="Uraian..."
                                        rows="200" cols="20" required></textarea>
                                    <label for="uraian_laporan">Uraian hasil Kegiatan</label>
                                </div>
                            </div>
                        </div>
                        <div id="uraian_tambah">

                        </div>
                        <div class="row">
                            <button type="button" class="btn btn-primary mb-3 pl-3"
                                style="width: fit-content;margin-left: 13px !important" id="tambah_uraian">Tambah
                                Uraian Kegiatan</button>
                        </div>

                        <div class="row">

                            <div class="col-md-12 select2-primary mb-4">
                                <div class="form-floating form-floating-outline">
                                    <select id="kuasa_hukum" name="kuasa_hukum[]" class="select2 form-select" multiple>
                                        {{-- @foreach ($kuasa_hukum as $value)
                                            <option value="{{ $value->id }}">{{ $value->name }}</option>
                                        @endforeach --}}
                                    </select>
                                    <label for="kuasa_hukum">Kuasa Hukum yang Bertugas</label>
                                </div>
                            </div>

                            <input type="hidden" value="1" id="jumlahPihak">
                            <label>Pihak yang terlibat</label>
                            <div id="dynamicInputContainer" class="d-flex flex-column">

                                <div class="div-nonsidang">
                                    <div class="d-flex gap-2 mb-3" style="align-items: center !important">
                                        <div class="col-md-5"><input type="text" class="form-control" name="name[1]"
                                                placeholder="Name"></div>
                                        <div class="col-md-2"><input type="text" class="form-control"
                                                name="jabatan[1]" placeholder="Peran/Jabatan"></div>
                                        <div class="col-md-2">
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="description[1]"
                                                    value="yes" id="yesRadio1" checked>
                                                <label class="form-check-label" for="yesRadio1">Hadir</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="description[1]"
                                                    value="no" id="noRadio1">
                                                <label class="form-check-label" for="noRadio1">Tidak Hadir</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="div-sidang">
                                </div>

                            </div>

                            <button type="button" class="btn btn-primary mb-3 pl-3"
                                style="width: fit-content;margin-left: 13px !important" id="tambah">Tambah
                                pihak</button>

                            <div class="col-lg-12 mb-4">
                                <label for="dokumenHasil" class="form-label">Dokumen Hasil</label>
                                <input class="form-control" type="file" id="dokumenHasil" name="dokumen_hasil"
                                    required>
                            </div>

                            <div class="col-lg-12">
                                <label for="fotoKegiatan" class="form-label">Foto Kegiatan</label>
                                <input class="form-control" type="file" id="fotoKegiatan" name="foto_kegiatan[]"
                                    required multiple>
                            </div>

                        </div>

                        <button type="submit" class="btn btn-primary mt-4">Simpan Draft</button>

                    </form>
                </div>
            </div>
        </div>

    </div>
@endsection
