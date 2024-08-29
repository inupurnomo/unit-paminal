@extends('layouts/layoutMaster')

@php
    $title = $dumas->pelapor . ' - ' . $dumas->satker;
    $tab = request('tab');
@endphp
@section('title', $title)

@section('vendor-style')
{{-- <link rel="stylesheet" href="{{asset('assets/vendor/libs/apex-charts/apex-charts.css')}}" /> --}}
<link rel="stylesheet" href="{{asset('assets/vendor/libs/select2/select2.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/flatpickr/flatpickr.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/bootstrap-datepicker/bootstrap-datepicker.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/bootstrap-daterangepicker/bootstrap-daterangepicker.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/jquery-timepicker/jquery-timepicker.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/pickr/pickr-themes.css')}}" />

<link rel="stylesheet" href="{{asset('assets/vendor/libs/select2/select2.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/tagify/tagify.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/bootstrap-select/bootstrap-select.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/typeahead-js/typeahead.css')}}" />
<link rel="stylesheet" href="{{ asset('assets/vendor/libs/sweetalert2/sweetalert2.css') }}" />

@endsection

@section('page-style')
<!-- Page -->
{{-- <link rel="stylesheet" href="{{asset('assets/vendor/css/pages/cards-analytics.css')}}"> --}}
<style>
  .checkbox-lg .form-check-input{
  top: .8rem;
  scale: 1.4;
  margin-right: 0.7rem;
  }

  .checkbox-lg .form-check-label {
  padding-top: 13px;
  }

  .checkbox-xl .form-check-input {
  top: 1.2rem;
  scale: 1.7;
  margin-right: 0.8rem;
  }

  .checkbox-xl .form-check-label {
  padding-top: 19px;
  font-size: 16px;
  }
</style>
@endsection

@section('vendor-script')
{{-- <script src="{{asset('assets/vendor/libs/apex-charts/apexcharts.js')}}"></script> --}}
<script src="{{asset('assets/vendor/libs/autosize/autosize.js')}}"></script>
<script src="{{asset('assets/vendor/libs/cleavejs/cleave.js')}}"></script>
<script src="{{asset('assets/vendor/libs/cleavejs/cleave-phone.js')}}"></script>
<script src="{{asset('assets/vendor/libs/bootstrap-maxlength/bootstrap-maxlength.js')}}"></script>
<script src="{{asset('assets/vendor/libs/jquery-repeater/jquery-repeater.js')}}"></script>
<script src="{{asset('assets/vendor/libs/moment/moment.js')}}"></script>
{{-- <script src="{{asset('assets/vendor/libs/flatpickr/flatpickr.js')}}"></script> --}}
<script src="{{asset('assets/vendor/libs/bootstrap-datepicker/bootstrap-datepicker.js')}}"></script>
<script src="{{asset('assets/vendor/libs/bootstrap-daterangepicker/bootstrap-daterangepicker.js')}}"></script>
<script src="{{asset('assets/vendor/libs/jquery-timepicker/jquery-timepicker.js')}}"></script>
<script src="{{asset('assets/vendor/libs/pickr/pickr.js')}}"></script>

<script src="{{asset('assets/vendor/libs/select2/select2.js')}}"></script>
<script src="{{asset('assets/vendor/libs/tagify/tagify.js')}}"></script>
<script src="{{asset('assets/vendor/libs/bootstrap-select/bootstrap-select.js')}}"></script>
<script src="{{asset('assets/vendor/libs/typeahead-js/typeahead.js')}}"></script>
<script src="{{asset('assets/vendor/libs/bloodhound/bloodhound.js')}}"></script>
<script src="{{ asset('assets/vendor/libs/sweetalert2/sweetalert2.js') }}"></script>
@endsection

@section('page-script')
{{-- <script src="{{asset('assets/js/cards-analytics.js')}}"></script> --}}
<script src="{{asset('assets/js/forms-extras.js')}}"></script>
{{-- <script src="{{asset('assets/js/forms-pickers.js')}}"></script> --}}

<script src="{{asset('assets/js/forms-selects.js')}}"></script>
{{-- <script src="{{asset('assets/js/forms-tagify.js')}}"></script> --}}
<script src="{{asset('assets/js/forms-typeahead.js')}}"></script>

