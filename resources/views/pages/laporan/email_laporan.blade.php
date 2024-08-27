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
                                <img src="{{ $data['base'] }}/images/{{ $setting->logo_perusahaan }}" alt=""
                                    class="app-brand-logo demo" width="25">
                                {{ $setting->nama_perusahaan }}
                                <span class="badge"
                                    style="border-radius: 10px;padding: 3px 6px; font-size: 16px; font-weight: normal; margin-left:10px; background-color: #ccc; color: #333;">
                                    {{ $data['data']->status->nama_status }}
                                </span>
                            </h2>
                            <p>{{ $data['perusahaan']->alamat }}</p>
                            <p>{{ $data['perusahaan']->nomor_telepon }}</p>
                        </td>
                        <td style="text-align: right;vertical-align: top;">
                            <h4 style="font-weight: bold;">No Perkara : {{ $data['data']->kegiatan->no_perkara }}</h4>
                            <div>
                                <span>Tanggal :</span>
                                <span>{{ Helper::tglFormatIndo($data['data']->created_at) }}</span>
                            </div>
                        </td>
                    </tr>
                </table>
            </div>
            <hr />
            <div style="display: flex; justify-content: space-between">
                <table style="width: 100%">
                    <tr>
                        <td style="margin-bottom: 15px;vertical-align: top;">
                            <h4 style="font-weight: bold;">Agenda : {{ $data['data']->agenda }}</h4>
                            <p>Tempat : {{ $data['data']->tempat }}</p>
                            <p>Tanggal : {{ Helper::tglFormatIndo($data['data']->created_at) }}</p>
                            <p>Uraian Kegiatan :
                            <div>{{ $data['data']->uraian }}</div>
                            </p>
                        </td>
                        <td style="margin-bottom: 15px;vertical-align: top;">
                            <h4 style="font-weight: bold;">Pihak yang terlibat :</h4>
                            @foreach ($data['laporan_pihak'] as $item)
                                <div style="font-weight: normal">
                                    {{ $item->name }}/{{ $item->jabatan }}/{{ $item->keterangan }}</div>
                            @endforeach
                        </td>
                        <td style="margin-bottom: 15px;vertical-align: top;">
                            <h4 style="font-weight: bold;">Kuasa Hukum :</h4>
                            @foreach ($data['laporan_kuasa_hukum'] as $item)
                                <div style="font-weight: normal;">{{ $item->user->name }}</div>
                            @endforeach
                        </td>
                    </tr>
                </table>
            </div>
            <div style="">
                <a href="{{ $data['base'] }}/file/{{ $data['data']->file_dokumen_hasil }}"
                    style="cursor: pointer"><button style="padding: 5px 5px;">Lihat Dokumen</button></a>
            </div>
            <hr />
        </div>

        <hr class="my-0" />

    </div>

</body>

</html>
