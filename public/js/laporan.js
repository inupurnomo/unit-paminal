$(document).ready(function () {
  getData();

  $('.flatpickr-date').flatpickr({
    monthSelectorType: 'static'
  });
  $('#jenis_laporan').on('change', function () {
    var selectedOption = $(this).val();
    getDataKegiatan(selectedOption);

    if (selectedOption == "Sidang") {
      $(".div-sidang").empty().html(`<div class="d-flex gap-2 mb-3" style="align-items: center !important">
        <div class="col-md-5"><input type="text" class="form-control" name="name[1]" placeholder="Name"></div>
        <div class="col-md-2"><input type="text" class="form-control" name="jabatan[1]" placeholder="Peran/Jabatan" value="Hakim" readonly></div>
        <div class="col-md-2">
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="description[1]" value="yes" id="yesRadio1" checked>
                <label class="form-check-label" for="yesRadio1">Hadir</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="description[1]" value="no" id="noRadio1">
                <label class="form-check-label" for="noRadio1">Tidak Hadir</label>
            </div>
        </div>
    </div>

    <div class="d-flex gap-2 mb-3" style="align-items: center !important">
        <div class="col-md-5"><input type="text" class="form-control" name="name[2]" placeholder="Name"></div>
        <div class="col-md-2"><input type="text" class="form-control" name="jabatan[2]" placeholder="Peran/Jabatan" value="Hakim Anggota" readonly></div>
        <div class="col-md-2">
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="description[2]" value="yes" id="yesRadio2" checked>
                <label class="form-check-label" for="yesRadio2">Hadir</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="description[2]" value="no" id="noRadio2">
                <label class="form-check-label" for="noRadio2">Tidak Hadir</label>
            </div>
        </div>
    </div>

    <div class="d-flex gap-2 mb-3" style="align-items: center !important">
        <div class="col-md-5"><input type="text" class="form-control" name="name[3]" placeholder="Name"></div>
        <div class="col-md-2"><input type="text" class="form-control" name="jabatan[3]" placeholder="Peran/Jabatan" value="Hakim Anggota" readonly></div>
        <div class="col-md-2">
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="description[3]" value="yes" id="yesRadio3" checked>
                <label class="form-check-label" for="yesRadio3">Hadir</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="description[3]" value="no" id="noRadio3">
                <label class="form-check-label" for="noRadio3">Tidak Hadir</label>
            </div>
        </div>
    </div>

    <div class="d-flex gap-2 mb-3" style="align-items: center !important">
        <div class="col-md-5"><input type="text" class="form-control" name="name[4]" placeholder="Name"></div>
        <div class="col-md-2"><input type="text" class="form-control" name="jabatan[4]" placeholder="Peran/Jabatan" value="Panitera Pengganti" readonly></div>
        <div class="col-md-2">
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="description[4]" value="yes" id="yesRadio4" checked>
                <label class="form-check-label" for="yesRadio4">Hadir</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="description[4]" value="no" id="noRadio4">
                <label class="form-check-label" for="noRadio4">Tidak Hadir</label>
            </div>
        </div>
    </div>`);
      $(".div-nonsidang").empty().html(``);
      $("#div-sidang-time").empty().html(`<div class="col-lg-6 md-12">
        <div class="form-floating form-floating-outline mb-4">
            <input class="form-control" type="time" name="startTime" id="startTime" />
            <label for="html5-time-input">Waktu Mulai Sidang</label>
            </div>
    </div>

    <div class="col-lg-6 md-12">
        <div class="form-floating form-floating-outline mb-4">
            <input class="form-control" type="time" name="endTime" id="EndTime" />
            <label for="html5-time-input">Waktu Selesai Sidang</label>
            </div>
    </div>`);

      no = 4;
    } else {
      $(".div-sidang").empty().html(``);
      $("#div-sidang-time").empty().html(``);
      $(".div-nonsidang").empty().html(`<div class="d-flex gap-2 mb-3" style="align-items: center !important">
            <div class="col-md-5"><input type="text" class="form-control" name="name[1]" placeholder="Name"></div>
            <div class="col-md-2"><input type="text" class="form-control" name="jabatan[1]" placeholder="Peran/Jabatan"></div>
            <div class="col-md-2">
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="description[1]" value="yes" id="yesRadio1" checked>
                    <label class="form-check-label" for="yesRadio1">Hadir</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="description[1]" value="no" id="noRadio1">
                    <label class="form-check-label" for="noRadio1">Tidak Hadir</label>
                </div>
            </div>
        </div>`);
      no = $('#jumlahPihak').val() != 0 ? $('#jumlahPihak').val() : 1;
    }
  });

  $('#kegiatan').on('change', function () {
    var selectedOption = $(this).val();
    getDataKuasaHukum(selectedOption);
  });

  $('#status').on('change', function () {
    var selectedOption = $(this).val();
    console.log(selectedOption);
    if (selectedOption == 3) {
      $('#catatan').removeClass('d-none');
    } else {
      $('#catatan').addClass('d-none');
    }
  });

  // Reference to the image slider container
  var imageSlider = $('.image-slider');
  var modalImage = $('#modalImage');

  imageSlider.slick({
    slidesToShow: 4,
    slidesToScroll: 1,
    autoplay: false,
    dots: true,
    infinite: false,
    responsive: [
      {
        breakpoint: 768,
        settings: {
          slidesToShow: 2
        }
      },
      {
        breakpoint: 480,
        settings: {
          slidesToShow: 1
        }
      }
    ]
  });

  $('.image-link').click(function () {
    var imageUrl = $(this).find('img').attr('src');
    console.log(imageUrl);
    modalImage.attr('src', imageUrl);
  });
});
// Example starter JavaScript for disabling form submissions if there are invalid fields
(function () {
  'use strict';

  // Fetch all the forms we want to apply custom Bootstrap validation styles to
  var forms = document.querySelectorAll('.needs-validation');
  var formsApprove = document.querySelectorAll('.forms-approved');
  var formsEdit = document.querySelectorAll('.forms-edit-validation');

  // Loop over them and prevent submission
  Array.prototype.slice.call(forms).forEach(function (form) {
    form.addEventListener(
      'submit',
      function (event) {
        if (!form.checkValidity()) {
          event.preventDefault();
          event.stopPropagation();
        } else {
          event.preventDefault();
          var data = new FormData(this);
          ajaxPostFile('/laporan/simpan', data, 'success_res', 'error_res');
        }

        form.classList.add('was-validated');
      },
      false
    );
  });

  // Loop over them and prevent submission
  Array.prototype.slice.call(formsEdit).forEach(function (form) {
    form.addEventListener(
      'submit',
      function (event) {
        if (!form.checkValidity()) {
          event.preventDefault();
          event.stopPropagation();
        } else {
          event.preventDefault();
          var data = new FormData(this);
          var id = document.getElementById('submitButton').getAttribute('kode');
          ajaxPostFile(`/laporan/update/${id}`, data, 'success_res', 'error_res');
        }

        form.classList.add('was-validated');
      },
      false
    );
  });

  // Forms Approve
  Array.prototype.slice.call(formsApprove).forEach(function (form) {
    form.addEventListener(
      'submit',
      function (event) {
        if (!form.checkValidity()) {
          event.preventDefault();
          event.stopPropagation();
        } else {
          event.preventDefault();
          var data = new FormData(this);
          var id = document.getElementById('submitButton').getAttribute('kode');

          ajaxPostFile(`/laporan/approve-laporan/${id}`, data, 'success_res', 'error_res');
        }

        form.classList.add('was-validated');
      },
      false
    );
  });
})();

