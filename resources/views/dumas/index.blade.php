@extends('layouts/layoutMaster')

@section('title', 'Daftar Dumas')

@section('vendor-style')
{{-- <link rel="stylesheet" href="{{asset('assets/vendor/libs/apex-charts/apex-charts.css')}}" /> --}}
<link rel="stylesheet" href="{{asset('assets/vendor/libs/select2/select2.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/bootstrap-select/bootstrap-select.css')}}" />
<link rel="stylesheet" href="{{ asset('assets/vendor/libs/sweetalert2/sweetalert2.css') }}" />
@endsection

@section('page-style')
<!-- Page -->
{{-- <link rel="stylesheet" href="{{asset('assets/vendor/css/pages/cards-analytics.css')}}"> --}}
@endsection

@section('vendor-script')
{{-- <script src="{{asset('assets/vendor/libs/apex-charts/apexcharts.js')}}"></script> --}}
<script src="{{asset('assets/vendor/libs/select2/select2.js')}}"></script>
<script src="{{asset('assets/vendor/libs/bootstrap-select/bootstrap-select.js')}}"></script>
<script src="{{ asset('assets/vendor/libs/sweetalert2/sweetalert2.js') }}"></script>
@endsection

@section('page-script')
{{-- <script src="{{asset('assets/js/cards-analytics.js')}}"></script> --}}
<script src="{{asset('assets/js/forms-selects.js')}}"></script>
<script src="{{asset('assets/js/dumas/index.js')}}"></script>
@endsection

@section('content')

<h4 class="py-3 mb-4"><span class="text-muted fw-light">Dumas /</span> Daftar Dumas</h4>

<form action="{{ route('dumas') }}" method="GET">
  <div class="row mb-1">
    <div class="col-sm-12 col-md-6 mb-2">
      <div class="form-floating form-floating-outline">
        <input type="text" name="q" id="q" class="form-control" placeholder="Pencarian..." value="{{ app('request')->input('q') }}" autocomplete="off">
        <label for="q">Pencarian</label>
      </div>
    </div>
    <div class="col-sm-12 col-md-3 mb-2">
      <div class="form-floating form-floating-outline">
        <input type="date" name="start" id="date" class="form-control" placeholder="Tanggal"" value="{{ app('request')->input('start') }}">
        <label for="date">Start</label>
      </div>
    </div>
    <div class="col-sm-12 col-md-3 mb-2">
      <div class="form-floating form-floating-outline">
        <input type="date" name="end" id="end" class="form-control" placeholder="Tanggal"" value="{{ app('request')->input('end') }}">
        <label for="date-end">End</label>
      </div>
    </div>
  </div>

  @if (auth()->user()->username == 'administrator')
  <div class="row">
    <div class="col-6 mb-2">
      <div class="form-floating form-floating-outline">
        <select id="den" name="den" class="select2 form-select form-select-lg" data-allow-clear="true">
          <option value="">Pilih Den</option>
          @foreach ($den as $d)
              <option value="{{ $d->id }}" {{ app('request')->input('den') == $d->id ? 'selected' : '' }}>{{ $d->name }}</option>
          @endforeach
        </select>
        <label for="den">Pilih Den</label>
      </div>
    </div>
    <div class="col-6 mb-2">
      <div class="form-floating form-floating-outline">
        <select id="unit" name="unit" class="select2 form-select form-select-lg" data-allow-clear="true">
          <option value="">Pilih Unit</option>
          @foreach ($unit as $u)
              <option value="{{ $u->id }}" {{ app('request')->input('unit') == $u->id ? 'selected' : '' }}>{{ $u->name }}</option>
          @endforeach
        </select>
        <label for="unit">Pilih Unit</label>
      </div>
    </div>
  </div>
  @endif
  <div class="col-12 d-grid">
    <button class="btn btn-primary waves-effect waves-light w-100" type="submit">Filter</button>
  </div>
</form>
<div class="divider">
  <div class="divider-text">
    <i class="mdi mdi-star-outline"></i>
  </div>
</div>
@if (app('request')->all())
<div class="mb-4">
  <span class="">Total <strong>{{ count($dumas) }}</strong> dumas ditemukan.</span>