<script>
  $(document).ready(function () {
    var no = 1;
    var noBukti = 1;
    var noSprin = 1;
    $(document).on('click', '#tambah_saksi', function () {
      no++;
      var inputGroup = $(
        `
        <div class="saksi-add row mt-2">
          <div class="row">
            <div class="col-sm-12 col-md-6">
              <div class="form-floating form-floating-outline mb-2">
                <input type="text" name="witness[]" class="form-control" id="bs-validation-name" placeholder="Nama Saksi" required="">
                <label for="bs-validation-name">Nama Saksi</label>
                <div class="valid-feedback"> Looks good! </div>
                <div class="invalid-feedback"> Please enter the witness. </div>
              </div>
            </div>
            <div class="col-sm-12 col-md-6">
              <div class="form-floating form-floating-outline mb-2">
                <input type="text" name="witness_phone[]" class="form-control" id="bs-validation-name" placeholder="Nomor Telephone" required="" oninput="this.value = this.value.replace(/[^0-9+]/g, '');" maxlength="15">
                <label for="bs-validation-name">Nomor Telephone Saksi</label>
                <div class="valid-feedback"> Looks good! </div>
                <div class="invalid-feedback"> Please enter the phone number. </div>
              </div>
            </div>
            <div class="col-sm-12 col-md-6">
              <div class="form-floating form-floating-outline mb-2">
                <input type="date" name="witness_date[]" class="form-control" id="bs-validation-name" placeholder="Tanggal Klarifikasi" required="">
                <label for="bs-validation-name">Tanggal Klarifikasi</label>
                <div class="valid-feedback"> Looks good! </div>
                <div class="invalid-feedback"> Please enter the date. </div>
              </div>
            </div>
          </div>
          <div class="col-2">
            <button type="button" class="btn btn-danger remove_attach" title='Hapus'><i class="mdi mdi-delete me-1"></i></button>
          </div>
        </div>`
      );

      $('#saksi').append(inputGroup);
    });
    $(document).on('click', '#tambah_bukti', function () {
      noBukti++;
      var inputGroup = $(
        `
        <div class="bukti-add row mt-2">
          <div class="row">
            <div class="form-floating form-floating-outline col-sm-12 col-md-4">
              <select id="select2Basic" name="evidence_type[]" class="select2 form-select form-select-lg" data-allow-clear="true" required="">
                <option value="">Pilih Type</option>
                @foreach ($evidence_type as $item)
                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                @endforeach
              </select>
              <label for="select2Basic">Pilih Type</label>
            </div>
            <div class="col-sm-12 col-md-8">
              <div class="form-floating form-floating-outline mb-2">
                <input type="text" name="evidence_name[]" class="form-control" id="bs-validation-name" placeholder="Nama Bukti" required=""">
                <label for="bs-validation-name">Nama Bukti</label>
                <div class="valid-feedback"> Looks good! </div>
                <div class="invalid-feedback"> Please enter the name of evidence. </div>
              </div>
            </div>
            <div class="col-sm-12 col-md-12">
              <div class="form-floating form-floating-outline mb-2">
                <input type="file" name="evidence_file[]" class="form-control" id="bs-validation-name" required="">
                <label for="bs-validation-name">Pilih File</label>
                <div class="valid-feedback"> Looks good! </div>
                <div class="invalid-feedback"> Please choose file. </div>
              </div>
            </div>
          </div>
          <div class="col-2">
            <button type="button" class="btn btn-danger remove_attach_bukti" title='Hapus'><i class="mdi mdi-delete me-1"></i></button>
          </div>
        </div>`
      );

      $('#bukti').append(inputGroup);
    });
    $(document).on('click', '#tambah_sprin', function () {
      noSprin++;
      var inputGroupSprin = $(
        `
        <div class="sprin-add mt-2">
          <div class="row">
            <div class="col-sm-12 col-md-6">
              <div class="form-floating form-floating-outline mb-4">
                <input type="file" name="sprin_file" class="form-control" id="bs-validation-name" required="" accept="application/pdf">
                <label for="bs-validation-name">Dokumen SPRIN</label>
                <div class="valid-feedback"> Looks good! </div>
                <div class="invalid-feedback"> Please select ND file. </div>
              </div>
            </div>
            <div class="col-sm-12 col-md-6">
              <div class="form-floating form-floating-outline mb-4">
                <input type="date" name="sprin_date" class="form-control" id="bs-validation-date" required="">
                <label for="bs-validation-date">Berlaku Hingga</label>
                <div class="valid-feedback"> Looks good! </div>
                <div class="invalid-feedback"> Please select date. </div>
              </div>
            </div>
          </div> 
          <div class="col-2">
            <button type="button" class="btn btn-danger remove_attach_sprin" title='Hapus'><i class="mdi mdi-delete me-1"></i></button>
          </div>
        </div>`
      );

      $('#sprinRow').append(inputGroupSprin);
      $('#sprinBtn').hide();
    });

    $(document).on('click', '.remove_attach', function (e) {
      if (e.type == 'click') {
        if (no > 1) {
          $(this).parents('.saksi-add').fadeOut();
          $(this).parents('.saksi-add').remove();
          no--;
        }
      }
    });
    $(document).on('click', '.remove_attach_bukti', function (e) {
      if (e.type == 'click') {
        if (noBukti > 1) {
          $(this).parents('.bukti-add').fadeOut();
          $(this).parents('.bukti-add').remove();
          noBukti--;
        }
      }
    });
    $(document).on('click', '.remove_attach_sprin', function (e) {
      if (e.type == 'click') {
        if (noSprin > 1) {
          $(this).parents('.sprin-add').fadeOut();
          $(this).parents('.sprin-add').remove();
          noSprin--;
        }
      }
      $('#sprinBtn').show();
    });
  });

  function handleClick(checkbox) {
    var isChecked = $(checkbox).prop('checked')
    var table = $(checkbox).data('table');
    var id = $(checkbox).data('id');

    $.ajax({
      data: {
        table: table,
        id: id
      },
      url: "".concat(baseUrl, "dumas/arsip/") + id,
      type: 'POST',
      success: function success(response) {
        var iconType;
        if (response.status == 200) {
          iconType = 'success';
        } else {
          iconType = 'error';
          checkbox.checked = !isChecked;
        }
        // sweetalert
        Swal.fire({
          icon: response.status == 200 ? 'success' : 'error',
          title: response.status == 200 ? 'Success' : 'Error',
          text: response.message,
          customClass: {
            confirmButton: 'btn btn-success'
          }
        })
      },
      error: function error(err) {
        // Revert checkbox state to its previous status if AJAX fails
        checkbox.checked = !isChecked;
        Swal.fire({
          title: 'Error!',
          text: 'Internal server Error',
          icon: 'error',
          customClass: {
            confirmButton: 'btn btn-success'
          }
        })
      }
    });
  };

