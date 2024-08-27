$(document).ready(function () {
  getData();



});
// Example starter JavaScript for disabling form submissions if there are invalid fields
(function () {
  'use strict';

  // Fetch all the forms we want to apply custom Bootstrap validation styles to
  var forms = document.querySelectorAll('.needs-validation');
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
          ajaxPostFile('/kegiatan/simpan', data, 'success_res', 'error_res');
        }

        form.classList.add('was-validated');
      },
      false
    );
  });

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
          ajaxPostFile(`/kegiatan/update/${id}`, data, 'success_res', 'error_res');
        }

        form.classList.add('was-validated');
      },
      false
    );
  });
})();

var table = '';

function getData() {
  table = $('.datatables-kegiatan').DataTable({
    processing: true,
    serverSide: true,
    searching: true,
    responsive: false,
    search: {
      regex: true
    },
    ajax: {
      url: '/kegiatan/list',
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
        data: 'nama',
        name: 'nama',
        responsivePriority: -1
      },
      {
        data: 'type_kegiatan',
        name: 'type_kegiatan',
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


var no = $('#jumlahPihak').val() != 0 ? $('#jumlahPihak').val() : 1;

$(document).on('click', '#tambah', function () {
  no++;
  var inputGroup = $(
    '<div class="d-flex gap-2 row-add form-row mb-3 align-items-center">' +
      '<div class="col-md-5"><input type="text" class="form-control" name="name[]" placeholder="Name" required></div>' +
      '<div class="col-md-2"><input type="text" class="form-control" name="email[]" placeholder="Email" required></div>' +
      '<div class="col-md-2"><input type="number" class="form-control" name="notelp[]" placeholder="No Telp" required></div>' +
      '<div class="col-md-2"><button type="button" class="btn btn-danger remove_attach"><span class="mdi mdi-trash-can-outline"></span></button></div>' +
    '</div>'
  );

  $('#dynamicInputContainer').append(inputGroup);
});

$(document).on('click', '.remove_attach', function (e) {
  console.log(`asdsad`);
  if (e.type == 'click') {
    if (no > 1) {
      $(this).parents('.row-add').fadeOut();
      $(this).parents('.row-add').remove();
      no--;
    }
  }
});

function deleteRecord() {
  id = $('#deleteModal #deleteRecordId').val();
  var csrfToken = $('meta[name="csrf-token"]').attr('content');
  $.ajax({
    type: 'DELETE',
    url: `kegiatan/hapus/${id}`,
    headers: {
      'X-CSRF-TOKEN': csrfToken
    },
    success: function (response) {
      $('#deleteModal').modal('hide');
      $('.datatables-kegiatan').DataTable().ajax.reload();
    },
    error: function (error) {
      console.error('Delete error:', error);
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
    window.location.href = '/kegiatan';
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
