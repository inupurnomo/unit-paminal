$(document).ready(function () {
  var modalImage = $('#modalImage');

  $('.image-link').click(function () {
    var imageUrl = $(this).find('img').attr('src');
    modalImage.attr('src', imageUrl);
  });

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
  var formsAddCompetence = document.querySelectorAll('.add-new-competence');
  var formsAddClient = document.querySelectorAll('.add-new-client');
  var formsAddTeam = document.querySelectorAll('.add-new-team');
  var formsCompetenceEdit = document.querySelectorAll('.forms-edit-competence');
  var formsClientEdit = document.querySelectorAll('.forms-edit-client');
  var formsTeamEdit = document.querySelectorAll('.forms-edit-team');

  // Loop over them and prevent submission
  Array.prototype.slice.call(formsAddCompetence).forEach(function (form) {
    form.addEventListener(
      'submit',
      function (event) {
        if (!form.checkValidity()) {
          event.preventDefault();
          event.stopPropagation();
        } else {
          event.preventDefault();
          var data = new FormData(this);
          ajaxPostFile('/pengaturan/kompetensi/tambah', data, 'success_res', 'error_res');
        }

        form.classList.add('was-validated');
        form.reset();
      },
      false
    );
  });

  Array.prototype.slice.call(formsAddClient).forEach(function (form) {
    form.addEventListener(
      'submit',
      function (event) {
        if (!form.checkValidity()) {
          event.preventDefault();
          event.stopPropagation();
        } else {
          event.preventDefault();
          var data = new FormData(this);
          ajaxPostFile('/pengaturan/client/tambah', data, 'success_res', 'error_res');
        }

        form.classList.add('was-validated');
        form.reset();
      },
      false
    );
  });

  Array.prototype.slice.call(formsAddTeam).forEach(function (form) {
    form.addEventListener(
      'submit',
      function (event) {
        if (!form.checkValidity()) {
          event.preventDefault();
          event.stopPropagation();
        } else {
          event.preventDefault();
          var data = new FormData(this);
          ajaxPostFile('/pengaturan/user-baru', data, 'success_res', 'error_res');
        }

        form.classList.add('was-validated');
        // form.reset();
      },
      false
    );
  });

  Array.prototype.slice.call(formsCompetenceEdit).forEach(function (form) {
    form.addEventListener(
      'submit',
      function (event) {
        if (!form.checkValidity()) {
          event.preventDefault();
          event.stopPropagation();
        } else {
          event.preventDefault();
          var id = document.getElementById('submitCompetence').getAttribute('kode');
          var data = new FormData(this);
          ajaxPostFile(`/pengaturan/kompetensi/update/${id}`, data, 'success_res', 'error_res');
        }

        form.classList.add('was-validated');
      },
      false
    );
  });

  Array.prototype.slice.call(formsClientEdit).forEach(function (form) {
    form.addEventListener(
      'submit',
      function (event) {
        if (!form.checkValidity()) {
          event.preventDefault();
          event.stopPropagation();
        } else {
          event.preventDefault();
          var id = document.getElementById('submitClient').getAttribute('kode');
          var data = new FormData(this);
          ajaxPostFile(`/pengaturan/client/update/${id}`, data, 'success_res', 'error_res');
        }

        form.classList.add('was-validated');
      },
      false
    );
  });

  Array.prototype.slice.call(formsTeamEdit).forEach(function (form) {
    form.addEventListener(
      'submit',
      function (event) {
        if (!form.checkValidity()) {
          event.preventDefault();
          event.stopPropagation();
        } else {
          event.preventDefault();
          var id = document.getElementById('submitTeam').getAttribute('kode');
          var data = new FormData(this);
          ajaxPostFile(`/pengaturan/team/update/${id}`, data, 'success_res', 'error_res');
        }

        form.classList.add('was-validated');
        form.reset();
      },
      false
    );
  });
})();

var table = '';

