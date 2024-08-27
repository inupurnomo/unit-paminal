$(document).ready(function () {
  getData();

  $('#kategori').hide();
  $('#role').on('change', function () {
    var selectedOption = $(this).val();
    if (selectedOption == 'advokat') {
      $('#kategori').show();
    } else {
      $('#kategori').hide();
    }
  });
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
          ajaxPostJson('/pengaturan/user-baru', $('#formcreateuser').serialize(), 'success_res', 'error_res');
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
          var id = document.getElementById('submitButton').getAttribute('kode');
          ajaxPostJson(`/pengaturan/user/update/${id}`, $('#formedituser').serialize(), 'success_res', 'error_res');
        }

        form.classList.add('was-validated');
      },
      false
    );
  });
})();

var table = '';

$('#resetPassword').on('click', function () {
  var id = $(this).data('id');
  $('#resetModal').modal('show');
  $('#resetModal #resetRecordId').val(id);
});

function getData() {
  table = $('.datatables-users').DataTable({
    processing: true,
    serverSide: true,
    searching: true,
    responsive: false,
    search: {
      regex: true
    },
    ajax: {
      url: '/pengaturan/user/list',
      method: 'post',
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
        data: 'name',
        name: 'name',
        responsivePriority: -1
      },
      {
        data: 'username',
        name: 'username',
        responsivePriority: -1
      },
      {
        data: 'role',
        orderable: false,
        searchable: false
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

function deleteRecord() {
  id = $('#deleteModal #deleteRecordId').val();
  var csrfToken = $('meta[name="csrf-token"]').attr('content');
  $.ajax({
    type: 'DELETE',
    url: `/pengaturan/user/hapus/${id}`,
    headers: {
      'X-CSRF-TOKEN': csrfToken
    },
    success: function (response) {
      $('#deleteModal').modal('hide');
      $('.datatables-users').DataTable().ajax.reload();
      success_res(response);
    },
    error: function (error) {
      console.error('Delete error:', error);
      error_res('Delete gagal');
    }
  });
}

function resetPassword() {
  id = $('#resetModal #resetRecordId').val();
  console.log(id);
  var csrfToken = $('meta[name="csrf-token"]').attr('content');
  $.ajax({
    type: 'POST',
    url: `/pengaturan/user/reset/${id}`,
    headers: {
      'X-CSRF-TOKEN': csrfToken
    },
    success: function (response) {
      $('#deleteModal').modal('hide');
      success_res(response);
    },
    error: function (error) {
      console.error('Reset error:', error);
      error_res('Reset error');
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
    table.table().draw();
    window.location.href = '/pengaturan/user';
    $('#modal_buat_user').modal('hide');
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
