@extends('layouts/layoutMaster')

@section('title', ' Edit Kepailitan - Forms')

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
    <script src="{{ asset('assets/js/form-layouts.js') }}"></script>
    <script src="{{ asset('js/master.js') }}"></script>
    <script src="{{ asset('js/kepailitan.js') }}"></script>
@endsection

@section('content')

{{-- @php
    dd($kepailitan_kuasa_hukum->pluck('id_user')->toArray());
@endphp --}}
    <h4 class="py-3 mb-4">
        <span class="text-muted fw-light">Kepailitan /</span> Edit Kepailitan
    </h4>
    <!-- Basic Layout -->
    <div class="row">
        <div class="col-xl">
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Form Edit Kepailitan</h5> <small class="text-body float-end"></small>
                </div>
                <div class="card-body">
                    <form class="forms-edit-validation" onsubmit="return false;" novalidate id="formeditkegiatan" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-floating form-floating-outline mb-4">
                            <select id="type_kepailitan" class="select2 form-select" name="type_kepailitan"
                                data-allow-clear="true">
                                <option value="">Select</option>
                                <option value="Debitor" {{ $data->type_kepailitan == "Debitor" ? "Selected" : "" }}>Debitor</option>
                                <option value="Kurator" {{ $data->type_kepailitan == "Kurator" ? "Selected" : "" }}>Kurator</option>
                                <option value="Kreditor" {{ $data->type_kepailitan == "Kreditor" ? "Selected" : "" }}>Kreditor</option>
                                <option value="Pengurus PKPU" {{ $data->type_kepailitan == "Pengurus PKPU" ? "Selected" : "" }}>Pengurus PKPU</option>
                            </select>
                            <label for="type_kepailitan">Jenis Kepailitan</label>
                        </div>

                        <div class="form-floating form-floating-outline mb-4">
                            <input type="text" class="form-control" id="no_perkara" name="no_perkara"
                                placeholder="SKH891289" value="{{ $data->no_perkara }}" />
                            <label for="no_perkara">Nomor Perkara</label>
                        </div>
                        <div class="form-floating form-floating-outline mb-4">
                            <input type="text" class="form-control" id="nama_kegiatan" name="nama_kegiatan"
                                placeholder="Nama Kegiatan" value="{{ $data->nama_kegiatan }}" />
                            <label for="nama_kegiatan">Nama Kegiatan</label>
                        </div>

                        <div class="col-lg-12 md-12">
                            <div class="form-floating form-floating-outline mb-4">
                              <select id="jenis_pemberi_kuasa" class="select2 form-select" name="jenis_pemberi_kuasa"
                                  data-allow-clear="true" required>
                                  <option value="">Select</option>
                                  <option value="Badan Usaha" {{ $data->jenis_pemberi_kuasa == "Badan Usaha" ? "Selected" : "" }}>Badan Usaha</option>
                                  <option value="Perseorangan" {{ $data->jenis_pemberi_kuasa == "Perseorangan" ? "Selected" : "" }}>Perseorangan</option>
                              </select>
                              <label for="jenis_pemberi_kuasa">Jenis Pemberi Kuasa</label>
                            </div>
                          </div>

                        <input type="hidden" id="jumlahPihak" value="{{ count($kepailitan_pemberikuasa) }}">
                        <label>Pemberi Kuasa</label>
                        <div id="dynamicInputContainer" class="d-flex flex-column">
                                @if (count($kepailitan_pemberikuasa) > 0)
                                    @foreach ($kepailitan_pemberikuasa as $item)
                                        <div class="d-flex gap-2 mb-3 row-add" style="align-items: center !important">
                                            <div class="col-md-5"><input type="text" class="form-control" name="name[{{ $loop->iteration }}]" placeholder="Nama" value="{{ $item->nama }}"></div>
                                            <div class="col-md-2"><input type="text" class="form-control" name="email[{{ $loop->iteration }}]" placeholder="Email" value="{{ $item->email }}"></div>
                                            <div class="col-md-2"><input type="text" class="form-control" name="notelp[{{ $loop->iteration }}]" placeholder="No Telp" value="{{ $item->notelp }}"></div>
                                            @if ($loop->iteration > 1)
                                            <div class="col-md-2"><button type="button" class="btn btn-danger remove_attach">Remove</button></div>
                                                
                                            @endif
                                        </div>
                                    @endforeach
                                @else
                                <div id="dynamicInputContainer" class="d-flex flex-column">
                                    <div class="d-flex gap-2 mb-3" style="align-items: center !important">
                                        <div class="col-md-5"><input type="text" class="form-control" name="name[1]" placeholder="Nama"></div>
                                        <div class="col-md-2"><input type="text" class="form-control" name="email[1]" placeholder="Email"></div>
                                        <div class="col-md-2"><input type="number" class="form-control" name="notelp[1]" placeholder="No Telp"></div>
                                    </div>
                                </div>
                            @endif
                        </div>
                        <button type="button" class="btn btn-primary mb-3 pl-3" style="width: fit-content;margin-left: 13px !important" id="tambah">Tambah Pemberi Kuasa</button>

                        <div class="form-floating form-floating-outline mb-4">
                            <textarea id="alamat" name="alamat" class="form-control" placeholder="Alamat.." style="height: 60px;">{{ $data->alamat }}</textarea>
                            <label for="alamat">Alamat</label>
                        </div>
                        
                        <div class="form-floating form-floating-outline mb-4">
                            <textarea id="uraian_kegiatan" class="form-control" name="uraian_kegiatan" placeholder="Uraian..." style="height: 60px;">{{ $data->uraian }}</textarea>
                            <label for="uraian_kegiatan">Uraian Kegiatan</label>
                        </div>
                        <div class="col-md-12 select2-primary mb-4">
                            <div class="form-floating form-floating-outline">
                                <select name="leader" class="kuasa_hukum select2 form-select">
                                    
                                    @foreach ($kuasa_hukum as $value)
                                        <option value="{{ $value->id }}"  {{ $value->id == $data->leader ? 'selected' : '' }}>{{ $value->name }}</option>
                                    @endforeach
                                </select>
                                <label for="kuasa_hukum">Leader Kuasa Hukum</label>
                            </div>
                        </div>
                        <div class="col-md-12 select2-primary mb-4">
                            <div class="form-floating form-floating-outline">
                                <select name="kuasa_hukum[]" class="kuasa_hukum select2 form-select" multiple>
                                    @foreach ($kuasa_hukum as $value)
                                        <option value="{{ $value->id }}"  {{ in_array($value->id, $kepailitan_kuasa_hukum->pluck('id_user')->toArray()) ? 'selected' : '' }}>{{ $value->name }}</option>
                                    @endforeach
                                </select>
                                <label for="kuasa_hukum">Kuasa Hukum yang ditugaskan</label>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <label for="formFile" class="form-label">Surat Kuasa</label>
                            <input class="form-control" type="file" id="formFile" name="file_kegiatan" value="{{ $data->file }}">
                            @if($data->file)
                                <p>Current File: {{ $data->file }}</p>
                            @endif
                        </div>
                        <button id="submitButton" type="submit" kode="{{ $data->id }}" class="btn btn-primary mt-4">Simpan Kegiatan</button>

                      </form>
                </div>
            </div>
        </div>

    </div>
@endsection