function getData() {
  tableCompetence = $('.datatables-competence').DataTable({
    processing: true,
    serverSide: true,
    searching: true,
    responsive: false,
    pageLength: 5,
    lengthMenu: [5, 10, 15, 20],
    search: {
      regex: true
    },
    ajax: {
      url: '/pengaturan/kompetensi/list',
      method: 'post',
      data: function (data) {
        data._token = $('meta[name="csrf-token"]').attr('content');
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
        data: 'gambar',
        name: 'gambar',
        responsivePriority: -1
      },
      {
        data: 'title',
        name: 'title',
        responsivePriority: -1
      },
      {
        data: 'content',
        name: 'content',
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
      $('.edit-competence').on('click', function () {
        var id = $(this).data('id');
        var svg = $(this).data('svg');
        var title = $(this).data('title');
        var content = $(this).data('content');
        $('#offcanvasEditCompetence').offcanvas('show');
        $('#submitCompetence').attr('kode', id);
        $('#offcanvasEditCompetence #competenceSvg').val(svg);
        $('#offcanvasEditCompetence #competenceTitle').val(title);
        $('#offcanvasEditCompetence #competenceContent').val(content);
      });
      // Bind click event to the delete button
      $('.delete-competence').on('click', function () {
        var id = $(this).data('id');
        $('#deleteCompetence').modal('show');
        $('#deleteCompetence #deleteCompetenceId').val(id);
      });
    }
  });
  $('#kt_search').on('click', function (e) {
    e.preventDefault();
    tableCompetence.table().draw();
  });

  $('#kt_reset').on('click', function (e) {
    $('.form-control').val('');
    tableCompetence.table().draw();
  });

  tableClient = $('.datatables-clients').DataTable({
    processing: true,
    serverSide: true,
    searching: true,
    responsive: false,
    pageLength: 5,
    lengthMenu: [5, 10, 15, 20],
    search: {
      regex: true
    },
    ajax: {
      url: '/pengaturan/client/list',
      method: 'post',
      data: function (data) {
        data._token = $('meta[name="csrf-token"]').attr('content');
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
        data: 'gambar',
        name: 'gambar',
        responsivePriority: -1
      },
      {
        data: 'label',
        name: 'label',
        responsivePriority: -1
      },
      {
        data: 'alamat',
        name: 'alamat',
        responsivePriority: -1
      },
      {
        data: 'aksi',
        name: 'aksi',
        responsivePriority: -1
      },
    ],
    drawCallback: function () {
      // Image modal
      var modalImage = $('#modalImage');
      $('.image-link').click(function () {
        var imageUrl = $(this).find('img').attr('src');
        modalImage.attr('src', imageUrl);
      });
      // Bind click event to the delete button
      $('.edit-client').on('click', function () {
        var id = $(this).data('id');
        var image = $(this).data('image');
        var label = $(this).data('label');
        var alamat = $(this).data('alamat');
        $('#offcanvasEditClient').offcanvas('show');
        $('#offcanvasEditClientLabel').html('Edit Client - ' + label);
        $('#submitClient').attr('kode', id);
        $('#offcanvasEditClient #clientImage').attr('src', '/images/clients/' + image);
        $('#offcanvasEditClient #clientName').val(label);
        $('#offcanvasEditClient #clientAddress').val(alamat);
      });
      // Bind click event to the delete button
      $('.delete-client').on('click', function () {
        var id = $(this).data('id');
        $('#deleteClient').modal('show');
        $('#deleteClient #deleteClientId').val(id);
      });
    }
  });
  $('#kt_search').on('click', function (e) {
    e.preventDefault();
    tableClient.table().draw();
  });

  $('#kt_reset').on('click', function (e) {
    $('.form-control').val('');
    tableClient.table().draw();
  });

  tableTeam = $('.datatables-teams').DataTable({
    processing: true,
    serverSide: true,
    searching: true,
    responsive: false,
    pageLength: 5,
    lengthMenu: [5, 10, 15, 20],
    search: {
      regex: true
    },
    ajax: {
      url: '/pengaturan/team/list',
      method: 'post',
      data: function (data) {
        data._token = $('meta[name="csrf-token"]').attr('content');
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
        data: 'deskripsi',
        name: 'deskripsi',
        responsivePriority: -1
      },
      {
        data: 'show',
        name: 'show',
        responsivePriority: -1

      },
      {
        data: 'aksi',
        name: 'aksi',
        responsivePriority: -1
      }
    ],
    drawCallback: function () {
      // Image modal
      var modalImage = $('#modalImage');
      $('.image-link').click(function () {
        var imageUrl = $(this).find('img').attr('src');
        modalImage.attr('src', imageUrl);
      });

      $('.is_show').change(function () {
        var id = $(this).data('id');
        showUser(id);
      });
      // Bind click event to the delete button
      $('.edit-team').on('click', function () {
        $('#imageAvailable').hide();
        var id = $(this).data('id');
        var image = $(this).data('image');
        var nama = $(this).data('nama');
        var deskripsi = $(this).data('deskripsi');
        $('#offcanvasEditTeam').offcanvas('show');
        $('#offcanvasEditTeamLabel').html('Edit Team - ' + nama);
        $('#submitTeam').attr('kode', id);
        if (image) {
          $('#offcanvasEditTeam #imageAvailable').show();
          $('#offcanvasEditTeam #teamImage').attr('src', '/images/teams/' + image);
        }
        $('#offcanvasEditTeam #teamName').val(nama);
        $('#offcanvasEditTeam #teamDeskripsi').val(deskripsi);
      });
      // Bind click event to the delete button
      $('.delete-team').on('click', function () {
        var id = $(this).data('id');
        $('#deleteTeam').modal('show');
        $('#deleteTeam #deleteTeamId').val(id);
      });
    }
  });
  $('#kt_search').on('click', function (e) {
    e.preventDefault();
    tableTeam.table().draw();
  });

  $('#kt_reset').on('click', function (e) {
    $('.form-control').val('');
    tableTeam.table().draw();
  });
}

function deleteCompetence() {
  id = $('#deleteCompetence #deleteCompetenceId').val();
  var csrfToken = $('meta[name="csrf-token"]').attr('content');
  $.ajax({
    type: 'DELETE',
    url: `/pengaturan/kompetensi/hapus/${id}`,
    headers: {
      'X-CSRF-TOKEN': csrfToken
    },
    success: function (response) {
      $('#deleteCompetence').modal('hide');
      $('.datatables-competence').DataTable().ajax.reload();
      success_res(response);
    },
    error: function (error) {
      console.error('Delete error:', error);
      error_res('Delete gagal');
    }
  });
}

function deleteClient() {
  id = $('#deleteClient #deleteClientId').val();
  var csrfToken = $('meta[name="csrf-token"]').attr('content');
  $.ajax({
    type: 'DELETE',
    url: `/pengaturan/client/hapus/${id}`,
    headers: {
      'X-CSRF-TOKEN': csrfToken
    },
    success: function (response) {
      $('#deleteClient').modal('hide');
      $('.datatables-clients').DataTable().ajax.reload();
      success_res(response);
    },
    error: function (error) {
      console.error('Delete error:', error);
      error_res('Delete gagal');
    }
  });
}

function deleteTeam() {
  id = $('#deleteTeam #deleteTeamId').val();
  var csrfToken = $('meta[name="csrf-token"]').attr('content');
  $.ajax({
    type: 'DELETE',
    url: `/pengaturan/user/hapus/${id}`,
    headers: {
      'X-CSRF-TOKEN': csrfToken
    },
    success: function (response) {
      $('#deleteTeam').modal('hide');
      $('.datatables-teams').DataTable().ajax.reload();
      success_res(response);
    },
    error: function (error) {
      console.error('Delete error:', error);
      error_res('Delete gagal');
    }
  });
}

function showUser(id) {
  var csrfToken = $('meta[name="csrf-token"]').attr('content');
  $.ajax({
    type: 'PUT',
    url: `/pengaturan/team/show/${id}`,
    headers: {
      'X-CSRF-TOKEN': csrfToken
    },
    success: function (response) {
      $('.datatables-teams').DataTable().ajax.reload();
      success_res(response);
    },
    error: function (error) {
      console.error('Update error:', error);
      error_res('Update gagal');
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
    tableCompetence.table().draw();
    tableClient.table().draw();
    tableTeam.table().draw();
    $('.offcanvas').offcanvas('hide');
    $('#deleteCompetence').modal('hide');
    $('#deleteClient').modal('hide');
    $('#deleteTeam').modal('hide');
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
