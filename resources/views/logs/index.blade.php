@extends('layouts/layoutMaster')

@section('title', 'Activity Logs')

@section('vendor-style')
<link rel="stylesheet" href="{{asset('assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css')}}">
<link rel="stylesheet" href="{{asset('assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css')}}">
<link rel="stylesheet" href="{{asset('assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css')}}">
<link rel="stylesheet" href="{{asset('assets/vendor/libs/select2/select2.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/@form-validation/umd/styles/index.min.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/animate-css/animate.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/sweetalert2/sweetalert2.css')}}" />
@endsection

@section('vendor-script')
<script src="{{asset('assets/vendor/libs/moment/moment.js')}}"></script>
<script src="{{asset('assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js')}}"></script>
<script src="{{asset('assets/vendor/libs/select2/select2.js')}}"></script>
<script src="{{asset('assets/vendor/libs/@form-validation/umd/bundle/popular.min.js')}}"></script>
<script src="{{asset('assets/vendor/libs/@form-validation/umd/plugin-bootstrap5/index.min.js')}}"></script>
<script src="{{asset('assets/vendor/libs/@form-validation/umd/plugin-auto-focus/index.min.js')}}"></script>
<script src="{{asset('assets/vendor/libs/cleavejs/cleave.js')}}"></script>
<script src="{{asset('assets/vendor/libs/cleavejs/cleave-phone.js')}}"></script>
<script src="{{asset('assets/vendor/libs/sweetalert2/sweetalert2.js')}}"></script>
@endsection

@section('page-script')
{{-- <script src="{{asset('js/laravel-user-management.js')}}"></script> --}}
<script src="{{asset('js/master.js')}}"></script>
<script src="{{asset('assets/js/forms-selects.js')}}"></script>
<script>
    
  $(document).ready(function () {
      getData();
  });
  
  function getData() {
  table = $('.datatables-logs').DataTable({
    processing: true,
    serverSide: true,
    searching: true,
    responsive: false,
    search: {
      regex: true
    },
    ajax: {
      url: '/log-activity/list',
      data: function (data) {
        data._token = $('meta[name="csrf-token"]').attr('content');
      },
      method: 'post',
    },
    columns: [
      {
        data: 'DT_RowIndex',
        name: 'DT_RowIndex',
        orderable: false,
        searchable: false,
        responsivePriority: 0
      },
      {
        data: 'url',
        name: 'url',
        responsivePriority: -1
      },
      {
            data: "method",
            name: "method",
            responsivePriority: -1,
        },
        {
            data: "ip",
            name: "ip",
            responsivePriority: -1,
        },
        {
            data: "agent",
            name: "agent",
            responsivePriority: -1,
        },
        {
            data: "user",
            name: "user",
            responsivePriority: -1,
        }
    ],
  });
  $('#kt_search').on('click', function (e) {
    e.preventDefault();
    table.table().draw();
  });

  $('#kt_reset').on('click', function (e) {
    $('.form-control').val('');
    table.table().draw();
  });
}
    </script>

@endsection

@section('content')

<div class="card">
  <div class="card-header">
    <h5 class="card-title mb-0">Activity Logs</h5>
  </div>
  <div class="card-datatable table-responsive">
    <table class="datatables-logs table" id="zero-config">
      <thead>
        <tr>
          <th>#</th>
          <th>Url</th>
          <th>Method</th>
          <th>IP Address</th>
          <th>Browser</th>
          <th>User</th>
        </tr>
      </thead>
    </table>
  </div>

</div>
@endsection
