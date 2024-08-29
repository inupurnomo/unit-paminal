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
@endsection

@section('content')
<h4 class="py-3 mb-4">
  <span class="text-muted fw-light">Dumas /</span> Edit Dumas
</h4>

<div class="row">
  <div class="col-md">
    <div class="card">
      <h5 class="card-header">Edit Dumas - <strong>{{ $dumas->pelapor }}</strong></h5>
      <div class="card-body">
        <form class="needs-validation" action="{{route('dumas.update', $dumas->id )}}" method="POST" novalidate="">
          @csrf
          @method('PUT')
          <div class="form-floating form-floating-outline mb-4">
            <input type="text" name="nd" class="form-control" id="bs-validation-name" placeholder="Nomor ND" required="" value="{{ $dumas->nd->number ?? '-' }}">
            <label for="bs-validation-name">Nomor ND</label>
            <div class="valid-feedback"> Looks good! </div>
            <div class="invalid-feedback"> Please enter ND number. </div>
          </div>
          <div class="form-floating form-floating-outline mb-4">
            <input type="text" name="tanggal" class="form-control flatpickr-input active" placeholder="YYYY-MM-DD" id="flatpickr-date" readonly="readonly" value="{{ $dumas->tanggal }}">
            <label for="flatpickr-date">Tanggal Diterima</label>
          </div>
          <div class="form-floating form-floating-outline mb-4">
            <input type="text" name="perihal" class="form-control" id="bs-validation-name" placeholder="Perihal" required="" value="{{ $dumas->perihal }}">
            <label for="bs-validation-name">Perihal</label>
            <div class="valid-feedback"> Looks good! </div>
            <div class="invalid-feedback"> Please enter perihal. </div>
          </div>

          <div class="form-floating form-floating-outline mb-4">
            <input type="text" name="pelapor" class="form-control" id="bs-validation-name" placeholder="Nama Pelapor" required="" value="{{ $dumas->pelapor }}">
            <label for="bs-validation-name">Nama Pelapor</label>
            <div class="valid-feedback"> Looks good! </div>
            <div class="invalid-feedback"> Please enter your name. </div>
          </div>
          <hr />
          <div class="form-floating form-floating-outline mb-4">
            <input type="text" name="satker" class="form-control" id="bs-validation-name" placeholder="Satker" required="" value="{{ $dumas->satker }}">
            <label for="satker">Satker</label>
            <div class="valid-feedback"> Looks good! </div>
            <div class="invalid-feedback"> Please enter satker. </div>
          </div>
          @foreach ($dumas->terlapor as $t)              
          <div class="form-floating form-floating-outline mb-4">
            <input type="text" name="terlapor" class="form-control" id="bs-validation-name" placeholder="Nama Terlapor" required="" value="{{ $t->name }}">
            <label for="bs-validation-name">Nama Terlapor</label>
            <div class="valid-feedback"> Looks good! </div>
            <div class="invalid-feedback"> Please enter your name. </div>
          </div>
          @endforeach
          <div class="form-floating form-floating-outline mb-4">
            <select id="select2Basic" name="pj_id" class="select2 form-select form-select-lg" data-allow-clear="true">
              <option value="">Pilih Penanggung Jawab</option>
              @foreach ($user as $item)
                  <option value="{{ $item->id }}" {{ $dumas->pj_id == $item->id ? 'selected' : '' }}>{{ $item->name }}</option>
              @endforeach
            </select>
            <label for="select2Basic">Penanggung Jawab</label>
          </div>
          <div class="row">
            <div class="col-12">
              <button role="submit" class="btn btn-primary waves-effect waves-light">Update</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
