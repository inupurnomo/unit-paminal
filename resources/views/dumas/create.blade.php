
@extends('layouts/layoutMaster')

@section('title', 'Dumas Baru - Dumas')

@section('vendor-style')
<link rel="stylesheet" href="{{asset('assets/vendor/libs/flatpickr/flatpickr.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/bootstrap-datepicker/bootstrap-datepicker.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/bootstrap-daterangepicker/bootstrap-daterangepicker.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/jquery-timepicker/jquery-timepicker.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/pickr/pickr-themes.css')}}" />

<link rel="stylesheet" href="{{asset('assets/vendor/libs/select2/select2.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/tagify/tagify.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/bootstrap-select/bootstrap-select.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/typeahead-js/typeahead.css')}}" />
@endsection

@section('vendor-script')
<script src="{{asset('assets/vendor/libs/moment/moment.js')}}"></script>
<script src="{{asset('assets/vendor/libs/flatpickr/flatpickr.js')}}"></script>
<script src="{{asset('assets/vendor/libs/bootstrap-datepicker/bootstrap-datepicker.js')}}"></script>
<script src="{{asset('assets/vendor/libs/bootstrap-daterangepicker/bootstrap-daterangepicker.js')}}"></script>
<script src="{{asset('assets/vendor/libs/jquery-timepicker/jquery-timepicker.js')}}"></script>
<script src="{{asset('assets/vendor/libs/pickr/pickr.js')}}"></script>

<script src="{{asset('assets/vendor/libs/select2/select2.js')}}"></script>
<script src="{{asset('assets/vendor/libs/tagify/tagify.js')}}"></script>
<script src="{{asset('assets/vendor/libs/bootstrap-select/bootstrap-select.js')}}"></script>
<script src="{{asset('assets/vendor/libs/typeahead-js/typeahead.js')}}"></script>
<script src="{{asset('assets/vendor/libs/bloodhound/bloodhound.js')}}"></script>
@endsection
@section('page-script')
{{-- <script src="{{asset('assets/js/form-basic-inputs.js')}}"></script> --}}
<script src="{{asset('assets/js/forms-pickers.js')}}"></script>

<script src="{{asset('assets/js/forms-selects.js')}}"></script>
{{-- <script src="{{asset('assets/js/forms-tagify.js')}}"></script> --}}
<script src="{{asset('assets/js/forms-typeahead.js')}}"></script>
<script>
  $(document).ready(function () {
    var no = 1;
            $(document).on('click', '#tambah_terlapor', function () {
          no++;
          console.log(no);
          var inputGroup = $(
            `
            <div class="bb-add row">
              <div class="col-md-12 d-flex flex-row justify-content-between align-items-center"></div>

              <div class="col-10">
                <div class="form-floating form-floating-outline mb-2">
                  <input type="text" name="terlapor[]" class="form-control" id="bs-validation-name" placeholder="Nama Terlapor" required="">
                  <label for="bs-validation-name">Nama Terlapor</label>
                  <div class="valid-feedback"> Looks good! </div>
                  <div class="invalid-feedback"> Please enter your name. </div>
                </div>
              </div>
              <div class="col-2">
                <button type="button" class="btn btn-danger remove_attach" title='Hapus'><i class="mdi mdi-delete me-1"></i></button>
              </div>
            </div>`
          );

          $('#terlapor').append(inputGroup);
        });

        $(document).on('click', '.remove_attach', function (e) {
          if (e.type == 'click') {
            if (no > 1) {
              $(this).parents('.bb-add').fadeOut();
              $(this).parents('.bb-add').remove();
              no--;
            }
          }
        });
  });
</script>
@endsection

@section('content')
<h4 class="py-3 mb-4">
  <span class="text-muted fw-light">Dumas /</span> Dumas Baru
</h4>

