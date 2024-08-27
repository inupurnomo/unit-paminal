@extends('layouts/layoutMaster')

@section('title', ' Preview Laporan - Forms')

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
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/pages/app-chat.css') }}" />

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
    <script src="{{ asset('js/laporan.js') }}"></script>
    <script src="{{ asset('js/master.js') }}"></script>
    <script src="{{ asset('assets/js/forms-pickers.js') }}"></script>
    <script src="{{ asset('assets/js/forms-selects.js') }}"></script>
    <script src="{{ asset('assets/js/forms-tagify.js') }}"></script>
    <script src="{{ asset('assets/js/form-layouts.js') }}"></script>
@endsection
@php
    $setting = App\Models\SettingPerusahaan::first();
@endphp

@section('content')

    <h4 class="py-3 mb-4">
        <span class="text-muted fw-light">Laporan /</span> Detail Laporan

    </h4>
    <img src="/images/{{ $setting->logo_perusahaan }}" alt="" class="app-brand-logo demo" width="25">
    <!-- Basic Layout -->
    <div class="row">
        <div class="col-xxl">
            <div class="card mb-4">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h5 class="mb-0">Detail Laporan</h5> <small class="text-muted float-end"></small>
                </div>
                <div class="card-body">
                    <div class="row mb-2">
                        <label class="col-sm-3" for="basic-default-name">Jenis Laporan</label>
                        <label class="col-sm-1" for="basic-default-name" style="width: fit-content">:</label>
                        <label class="col-sm-6 justify-start" for="basic-default-name">{{ $data->jenis_laporan }}</label>
                    </div>
                    <div class="row mb-2">
                        <label class="col-sm-3" for="basic-default-name">Kegiatan</label>
                        <label class="col-sm-1" for="basic-default-name" style="width: fit-content">:</label>
                        <label class="col-sm-6 justify-start" for="basic-default-name">{{ $data->kegiatan->nama }}</label>
                    </div>
                    <div class="row mb-2">
                        <label class="col-sm-3" for="basic-default-name">Pemimpin Kegiatan</label>
                        <label class="col-sm-1" for="basic-default-name" style="width: fit-content">:</label>
                        <label class="col-sm-6 justify-start"
                            for="basic-default-name">{{ $data->kegiatan->leader }}</label>
                    </div>
                    <div class="row mb-2">
                        <label class="col-sm-3" for="basic-default-name">Kuasa Hukum yang ditugaskan</label>
                        <label class="col-sm-1" for="basic-default-name" style="width: fit-content">:</label>
                        <label class="col-sm-6 justify-start" for="basic-default-name">
                            @foreach ($laporan_kuasa_hukum as $item)
                                - {{ $item->user->name }} <br>
                            @endforeach
                        </label>
                    </div>
                    <div class="row mb-2">
                        <label class="col-sm-3" for="basic-default-name">Agenda</label>
                        <label class="col-sm-1" for="basic-default-name" style="width: fit-content">:</label>
                        <label class="col-sm-6 justify-start" for="basic-default-name">{{ $data->agenda }}</label>
                    </div>
                    <div class="row mb-2">
                        <label class="col-sm-3" for="basic-default-name">Tempat</label>
                        <label class="col-sm-1" for="basic-default-name" style="width: fit-content">:</label>
                        <label class="col-sm-6 justify-start" for="basic-default-name">{{ $data->tempat }}</label>
                    </div>
                    <div class="row mb-2">
                        <label class="col-sm-3" for="basic-default-name">Tanggal</label>
                        <label class="col-sm-1" for="basic-default-name" style="width: fit-content">:</label>
                        <label class="col-sm-6 justify-start" for="basic-default-name">{{ $data->tanggal }}</label>
                    </div>
                    <div class="row mb-2">
                        <label class="col-sm-3" for="basic-default-name">Uraian</label>
                        <label class="col-sm-1" for="basic-default-name" style="width: fit-content">:</label>
                        <label class="col-sm-6 justify-start" for="basic-default-name">{{ $data->uraian }}</label>
                    </div>
                    <div class="row mb-2">
                        <label class="col-sm-3" for="basic-default-name">File Dokumen</label>
                        <label class="col-sm-1" for="basic-default-name" style="width: fit-content">:</label>
                        <label class="col-sm-6 justify-start" for="basic-default-name"><a
                                href="/file/{{ $data->file_dokumen_hasil }}"> {{ $data->file_dokumen_hasil }}
                            </a></label>
                    </div>
                    <div class="row mb-2">
                        <label class="col-sm-3" for="basic-default-name">Foto Kegiatan</label>
                        <label class="col-sm-1" for="basic-default-name" style="width: fit-content">:</label>
                        @if (count($foto_kegiatan) > 0)
                            <label class="col-sm-6 justify-start" for="basic-default-name">
                                @foreach ($foto_kegiatan as $item)
                                    <a href="/file/{{ $item->file }}"> {{ $item->file }} </a>
                                @endforeach
                            </label>
                        @else
                            <label class="col-sm-6 justify-start" for="basic-default-name"> - </label>
                        @endif
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="col-xxl overflow-auto" style="max-height: 500px">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Riwayat Laporan</h5> <small class="text-body float-end"></small>
                    </div>
                    <div class="d-flex flex-column">
                        @foreach ($laporan_activity as $item)
                            @if ($item->user->role_name() == 'owner')
                                <div class="d-flex overflow-hidden p-4 gap-2">
                                    <div class="user-avatar flex-shrink-0 me-3 align-self-center">
                                        <div class="avatar avatar-sm">
                                            <img src="{{ asset('assets/img/avatars/4.png') }}" alt="Avatar"
                                                class="rounded-circle">
                                        </div>
                                    </div>
                                    <div class="chat-message-wrapper flex-grow-1">
                                        <div style="background-color: #fff;border: 1px solid #AAAAAA45">
                                            <p class="p-2 w-100 fw-bold"
                                                style="background-color: #DEE8F2;color: #2F294D;text-align: end">
                                                {{ $item->user->name }}</p>
                                            <div class="d-flex flex-column px-2">
                                                <p class="fw-bold" style="color: #2F294D">
                                                    {{ $item->status->nama_status }} -
                                                    {{ Helper::tglFormatIndo($item->created_at) }}</p>
                                                <p>{{ $item->catatan }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <div class="d-flex overflow-hidden p-4 gap-4">
                                    <div class="chat-message-wrapper flex-grow-1">
                                        <div style="background-color: #fff;border: 1px solid #AAAAAA45">
                                            <p class="p-2 w-100 fw-bold"
                                                style="background-color: #DEE8F2;color: #2F294D;text-align: end">
                                                {{ $item->user->name }}</p>
                                            <div class="d-flex flex-column px-2">
                                                <p class="fw-bold" style="color: #2F294D">
                                                    {{ $item->status->nama_status }} -
                                                    {{ Helper::tglFormatIndo($item->created_at) }}</p>
                                                <p>{{ $item->catatan }}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="user-avatar flex-shrink-0 me-3 align-self-center">
                                        <div class="avatar avatar-sm">
                                            <img src="{{ asset('assets/img/avatars/4.png') }}" alt="Avatar"
                                                class="rounded-circle">
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach



                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="row">
                <div class="col-xxl">
                    <div class="card mb-4">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">Update Laporan</h5> <small class="text-body float-end"></small>
                        </div>
                        <div class="card-body">
                            <form class="forms-approved" onsubmit="return false;" novalidate id="formapprove">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="col-lg-12 sm-12">
                                        <div class="form-floating form-floating-outline">
                                            <select id="status" class="select2 form-select" name="status"
                                                data-allow-clear="true" required>
                                                <option value="">Select status laporan</option>
                                                <option value="3">Revisi</option>
                                                <option value="4">Approved</option>
                                            </select>
                                            <label for="status">Update Status Laporan</label>
                                        </div>
                                    </div>

                                    <div id="catatan" class="form-floating form-floating-outline mt-4 d-none">
                                        <textarea class="form-control h-px-200 " name="catatan" placeholder="Uraian..." rows="200" cols="20"></textarea>
                                        <label for="catatan">Catatan Revisi</label>
                                    </div>

                                </div>
                                <button id="submitButton" type="submit" kode="{{ $data->id }}"
                                    class="btn btn-primary mt-4">Update Laporan</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