var table = '';

var no = $('#jumlahPihak').val() != 0 ? $('#jumlahPihak').val() : 1;
var no_uraiain = $('#jumlahuraian').val() != 0 ? $('#jumlahuraian').val() : 1;

$(document).on('click', '#tambah', function () {
  no++;
  var inputGroup = $(
    '<div class="d-flex gap-2 row-add form-row mb-3 align-items-center">' +
    '<div class="col-md-5"><input type="text" class="form-control" name="name[]" placeholder="Name"></div>' +
    '<div class="col-md-2"><input type="text" class="form-control" name="jabatan[]" placeholder="Peran/Jabatan"></div>' +
    '<div class="col-md-2">' +
    '<div class="form-check form-check-inline">' +
    `<input class="form-check-input" type="radio" name="description[${no}]" value="yes" id="yesRadio${no}" checked>` +
    `<label class="form-check-label" for="yesRadio${no}">Hadir</label>` +
    '</div>' +
    '<div class="form-check form-check-inline">' +
    `<input class="form-check-input" type="radio" name="description[${no}]" value="no" id="noRadio${no}">` +
    `<label class="form-check-label" for="noRadio${no}">Tidak Hadir</label>` +
    '</div>' +
    '</div>' +
    '<div class="col-md-2"><button type="button" class="btn btn-danger remove_attach">Remove</button></div>' +
    '</div>'
  );

  $('#dynamicInputContainer').append(inputGroup);
});

