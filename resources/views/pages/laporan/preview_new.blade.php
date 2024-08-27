@php
    $configData = Helper::appClasses();
    $customizerHidden = 'customizer-hide';
@endphp
@extends('layouts/layoutMaster')

@section('title', 'Preview - Invoice')

@section('vendor-style')

    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/jquery.slick/1.6.0/slick.css" />
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/jquery.slick/1.6.0/slick-theme.css">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/flatpickr/flatpickr.css') }}" />
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

    <style>
        .image-link img {
            width: 100%;
            height: auto;
            border: 1px solid #ddd;
            /* Optional border for images */
            border-radius: 5px;
            /* Optional border radius for images */
            transition: transform 0.3s ease-in-out;
        }
    </style>

@endsection

@section('page-style')
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/pages/app-invoice.css') }}" />
@endsection

@section('page-script')
    <script src="{{ asset('js/laporan.js') }}"></script>
    <script src="{{ asset('js/master.js') }}"></script>
    <script src="{{ asset('assets/js/forms-pickers.js') }}"></script>
    <script src="{{ asset('assets/js/forms-selects.js') }}"></script>
    <script src="{{ asset('assets/js/form-layouts.js') }}"></script>
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
    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery.slick/1.6.0/slick.min.js"></script>
@endsection
@php
    $setting = App\Models\SettingPerusahaan::first();