<div class="row">
  <div class="col-md">
    <div class="card">
      <h5 class="card-header">Tambah Dumas Baru</h5>
      <div class="card-body">
        <form class="needs-validation" action="{{route('dumas.store')}}" method="POST" enctype="multipart/form-data">
          @csrf
          @method('POST')
          <div class="form-floating form-floating-outline mb-4">
            <input type="text" name="nd" class="form-control" id="bs-validation-name" placeholder="Nomor ND" required="" value="{{ old('nd') }}">
            <label for="bs-validation-name">Nomor ND</label>
            <div class="valid-feedback"> Looks good! </div>
            <div class="invalid-feedback"> Please enter ND number. </div>
          </div>
          <div class="form-floating form-floating-outline mb-4">
            <input type="file" name="nd_file" class="form-control" id="bs-validation-name" required="" accept="application/pdf" value="{{ old('nd_file') }}">
            <label for="bs-validation-name">Dokumen ND</label>
            <div class="valid-feedback"> Looks good! </div>
            <div class="invalid-feedback"> Please select ND file. </div>
          </div>
          <div class="form-floating form-floating-outline mb-4">
            <input type="text" name="tanggal" class="form-control flatpickr-input active" placeholder="YYYY-MM-DD" id="flatpickr-date" value="{{ old('tanggal') }}">
            <label for="flatpickr-date">Tanggal Diterima</label>
          </div>

          <hr >
          <div class="form-floating form-floating-outline mb-4">
            <input type="text" name="pelapor" class="form-control" id="bs-validation-name" placeholder="Nama Pelapor" required="" value="{{ old('pelapor') }}">
            <label for="bs-validation-name">Nama Pelapor</label>
            <div class="valid-feedback"> Looks good! </div>
            <div class="invalid-feedback"> Please enter your name. </div>
          </div>

          <hr />
          <div class="form-floating form-floating-outline mb-4">
            <input type="text" name="perihal" class="form-control" id="bs-validation-name" placeholder="Perihal" required="" value="{{ old('perihal') }}">
            <label for="bs-validation-name">Perihal</label>
            <div class="valid-feedback"> Looks good! </div>
            <div class="invalid-feedback"> Please enter perihal. </div>
          </div>

          <div class="form-floating form-floating-outline mb-4">
            <input type="text" name="dugaan" class="form-control" id="bs-validation-name" placeholder="Dugaan" required="" value="{{ old('dugaan') }}">
            <label for="bs-validation-name">Dugaan</label>
            <div class="valid-feedback"> Looks good! </div>
            <div class="invalid-feedback"> Please enter dugaan. </div>
          </div>

          <div class="form-floating form-floating-outline mb-4">
            <input type="text" name="wujud_perbuatan" class="form-control" id="bs-validation-name" placeholder="Wujud Perbuatan" required="" value="{{ old('wujud_perbuatan') }}">
            <label for="bs-validation-name">Wujud Perbuatan</label>
            <div class="valid-feedback"> Looks good! </div>
            <div class="invalid-feedback"> Please enter wujud perbuatan. </div>
          </div>

          <hr />
          <div id="terlapor">
            <div class="form-floating form-floating-outline mb-2">
              <input type="text" name="terlapor[]" class="form-control" id="bs-validation-name" placeholder="Nama Terlapor" required="">
              <label for="bs-validation-name">Nama Terlapor</label>
              <div class="valid-feedback"> Looks good! </div>
              <div class="invalid-feedback"> Please enter your name. </div>
            </div>
          </div>
          <div class="row mb-4">
            <div class="col-12">
              <button type="button" class="btn btn-sm btn-primary" data-repeater-create id="tambah_terlapor"><i class="mdi mdi-plus me-1"></i> Tambah Terlapor</button>
            </div>
          </div>

          <div class="form-floating form-floating-outline mb-4">
            <input type="text" name="satker" class="form-control" id="bs-validation-name" placeholder="Satker" required="" value="{{ old('satker') }}">
            <label for="bs-validation-name">Satker</label>
            <div class="valid-feedback"> Looks good! </div>
            <div class="invalid-feedback"> Please enter the origin of dumas. </div>
          </div>

          @if (auth()->user()->username == 'administrator')
          <div class="form-floating form-floating-outline mb-4">
            <select id="den" name="den_id" class="select2 form-select form-select-lg" data-allow-clear="true" required="">
              <option value="">Pilih Den</option>
              @foreach ($den as $d)
                  <option value="{{ $d->id }}">{{ $d->name }}</option>
              @endforeach
            </select>
            <label for="den">Den</label>
          </div>

          <div class="form-floating form-floating-outline mb-4">
            <select id="unit" name="unit_id" class="select2 form-select form-select-lg" data-allow-clear="true" required="">
              <option value="">Pilih Unit</option>
              @foreach ($unit as $u)
                  <option value="{{ $u->id }}">{{ $u->name }}</option>
              @endforeach
            </select>
            <label for="unit">Unit</label>
          </div>
          @endif
          
          <div class="form-floating form-floating-outline mb-4">
            <select id="select2Basic" name="pj_id" class="select2 form-select form-select-lg" data-allow-clear="true" required="">
              <option value="">Pilih Penanggung Jawab</option>
              @foreach ($user as $item)
                  <option value="{{ $item->id }}">{{ $item->pangkat->nama_pangkat }} {{ $item->name }}</option>
              @endforeach
            </select>
            <label for="select2Basic">Penanggung Jawab</label>
          </div>
          <div class="row">
            <div class="col-12">
              <button role="submit" class="btn btn-primary waves-effect waves-light w-100">Tambah</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
