@extends('layouts/layoutMaster')

@section('title', 'Auth Logs')

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
      url: '/auth-logs/list',
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
        data: 'username',
        name: 'username',
        responsivePriority: -1
      },
      {
            data: "role",
            name: "role",
            responsivePriority: -1,
        },
        {
            data: "browser",
            name: "browser",
            responsivePriority: -1,
        },
        {
            data: "ip_address",
            name: "ip_address",
            responsivePriority: -1,
        },
        {
            data: "login_at",
            name: "login_at",
            responsivePriority: -1,
        },
        {
            data: "login_successful",
            name: "login_successful",
            responsivePriority: -1,
        },
        {
            data: "logout_at",
            name: "logout_at",
            responsivePriority: -1,
        },
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
    <h5 class="card-title mb-0">Auth Logs</h5>
  </div>
  <div class="card-datatable table-responsive">
    <table class="datatables-logs table" id="zero-config">
      <thead>
        <tr>
          <th>#</th>
          <th>Username</th>
          <th>Role</th>
          <th>Browser</th>
          <th>IP Address</th>
          <th>Login at</th>
          <th>Login Successfully</th>
          <th>Logout at</th>
        </tr>
      </thead>
    </table>
  </div>

</div>
@endsection
