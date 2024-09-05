@extends('layouts/layoutMaster')

@section('title', 'Edit Dumas')

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
        <form class="needs-validation" action="{{route('dumas.update', $dumas->id )}}" method="POST" novalidate="" enctype="multipart/form-data">
          @csrf
          @method('PUT')
          <div class="form-floating form-floating-outline mb-4">
            <input type="text" name="nd" class="form-control" id="bs-validation-name" placeholder="Nomor ND" required="" value="{{ $dumas->nd->number ?? '-' }}">
            <label for="bs-validation-name">Nomor ND</label>
            <div class="valid-feedback"> Looks good! </div>
            <div class="invalid-feedback"> Please enter ND number. </div>
          </div>
          <div class="form-floating form-floating-outline mb-4">
            <input type="file" name="nd_file" class="form-control" id="bs-validation-name" accept="application/pdf">
            <label for="bs-validation-name">Dokumen ND</label>
            <div class="valid-feedback"> Looks good! </div>
            <div class="invalid-feedback"> Please select ND file. </div>
            <div class="mt-2">ND Saat ini: <a href="{{$dumas->nd->file}}" target="_blank" title="Litat Dokumen">{{ $dumas->nd->number }}</a></div>
          </div>
          <div class="form-floating form-floating-outline mb-4">
            <input type="text" name="tanggal" class="form-control flatpickr-input active" placeholder="YYYY-MM-DD" id="flatpickr-date" readonly="readonly" value="{{ $dumas->tanggal }}">
            <label for="flatpickr-date">Tanggal Diterima</label>
          </div>

          <hr />
          <div class="form-floating form-floating-outline mb-4">
            <input type="text" name="pelapor" class="form-control" id="bs-validation-name" placeholder="Nama Pelapor" required="" value="{{ $dumas->pelapor }}">
            <label for="bs-validation-name">Nama Pelapor</label>
            <div class="valid-feedback"> Looks good! </div>
            <div class="invalid-feedback"> Please enter your name. </div>
          </div>
          <div class="col">
            <div class="form-floating form-floating-outline">
              <input type="date" name="date_pelapor"class="form-control" id="date_pelapor" placeholder="Tanggal Klarifikasi" value="{{ $dumas->date_pelapor }}">
              <label for='date_pelapor'>Tanggal Klarifikasi</label>
              <div class="valid-feedback"> Looks good! </div>
              <div class="invalid-feedback"> Please enter the date. </div>
            </div>
          </div>  

          <hr />
          <div class="form-floating form-floating-outline mb-4">
            <input type="text" name="perihal" class="form-control" id="bs-validation-name" placeholder="Perihal" required="" value="{{ $dumas->perihal }}">
            <label for="bs-validation-name">Perihal</label>
            <div class="valid-feedback"> Looks good! </div>
            <div class="invalid-feedback"> Please enter perihal. </div>
          </div>
          <div class="form-floating form-floating-outline mb-4">
            <input type="text" name="dugaan" class="form-control" id="bs-validation-dugaan" placeholder="Dugaan" required="" value="{{ $dumas->dugaan }}">
            <label for="bs-validation-dugaan">Dugaan</label>
            <div class="valid-feedback"> Looks good! </div>
            <div class="invalid-feedback"> Please enter perihal. </div>
          </div>
          <div class="form-floating form-floating-outline mb-4">
            <input type="text" name="wujud_perbuatan" class="form-control" id="bs-validation-wp" placeholder="Perihal" required="" value="{{ $dumas->wujud_perbuatan }}">
            <label for="bs-validation-wp">Wujud Perbuatan</label>
            <div class="valid-feedback"> Looks good! </div>
            <div class="invalid-feedback"> Please enter perihal. </div>
          </div>

          <hr />
          <h6>Terlapor</h6>
          @foreach ($dumas->terlapor as $t)  
          <div class="row">
            <div class="col">
              <div class="form-floating form-floating-outline mb-4">
                <input type="text" name="terlapor_id[]" id="terlapor_id" value="{{ $t->id }}" hidden>
                <input type="text" name="terlapor_name[]" class="form-control" id="terlapor_name" placeholder="Nama Terlapor" required="" value="{{ $t->name }}">
                <label for="terlapor-name">Nama Terlapor</label>
                <div class="valid-feedback"> Looks good! </div>
                <div class="invalid-feedback"> Please enter your name. </div>
              </div>  
            </div>  
            <div class="col">
              <div class="form-floating form-floating-outline">
                <input type="date" name="terlapor_date[]"class="form-control" id="terlapor_date" placeholder="Tanggal Klarifikasi" value="{{ $t->date }}">
                <label for='terlapor_date'>Tanggal Klarifikasi</label>
                <div class="valid-feedback"> Looks good! </div>
                <div class="invalid-feedback"> Please enter the date. </div>
              </div>
            </div>  
          </div>            

          @endforeach
          <div class="form-floating form-floating-outline mb-4">
            <input type="text" name="satker" class="form-control" id="bs-validation-name" placeholder="Satker" required="" value="{{ $dumas->satker }}">
            <label for="satker">Satker</label>
            <div class="valid-feedback"> Looks good! </div>
            <div class="invalid-feedback"> Please enter satker. </div>
          </div>

          @if (count($dumas->witness) != 0)
          <hr />
          <h6>Saksi</h6>
          @foreach ($dumas->witness as $w)
          <input type="text" name="witness_id[]" id="witness_id" value="{{ $w->id }}" hidden>
          <div class="row">
            <div class="col-sm-12 col-md-6">
              <div class="form-floating form-floating-outline mb-4">
                <input type="text" name="witness_name[]" class="form-control" id="witness_name" placeholder="Nama Terlapor" value="{{ $w->name }}">
                <label for="terlapor_name">Nama Saksi</label>
                <div class="valid-feedback"> Looks good! </div>
                <div class="invalid-feedback"> Please enter witness name. </div>
              </div>  
            </div> 
            <div class="col-sm-12 col-md-6">
              <div class="form-floating form-floating-outline mb-4">
                <input type="text" name="witness_phone[]" class="form-control" id="witness_phone" placeholder="Nomor Telephone" value="{{ $w->telephone }}" oninput="this.value = this.value.replace(/[^0-9+]/g, '');" maxlength="15">
                <label for="witness_phone">No Telephone Saksi</label>
                <div class="valid-feedback"> Looks good! </div>
                <div class="invalid-feedback"> Please enter witness name. </div>
              </div>  
            </div> 
            <div class="col">
              <div class="form-floating form-floating-outline mb-4">
                <input type="date" name="witness_date[]"class="form-control" id="witness_date" placeholder="Tanggal Klarifikasi" value="{{ $w->date }}">
                <label for='witness_date'>Tanggal Klarifikasi</label>
                <div class="valid-feedback"> Looks good! </div>
                <div class="invalid-feedback"> Please enter the date. </div>
              </div>
            </div>   
          </div>
          @endforeach
          @endif

          <hr/>
          <div class="form-floating form-floating-outline mb-4">
            <select id="select2Basic" name="pj_id" class="select2 form-select form-select-lg" data-allow-clear="true">
              <option value="">Pilih Penanggung Jawab</option>
              @foreach ($user as $item)
                  <option value="{{ $item->id }}" {{ $dumas->pj_id == $item->id ? 'selected' : '' }}>{{ $item->name }}</option>
              @endforeach
            </select>
            <label for="select2Basic">Penanggung Jawab</label>
          </div>

          @if (auth()->user()->username == 'administrator')
          <hr />
          <div class="form-floating form-floating-outline mb-4">
            <select id="den" name="den_id" class="select2 form-select form-select-lg" data-allow-clear="true" required="">
              <option value="">Pilih Den</option>
              @foreach ($den as $d)
                  <option value="{{ $d->id }}" {{ $dumas->den_id == $d->id ? 'selected' : '' }}>{{ $d->name }}</option>
              @endforeach
            </select>
            <label for="den">Den</label>
          </div>

          <div class="form-floating form-floating-outline mb-4">
            <select id="unit" name="unit_id" class="select2 form-select form-select-lg" data-allow-clear="true" required="">
              <option value="">Pilih Unit</option>
              @foreach ($unit as $u)
                  <option value="{{ $u->id }}" {{ $dumas->unit_id == $u->id ? 'selected' : '' }}>{{ $u->name }}</option>
              @endforeach
            </select>
            <label for="unit">Unit</label>
          </div>
          @endif
          <div class="row">
            <div class="col-12">
              <button role="submit" type="submit" class="btn btn-primary waves-effect waves-light">Update</button>
              <button role="button" type="button" class="btn btn-outline-secondary waves-effect waves-light" onclick="window.history.back();">Cancel</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
