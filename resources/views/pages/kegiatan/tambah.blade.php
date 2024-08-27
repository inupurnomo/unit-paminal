@extends('layouts/layoutMaster')

@section('title', ' Tambah Kegiatan - Forms')

@section('vendor-style')
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/select2/select2.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/@form-validation/umd/styles/index.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/animate-css/animate.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/sweetalert2/sweetalert2.css') }}" />

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
@endsection

@section('page-script')
    <script src="{{ asset('assets/js/form-layouts.js') }}"></script>
    <script src="{{ asset('js/master.js') }}"></script>
    <script src="{{ asset('js/kegiatan.js') }}"></script>
@endsection

@section('content')
    <h4 class="py-3 mb-4">
        <span class="text-muted fw-light">Perkara /</span> Tambah Perkara
    </h4>
    <!-- Basic Layout -->
    <div class="row">
        <div class="col-xl">
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Form Perkara</h5> <small class="text-body float-end"></small>
                </div>
                <div class="card-body">
                    <form class="needs-validation" novalidate id="formcreatekegiatan" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-lg-6 md-12">
                                <div class="form-floating form-floating-outline mb-4">
                                    <select id="type_kegiatan" class="select2 form-select" name="type_kegiatan"
                                        data-allow-clear="true" required>
                                        <option value="">Pilih</option>
                                        <option value="Sidang">Sidang</option>
                                        <option value="Non Sidang">Non Sidang</option>
                                    </select>
                                    <label for="type_kegiatan">Jenis Perkara</label>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-12">
                                <div class="form-floating form-floating-outline mb-4">
                                    <input type="text" class="form-control" id="no_perkara" name="no_perkara"
                                        placeholder="SKH891289" required />
                                    <label for="no_perkara">Nomor Perkara</label>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-floating form-floating-outline mb-4">
                                    <input type="text" class="form-control" id="nama_kegiatan" name="nama_kegiatan"
                                        placeholder="Nama Kegiatan" required />
                                    <label for="nama_kegiatan">Nama Perkara</label>
                                </div>
                            </div>
                            <div class="col-lg-12 md-12">
                                <div class="form-floating form-floating-outline mb-4">
                                    <select id="jenis_pemberi_kuasa" class="select2 form-select" name="jenis_pemberi_kuasa"
                                        data-allow-clear="true" required>
                                        <option value="">Select</option>
                                        <option value="Badan Usaha">Badan Usaha</option>
                                        <option value="Perseorangan">Perseorangan</option>
                                    </select>
                                    <label for="jenis_pemberi_kuasa">Jenis Pemberi Kuasa</label>
                                </div>
                            </div>

                            <input type="hidden" value="1" id="jumlahPihak">
                            <label>Pemberi Kuasa</label>
                            <div id="dynamicInputContainer" class="d-flex flex-column">
                                <div class="d-flex gap-2 mb-3" style="align-items: center !important">
                                    <div class="col-md-5"><input type="text" class="form-control" name="name[1]"
                                            placeholder="Nama"></div>
                                    <div class="col-md-2"><input type="text" class="form-control" name="email[1]"
                                            placeholder="Email"></div>
                                    <div class="col-md-2"><input type="number" class="form-control" name="notelp[1]"
                                            placeholder="No Telp"></div>
                                </div>
                            </div>
                            <button type="button" class="btn btn-primary mb-3 pl-3"
                                style="width: fit-content;margin-left: 13px !important" id="tambah">Tambah Pemberi
                                Kuasa</button>

                            {{-- <div class="col-lg-4 col-md-12">
                            <div class="form-floating form-floating-outline mb-4">
                              <input type="text" id="no_telp" class="form-control phone-mask" name="no_telp"
                                  placeholder="658 799 8941" required/>
                              <label for="no_telp">No Telp</label>
                            </div>
                          </div>
                          <div class="col-lg-4 col-md-12">
                            <div class="mb-4">
                              <div class="input-group input-group-merge">
                                  <div class="form-floating form-floating-outline">
                                      <input type="text" id="email" class="form-control" name="email"
                                          placeholder="john.doe" aria-label="john.doe" aria-describedby="email2" required/>
                                      <label for="email">Email</label>
                                  </div>
                              </div>
                              @error('email')
                                  <div style="color:red">{{ $message }}</div>
                              @enderror
                            </div>
                          </div> --}}
                        </div>

                        <div class="form-floating form-floating-outline mb-4">
                            <textarea id="alamat" name="alamat" class="form-control" placeholder="Alamat.." style="height: 60px;"></textarea>
                            <label for="alamat">Alamat</label>
                        </div>
                        <div class="form-floating form-floating-outline mb-4">
                            <textarea id="uraian_kegiatan" class="form-control h-px-200" name="uraian_kegiatan" placeholder="Uraian..."
                                rows="200" cols="20"></textarea>
                            <label for="uraian_kegiatan">Uraian Perkara</label>
                        </div>
                        <div class="col-md-12 select2-primary mb-4">
                            <div class="form-floating form-floating-outline">
                                <select id="leader" name="leader" class="select2 form-select">
                                    <option value="">Select Leader</option>
                                    @foreach ($kuasa_hukum as $value)
                                        <option value="{{ $value->id }}">{{ $value->name }}</option>
                                    @endforeach
                                </select>
                                <label for="leader">Leader Kuasa Hukum</label>
                            </div>
                        </div>
                        <div class="col-md-12 select2-primary mb-4">
                            <div class="form-floating form-floating-outline">
                                <select id="kuasa_hukum" name="kuasa_hukum[]" class="select2 form-select" multiple>
                                    @foreach ($kuasa_hukum as $value)
                                        <option value="{{ $value->id }}">{{ $value->name }}</option>
                                    @endforeach
                                </select>
                                <label for="kuasa_hukum">Kuasa Hukum yang Bertugas</label>
                            </div>
                        </div>
                        <div class="col-lg-12 mb-4">
                            <label for="formFile" class="form-label">Surat Kuasa</label>
                            <input class="form-control" type="file" id="formFile" name="file_kegiatan">
                        </div>

                        <div class="col-lg-12">
                            <label for="formDokumen" class="form-label">Dokumen Pendukung</label>
                            <input class="form-control" type="file" id="formDokumen" name="dokumen_pendukung[]"
                                multiple>
                        </div>

                        <button type="submit" class="btn btn-primary mt-4">Simpan Perkara</button>

                    </form>
                </div>
            </div>
        </div>

    </div>
@endsection