$(document).on('click', '#tambah_uraian', function () {
  no_uraiain++;
  var inputGroup = $(`
 <div id="row_kegiatan${no_uraiain}" class="row-add">
 <h5 class="mb-3">Kegiatan ${no_uraiain}</h5> <small class="text-body float-end"></small>
 <div class="row">
   <div class="col-lg-6 md-12">
       <div class="form-floating form-floating-outline">
           <input type="text" name="tanggal[${no_uraiain}]" class="form-control" placeholder="YYYY-MM-DD"
               id="tanggal_uraian${no_uraiain}" required/>
           <label for="flatpickr-date">Tanggal</label>
       </div>
   </div>
   <div class="col-lg-6 col-md-12">
   <div class="form-check">
       <input class="form-check-input" type="radio" name="is_sidang" id="flexRadioDefault${no_uraiain}"
           value="${no_uraiain}" required>
       <label class="form-check-label" for="flexRadioDefault${no_uraiain}">
           Tandai Sebagai Kegiatan Sidang
       </label>
   </div>
</div>
   <div class="col-12 md-12 mt-4">
       <div class="form-floating form-floating-outline mb-4">
           <textarea id="uraian_laporan" class="form-control h-px-200" name="uraian_laporan[${no_uraiain}]" placeholder="Uraian..."
               rows="200" cols="20" required></textarea>
           <label for="uraian_laporan">Uraian hasil Kegiatan</label>
       </div>
   </div>
   <div class="col-md-12 d-flex justify-content-end"><button type="button" class="btn btn-danger remove_uraian">Hapus</button></div>
 </div>
 </div>
  `
  );

  $('#uraian_tambah').append(inputGroup);
  $(`#tanggal_uraian${no_uraiain}`).flatpickr({
    monthSelectorType: 'static'
  });

  $(`#tanggal_uraian${no_uraiain}`).prop('readonly', false);

  $(`#tanggal_uraian${no_uraiain}`).flatpickr({
    monthSelectorType: 'static'
  });

  $(`#tanggal_uraian${no}`).prop('readonly', false);
});
$(document).on('click', '.remove_uraian', function (e) {
  if (e.type == 'click') {
    if (no_uraiain > 1) {
      $(this).parents('.row-add').fadeOut();
      $(this).parents('.row-add').remove();
      no_uraiain--;
    }
  }
});

$(document).on('click', '.remove_attach', function (e) {
  if (e.type == 'click') {
    if (no > 1) {
      $(this).parents('.row-add').fadeOut();
      $(this).parents('.row-add').remove();
      no--;
    }
  }
});