</script>

<script>
function addParamToUrl(param, value) {
    // Mendapatkan URL saat ini
    let currentUrl = window.location.href;
    
    // Membuat URL baru dengan parameter
    let newUrl = new URL(currentUrl);
    newUrl.searchParams.set(param, value); // Menambahkan atau mengganti parameter
    
    // Memperbarui URL tanpa reload halaman
    window.history.pushState({}, '', newUrl);
}
</script>
@endsection

@section('content')

<h4 class="py-3 mb-4"><span class="text-muted fw-light">Dumas /</span> {{ $dumas->pelapor }} - {{ $dumas->satker }}
</h4>

<div class="row">
  <div class="col">
    <div class="card mb-3">
      <div class="card-header p-0">
        <div class="nav-align-top">
          <ul class="nav nav-tabs" role="tablist">
            <li class="nav-item" role="presentation">
              <button onclick="addParamToUrl('tab', 'home')" type="button" class="nav-link d-flex flex-column gap-1 {{ $tab == 'home' || $tab == '' ? 'active' : '' }} waves-effect" role="tab" data-bs-toggle="tab" data-bs-target="#navs-home-card" aria-controls="navs-home-card" aria-selected="true"><i class="tf-icons mdi mdi-home-outline mdi-20px me-1"></i> Home</button>
            </li>
            <li class="nav-item" role="presentation">
              <button onclick="addParamToUrl('tab', 'documents')" type="button" class="nav-link d-flex flex-column gap-1 {{ $tab == 'documents' ? 'active' : '' }} waves-effect" role="tab" data-bs-toggle="tab" data-bs-target="#navs-documents-card" aria-controls="navs-documents-card" aria-selected="false" tabindex="-1"><i class="tf-icons mdi mdi-file-document-outline mdi-20px me-1"></i> Documents</button>
            </li>
          <span class="tab-slider" style="left: 0px; width: 91.4062px; bottom: 0px;"></span></ul>
        </div>
      </div>
      <div class="card-body px-0 py-0">
        <div class="tab-content pb-0">
          <div class="tab-pane fade  {{ $tab == 'home' || $tab == '' ? 'show active' : '' }}" id="navs-home-card" role="tabpanel">
            <div class="row gy-4">
              <!-- Total Transactions & Report Chart -->
              <div class="col-xl-8">
                <div class="h-100">
                  <div class="card-body">
                    <div class="col-md mb-4 mb-md-2">
                      <div class="accordion mt-3" id="accordionExample">
                        <div class="accordion-item">
                          <h2 class="accordion-header" id="headingOne">
                            <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#accordionOne" aria-expanded="false" aria-controls="accordionOne">
                              Lihat Detail
                            </button>
                          </h2>
                          <div id="accordionOne" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                              <table class="table table-hover">
                                <tbody>
                                  <tr>
                                    <td>Nota Dinas</td>
                                    <td>:</td>
                                    <td><a href="{{ $dumas->nd->file }}" target="_blank" rel="noopener noreferrer" title="Lihat Nota Dinas">{{ $dumas->nd->number ?? '-' }}</a></td>
                                  </tr>
                                  <tr>
                                    <td>Tanggal Diterima</td>
                                    <td>:</td>
                                    <td>{{ \Carbon\Carbon::parse($dumas->tanggal)->translatedFormat('l, d F Y') }}</td>
                                  </tr>
                                  <tr>
                                    <td>Pelapor</td>
                                    <td>:</td>
                                    <td>{{ $dumas->pelapor }}</td>
                                  </tr>
                                  <tr>
                                    <td>Terlapor</td>
                                    <td>:</td>
                                    <td>
                                      @foreach ($dumas->terlapor as $t)
                                      <div>{{ $t->name }}</div>                    
                                      @endforeach
                                    </td>
                                  </tr>
                                  <tr>
                                    <td>Satker</td>
                                    <td>:</td>
                                    <td>{{ $dumas->satker }}</td>
                                  </tr>
                                  <tr>
                                    <td>Perihal</td>
                                    <td>:</td>
                                    <td>{{ $dumas->perihal }}</td>
                                  </tr>
                                  <tr>
                                    <td>Dugaan</td>
                                    <td>:</td>
                                    <td>{{ $dumas->dugaan }}</td>
                                  </tr>
                                  <tr>
                                    <td>Wujud Perbuatan</td>
                                    <td>:</td>
                                    <td>{{ $dumas->wujud_perbuatan }}</td>
                                  </tr>
                                </tbody>
                              </table>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <hr class="mb-2" />
                    <form action="{{ route('dumas.transaction', $dumas->id) }}" method="POST" enctype="multipart/form-data">
                      @csrf
                      @method('POST')
                      <input type="text" name="dumas_id" id="dumas_id" value="{{ $dumas->id }}" hidden>
                      <div class="form-check checkbox-xl mb-2">
                        <input class="form-check-input" type="checkbox" value="true" name="sp2hp2" id="sp2hp2" {{ $dumas->sphp && $dumas->sphp->is_done == 1 ? 'checked' : '' }} />
                        <label class="form-check-label" for="sp2hp2">
                          SP2 HP2
                        </label>
                      </div>
                      <div class="form-check checkbox-xl mb-2">
                        <input class="form-check-input" type="checkbox" value="true" name="klarifikasi" id="klarifikasi" {{ $dumas->klarifikasi && $dumas->klarifikasi->is_done == 1 ? 'checked' : '' }} />
                        <label class="form-check-label" for="klarifikasi">
                          Jadwal Klarifikasi Pelapor
                        </label>
                      </div>
                      <div class="form-check checkbox-xl mb-2">
                        <input class="form-check-input" type="checkbox" value="true" name="sprin_lidik" id="sprin_lidik" {{ $dumas->sprinlidik && $dumas->sprinlidik->is_done == 1 ? 'checked' : '' }} />
                        <label class="form-check-label" for="sprin_lidik">
                          Pengajuan Sprin Lidik
                        </label>
                      </div>
                      <div class="form-check checkbox-xl mb-2">
                        <input class="form-check-input" type="checkbox" value="true" name="pulbaket" id="pulbaket" {{ $dumas->pulbaket && $dumas->pulbaket->is_done == 1 ? 'checked' : '' }} />
                        <label class="form-check-label" for="pulbaket">
                          Pulbaket
                        </label>
                      </div>
                      <div class="row">
                        <div class="col ml-6">
                          <div class="form-check checkbox-xl mb-2">
                            <input class="form-check-input" type="checkbox" value="true" name="riksa_saksi" id="riksa_saksi" {{ $dumas->riksasaksi && $dumas->riksasaksi->is_done == 1 ? 'checked' : '' }} />
                            <label class="form-check-label" for="riksa_saksi">
                              Jadwal Riksa Saksi
                            </label>
                          </div>
                          <div class="ml-6">
                            @foreach ($dumas->witness as $w)                    
                            <div class="form-check checkbox-xl mb-2">
                              <input class="form-check-input" type="text" value="{{$w->id}}" name="witness_id[]" hidden />
                              <input class="form-check-input" type="checkbox" value="true" name='witness_value{{$w->id}}' id='witness{{$w->id}}' {{ $w->is_done == 1 ? 'checked' : ''  }}/>
                              <label class="form-check-label" for='witness{{$w->id}}'>
                                {{ $w->name }} - {{ $w->telephone }} <span class="badge bg-label-info">
                                  {{ \Carbon\Carbon::parse($w->date)->translatedFormat('l, d F Y') }}
                                </span>
                              </label>
                            </div>
                            @endforeach
                            <hr />
                            <div class="mt-2" id="saksi">
                              {{-- <h6>Saksi</h6> --}}
                            </div>
                            <div class="col-12 mt-2">
                              <button type="button" class="btn btn-sm btn-primary" data-repeater-create id="tambah_saksi"><i class="mdi mdi-plus me-1"></i> Tambah Saksi</button>
                            </div>
                          </div>
                          <div class="form-check checkbox-xl mb-2">
                            <input class="form-check-input" type="checkbox" value="true" name="bukti_pendukung" id="bukti_pendukung" {{ $dumas->bukti_pendukung && $dumas->bukti_pendukung->is_done == 1 ? 'checked' : '' }} />
                            <label class="form-check-label" for="bukti_pendukung">
                              Bukti Pendukung
                            </label>
                          </div>
                          <div class="ml-6">
                            @foreach ($dumas->evidences as $e)                    
                            <div class="form-check checkbox-xl mb-2">
                              <input class="form-check-input" type="text" value="{{$e->id}}" name="evidence_id[]" hidden />
                              <input class="form-check-input" type="checkbox" value="true" name='evidence_value{{$e->id}}' id='evidence{{$e->id}}' {{ $e->is_done == 1 ? 'checked' : '' }} />
                              <label class="form-check-label" for='evidence{{$e->id}}'>
                                {{ $e->name }} - <a href="{{ $e->file }}" target="_blank" title="Lihat Bukti"><sm>Lihat Bukti<sm></a>
                              </label>
                            </div>
                            @endforeach
                            <hr />
                            <div class="mt-2" id="bukti">
                              {{-- <h6>Bukti</h6> --}}
                            </div>
                            <div class="col-12 mt-2">
                              <button type="button" class="btn btn-sm btn-primary" data-repeater-create id="tambah_bukti"><i class="mdi mdi-plus me-1"></i> Tambah Bukti</button>
                            </div>
                          </div>
                          <div class="form-check checkbox-xl mb-2">
                            <input class="form-check-input" type="checkbox" value="true" name="klarifikasi_terlapor" id="klarifikasi_terlapor" {{ $dumas->klarifikasi_terlapor && $dumas->klarifikasi_terlapor->is_done == 1 ? 'checked' : '' }} />
                            <label class="form-check-label" for="klarifikasi_terlapor">
                              Klarifikasi Terlapor
                            </label>
                          </div>
                          <div class="ml-6">
                            @foreach ($dumas->terlapor as $t)                    
                            <div class="form-check checkbox-xl mb-3">
                              <input class="form-check-input" type="text" value="{{$t->id}}" name="terlapor_id[]" hidden />
                              <input class="form-check-input" type="checkbox" value="true" name='terlapor_value{{$t->id}}' id='terlapor{{$t->id}}' {{ $t->is_done == 1 ? 'checked' : '' }} />
                              <label class="form-check-label" for='terlapor{{$t->id}}'>
                                {{ $t->name }} @if ($t->date)    
                                <span class="badge bg-label-info">
                                  {{ \Carbon\Carbon::parse($t->date)->translatedFormat('l, d F Y') }}
                                </span>
                                @endif
                              </label>
                            </div>
                            @if (!$t->date)
                            <div class="col-sm-12 col-md-6">
                              <div class="form-floating form-floating-outline">
                                <input type="date" name='terlapor_date{{$t->id}}' class="form-control" id='terlapor_date{{$t->id}}' placeholder="Tanggal Klarifikasi">
                                <label for='terlapor_date{{$t->id}}'>Tanggal Klarifikasi</label>
                                <div class="valid-feedback"> Looks good! </div>
                                <div class="invalid-feedback"> Please enter the date. </div>
                              </div>
                            </div>
                            @endif
                            @endforeach
                          </div>
                          <div class="form-check checkbox-xl mb-2">
                            <input class="form-check-input" type="checkbox" value="true" name="lhp" id="lhp"  {{ $dumas->lhp && $dumas->lhp->is_done == 1 ? 'checked' : '' }} />
                            <label class="form-check-label" for="lhp">
                              LHP
                            </label>
                          </div>
                          <div class="row">
                            <div class="col ml-6">
                              <div class="form-check checkbox-xl mb-2">
                                <input class="form-check-input" type="checkbox" value="true" name="pengajuan_gelar" id="pengajuan_gelar" {{ $dumas->pengajuan_gelar && $dumas->pengajuan_gelar->is_done == 1 ? 'checked' : '' }} />
                                <label class="form-check-label" for="pengajuan_gelar">
                                  Pengajuan Gelar
                                </label>
                              </div>
                              <div class="form-check checkbox-xl mb-2">
                                <input class="form-check-input" type="checkbox" value="true" name="nd_gelar" id="nd_gelar" {{ $dumas->nd_gelar && $dumas->nd_gelar->is_done == 1 ? 'checked' : '' }} />
                                <label class="form-check-label" for="nd_gelar">
                                  ND Gelar
                                </label>
                              </div>
                            </div>
                          </div>
                          <div class="form-check checkbox-xl mb-2">
                            <input class="form-check-input" type="checkbox" value="true" name="lhg" id="lhg" {{ $dumas->lhg && $dumas->lhg->is_done == 1 ? 'checked' : '' }} />
                            <label class="form-check-label" for="lhg">
                              LHG
                            </label>
                          </div>
            
                          <div class="row">
                            <div class="col ml-6">
                              <div class="form-check checkbox-xl mb-2">
                                <input class="form-check-input" type="checkbox" value="true" name="nd_kadiv" id="nd_kadiv" {{ $dumas->nd_kadiv && $dumas->nd_kadiv->is_done == 1 ? 'checked' : '' }} />
                                <label class="form-check-label" for="nd_kadiv">
                                  ND Kadiv
                                </label>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="form-check checkbox-xl mb-2">
                        <input class="form-check-input" type="checkbox" value="true" id="sp2hp2_second" name="sp2hp2_second"  {{ $dumas->sphp_second && $dumas->sphp_second->is_done == 1 ? 'checked' : '' }} />
                        <label class="form-check-label" for="sp2hp2_second">
                          SP2 HP2
                        </label>
                      </div>
                      <div class="row mt-4">
                        <div class="col">
                          <button class="btn btn-primary w-100" type="submit">Simpan</button>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
              <!--/ Total Transactions & Report Chart -->
              <!-- Timeline Basic-->
              <div class="col-xl-4 mb-4 mb-xl-0">
                <div class="card">
                  <h5 class="card-header">Progress</h5>
                  <div class="card-body">
                    <div class="row mb-4">
                      <form action="{{ route('progress.add', $dumas->id) }}" method="POST">
                        @csrf
                        @method('POST')
                        <textarea id="autosize-demo" rows="3" name="progress_value" class="form-control" style="overflow: hidden; overflow-wrap: break-word; resize: none; text-align: start; height: 82px;" required></textarea>
                        <button class="btn btn-primary w-full mt-2">Tambah Progress</button>
                      </form>
                    </div>
                    <ul class="timeline mb-0">
                      @foreach ($dumas->progress as $p)                
                      <li class="timeline-item timeline-item-transparent">
                        <span class="timeline-point timeline-point-primary"></span>
                        <div class="timeline-event">
                          <div class="timeline-header border-bottom">
                            {{-- <h6 class="mb-0">Get on the flight</h6> --}}
                            <span class="text-muted">
                              {{ \Carbon\Carbon::parse($p->updated_at)->translatedFormat('l, d F Y') }}
                            </span>
                            <div class="my-1">
                              <span class="text-muted">
                                <a type="button" class="btn btn-xs btn-danger" title='Hapus' href="javascript:void(0);" onclick="event.preventDefault(); document.getElementById('delete-form{{$p->id}}').submit();">-</a>
                                <form method="POST" id='delete-form{{$p->id}}' action="{{ route('progress.destroy', $p->id) }}">
                                  @csrf
                                  @method('DELETE')
                                </form>
                              </span>
                            </div>
                          </div>
                          <div class="d-flex justify-content-between flex-wrap">
                            <div>
                              <span>{{ $p->value }}</span>
                            </div>
                          </div>
                        </div>
                      </li>
                      @endforeach
                    </ul>
                  </div>
                </div>
              </div>
              <!-- /Timeline Basic -->
            </div>
          </div>
          <div class="tab-pane fade  {{ $tab == 'documents' ? 'show active' : '' }}" id="navs-documents-card" role="tabpanel">
            <h4 class="card-title">Documents</h4>
            <div class="divider">
              <div class="divider-text">
                <i class="mdi mdi-star-outline"></i>
              </div>
            </div>

            <form action="{{ route('document.store', $dumas->id) }}" method="POST" enctype="multipart/form-data">
              @csrf
              @method('POST')
              <h5>Dokumen Nota Dinas</h5>
              @if (!$dumas->nd->file)  
              <div class="form-floating form-floating-outline mb-4">
                <input type="file" name="nd_file" class="form-control" id="bs-validation-name" required="" accept="application/pdf">
                <label for="bs-validation-name">Dokumen ND</label>
                <div class="valid-feedback"> Looks good! </div>
                <div class="invalid-feedback"> Please select ND file. </div>
              </div>
              @else
              <div class="d-flex justify-content-between mb-4">
                <div class=""><a href="{{$dumas->nd->file}}" target="_blank" rel="noopener noreferrer" title="Lihat Nota Dinas">{{ $dumas->nd->number }}</a></div>
                <div class="">
                  <div class="form-check form-switch mb-2">
                    <input class="form-check-input" type="checkbox" id="doc_nd" data-bs-toggle="tooltip" data-bs-placement="top" title="Arsipkan Dokumen" data-table="nd" data-id="{{ $dumas->nd->id }}" {{ $dumas->nd->is_archived == 1 ? 'checked' : '' }} onclick="handleClick(this)">
                    <label class="form-check-label" for="doc_nd">Arsip</label>
                  </div>
                </div>
              </div>
              @endif

              <div class="divider">
                <div class="divider-text">
                  SPRIN
                </div>
              </div>

              <h5>Dokumen SPRIN</h5>
              @if ($dumas->nd && count($dumas->sprin) === 0)
              <div class="row">
                <div class="col-sm-12 col-md-6">
                  <div class="form-floating form-floating-outline mb-4">
                    <input type="file" name="sprin_file" class="form-control" id="bs-validation-name" required="" accept="application/pdf">
                    <label for="bs-validation-name">Dokumen SPRIN</label>
                    <div class="valid-feedback"> Looks good! </div>
                    <div class="invalid-feedback"> Please select ND file. </div>
                  </div>
                </div>
                <div class="col-sm-12 col-md-6">
                  <div class="form-floating form-floating-outline mb-4">
                    <input type="date" name="sprin_date" class="form-control" id="bs-validation-date" required="">
                    <label for="bs-validation-date">Berlaku Hingga</label>
                    <div class="valid-feedback"> Looks good! </div>
                    <div class="invalid-feedback"> Please select date. </div>
                  </div>
                </div>
              </div>          
              @else
              <div class="mb-4">
                @if ($dumas->sprin)
                @foreach ($dumas->sprin as $s)
                <div class="d-flex justify-content-between">
                  <div class="mb-2">
                    <div><a href="{{$s->file}}" target="_blank" rel="noopener noreferrer" title="Lihat SPRIN">Lihat Dokumen</a></div>
                    <div>Berlaku hingga {{ $s->valid_until }}</div>
                  </div>
                  <div class="d-grid">
                    <div class="form-check form-switch mb-2">
                      <input class="form-check-input" type="checkbox" id="doc_sprin" data-bs-toggle="tooltip" data-bs-placement="top" title="Arsipkan Dokumen" data-table="sprin" data-id="{{ $s->id }}" {{ $s->is_archived == 1 ? 'checked' : '' }} onclick="handleClick(this)">
                      <label class="form-check-label" for="doc_sprin">Arsip</label>
                    </div>
                  </div>                             
                </div>
                @endforeach
                @php
                  $targetDate = \Carbon\Carbon::parse($s->valid_until);
                  $today = \Carbon\Carbon::today();
                @endphp
                @if ($today->greaterThanOrEqualTo($targetDate))
                <div id="sprinRow">
                </div>
                <div id="sprinBtn" class="mt-2">
                  <button class="btn btn-primary" role="button" type="button" id="tambah_sprin">Perpanjangan SPRIN</button>
                </div>
                @endif
                @else
                <div>Upload Dokumen Nota Dinas terlebih dahulu!</div>
                @endif
              </div>
              @endif

              <div class="divider">
                <div class="divider-text">
                  Saksi
                </div>
              </div>

              <h5>Dokumen BAI Saksi</h5>
              @if (count($dumas->sprin) !== 0 && !$dumas->bai_saksi)
              <div class="form-floating form-floating-outline mb-4">
                <input type="file" name="bai_saksi" class="form-control" id="bs-validation-name" required="" accept="application/pdf">
                <label for="bs-validation-name">Dokumen BAI SaksiI</label>
                <div class="valid-feedback"> Looks good! </div>
                <div class="invalid-feedback"> Please select BAI file. </div>
              </div>
              @else
              <div class="d-flex justify-content-between mb-4">
                @if ($dumas->bai_saksi)
                <div><a href="{{$dumas->bai_saksi->file}}" target="_blank" rel="noopener noreferrer" title="Lihat Dokumen">Lihat Dokumen</a></div>
                <div class="d-grid">
                  <div class="form-check form-switch mb-2">
                    <input class="form-check-input" type="checkbox" id="doc_bai_saksi" data-bs-toggle="tooltip" data-bs-placement="top" title="Arsipkan Dokumen" data-table="bai_saksi" data-id="{{ $dumas->bai_saksi->id }}" {{ $dumas->bai_saksi->is_archived == 1 ? 'checked' : '' }} onclick="handleClick(this)">
                    <label class="form-check-label" for="doc_bai_saksi">Arsip</label>
                  </div>
                </div>  
                @else
                <div class="text-danger">Upload Dokumen SPRIN terlebih dahulu!</div>
                @endif
              </div>
              @endif

              <h5>Dokumen Surat Pernyataan Saksi</h5>
              @if ($dumas->bai_saksi && !$dumas->sp_saksi)
              <div class="form-floating form-floating-outline mb-4">
                <input type="file" name="sp_saksi" class="form-control" id="bs-validation-name" required="" accept="application/pdf">
                <label for="bs-validation-name">Dokumen Surat Pernyataan</label>
                <div class="valid-feedback"> Looks good! </div>
                <div class="invalid-feedback"> Please select SP file. </div>
              </div>
              @else
              <div class="d-flex justify-content-between mb-4">
                @if ($dumas->sp_saksi)
                <div><a href="{{$dumas->sp_saksi->file}}" target="_blank" rel="noopener noreferrer" title="Lihat Dokumen">Lihat Dokumen</a></div>
                <div class="d-grid">
                  <div class="form-check form-switch mb-2">
                    <input class="form-check-input" type="checkbox" id="doc_sp_saksi" data-bs-toggle="tooltip" data-bs-placement="top" title="Arsipkan Dokumen" data-table="sp_saksi" data-id="{{ $dumas->sp_saksi->id }}" {{ $dumas->sp_saksi->is_archived == 1 ? 'checked' : '' }} onclick="handleClick(this)">
                    <label class="form-check-label" for="doc_sp_saksi">Arsip</label>
                  </div>
                </div> 
                @else
                <div class="text-danger">Upload Dokumen BAI Saksi terlebih dahulu!</div>
                @endif
              </div>
              @endif

              <div class="divider">
                <div class="divider-text">
                  Terlapor
                </div>
              </div>

              <h5>Dokumen BAI Terlapor</h5>
              @if ($dumas->sp_saksi && !$dumas->bai_terlapor)
              <div class="form-floating form-floating-outline mb-4">
                <input type="file" name="bai_terlapor" class="form-control" id="bs-validation-name" required="" accept="application/pdf">
                <label for="bs-validation-name">Dokumen BAI Terlapor</label>
                <div class="valid-feedback"> Looks good! </div>
                <div class="invalid-feedback"> Please select BAI file. </div>
              </div>
              @else
              <div class="d-flex justify-content-between mb-4">
                @if ($dumas->bai_terlapor)
                <div><a href="{{$dumas->bai_terlapor->file}}" target="_blank" rel="noopener noreferrer" title="Lihat Dokumen">Lihat Dokumen</a></div>
                <div class="d-grid">
                  <div class="form-check form-switch mb-2">
                    <input class="form-check-input" type="checkbox" id="doc_bai_terlapor" data-bs-toggle="tooltip" data-bs-placement="top" title="Arsipkan Dokumen" data-table="bai_terlapor" data-id="{{ $dumas->bai_terlapor->id }}" {{ $dumas->bai_terlapor->is_archived == 1 ? 'checked' : '' }} onclick="handleClick(this)">
                    <label class="form-check-label" for="doc_bai_terlapor">Arsip</label>
                  </div>
                </div> 
                @else
                <div class="text-danger">Upload Dokumen Pernyataan Saksi terlebih dahulu!</div>
                @endif
              </div>
              @endif

              <h5>Dokumen Surat Pernyataan Terlapor</h5>
              @if ($dumas->bai_terlapor && !$dumas->sp_terlapor)
              <div class="form-floating form-floating-outline mb-4">
                <input type="file" name="sp_terlapor" class="form-control" id="bs-validation-name" required="" accept="application/pdf">
                <label for="bs-validation-name">Dokumen BAI</label>
                <div class="valid-feedback"> Looks good! </div>
                <div class="invalid-feedback"> Please select SP file. </div>
              </div>
              @else
              <div class="d-flex justify-content-between mb-4">
                @if ($dumas->sp_terlapor)
                <div><a href="{{$dumas->sp_terlapor->file}}" target="_blank" rel="noopener noreferrer" title="Lihat Dokumen">Lihat Dokumen</a></div>
                <div class="d-grid">
                  <div class="form-check form-switch mb-2">
                    <input class="form-check-input" type="checkbox" id="doc_sp_terlapor" data-bs-toggle="tooltip" data-bs-placement="top" title="Arsipkan Dokumen" data-table="sp_terlapor" data-id="{{ $dumas->sp_terlapor->id }}" {{ $dumas->sp_terlapor->is_archived == 1 ? 'checked' : '' }} onclick="handleClick(this)">
                    <label class="form-check-label" for="doc_sp_terlapor">Arsip</label>
                  </div>
                </div> 
                @else
                <div class="text-danger">Upload Dokumen BAI terlebih dahulu!</div>
                @endif
              </div>
              @endif

              <div class="divider">
                <div class="divider-text">
                  LHP
                </div>
              </div>

              <h5>Dokumen ND LHP</h5>
              @if ($dumas->sp_terlapor && !$dumas->nd_lhp)
              <div class="form-floating form-floating-outline mb-4">
                <input type="file" name="nd_lhp" class="form-control" id="bs-validation-name" required="" accept="application/pdf">
                <label for="bs-validation-name">Dokumen ND LHP</label>
                <div class="valid-feedback"> Looks good! </div>
                <div class="invalid-feedback"> Please select SP file. </div>
              </div>
              @else
              <div class="d-flex justify-content-between mb-4">
                @if ($dumas->nd_lhp)
                <div><a href="{{$dumas->nd_lhp->file}}" target="_blank" rel="noopener noreferrer" title="Lihat Dokumen">Lihat Dokumen</a></div>
                <div class="d-grid">
                  <div class="form-check form-switch mb-2">
                    <input class="form-check-input" type="checkbox" id="nd_lhp" data-bs-toggle="tooltip" data-bs-placement="top" title="Arsipkan Dokumen" data-table="lhp" data-id="{{ $dumas->nd_lhp->id }}" {{ $dumas->nd_lhp->is_archived == 1 ? 'checked' : '' }} onclick="handleClick(this)">
                    <label class="form-check-label" for="nd_lhp">Arsip</label>
                  </div>
                </div> 
                @else
                <div class="text-danger">Upload Dokumen Surat Penyataan Terlapor terlebih dahulu!</div>
                @endif
              </div>
              @endif

              <div class="divider">
                <div class="divider-text">
                  LHG
                </div>
              </div>

              <h5>Dokumen ND LHG</h5>
              @if ($dumas->nd_lhp && !$dumas->nd_lhg)
              <div class="form-floating form-floating-outline mb-4">
                <input type="file" name="nd_lhg" class="form-control" id="bs-validation-name" required="" accept="application/pdf">
                <label for="bs-validation-name">Dokumen ND LHG</label>
                <div class="valid-feedback"> Looks good! </div>
                <div class="invalid-feedback"> Please select SP file. </div>
              </div>
              @else
              <div class="d-flex justify-content-between mb-4">
                @if ($dumas->nd_lhg)
                <div><a href="{{$dumas->nd_lhg->file}}" target="_blank" rel="noopener noreferrer" title="Lihat Dokumen">Lihat Dokumen</a></div>
                <div class="d-grid">
                  <div class="form-check form-switch mb-2">
                    <input class="form-check-input" type="checkbox" id="nd_lhg" data-bs-toggle="tooltip" data-bs-placement="top" title="Arsipkan Dokumen" data-table="lhg" data-id="{{ $dumas->nd_lhg->id }}" {{ $dumas->nd_lhg->is_archived == 1 ? 'checked' : '' }} onclick="handleClick(this)">
                    <label class="form-check-label" for="nd_lhg">Arsip</label>
                  </div>
                </div> 
                @else
                <div class="text-danger">Upload Dokumen ND LHP terlebih dahulu!</div>
                @endif
              </div>
              @endif

              <div class="row mt-4">
                <div class="col">
                  <button class="btn btn-primary w-100" type="submit">Simpan</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
      <div class="card-footer">
        <div class="d-flex justify-content-between align-items-center">
          <div>
            Penanggung Jawab : <a href="javascript:void(0);" class=""><strong>{{ $dumas->pj->name ?? '-' }}</strong></a>
          </div>
          @if ($dumas->is_done == 0)              
          <div>
            <button type="button" class="btn btn-danger waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#endDumas">Tandai Selesai</button>
          </div>
          @endif
        </div>
      </div>
    </div>
  </div>
