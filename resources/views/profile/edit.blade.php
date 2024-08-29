@extends('layouts/layoutMaster')

@section('title', 'Account settings - Account')

@section('vendor-style')
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/select2/select2.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/@form-validation/umd/styles/index.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/animate-css/animate.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/sweetalert2/sweetalert2.css') }}" />
@endsection

@section('vendor-script')
    <script src="{{ asset('assets/vendor/libs/select2/select2.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/@form-validation/umd/bundle/popular.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/@form-validation/umd/plugin-bootstrap5/index.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/@form-validation/umd/plugin-auto-focus/index.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/cleavejs/cleave.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/cleavejs/cleave-phone.js') }}"></script>
@endsection

@section('page-script')
    {{-- <script src="{{ asset('assets/js/pages-account-settings-account.js') }}"></script> --}}
@endsection

@section('content')
    <h4 class="py-3 mb-4">
        <span class="text-muted fw-light">Account Settings /</span> Account
    </h4>

    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4">
                <h4 class="card-header">Profile Details</h4>
                <div class="card-body">
                    <form id="formAccountSettings" method="POST" action="{{ route('profile.update') }}">
                      @csrf
                      @method('POST')
                        <div class="row mt-2 gy-4">
                            <div class="col-md-6">
                                <div class="form-floating form-floating-outline">
                                    <input class="form-control" type="text" id="username" name="username"
                                        value="{{ old('username', $user->username) }}" required="" />
                                    <label for="username">Username</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                              <div class="form-floating form-floating-outline">
                                  <select id="pangkat" name="pangkat_id" class="select2 form-select" required="">
                                    @foreach ($pangkat as $p)
                                        <option value="{{ $p->id }}" {{ $user->pangkat_id == $p->id ? 'selected' : '' }}>{{ $p->nama_pangkat }}</option>
                                    @endforeach
                                  </select>
                                  <label for="pangkat">Pangkat</label>
                              </div>
                          </div>
                          <div class="col-md-6">
                              <div class="form-floating form-floating-outline">
                                  <input class="form-control" type="text" id="name" name="name"
                                      value="{{ $user->name }}" autofocus required="" />
                                  <label for="name">Name</label>
                              </div>
                          </div>
                          <div class="col-md-6">
                              <div class="form-floating form-floating-outline">
                                  <input type="text" class="form-control" id="jabatan" name="jabatan"
                                      value="{{ $user->jabatan }}" required="" />
                                  <label for="jabatan">Jabatan</label>
                              </div>
                          </div>
                          <div class="col-md-6">
                              <div class="form-floating form-floating-outline">
                                  <input type="text" class="form-control" id="role"
                                      value="{{ $user->role_name() }}" required="" disabled />
                                  <label for="role">Role</label>
                              </div>
                          </div>
                        </div>
                        <div class="mt-4">
                            <button type="submit" class="btn btn-primary me-2">Simpan</button>
                            <button type="reset" class="btn btn-outline-secondary" onclick="window.location.href='{{ route('profile') }}'">Cancel</button>
                        </div>
                    </form>
                </div>
                <!-- /Account -->
            </div>
        </div>
    </div>
@endsection