function getData() {
  table = $('.datatables-laporan').DataTable({
    processing: true,
    serverSide: true,
    searching: true,
    responsive: false,
    search: {
      regex: true
    },
    ajax: {
      url: '/laporan/list',
      method: 'get',
      data: function (data) {
        (data._token = $('meta[name="csrf-token"]').attr('content')),
          (data.polda = $('#polda').val()),
          (data.jenis_kelamin = $('#jenis_kelamin').val()),
          (data.jenis_pelanggaran = $('#jenis_pelanggaran').val()),
          (data.pangkat = $('#pangkat').val()),
          (data.wujud_perbuatan = $('#wujud_perbuatan').val()),
          (data.nama_pelanggar = $('#nama_pelanggar').val()),
          (data.nrp = $('#nrp').val()),
          (data.tanggal_mulai = $('#tanggal_mulai').val()),
          (data.tanggal_akhir = $('#tanggal_akhir').val()),
          (data.tanggal_mulai_kep = $('#tanggal_mulai_kep').val()),
          (data.tanggal_akhir_kep = $('#tanggal_akhir_kep').val()),
          (data.tanggal_mulai_sp = $('#tanggal_mulai_sp').val()),
          (data.tanggal_akhir_sp = $('#tanggal_akhir_sp').val()),
          (data.jabatan = $('#jabatan').val()),
          (data.polres = $('#polres').val());
      }
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
        data: 'id_kegiatan',
        name: 'id_kegiatan',
        responsivePriority: -1
      },
      {
        data: 'jenis_laporan',
        name: 'jenis_laporan',
        responsivePriority: -1
      },
      {
        data: 'tanggal_kegiatan',
        name: 'tanggal',
        responsivePriority: -1
      },
      {
        data: 'status',
        name: 'id_status',
        responsivePriority: -1
      },
      {
        data: 'aksi',
        name: 'aksi',
        responsivePriority: -1
      }
    ],
    drawCallback: function () {
      // Bind click event to the delete button
      $('.delete-btn').on('click', function () {
        var id = $(this).data('id');
        $('#deleteModal').modal('show');
        $('#deleteModal #deleteRecordId').val(id);
      });

      $('.submit-button').on('click', function () {
        var id = $(this).data('id');
        $('#submitModal').modal('show');
        $('#submitModal #submitRecordId').val(id);
      });
    }
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

function submitLaporan() {
  id = $('#submitModal #submitRecordId').val();
  password = document.getElementById(`password`).value;
  $('.pesanError').addClass('d-none');

  var csrfToken = $('meta[name="csrf-token"]').attr('content');
  $.ajax({
    type: 'put',
    url: `/laporan/submit-laporan/${id}`,
    headers: {
      'X-CSRF-TOKEN': csrfToken
    },
    data: {
      password: password
    },
    success: function (response) {
      console.log('masuk');
      console.log(response);
      if (response.status == 200) {
        $('#submitModal').modal('hide');
        $('.datatables-laporan').DataTable().ajax.reload();
      } else {
        $('.pesanError').removeClass('d-none');
      }
    },
    error: function (error) {
      console.error('Submit error:', error);
    }
  });
}

function deleteRecord() {
  id = $('#deleteModal #deleteRecordId').val();
  var csrfToken = $('meta[name="csrf-token"]').attr('content');
  $.ajax({
    type: 'DELETE',
    url: `/laporan/hapus/${id}`,
    headers: {
      'X-CSRF-TOKEN': csrfToken
    },
    success: function (response) {
      $('#deleteModal').modal('hide');
      $('.datatables-laporan').DataTable().ajax.reload();
    },
    error: function (error) {
      console.error('Delete error:', error);
    }
  });
}

function getDataKegiatan(id) {
  $.ajax({
    type: 'get',
    url: `/laporan/get-kegiatan/${id}`,
    success: function (response) {
      html = `<option value=''>Select Kegiatan</option>`;
      response.forEach(element => {
        html += `<option value="${element['id']}">${element['nama']}</option>`;
      });

      document.getElementById('kegiatan').innerHTML = html;
    },
    error: function (error) {
      console.error('data error:', error);
    }
  });
}

function getDataKuasaHukum(id) {
  $.ajax({
    type: 'get',
    url: `/laporan/get-kuasa-hukum/${id}`,
    success: function (response) {
      html = '';
      response.forEach(element => {
        console.log(element['id_user'], element['user']['name']);
        html += `<option value="${element['id_user']}">${element['user']['name']}</option>`;
      });

      document.getElementById('kuasa_hukum').innerHTML = html;
    },
    error: function (error) {
      console.error('data error:', error);
    }
  });
}

function success_res(data) {
  if (data.status == 200) {
    Swal.fire({
      position: 'center',
      icon: 'success',
      title: data.message,
      showConfirmButton: false,
      timer: 1500,
      customClass: {
        confirmButton: 'btn btn-primary waves-effect waves-light'
      },
      buttonsStyling: false
    });
    // swal('Login Berhasil', data.message, 'success');
    window.location.href = '/laporan';
  } else if (data.status == 401) {
    Swal.fire({
      icon: 'error',
      title: data.message,
      showConfirmButton: false,
      timer: 1500,
      customClass: {
        confirmButton: 'btn btn-primary waves-effect waves-light'
      },
      buttonsStyling: false
    });
  }
}

function error_res(data) {
  Swal.fire({
    position: 'center',
    icon: 'error',
    title: data,
    showConfirmButton: false,
    timer: 1500,
    customClass: {
      confirmButton: 'btn btn-primary waves-effect waves-light'
    },
    buttonsStyling: false
  });
}