</div>

<!-- endDumas Modal -->
<div class="modal fade" id="endDumas" data-bs-backdrop="static" tabindex="-1">
  <div class="modal-dialog">
      <form class="modal-content" action="{{ route('dumas.end', $dumas->id )}}" method="POST">
        @csrf
        @method('POST')
          <div class="modal-header">
              <h4 class="modal-title" id="backDropModalTitle">Tandai Selesai</h4>
              <button type="button" class="btn-close" data-bs-dismiss="modal"
                  aria-label="Close"></button>
          </div>
          <div class="modal-body">
              <div class="row">
                  <div class="col mb-2 mt-2">
                    <div class="form-floating form-floating-outline">
                      <select id="select2Basic" name="status_id" class="select2 form-select form-select-lg" data-allow-clear="true" required="">
                        <option value="">Status</option>
                        @foreach ($dumas_status as $status)
                            <option value="{{ $status->id }}">{{ $status->name }}</option>
                        @endforeach
                      </select>
                      <label for="select2Basic">Status</label>
                    </div>
                  </div>
              </div>
              <div class="row g-2">
                  <div class="col mb-2">
                      <div class="form-floating form-floating-outline">
                          <textarea id="autosize-demo" rows="3" name="catatan" class="form-control" style="overflow: hidden; overflow-wrap: break-word; resize: none; text-align: start; height: 82px;" required></textarea>
                          <label for="autosize-demo">Catatan</label>
                      </div>
                  </div>
              </div>
          </div>
          <div class="modal-footer">
              <button type="button" class="btn btn-outline-secondary"
                  data-bs-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-danger">Selesai</button>
          </div>
      </form>
  </div>
</div>
@endsection
