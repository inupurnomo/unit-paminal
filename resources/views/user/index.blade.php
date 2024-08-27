@extends('layouts/layoutMaster')

@section('title', 'User Management')

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
<script src="{{asset('js/laravel-user-management.js')}}"></script>
<script src="{{asset('assets/js/forms-selects.js')}}"></script>

@endsection

@section('content')

<div class="row g-4 mb-4">
  <div class="col-sm-6 col-xl-3">
    <div class="card">
      <div class="card-body">
        <div class="d-flex align-items-start justify-content-between">
          <div class="content-left">
            <span>Users</span>
            <div class="d-flex align-items-end mt-2">
              <h3 class="mb-0 me-2">{{$totalUser}}</h3>
              <small class="text-success">(100%)</small>
            </div>
            <small>Total Users</small>
          </div>
          <span class="avatar">
            <span class="avatar-initial bg-label-primary rounded">
              <i class="mdi mdi-account-outline mdi-24px"></i>
            </span>
          </span>
        </div>
      </div>
    </div>
  </div>
  <div class="col-sm-6 col-xl-3">
    <div class="card">
      <div class="card-body">
        <div class="d-flex align-items-start justify-content-between">
          <div class="content-left">
            <span>Verified Users</span>
            <div class="d-flex align-items-end mt-2">
              <h3 class="mb-0 me-2">{{$verified}}</h3>
              <small class="text-success">(+95%)</small>
            </div>
            <small>Recent analytics </small>
          </div>
          <span class="avatar">
            <span class="avatar-initial bg-label-success rounded">
              <i class="mdi mdi-account-check-outline mdi-24px"></i>
            </span>
          </span>
        </div>
      </div>
    </div>
  </div>
  <div class="col-sm-6 col-xl-3">
    <div class="card">
      <div class="card-body">
        <div class="d-flex align-items-start justify-content-between">
          <div class="content-left">
            <span>Duplicate Users</span>
            <div class="d-flex align-items-end mt-2">
              <h3 class="mb-0 me-2">{{$userDuplicates}}</h3>
              <small class="text-success">(0%)</small>
            </div>
            <small>Recent analytics</small>
          </div>
          <span class="avatar">
            <span class="avatar-initial bg-label-danger rounded">
              <i class="mdi mdi-account-multiple-outline mdi-24px"></i>
            </span>
          </span>
        </div>
      </div>
    </div>
  </div>
  <div class="col-sm-6 col-xl-3">
    <div class="card">
      <div class="card-body">
        <div class="d-flex align-items-start justify-content-between">
          <div class="content-left">
            <span>Verification Pending</span>
            <div class="d-flex align-items-end mt-2">
              <h3 class="mb-0 me-2">{{$notVerified}}</h3>
              <small class="text-danger">(+6%)</small>
            </div>
            <small>Recent analytics</small>
          </div>
          <span class="avatar">
            <span class="avatar-initial bg-label-warning rounded">
              <i class="mdi mdi-account-circle-outline mdi-24px"></i>
            </span>
          </span>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Users List Table -->
<div class="card">
  <div class="card-header">
    <h5 class="card-title mb-0">User List</h5>
  </div>
  <div class="card-datatable table-responsive">
    <table class="datatables-users table">
      <thead class="table-light">
        <tr>
          <th></th>
          <th>Id</th>
          <th>Username</th>
          <th>Name</th>
          <th>Jabatan</th>
          <th>Role</th>
          <th>Den</th>
          <th>Unit</th>
          <th>Actions</th>
        </tr>
      </thead>
    </table>
  </div>
  <!-- Offcanvas to add new user -->
  <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasAddUser" aria-labelledby="offcanvasAddUserLabel">
    <div class="offcanvas-header">
      <h5 id="offcanvasAddUserLabel" class="offcanvas-title">Add User</h5>
      <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body mx-0">
      <form class="add-new-user pt-0" id="addNewUserForm">
        <input type="hidden" name="id" id="user_id">
        <div class="form-floating form-floating-outline mb-4">
          <input type="text" class="form-control" id="add-user-username" placeholder="Username" name="username" aria-label="Username" required="" />
          <label for="add-user-fullname">Username</label>
        </div>
        <div class="form-floating form-floating-outline mb-4">
          <select id="add-user-pangkat" name="pangkat_id" class="select2 form-select form-select-lg" data-allow-clear="true" required="">
            <option value="">Pilih Pangkat</option>
            @foreach ($pangkat as $p)
                <option value="{{ $p->id }}">{{ $p->nama_pangkat }}</option>
            @endforeach
          </select>
          <label for="add-user-pangkat">Pilih Pangkat</label>
        </div>
        <div class="form-floating form-floating-outline mb-4">
          <input type="text" class="form-control" id="add-user-fullname" placeholder="John Doe" name="name" aria-label="John Doe" />
          <label for="add-user-fullname">Full Name</label>
        </div>
        {{-- <div class="form-floating form-floating-outline mb-4">
          <input type="text" id="add-user-email" class="form-control" placeholder="john.doe@example.com" aria-label="john.doe@example.com" name="email" />
          <label for="add-user-email">Email</label>
        </div> --}}
        <div class="form-floating form-floating-outline mb-4">
          <input type="text" id="add-user-jabatan" class="form-control" placeholder="Jabatan" aria-label="Jabatan" name="jabatan" />
          <label for="add-user-jabatan">Jabatan</label>
        </div>
        <div class="form-floating form-floating-outline mb-4">
          <select id="add-user-role" name="role" class="select2 form-select form-select-lg" data-allow-clear="true" required="">
            <option value="">Pilih Role</option>
            @if (auth()->user()->role_name() == 'administrator')
            <option value="administrator">administrator</option>
            @endif
            @foreach ($role as $r)
            @if ($r->name != 'administrator')
            <option value="{{ $r->name }}">{{ $r->name }}</option>
            @endif  
            @endforeach
          </select>
          <label for="add-user-role">Pilih Role</label>
        </div>
        <div class="form-floating form-floating-outline mb-4">
          <select id="add-user-den" name="den_id" class="select2 form-select form-select-lg" data-allow-clear="true" required="">
            <option value="">Pilih Den</option>
            @foreach ($den as $d)
                <option value="{{ $d->id }}">{{ $d->name }}</option>
            @endforeach
          </select>
          <label for="add-user-den">Pilih Den</label>
        </div>
        <div class="form-floating form-floating-outline mb-4">
          <select id="add-user-unit" name="unit_id" class="select2 form-select form-select-lg" data-allow-clear="true" required="">
            <option value="">Pilih Unit</option>
            @foreach ($unit as $u)
                <option value="{{ $u->id }}">{{ $u->name }}</option>
            @endforeach
          </select>
          <label for="add-user-unit">Pilih Unit</label>
        </div>
        <button type="submit" class="btn btn-primary me-sm-3 me-1 data-submit">Submit</button>
        <button type="reset" class="btn btn-label-secondary" data-bs-dismiss="offcanvas">Cancel</button>
      </form>
    </div>
  </div>
</div>
@endsection
