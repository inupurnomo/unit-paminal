var table = '';
$(document).ready(function () {
  var modalImage = $('#modalImage');

  $('.image-link').click(function () {
    var imageUrl = $(this).find('img').attr('src');
    modalImage.attr('src', imageUrl);
  });

  getData();

  $('#biaya').val(formatRupiah($('#biaya').val()));
  $('#biaya').on('keyup', function (e) {
    $('#biaya').val(formatRupiah($('#biaya').val()));
  });
});

(function () {
  var formsEdit = document.querySelectorAll('.forms-edit-validation');
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
          ajaxPostFile(`/rapat/rembuisment/update/${id}`, data, 'success_res', 'error_res');
        }

        form.classList.add('was-validated');
      },
      false
    );
  });
})();

function formatRupiah(angka, prefix) {
  var number_string = angka.replace(/[^,\d]/g, '').toString(),
    split = number_string.split(','),
    sisa = split[0].length % 3,
    rupiah = split[0].substr(0, sisa),
    ribuan = split[0].substr(sisa).match(/\d{3}/gi);

  if (ribuan) {
    separator = sisa ? '.' : '';
    rupiah += separator + ribuan.join('.');
  }

  rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
  return prefix == undefined ? rupiah : rupiah ? 'Rp. ' + rupiah : '';
}

function getDataKepailitan(id) {
  $.ajax({
    type: 'get',
    url: `/rapat/get-kepailitan-by-type/${id}`,
    success: function (response) {
      html = `<option value=''>Select Kepailitan</option>`;
      response.forEach(element => {
        html += `<option value="${element['id']}">${element['nama_kegiatan']}</option>`;
      });

      document.getElementById('kepailitan').innerHTML = html;
    },
    error: function (error) {
      console.error('data error:', error);
    }
  });
}

function getAgendaKegiantan(id) {
  ajaxGetWithoutLoading('/rapat/get-rapat-kepailitan/' + id, 'success_list_agenda', 'error_list_agenda');
}

function success_list_agenda(data) {
  if (data.status == 200) {
    html = `<option value=''>Select Kegiatan</option>`;
    data.data.forEach(element => {
      html += `<option value="${element['id']}">${element['agenda']}</option>`;
    });
    console.log(html);
    document.getElementById('agenda').innerHTML = html;
  }
}
function success_list_agenda(data) {
  if (data.status == 200) {
    html = `<option value=''>Select Kegiatan</option>`;
    data.data.forEach(element => {
      html += `<option value="${element['id']}" tempat="${element['tempat']}">${element['agenda']}</option>`;
    });
    console.log(html);
    document.getElementById('agenda').innerHTML = html;
  }
}

function deleteRecord() {
  id = $('#deleteModal #deleteRecordId').val();
  var csrfToken = $('meta[name="csrf-token"]').attr('content');
  $.ajax({
    type: 'DELETE',
    url: `/rapat/rembuisment/hapus/${id}`,
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
      error_res(error);
    }
  });
}

function success_res(data) {
  console.log(data);
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
    window.location.href = '/rapat/rembuisment';
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

function getData() {
  table = $('.datatables-kegiatan').DataTable({
    processing: true,
    serverSide: true,
    searching: true,
    responsive: false,
    ajax: {
      url: '/rapat/rembuisment/list',
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
        data: 'rapat.agenda',
        name: 'rapat.agenda',
        responsivePriority: -1
      },
      {
        data: 'nama_kegiatan',
        name: 'nama_kegiatan',
        responsivePriority: -1
      },
      {
        data: 'tempat',
        name: 'tempat',
        responsivePriority: -1
      },
      {
        data: 'tanggal_kegiatan',
        name: 'tanggal',
        responsivePriority: -1
      },
      {
        data: 'biaya_kegiatan',
        name: 'biaya',
        responsivePriority: -1
      },
      {
        data: 'bukti',
        name: 'bukti',
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
      var modalImage = $('#modalImage');

      $('.image-link').click(function () {
        var imageUrl = $(this).find('img').attr('src');
        modalImage.attr('src', imageUrl);
      });

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
