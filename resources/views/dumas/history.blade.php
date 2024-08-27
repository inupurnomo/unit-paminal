@extends('layouts/layoutMaster')

@section('title', 'Dumas History')

@section('vendor-style')
{{-- <link rel="stylesheet" href="{{asset('assets/vendor/libs/apex-charts/apex-charts.css')}}" /> --}}
@endsection

@section('page-style')
<!-- Page -->
{{-- <link rel="stylesheet" href="{{asset('assets/vendor/css/pages/cards-analytics.css')}}"> --}}
@endsection

@section('vendor-script')
{{-- <script src="{{asset('assets/vendor/libs/apex-charts/apexcharts.js')}}"></script> --}}
@endsection

@section('page-script')
{{-- <script src="{{asset('assets/js/cards-analytics.js')}}"></script> --}}
@endsection

@section('content')

<h4 class="py-3 mb-4"><span class="text-muted fw-light">Dumas /</span> Dumas History
</h4>

<div class="row gy-4">
@foreach ($dumas as $item)
    
  <!-- Performance Overview Chart-->
  <div class="col-12 col-xl-4 col-md-6">
    <div class="card h-100">
      <div class="card-header pb-1">
        <div class="d-flex justify-content-between">
          <a href="{{ route('dumas.show', $item->id ) }}" class="mb-1">{{ $item->pelapor }} - {{ strtoupper($item->satker) }}</a>
          <div class="dropdown">
            <button class="btn p-0" type="button" id="performanceOverviewDropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="mdi mdi-dots-vertical mdi-24px"></i>
            </button>
            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="performanceOverviewDropdown">
              <a class="dropdown-item" href="{{ route('dumas.show', $item->id) }}">Show</a>
              <a class="dropdown-item" href="{{ route('dumas.edit', $item->id )}}">Edit</a>
              <a class="dropdown-item" href="javascript:void(0);" onclick="event.preventDefault(); document.getElementById('done-form').submit();">Belum Selesai</a>
              <a class="dropdown-item" href="javascript:void(0);" onclick="event.preventDefault(); document.getElementById('delete-form').submit();">Delete</a>
              <form method="POST" id="done-form" action="{{ route('dumas.markDone', $item->id) }}">
                @csrf
              </form>
              <form method="POST" id="delete-form" action="{{ route('dumas.destroy', $item->id) }}">
                @csrf
                @method('DELETE')
              </form>
            </div>
          </div>
        </div>
      </div>
      <div class="card-body">
        <table class="table table-hover">
          <tbody>
            <tr>
              <td>Nota Dinas</td>
              <td>:</td>
              <td><a href="{{ $item->nd->file }}" target="_blank" rel="noopener noreferrer" title="Lihat Nota Dinas">{{ $item->nd->number ?? '-' }}</a></td>
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
              <td>Perihal</td>
              <td>:</td>
              <td>{{ $item->perihal }}</td>
            </tr>
            <hr />
            <tr>
              <td>Status</td>
              <td>:</td>
              <td>{{ $item->status->status->name ?? '-' }}</td>
            </tr>
            <tr>
              <td>Catatan</td>
              <td>:</td>
              <td>{{ $item->status->catatan ?? '-' }}</td>
            </tr>
          </tbody>
        </table>

      </div>
      <div class="card-footer">
        PJ : <a href="javascript:void(0)"><strong>{{ $item->pj->name }}</strong></a>
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
@endsection
