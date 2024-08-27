@extends('layouts/layoutMaster')

@section('title', 'Pengaturan Perusahaan - Pages')

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
    {{-- <script src="{{asset('assets/js/app-user-list.js')}}"></script> --}}
    <script src="{{ asset('js/master.js') }}"></script>
    <script src="{{ asset('js/perusahaan.js') }}"></script>
@endsection

@section('content')
    <h4 class="py-3 mb-4">
        <span class="text-muted fw-light">Pengaturan /</span> Perusahaan
    </h4>

    <div class="row">
        <div class="col-lg-12">
            <div class="card mb-4">
                <h5 class="card-header">Informasi Perusahaan</h5>
                <div class="card-body">
                    <form action="" class="needs-validation" novalidate id="form-perusahaan">
                        @csrf
                        <div class="row">
                            <div class="col-lg-6 mb-2">
                                <div class="input-group">
                                    <div class="form-floating form-floating-outline">
                                        <input type="text" class="form-control" id="nama_pt" name="nama_pt"
                                            aria-label="Nama PT" aria-describedby="basic-addon11"
                                            value="{{ $perusahaan->nama_pt }}" required/>
                                        <label for="basic-addon11">Nama PT</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 mb-2">
                                <div class="input-group">
                                    <div class="form-floating form-floating-outline">
                                        <input type="text" class="form-control" id="nama_perusahaan"
                                            name="nama_perusahaan" aria-label="Nama Perusahaan"
                                            aria-describedby="basic-addon11" value="{{ $perusahaan->nama_perusahaan }}" required/>
                                        <label for="basic-addon11">Nama Perusahaan</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col mb-4">
                                <div class="form-floating form-floating-outline">
                                    <textarea id="deskripsi" class="form-control h-px-200" name="deskripsi" placeholder="Deskripsi"
                                    rows="200" cols="20">{{ $perusahaan->deskripsi }}</textarea>
                                    <label for="uraian_kegiatan">Deskripsi</label>
                                </div>
                            </div>
                            <div class="col-lg-6 mb-2">
                              <div class="row">
                                <div class="sm-col-12 col-lg-6">
                                  <label for="formFile" class="form-label">Logo Perusahaan</label>
                                  <input class="form-control" type="file" id="formFile" name="logo_perusahaan">
                                  @if ($perusahaan->logo_perusahaan)
                                      <div class="col-lg-6 mt-2">
                                          <img src="/images/{{ $perusahaan->logo_perusahaan }}"
                                              alt="" height="100">
                                      </div>
                                  @endif
                                </div>
                                <div class="sm-col-12 col-lg-6">
                                  <label for="formFile" class="form-label">Logo Navbar</label>
                                  <input class="form-control" type="file" id="formFile" name="logo_text">
                                  @if ($perusahaan->logo_text)
                                      <div class="col-lg-6 mt-2">
                                          <img src="/images/{{ $perusahaan->logo_text }}"
                                              alt="" height="50">
                                      </div>
                                  @endif
                                </div>
                              </div>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-lg-6 mb-2">
                                <div class="input-group">
                                    <div class="form-floating form-floating-outline">
                                        <input type="email" class="form-control" id="email" name="email" placeholder="email@email.com"
                                            value="{{ $perusahaan->email }}" />
                                        <label for="email">Email Perusahaan</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 mb-2">
                                <div class="input-group">
                                    <div class="form-floating form-floating-outline">
                                        <input type="number" class="form-control" id="nomor_telepon" name="nomor_telepon" placeholder="081234567890"
                                            value="{{ $perusahaan->nomor_telepon }}" />
                                        <label for="nomor_telepon">No Telephone</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 mt-4">
                                <div class="form-floating form-floating-outline mb-4">
                                    <textarea id="alamat" class="form-control h-px-100" name="alamat" placeholder="Alamat Perusahaan"
                                    rows="100" cols="20">{{ $perusahaan->alamat }}</textarea>
                                    <label for="alamat">Alamat Perusahaan</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating form-floating-outline mb-4">
                                    <textarea id="about" class="form-control h-px-200" name="about" placeholder="Tentang Perusahaan"
                                    rows="200" cols="20">{{ $perusahaan->about }}</textarea>
                                    <label for="about">Tentang Perusahaan</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating form-floating-outline mb-4">
                                    <textarea id="law" class="form-control h-px-200" name="sdm" placeholder="Sumber Daya Manusia"
                                    rows="200" cols="20">{{ $perusahaan->sdm }}</textarea>
                                    <label for="law">Sumber Daya Manusia</label>
                                </div>
                            </div>
                        </div>
                        {{-- <div class="row">
                            <div class="col-12 mt-4">
                                <label for="visi_form">Visi</label>
                                <div id="snow-toolbar">
                                    <span class="ql-formats">
                                        <select class="ql-font"></select>
                                        <select class="ql-size"></select>
                                    </span>
                                    <span class="ql-formats">
                                        <button class="ql-bold"></button>
                                        <button class="ql-italic"></button>
                                        <button class="ql-underline"></button>
                                        <button class="ql-strike"></button>
                                    </span>
                                    <span class="ql-formats">
                                        <select class="ql-color"></select>
                                        <select class="ql-background"></select>
                                    </span>
                                    <span class="ql-formats">
                                        <button class="ql-script" value="sub"></button>
                                        <button class="ql-script" value="super"></button>
                                    </span>
                                    <span class="ql-formats">
                                        <button class="ql-header" value="1"></button>
                                        <button class="ql-header" value="2"></button>
                                        <button class="ql-blockquote"></button>
                                        <button class="ql-code-block"></button>
                                    </span>
                                </div>
                                <input type="text" name="visi" id="visi_form" hidden value="{!! $perusahaan->visi !!}">
                                <div id="snow-editor">
                                    {!! $perusahaan->visi !!}
                                </div>
                            </div>
                            <div class="col-12 mt-4">
                                <label for="misi_form">Misi</label>
                                <div id="snow-toolbar-misi">
                                    <span class="ql-formats">
                                        <select class="ql-font"></select>
                                        <select class="ql-size"></select>
                                    </span>
                                    <span class="ql-formats">
                                        <button class="ql-bold"></button>
                                        <button class="ql-italic"></button>
                                        <button class="ql-underline"></button>
                                        <button class="ql-strike"></button>
                                    </span>
                                    <span class="ql-formats">
                                        <select class="ql-color"></select>
                                        <select class="ql-background"></select>
                                    </span>
                                    <span class="ql-formats">
                                        <button class="ql-script" value="sub"></button>
                                        <button class="ql-script" value="super"></button>
                                    </span>
                                    <span class="ql-formats">
                                        <button class="ql-header" value="1"></button>
                                        <button class="ql-header" value="2"></button>
                                        <button class="ql-blockquote"></button>
                                        <button class="ql-code-block"></button>
                                    </span>
                                </div>
                                <input type="text" name="misi" id="misi_form" hidden value="{!! $perusahaan->misi !!}">
                                <div id="snow-editor-misi">
                                    {!! $perusahaan->misi !!}
                                </div>
                            </div>
                        </div> --}}
                        <button class="btn btn-primary w-100 mt-2">Simpan</button>
                    </form>

                </div>
            </div>
        </div>


    </div>

@endsection