@endphp
@section('content')

    <div class="row invoice-preview">
        <!-- Invoice -->
        <div class="col-xl-8 col-md-8 col-12 mb-md-0 mb-4">
            <div class="card invoice-preview-card">
                <div class="card-body">
                    <div class="d-flex justify-content-between flex-xl-row flex-md-column flex-sm-row flex-column">
                        <div class="mb-xl-0 pb-3">
                            <div class="d-flex svg-illustration align-items-center gap-2 mb-4">
                                <img src="/images/{{ $setting->logo_perusahaan }}" alt=""
                                    class="app-brand-logo demo" width="25">
                                {{-- <span class="app-brand-logo demo">@include('_partials.macros', [
                                    'width' => 25,
                                    'withbg' => 'var(--bs-primary)',
                                ])</span> --}}
                                <span class="h4 mb-0 app-brand-text fw-bold">{{ $setting->nama_perusahaan }} </span><span
                                    class="badge rounded-pill bg-secondary">{{ $data->status->nama_status }}</span>
                            </div>
                            <p class="mb-1">{{ $perusahaan->alamat }}</p>
                            {{-- <p class="mb-1">San Diego County, CA 91905, USA</p> --}}
                            <p class="mb-0">{{ $perusahaan->nomor_telepon }}</p>
                        </div>
                        <div>
                            <h4 class="fw-medium">No Perkara : {{ $data->kegiatan->no_perkara }}</h4>
                            <div class="mb-1">
                                <span>Tanggal :</span>
                                <span>{{ Helper::tglFormatIndo($data->created_at) }}</span>
                            </div>
                            {{-- <div>
                                <span>Date Due:</span>
                                <span>May 25, 2021</span>
                            </div> --}}
                        </div>
                    </div>
                </div>
                <hr class="my-0" />
                <div class="card-body">
                    <div class="d-flex justify-content-between flex-wrap">
                        <div class="my-3">
                            <h6 class="pb-2">Agenda : {{ $data->agenda }}:</h6>
                            <p class="mb-1">Tempat :{{ $data->tempat }}</p>
                            <p class="mb-1">Tanggal : {{ Helper::tglFormatIndo($data->created_at) }}</p>
                            <p class="mb-1">Uraian Kegiatan : {{ $data->uraian }}</p>

                            <p class="mb-1"><button class="btn btn-primary btn-sm"
                                    onclick="open_modal_dokumen('/file/{{ $data->file_dokumen_hasil }}')">Lihat
                                    Dokumen</button></p>
                            {{-- <p class="mb-0">peakyFBlinders@gmail.com</p> --}}
                        </div>

                        <div class="my-3">
                            <h6 class="pb-2">Pihak yang terlibat :</h6>
                            <table>
                                <tbody>
                                    @foreach ($laporan_pihak as $item)
                                        <tr>
                                            <td class="pe-3 fw-medium">
                                                {{ $item->name }}/{{ $item->jabatan }}/{{ $item->keterangan }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="my-3">
                            <h6 class="pb-2">Kuasa Hukum :</h6>
                            <table>
                                <tbody>
                                    @foreach ($laporan_kuasa_hukum as $item)
                                        <tr>
                                            <td class="pe-3 fw-medium">{{ $item->user->name }}</td>
                                            {{-- <td>$12,110.55</td> --}}
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="my-3">
                        <h6 class="pb-2">Foto Kegiatan:</h6>
                        <div class="image-slider">
                            @foreach ($foto_kegiatan as $item)
                                <a class="image-link" data-bs-toggle="modal" data-bs-target="#imageModal">
                                    <img height="150" class="col-md-3" src="/file/{{ $item->file }}"
                                        alt="">
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>


                <div class="card-body">
                    <div class="d-flex flex-wrap">
                        <h6 class="pb-2">Rembuisment :</h6>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-borderless m-0">
                            <thead class="border-top">
                                <tr>
                                    <th>Kegiatan</th>
                                    <th>Tempat</th>
                                    <th>Tanggal</th>
                                    <th>Biaya</th>
                                    <th>Bukti Bayar</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $total_biaya = 0; @endphp
                                @foreach ($data->rembuisment as $item)
                                    <tr>
                                        <td class="text-nowrap text-heading">{{ $item->nama_kegiatan }}</td>
                                        <td class="text-nowrap text-heading">{{ $item->tempat }}</td>
                                        <td>{{ Helper::tglFormatIndo($item->tanggal) }}</td>
                                        <td class="text-nowrap text-heading">{{ Helper::rupiah($item->biaya) }}</td>
                                        <td>
                                            <a class="image-link" data-bs-toggle="modal" data-bs-target="#imageModal" style="cursor: pointer">
                                                <i class='mdi mdi-eye-outline me-2'></i>
                                                <img style="display: none" src="/file/{{ $item->bukti_bayar }}" alt="" width="50">
                                            </a>

                                        </td>
                                        @php
                                            $total_biaya += $item->biaya;
                                        @endphp
                                    </tr>
                                @endforeach
                                {{-- <tr>
                                    <td class="text-nowrap text-heading">Vuexy Admin Template</td>
                                    <td class="text-nowrap">HTML Admin Template</td>
                                    <td>$32</td>
                                    <td>1</td>
                                    <td>$32.00</td>
                                </tr>
                                <tr>
                                    <td class="text-nowrap text-heading">Frest Admin Template</td>
                                    <td class="text-nowrap">Angular Admin Template</td>
                                    <td>$22</td>
                                    <td>1</td>
                                    <td>$22.00</td>
                                </tr>
                                <tr>
                                    <td class="text-nowrap text-heading">Apex Admin Template</td>
                                    <td class="text-nowrap">HTML Admin Template</td>
                                    <td>$17</td>
                                    <td>2</td>
                                    <td>$34.00</td>
                                </tr>
                                <tr class="border-bottom">
                                    <td class="text-nowrap text-heading">Robust Admin Template</td>
                                    <td class="text-nowrap">React Admin Template</td>
                                    <td>$66</td>
                                    <td>1</td>
                                    <td>$66.00</td>
                                </tr> --}}
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-md-0 mb-3">
                            <div>
                                <p class="mb-2">
                                    <span class="me-1 text-heading fw-medium">Ketua Tim:</span>
                                    <span>{{ $data->kegiatan->leader }}</span>
                                </p>
                                {{-- <span>Terima Kasih</span> --}}
                            </div>
                        </div>
                        <div class="col-md-6 d-flex justify-content-md-end mt-2">
                            <div class="invoice-calculations">
                                {{-- <div class="d-flex justify-content-between mb-2">
                                    <span class="w-px-150">Subtotal:</span>
                                    <h6 class="mb-0 pt-1">$1800</h6>
                                </div>
                                <div class="d-flex justify-content-between mb-2">
                                    <span class="w-px-150">Discount:</span>
                                    <h6 class="mb-0 pt-1">$28</h6>
                                </div>
                                <div class="d-flex justify-content-between mb-2">
                                    <span class="w-px-150">Tax:</span>
                                    <h6 class="mb-0 pt-1">21%</h6>
                                </div> --}}
                                <hr />
                                <div class="d-flex justify-content-between">
                                    <span class="w-px-150">Total:</span>
                                    <h6 class="mb-0 pt-1">{{ Helper::rupiah($total_biaya) }}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <hr class="my-0" />
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <span class="fw-medium text-heading">Note:</span>
                            <span>It was a pleasure working with you and your team. We hope you will keep us in mind for
                                future freelance
                                projects. Thank You!</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Invoice -->

        <!-- Invoice Actions -->
        <div class="col-xl-4 col-md-4 col-12 invoice-actions">
            @if ($data->id_status == 2 || $data->id_status == 4)
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Laporan</h5> <small class="text-body float-end"></small>
                    </div>
                    <div class="card-body">
                        @if (
                            $data->id_status == 2 &&
                                (auth()->user()->hasRole('owner') ||
                                    auth()->user()->hasRole('administrator')))
                            <form class="forms-approved mb-4" onsubmit="return false;" novalidate id="formapprove">
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
                        @endif
                        @if ($data->id_status == 4)
                            <a class="btn btn-primary d-grid w-100 mb-3" href="/send_laporan/{{ $data->id }}">
                                <span class="d-flex align-items-center justify-content-center text-nowrap"><i
                                        class="mdi mdi-send-outline scaleX-n1-rtl me-1"></i>Kirim Laporan</span>
                            </a>
                            <a href="/laporan/generate-pdf/{{ $data->id }}">
                                <button class="btn btn-outline-secondary d-grid w-100 mb-3">
                                    Download
                                </button>
                            </a>
                            {{-- <a class="btn btn-outline-secondary d-grid w-100 mb-3" target="_blank"
                            href="{{ url('app/invoice/print') }}">
                            Print
                        </a>
                        <a href="{{ url('app/invoice/edit') }}" class="btn btn-outline-secondary d-grid w-100 mb-3">
                            Edit Invoice
                        </a>
                        <button class="btn btn-success d-grid w-100" data-bs-toggle="offcanvas"
                            data-bs-target="#addPaymentOffcanvas">
                            <span class="d-flex align-items-center justify-content-center text-nowrap"><i
                                    class="mdi mdi-currency-usd me-1"></i>Add Payment</span>
                        </button> --}}
                        @endif

                    </div>
                </div>
            @endif

            <div class="card mt-2">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Riwayat Laporan</h5> <small class="text-body float-end"></small>
                </div>
                <div class="d-flex flex-column">
                    @foreach ($laporan_activity as $item)
                        @if ($item->user->role_name() == 'owner')
                            <div class="d-flex overflow-hidden p-2 gap-2">
                                <div class="user-avatar flex-shrink-0 me-3 align-self-center">
                                    <div class="avatar avatar-sm">
                                        <img src="{{ asset('assets/img/avatars/4.png') }}" alt="Avatar"
                                            class="rounded-circle" width="10">
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
                                            </p>
                                            <p>{{ Helper::tglFormatIndo($item->created_at) }}</p>
                                            <p>{{ $item->catatan }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="d-flex overflow-hidden p-2 gap-2">
                                <div class="chat-message-wrapper flex-grow-1">
                                    <div style="background-color: #fff;border: 1px solid #AAAAAA45">
                                        <p class="p-2 w-100 fw-bold"
                                            style="background-color: #DEE8F2;color: #2F294D;text-align: end">
                                            {{ $item->user->name }}</p>
                                        <div class="d-flex flex-column px-2">
                                            <p class="fw-bold" style="color: #2F294D">
                                                {{ $item->status->nama_status }} -
                                            </p>
                                            <p>{{ Helper::tglFormatIndo($item->created_at) }}</p>
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
        <!-- /Invoice Actions -->
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

    <!-- Offcanvas -->
    @include('_partials/_offcanvas/offcanvas-send-invoice')
    @include('_partials/_offcanvas/offcanvas-add-payment')
    <!-- /Offcanvas -->
@endsection
