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
            border: 1px solid #ddd; /* Optional border for images */
            border-radius: 5px; /* Optional border radius for images */
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
            <div>
              <h4 style="font-weight: bold;">{{ $setting->nama_perusahaan }}</h4>
              <span class="badge" style="background-color: #ccc; color: #333;">{{ $data->status->nama_status }}</span>
              <p>Office 149, 450 South Brand Brooklyn</p>
              <p>San Diego County, CA 91905, USA</p>
              <p>+1 (123) 456 7891, +44 (876) 543 2198</p>
            </div>
            <div>
              <h4 style="font-weight: normal;">No Perkara : {{ $data->kegiatan->no_perkara }}</h4>
              <div>
                <span>Tanggal :</span>
                <span>{{ Helper::tglFormatIndo($data->created_at) }}</span>
              </div>
            </div>
          </div>
          <hr />
          <div>
            <div style="margin-bottom: 15px;">
              <h6 style="font-weight: bold;">Agenda : {{ $data->agenda }}:</h6>
              <p>Tempat :{{ $data->tempat }}</p>
              <p>Tanggal : {{ Helper::tglFormatIndo($data->created_at) }}</p>
              <p>Uraian Kegiatan : {{ $data->uraian }}</p>
            </div>
            <div style="margin-bottom: 15px;">
              <h6 style="font-weight: bold;">Pihak yang terlibat :</h6>
              <table>
                <tbody>
                  @foreach ($laporan_pihak as $item)
                    <tr>
                      <td style="padding-right: 15px; font-weight: normal;">{{ $item->name }}/{{ $item->jabatan }}/{{ $item->keterangan }}</td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
            <div style="margin-bottom: 15px;">
              <h6 style="font-weight: bold;">Kuasa Hukum :</h6>
              <table>
                <tbody>
                  @foreach ($laporan_kuasa_hukum as $item)
                    <tr>
                      <td style="padding-right: 15px; font-weight: normal;">{{ $item->user->name }}</td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
          <hr />
          <div>
            <h6 style="font-weight: bold;">Rembuisment :</h6>
            <div class="table-responsive">
              <table style="border: none; margin: 0;">
                <thead>
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
                      <td style="text-align: left; font-weight: normal;">{{ $item->nama_kegiatan }}</td>
                      <td style="text-align: left; font-weight: normal;">{{ $item->tempat }}</td>
                      <td>{{ Helper::tglFormatIndo($item->tanggal) }}</td>
                      <td style="text-align: right; font-weight: normal;">{{ Helper::rupiah($item->biaya) }}</td>
                      <td>
                        <img src="/file/{{ $item->bukti_bayar }}" alt="" width="50">
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
          <div>
            <div style="display: flex; justify-content: space-between;">
              <div>
                
</body>
</html>
