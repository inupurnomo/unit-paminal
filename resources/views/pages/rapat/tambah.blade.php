@extends('layouts/layoutMaster')

@section('title', ' Tambah Rapat - Forms')

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
    <script src="{{ asset('js/rapat.js') }}"></script>
    <script src="{{ asset('js/master.js') }}"></script>
    <script src="{{ asset('assets/js/forms-pickers.js') }}"></script>
    <script src="{{ asset('assets/js/forms-selects.js') }}"></script>
    <script src="{{ asset('assets/js/form-layouts.js') }}"></script>

@endsection

@section('content')
    <h4 class="py-3 mb-4">
        <span class="text-muted fw-light">Rapat /</span> Tambah Rapat
    </h4>
    <!-- Basic Layout -->
    <div class="row">
        <div class="col-xl">
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Form Rapat</h5> <small class="text-body float-end"></small>
                </div>
                <div class="card-body">
                    <form class="needs-validation" novalidate id="formcreatelaporan" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-lg-6 md-12">
                                <div class="form-floating form-floating-outline mb-4">
                                    <select id="kepailitan" class="select2 form-select" name="kepailitan"
                                        data-allow-clear="true" required>
                                        <option value="">Select Kepailitan</option>
                                        @foreach ($kepailitan as $item)
                                            <option value="{{ $item->id }}">{{ $item->nama_kegiatan }}</option>
                                        @endforeach
                                    </select>
                                    <label for="kepailitan">Pilih Kepailitan</label>
                                </div>
                            </div>

                            <div class="col-lg-6 md-12">
                                <div class="form-floating form-floating-outline mb-4">
                                    <input type="text" class="form-control" id="no_perkara" name="no_perkara"
                                        placeholder="no_perkara.." readonly />
                                    <label for="no_perkara">No Perkara Kepailitan</label>
                                </div>
                            </div>

                            <div class="col-lg-4 md-12">
                                <div class="form-floating form-floating-outline mb-4">
                                    <select id="jenis_rapat" class="select2 form-select" name="jenis_rapat"
                                        data-allow-clear="true" required>
                                        <option value="">Select Jenis Rapat</option>
                                        <option value="Kreditor">Kreditor</option>
                                        <option value="Non Kreditor">Non Kreditor</option>
                                    </select>
                                    <label for="jenis_rapat">Jenis Rapat</label>
                                </div>
                            </div>
                            <div class="col-lg-4 md-12">
                                <div class="form-floating form-floating-outline mb-4">
                                    <input type="text" class="form-control" id="banyak_rapat" readonly />
                                    <label for="tempat">Rapat Ke :</label>
                                </div>
                            </div>

                            <div class="col-lg-4 md-12">
                                <div class="form-floating form-floating-outline mb-4">
                                    <input type="text" class="form-control" id="judul" name="judul"
                                        placeholder="judul.." required />
                                    <label for="judul">Judul Rapat</label>
                                </div>
                            </div>


                            {{-- <div class="form-floating form-floating-outline mb-4">
                                <textarea id="agenda" class="form-control h-px-200" name="agenda" placeholder="Agenda..." rows="200"
                                    cols="20"></textarea>
                                <label for="agenda">Agenda</label>
                            </div> --}}
                            <div class="col-lg-6 md-12">
                                <div class="form-floating form-floating-outline mb-4">
                                    <input type="text" class="form-control" id="agenda" name="agenda"
                                        placeholder="Agenda.." required />
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

                            <div class="col-lg-6 md-12">
                                <div class="form-floating form-floating-outline">
                                    <input type="text" name="tanggal" class="form-control" placeholder="YYYY-MM-DD"
                                        id="flatpickr-date" />
                                    <label for="flatpickr-date">Tanggal</label>
                                </div>
                            </div>
                            <div class="div-kreditor-time row mt-4">

                            </div>

                            <div class="form-floating form-floating-outline mb-4">
                                <textarea id="uraian_rapat" class="form-control h-px-200" name="uraian_rapat" placeholder="Uraian..."
                                    rows="200" cols="20"></textarea>
                                <label for="uraian_rapat">Uraian hasil Kegiatan</label>
                            </div>
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

                                <div class="div-nonkreditor">
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

                                <div class="div-kreditor">


                                </div>

                            </div>

                            <button type="button" class="btn btn-primary mb-3 pl-3"
                                style="width: fit-content;margin-left: 13px !important" id="tambah">Tambah
                                pihak</button>

                            <div class="col-lg-12 mb-4">
                                <label for="dokumenHasil" class="form-label">Dokumen Hasil</label>
                                <input class="form-control" type="file" id="dokumenHasil" name="dokumen_hasil">
                            </div>

                            <div class="col-lg-12">
                                <label for="fotoKegiatan" class="form-label">Foto Kegiatan</label>
                                <input class="form-control" type="file" id="fotoKegiatan" name="foto_kegiatan[]"
                                    multiple>
                            </div>

                        </div>

                        <button type="submit" class="btn btn-primary mt-4">Simpan Draft</button>

                    </form>
                </div>
            </div>
        </div>

    </div>
@endsection