</div>
@endif
<div class="row gy-4">
@foreach ($dumas as $item) 
  <!-- Performance Overview Chart-->
  <div class="col-12 col-xl-4 col-md-6">
    <div class="card h-100">
      <div class="card-header pb-1">
        <div class="d-flex justify-content-between">
          <a href="{{ route('dumas.show', $item->id ) }}" class="mb-1">{{ $item->pelapor }} - {{ strtoupper($item->satker) }}</a>
          <div class="d-flex gap-4 align-items-center">
            <div>
              @php
              // Parse tanggal valid_until dari sprin_latest, jika ada, jika tidak berikan nilai default yang aman
              $sprin_valid = $item->sprin_latest ? \Carbon\Carbon::parse($item->sprin_latest->valid_until) : null;
              $today = \Carbon\Carbon::today(); // Tanggal hari ini
              $hPlus7 = $today->copy()->addDays(7); // Tanggal H-7
          
              // Inisialisasi variabel untuk class dan tooltip
              $isWarningShow = false;
              $label = '';
              $tooltip_title = '';
          
              // Cek apakah sprin_valid tidak null sebelum membandingkan tanggal
              if ($sprin_valid) {
                  if ($sprin_valid->between($today, $hPlus7)) {
                      // Jika sprin_valid antara H-7 dan hari ini
                      $label = 'warning';
                      $tooltip_title = 'Sprin akan segera berakhir!';
                      $isWarningShow = true;
                  } elseif ($sprin_valid < $today) {
                      // Jika sprin_valid sudah lewat
                      $label = 'danger';
                      $tooltip_title = 'Sprin Expired!';
                      $isWarningShow = true;
                  }
              }
              @endphp

              @if ($isWarningShow)
              <span class="badge badge-center rounded-pill bg-label-{{$label}}" style="cursor: pointer;" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="{{$tooltip_title}}"><i class="mdi mdi-bell-outline"></i></span>
              @endif
            </div>
            <div class="dropdown">
              <button class="btn p-0" type="button" id="performanceOverviewDropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="mdi mdi-dots-vertical mdi-24px"></i>
              </button>
              <div class="dropdown-menu dropdown-menu-end" aria-labelledby="performanceOverviewDropdown">
                <a class="dropdown-item" href="{{ route('dumas.show', $item->id) }}">Show</a>
                <a class="dropdown-item" href="{{ route('dumas.edit', $item->id )}}">Edit</a>
                <a class="dropdown-item" href="javascript:void(0);" data-id="{{ $item->id }}" onclick="handleDone(this)">Selesai</a>
                <a class="dropdown-item" href="javascript:void(0);" data-id="{{ $item->id }}" onclick="handleDelete(this)">Delete</a>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="card-body table-responsive">
        <table class="table table-hover">
          <tbody>
            <tr>
              <td>Nota Dinas</td>
              <td>:</td>
              <td><a href="{{$item->nd->file }}" target="_blank" rel="noopener noreferrer" title="Lihat Nota Dinas">{{ $item->nd->number ?? '-' }}</a></td>
            </tr>
            <tr>
              <td>Tanggal Diterima</td>
              <td>:</td>
              <td>{{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('l, d F Y') }}</td>
            </tr>
            <tr>
              <td>Terlapor</td>
              <td>:</td>
              <td>
                @foreach ($item->terlapor as $t)
                <div>{{ $t->name }}</div>                    
                @endforeach
              </td>
            </tr>
            <tr>
              <td>Dugaan</td>
              <td>:</td>
              <td>{{ $item->dugaan }}</td>
            </tr>
            <hr />
            <tr>
              <td>Progress</td>
              <td>:</td>
              <td>{{ $item->latest_progress->value ?? '-' }}</td>
            </tr>
          </tbody>
        </table>
      </div>
      <div class="card-footer">
        PJ : <a href="javascript:void(0);"><strong>{{ $item->pj->name ?? '-' }}</strong></a>
      </div>
    </div>
  </div>
  <!--/ Performance Overview Chart-->
@endforeach

{{ $dumas->links() }}
@if (count($dumas) == 0)
    <div class="row my-4">
      <div class="col text-center"><h3>Tidak ada dumas.</h3></div>
    </div>
@endif
</div>

<div class="fab">
  <a href="{{ route('dumas.create') }}"  title="Buat Dumas" type="button" class="btn btn-icon btn-primary btn-fab waves-effect waves-light">
    <span class="tf-icons mdi mdi-plus mdi-24px"></span>
  </a>
</div>
@endsection
