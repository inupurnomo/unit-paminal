@php
    $configData = Helper::appClasses();
    $customizerHidden = 'customizer-hide';
@endphp
@php
    $configData = Helper::appClasses();
    $customizerHidden = 'customizer-hide';
    $setting = App\Models\SettingPerusahaan::first();
@endphp

<!DOCTYPE html>
<html lang="en">

<head>

    {{-- <link rel="stylesheet" href="/assets/vendor/css{{ $configData['rtlSupport'] }}/core.css"
    class="{{ $configData['hasCustomizer'] ? 'template-customizer-core-css' : '' }}" /> --}}
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
    @php
        $setting = App\Models\SettingPerusahaan::first();
    @endphp
    {{-- @section('content') --}}
</head>

<body>
    <div style="min-height: 100vh;">
        <div style="border: 1px solid #ddd; padding: 15px;">
            <div style="display: flex; justify-content: space-between;">
                <table style="width: 100%;">
                    <tr>
                        <td style="vertical-align: top;">
                            <h2 style="font-weight: bold;">
                                <img src="{{ $base }}/images/{{ $setting->logo_perusahaan }}" alt=""
                                    style="width: 60px; margin-right: 5px;" width="25">
                                {{ $setting->nama_perusahaan }}
                                <span class="badge"
                                    style="border-radius: 10px;padding: 3px 6px; font-size: 16px; font-weight: normal; margin-left:10px; background-color: #ccc; color: #333;">
                                    {{ $data->status->nama_status }}
                                </span>
                            </h2>
                            <p>{{ $perusahaan->alamat }}</p>
                            <p>{{ $perusahaan->nomor_telepon }}</p>
                        </td>
                        <td style="text-align: right;vertical-align: top;">
                            <h4 style="font-weight: bold;">No Perkara : {{ $data->kegiatan->no_perkara }}</h4>
                            <div>
                                <span>Tanggal :</span>
                                <span>{{ Helper::tglFormatIndo($data->created_at) }}</span>
                            </div>
                        </td>
                    </tr>
                </table>
            </div>
            <hr />
            <table style="width:40%;">
                <tr>
                    <td>Tempat</td>
                    <td>:</td>
                    <td>{{ $data->tempat }}</td>
                </tr>
                <tr>
                    <td>Tanggal</td>
                    <td>:</td>
                    <td></td>
                </tr>
                <tr>
                    <td>Perkara yang Ditangani</td>
                    <td>:</td>
                    <td></td>
                </tr>
                <tr>
                    <td>Agenda</td>
                    <td>:</td>
                    <td>
                        {{ $data->agenda }} </td>
                </tr>
                <tr>
                    <td>Kuasa Hukum yang Bertugas</td>
                    <td>:</td>
                    <td>
                        @foreach ($laporan_kuasa_hukum as $item)
                            <div style="font-weight: normal;">{{ $item->user->name }}</div>
                        @endforeach
                    </td>
                </tr>
            </table>
            <ol type="1">
                @foreach ($lapoaran_uraian as $key => $value)
                    <li>
                        {{ $value->uraian_kegiatan }}
                        @if ($value->is_sidang == 1)
                            <p>Adapun pihak-pihak yang hadir adalah sebagai berikut:</p>
                            <ul>
                                @foreach ($laporan_pihak as $item)
                                    <li>
                                        <div style="font-weight: normal">
                                            {{ $item->name }} Sebagai
                                            {{ $item->jabatan }} - {{ $item->keterangan }}</div>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </li>
                @endforeach
            </ol>
            <p>Demikian laporan ini kami sampaikan, atas perhatiannya kami sampaikan terima kasih.</p>
            <div style="display: flex; justify-content: space-between">
                <table style="width: 100%">
                    <tr>
                        <td style="margin-bottom: 15px;vertical-align: top;">
                            <h4 style="font-weight: bold;">Agenda : {{ $data->agenda }}</h4>
                            <p>Tempat : {{ $data->tempat }}</p>
                            <p>Tanggal : {{ Helper::tglFormatIndo($data->created_at) }}</p>
                            <p>Uraian Kegiatan :
                            <div>{{ $data->uraian }}</div>
                            </p>
                        </td>
                        <td style="margin-bottom: 15px;vertical-align: top;">
                            <h4 style="font-weight: bold;">Pihak yang terlibat :</h4>
                            @foreach ($laporan_pihak as $item)
                                <div style="font-weight: normal">
                                    {{ $item->name }}/{{ $item->jabatan }}/{{ $item->keterangan }}</div>
                            @endforeach
                        </td>
                        <td style="margin-bottom: 15px;vertical-align: top;">
                            <h4 style="font-weight: bold;">Kuasa Hukum :</h4>
                            @foreach ($laporan_kuasa_hukum as $item)
                                <div style="font-weight: normal;">{{ $item->user->name }}</div>
                            @endforeach
                        </td>
                    </tr>
                </table>
            </div>
            <div style="margin-top: 15px;">
                <span style="font-weight: bold">Link Dokumen Hasil :</span>
                {{ $base }}/file/{{ $data->file_dokumen_hasil }}
            </div>
            <hr />
            <div>
                <h3 style="font-weight: bold;">Rembuisment :</h3>
                <div style="">
                    <table style="border: none; margin: 0; width: 100%;">
                        <thead>
                            <tr style="text-align: left;">
                                <th>No</th>
                                <th>Kegiatan</th>
                                <th>Tempat</th>
                                <th>Tanggal</th>
                                <th>Biaya</th>
                                <th style="text-align: center">Bukti Bayar</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $total_biaya = 0;
                                $no = 1;
                            @endphp
                            @foreach ($data->rembuisment as $item)
                                <tr>
                                    <td style="text-align: left">{{ $no++ }}</td>
                                    <td style="text-align: left; font-weight: normal;">{{ $item->nama_kegiatan }}</td>
                                    <td style="text-align: left; font-weight: normal;">{{ $item->tempat }}</td>
                                    <td style="text-align: left; font-weight: normal;">
                                        {{ Helper::tglFormatIndo($item->tanggal) }}</td>
                                    <td style="text-align: left; font-weight: normal;">
                                        {{ Helper::rupiah($item->biaya) }}</td>
                                    <td style="text-align: center; font-weight: normal;">
                                        <img src="{{ $base }}/file/{{ $item->bukti_bayar }}" alt=""
                                            width="50" style="width: 200px;">
                                    </td>
                                    @php
                                        $total_biaya += $item->biaya;
                                    @endphp
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6 mb-md-0 mb-3">
                    <div>
                        <p class="mb-2">
                            <span style="font-weight: bold">Ketua Tim:</span>
                            <span>{{ ucfirst($data->kegiatan->leader) }}</span>
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
                        <div style="text-align: right;">
                            <span class="w-px-150" style="font-weight: bold">Total:</span>
                            <span class="mb-0 pt-1">{{ Helper::rupiah($total_biaya) }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <hr class="my-0" />
        <div class="card-body">
            <div class="row">
                <div class="col-12">
                    <span class="fw-medium text-heading" style="font-weight: bold">Note:</span>
                    <span>It was a pleasure working with you and your team. We hope you will keep us in mind for
                        future freelance
                        projects. Thank You!</span>
                </div>
            </div>
        </div>
    </div>

</body>

</html>
