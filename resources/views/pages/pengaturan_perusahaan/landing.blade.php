@extends('layouts/layoutMaster')

@section('title', 'Landing Page - Pages')

@section('vendor-style')
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/select2/select2.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/@form-validation/umd/styles/index.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/animate-css/animate.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/sweetalert2/sweetalert2.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/quill/typography.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/quill/katex.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/quill/editor.css') }}" />

@endsection

@section('vendor-script')
    <script src="{{ asset('assets/vendor/libs/moment/moment.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/select2/select2.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/@form-validation/umd/bundle/popular.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/@form-validation/umd/plugin-bootstrap5/index.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/@form-validation/umd/plugin-auto-focus/index.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/cleavejs/cleave.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/cleavejs/cleave-phone.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/sweetalert2/sweetalert2.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/quill/katex.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/quill/quill.js') }}"></script>
@endsection

@section('page-script')
    <script src="{{ asset('assets/js/form-layouts.js') }}"></script>
    <script src="{{ asset('js/master.js') }}"></script>
    <script src="{{ asset('js/landing.js') }}"></script>
@endsection

@section('content')
    <h4 class="py-3 mb-4">
        <span class="text-muted fw-light">Pengaturan /</span> Landing Page
    </h4>

    <div class="row">
        <div class="col-lg-12">
            <div class="card mb-4">
                <div class="card-datatable table-responsive">
                    <div class="card-header d-flex justify-content-between">
                        <h5 class="card-title">Kompetensi Perusahaan</h5>
                        <button class="add-new btn btn-primary waves-effect waves-light" data-bs-toggle="offcanvas"
                            data-bs-target="#offcanvasAddCompetence">Tambah Kompetensi</button>
                    </div>
                    <table class="datatables-competence table">
                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>SVG</th>
                                <th>Title</th>
                                <th>Content</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                    </table>
                </div>
                <hr />
                <div class="card-datatable table-responsive">
                  <div class="card-header d-flex justify-content-between">
                    <h5 class="card-title">Daftar Client</h5>
                    <button class="add-new btn btn-primary waves-effect waves-light" data-bs-toggle="offcanvas" data-bs-target="#offcanvasAddClient">Tambah Client</button>
                  </div>
                  <table class="datatables-clients table">
                    <thead class="table-light">
                      <tr>
                        <th>#</th>
                        <th>Logo</th>
                        <th>Nama Klien</th>
                        <th>Alamat</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>
                  </table>
                </div>
                <hr />
                <div class="card-datatable table-responsive">
                  <div class="card-header d-flex justify-content-between">
                    <h5 class="card-title">Daftar Team</h5>
                    <button class="add-new btn btn-primary waves-effect waves-light" data-bs-toggle="offcanvas" data-bs-target="#offcanvasAddTeam">Tambah Team</button>
                  </div>
                  <table class="datatables-teams table">
                    <thead class="table-light">
                      <tr>
                        <th>#</th>
                        <th>Nama</th>
                        <th>Deskripsi</th>
                        <th>Is Show?</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>
                  </table>
                </div>
            </div>
        </div>
    </div>

    {{-- Offcanvas Competence --}}
    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasAddCompetence" aria-labelledby="offcanvasAddClient">
        <div class="offcanvas-header">
            <h5 id="offcanvasAddCompetenceLabel" class="offcanvas-title">Tambah Kompetensi</h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body mx-0 flex-grow-0 h-100">
            <form class="add-new-competence needs-validation pt-0" novalidate id="addNewClientForm">
                @csrf
                <div class="form-floating form-floating-outline mb-4">
                  <input type="file" class="form-control" id="add-client-image" name="svg">
                  <label for="add-client-image">Gambar</label>
                </div>
                <div class="form-floating form-floating-outline mb-4">
                    <input type="text" class="form-control" id="competenceTitle" placeholder="Judul" name="title"
                        aria-label="Judul" />
                    <label for="competenceTitle">Judul</label>
                </div>
                <div class="form-floating form-floating-outline mb-4">
                    <textarea type="text" class="form-control" id="competenceContent" placeholder="Konten" name="content"
                        aria-label="Judul" style="height: 200px;"></textarea>
                    <label for="competenceContent">Konten</label>
                </div>
                <button type="submit" class="btn btn-primary me-sm-3 me-1 data-submit">Simpan</button>
                <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="offcanvas">Batal</button>
            </form>
        </div>
    </div>
    {{-- Offcanvas Competence Edit --}}
    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasEditCompetence"
        aria-labelledby="offcanvasEditCompetence">
        <div class="offcanvas-header">
            <h5 id="offcanvasEditCompetenceLabel" class="offcanvas-title">Edit Kompetensi</h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body mx-0 flex-grow-0 h-100">
            <form class="forms-edit-competence needs-validation pt-0" novalidate id="editCompetenceForm">
                @csrf
                @method('PUT')
                <div class="form-floating form-floating-outline mb-4">
                  <input type="file" class="form-control" id="add-client-image" name="svg">
                  <label for="add-client-image">Gambar</label>
                </div>
                <div class="form-floating form-floating-outline mb-4">
                    <input type="text" class="form-control" id="competenceTitle" placeholder="Judul" name="title"
                        aria-label="Judul" />
                    <label for="competenceTitle">Judul</label>
                </div>
                <div class="form-floating form-floating-outline mb-4">
                    <textarea type="text" class="form-control" id="competenceContent" placeholder="Konten" name="content"
                        aria-label="Judul" style="height: 200px;"></textarea>
                    <label for="competenceContent">Konten</label>
                </div>
                <button type="submit" class="btn btn-primary me-sm-3 me-1 data-submit"
                    id="submitCompetence">Simpan</button>
                <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="offcanvas">Batal</button>
            </form>
        </div>
    </div>
    {{-- Offcanvas Competence End --}}

    {{-- Offcanvas Client --}}
    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasAddClient" aria-labelledby="offcanvasAddClient">
      <div class="offcanvas-header">
        <h5 id="offcanvasAddClientLabel" class="offcanvas-title">Tambah Client</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
      </div>
      <div class="offcanvas-body mx-0 flex-grow-0 h-100">
        <form class="add-new-client needs-validation pt-0" novalidate id="addNewClientForm">
          @csrf
          <div class="form-floating form-floating-outline mb-4">
            <input type="file" class="form-control" id="add-client-image" name="image">
            <label for="add-client-image">Image</label>
          </div>
          <div class="form-floating form-floating-outline mb-4">
            <input type="text" class="form-control" id="add-user-fullname" placeholder="Nama Client" name="label" aria-label="Nama Client" />
            <label for="add-user-fullname">Nama Client</label>
          </div>
          <div class="form-floating form-floating-outline mb-4">
            <textarea type="text" class="form-control" id="clientAddress" placeholder="Alamat Client" name="alamat" aria-label="Alamat Client" style="height: 150px;"></textarea>
            <label for="add-user-fullname">Alamat Client</label>
          </div>
          <button type="submit" class="btn btn-primary me-sm-3 me-1 data-submit">Simpan</button>
          <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="offcanvas">Batal</button>
        </form>
      </div>
    </div>
    {{-- Offcanvas Client Edit --}}
    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasEditClient" aria-labelledby="offcanvasEditClient">
      <div class="offcanvas-header">
        <h5 id="offcanvasEditClientLabel" class="offcanvas-title">Edit Client</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
      </div>
      <div class="offcanvas-body mx-0 flex-grow-0 h-100">
        <form class="forms-edit-client needs-validation pt-0" novalidate id="editClientForm">
          @csrf
          @method('PUT')
          <div class="form-floating form-floating-outline mb-4">
            <input type="file" class="form-control" id="add-client-image" name="image">
            <label for="add-client-image">Image</label>
            <div class="mt-2">
              Current Logo:
              <img src="" id="clientImage" alt="clientImage" width="50" />
            </div>
          </div>
          <div class="form-floating form-floating-outline mb-4">
            <input type="text" class="form-control" id="clientName" placeholder="Nama Client" name="label" aria-label="Nama Client" />
            <label for="namaClient">Nama Client</label>
          </div>
          <div class="form-floating form-floating-outline mb-4">
            <textarea type="text" class="form-control" id="clientAddress" placeholder="Alamat Client" name="alamat" aria-label="Alamat Client" style="height: 150px;"></textarea>
            <label for="clientAdress">Alamat Client</label>
          </div>
          <button type="submit" class="btn btn-primary me-sm-3 me-1 data-submit" id="submitClient">Simpan</button>
          <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="offcanvas">Batal</button>
        </form>
      </div>
    </div>
    {{-- Offcanvas Client End --}}

    {{-- Offcanvas Team --}}
    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasAddTeam" aria-labelledby="offcanvasEditTeam">
        <div class="offcanvas-header">
            <h5 id="offcanvasAddTeamLabel" class="offcanvas-title">Tambah Team</h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body mx-0 flex-grow-0 h-100">
          <form class="add-new-team needs-validation pt-0" novalidate id="addNewTeamForm">
            @csrf
            <div class="modal-body">
                <div class="row">
                    <div class="col mb-2 mt-2">
                        <div class="form-floating form-floating-outline">
                            <input type="text" id="nama" class="form-control" placeholder="Enter Name"
                                name="name" required>
                            <label for="nameLarge">Nama</label>
                        </div>
                    </div>
                </div>
                <div class="row g-2">
                    <div class="col mb-2">
                        <div class="form-floating form-floating-outline">
                            <input type="number" id="phonenumber" class="form-control" placeholder="No Handphone"
                                name="phonenumber" required>
                            <label for="emailLarge">No Handphone</label>
                        </div>
                    </div>
                    <div class="col mb-2">
                        <div class="form-floating form-floating-outline">
                            <input type="text" id="email" class="form-control" placeholder="Email"
                                name="email" required>
                            <label for="emailLarge">Email</label>
                        </div>
                    </div>
                </div>
                <div class="row g-2">
                    <div class="col mb-2">
                        <div class="form-floating form-floating-outline">
                            <input type="text" id="username" class="form-control" placeholder="username / NIK"
                                name="username" required>
                            <label for="emailLarge">Username / NIK</label>
                        </div>
                    </div>
                    <div class="col mb-2">
                        <div class="form-floating form-floating-outline">
                            <select id="role" class="select2 form-select" data-allow-clear="true" required
                                name="role">
                                <option value="">Pilih Role / Bagian</option>
                                @foreach ($roles as $value)
                                    <option value="{{ $value->name }}">{{ $value->name }}</option>
                                @endforeach
                            </select>
                            <label for="role">Role</label>
                        </div>
                    </div>
                </div>
                <div class="col mb-2 mt-2" id="kategori">
                    <div class="form-floating form-floating-outline">
                        <select name="kategori" id="jenis_pengacara" class="select2 form-select">
                            <option value="" selected disabled>Pilih Jenis Advokat</option>
                            <option value="junior">Junior</option>
                            <option value="senior">Senior</option>
                        </select>
                        <label for="jenis_pengacara" id="label_pengacara">Jenis Advokat</label>
                    </div>
                </div>
                <div class="form-floating form-floating-outline mb-4">
                  <textarea type="text" class="form-control" id="add-user-description" placeholder="Deskripsi Client" name="deskripsi" aria-label="Deskripsi Singkat" style="height: 100px;"></textarea>
                  <label for="add-user-description">Deskripsi Singkat</label>
                </div>
            </div>
            <div class="form-floating form-floating-outline mb-4">
              <input type="file" class="form-control" id="add-client-ktp" name="ktp" required>
              <label for="add-client-ktp">Foto KTP</label>
            </div>
            <div class="form-floating form-floating-outline mb-4">
              <input type="file" class="form-control" id="add-client-kta" name="kta" required>
              <label for="add-client-kta">Foto KTA</label>
            </div>
            <div class="form-floating form-floating-outline mb-4">
              <input type="file" class="form-control" id="add-client-ba" name="berita_acara" required>
              <label for="add-client-ba">Berita Acara Sumpah</label>
            </div>
            <div class="offcanvas-footer mt-4">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="offcanvas">Close</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
        </div>
    </div>

    {{-- Offcanvas Team End --}}

    {{-- Delete Competence --}}
    <div class='modal fade' id='deleteCompetence' tabindex='-1' role='dialog' aria-labelledby='deleteModalLabel'
        aria-hidden='true'>
        <div class='modal-dialog' role='document'>
            <input type="hidden" id="deleteCompetenceId" value="">
            <div class='modal-content'>
                <div class='modal-header'>
                    <h5 class='modal-title' id='deleteModalLabel'>Delete Confirmation</h5>
                    <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                </div>
                <div class='modal-body'>
                    Are you sure you want to delete this Competence?
                </div>
                <div class='modal-footer'>
                    <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Cancel</button>
                    <button type='button' class='btn btn-danger' onclick="deleteCompetence()">Delete</button>
                </div>
            </div>
        </div>
    </div>

    {{-- Delete Client --}}
    <div class='modal fade' id='deleteClient' tabindex='-1' role='dialog' aria-labelledby='deleteModalLabel'
        aria-hidden='true'>
        <div class='modal-dialog' role='document'>
            <input type="hidden" id="deleteClientId" value="">
            <div class='modal-content'>
                <div class='modal-header'>
                    <h5 class='modal-title' id='deleteModalLabel'>Delete Confirmation</h5>
                    <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                </div>
                <div class='modal-body'>
                    Are you sure you want to delete this Client?
                </div>
                <div class='modal-footer'>
                    <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Cancel</button>
                    <button type='button' class='btn btn-danger' onclick="deleteClient()">Delete</button>
                </div>
            </div>
        </div>
    </div>

    {{-- Delete Team --}}
    <div class='modal fade' id='deleteTeam' tabindex='-1' role='dialog' aria-labelledby='deleteModalLabel'
        aria-hidden='true'>
        <div class='modal-dialog' role='document'>
            <input type="hidden" id="deleteTeamId" value="">
            <div class='modal-content'>
                <div class='modal-header'>
                    <h5 class='modal-title' id='deleteModalLabel'>Delete Confirmation</h5>
                    <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                </div>
                <div class='modal-body'>
                    Are you sure you want to delete this Team?
                </div>
                <div class='modal-footer'>
                    <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Cancel</button>
                    <button type='button' class='btn btn-danger' onclick="deleteTeam()">Delete</button>
                </div>
            </div>
        </div>
    </div>

    {{-- Image Modal --}}
    <div class="modal fade" id="imageModal" tabindex="-1" role="dialog" aria-labelledby="imageModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <img src="" alt="Large Image" id="modalImage" style="width: 100%;">
                </div>
            </div>
        </div>
    </div>
@endsection
