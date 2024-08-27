var table = '';
$(document).ready(function () {

  var no = 1;

const initialize = no => {
  $(`#tanggal_kegiatan${no}`).flatpickr({
    monthSelectorType: 'static'
  });

  $(`#tanggal_kegiatan${no}`).prop('readonly', false);

  $(`#tanggal${no}`).flatpickr({
    monthSelectorType: 'static'
  });

  $(`#tanggal${no}`).prop('readonly', false);

  $(`#biaya${no}`).on('keyup', function (e) {
    $(`#biaya${no}`).val(formatRupiah($(`#biaya${no}`).val()));
  });
}

$(document).on('click', '#tambah', function () {
  no++;

  var inputGroup = $(
    `
    <div class="row row-add form-row">
    <h5 class="mb-3">Rembuisment ${no}</h5> <small class="text-body float-end"></small>
    <div class="col-lg-4 md-12">
        <div class="form-floating form-floating-outline mb-4 has-validation">
            <select id="nama_kegiatan${no}" class="select2 form-control" name="nama_kegiatan[${no}]"
                data-allow-clear="true" required>
            </select>
            <label for="jenis_laporan">Kategori</label>
            <div class="invalid-feedback">
                Please choose a category.
            </div>
        </div>
    </div>
    <div class="col-lg-4 md-12">
        <div class="form-floating form-floating-outline mb-4">
            <input type="text" name="tanggal_kegiatan[${no}]" class="form-control"
                placeholder="YYYY-MM-DD" id="tanggal_kegiatan${no}" />
            <label for="flatpickr-date">Tanggal</label>
        </div>
    </div>
    <div class="col-lg-4 md-12">
        <div class="form-floating form-floating-outline mb-4">
            <input type="text" class="form-control" id="tempat_kegiatan${no}"
                name="tempat_kegiatan[${no}]" placeholder="Tempat Kegiatan.." />
            <label for="tempat">Tempat</label>
        </div>
    </div>
    <div class="col-lg-4 md-12">
        <div class="form-floating form-floating-outline mb-4">
            <input type="text" id="uraian${no}" class="form-control" name="uraian[${no}]" placeholder="Uraian..."></input>
            <label for="uraian">Deskripsi</label>
        </div>
    </div>
    <div class="col-lg-4 md-12">
        <div class="form-floating form-floating-outline mb-4">
            <input type="text" class="form-control" id="biaya${no}" name="biaya[${no}]"
                placeholder="Biaya.." />
            <label for="tempat">Biaya</label>
        </div>
    </div>
    <div class="col-lg-4 col-md-12">
        <div class="form-floating form-floating-outline mb-4">
            <input class="form-control" type="file" id="bukti${no}" name="bukti[${no}]">
            <label for="tempat">Bukti Bayar</label>
        </div>
    </div>
    <div class="col-md-12 d-flex justify-content-end"><button type="button" class="btn btn-danger remove_attach">Hapus</button></div>
</div>`
  );

  $('#dynamicInputContainer').append(inputGroup);
  getKategori(no);
  initialize(no);
  
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

  $('select').select2();
  $('#jenis_rapat').on('change', function () {
    var selectedOption = $(this).val();
    getDataKepailitan(selectedOption);
  });

  $('#kepailitan').on('change', function () {
    var selectedOption = $(this).val();
    getAgendaKegiantan(selectedOption);
  });

  $('#agenda').on('change', function () {
    // var selectedOption = $(this).val();
    var element = $(this).find('option:selected');
    var tempat = element.attr('tempat');
    var tanggal = element.attr('tanggal');
    $('#tempat').val(tempat);
    $('#tanggal').val(tanggal);
  });

  $('#tanggal_kegaitan').flatpickr({
    monthSelectorType: 'static'
  });

  $('#tanggal_kegaitan').prop('readonly', false);

  $('#tanggal').flatpickr({
    monthSelectorType: 'static'
  });

  $('#tanggal').prop('readonly', false);

  $('#biaya').on('keyup', function (e) {
    $('#biaya').val(formatRupiah($('#biaya').val()));
  });

  var forms = document.querySelectorAll('.needs-validation');
  Array.prototype.slice.call(forms).forEach(function (form) {
    form.addEventListener(
      'submit',
      function (event) {
        if (!form.checkValidity()) {
          event.preventDefault();
          event.stopPropagation();
        } else {
          event.preventDefault();
          let form = new FormData($('#formrembuisment')[0]);
          ajaxPostFile('/rapat/rembuisment/simpan', form, 'success_res', 'error_res');
        }

        form.classList.add('was-validated');
      },
      false
    );
  });
});

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

function getKategori(no) {
  $.ajax({
    type: 'get',
    url: `/kegiatan/rembuisment/get-kategori`,
    success: function (response) {
      html = `<option value=''>Select Kategori</option>`;
      response.data.forEach(element => {
        html += `<option value="${element['name']}">${element['name']}</option>`;
      });

      $(`#nama_kegiatan${no}`).html(html);
      $(`#nama_kegiatan${no}`).select2();

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
      html += `<option value="${element['id']}" tempat="${element['tempat']}" tanggal="${element['tanggal']}">${element['agenda']}</option>`;
    });
    console.log(html);
    document.getElementById('agenda').innerHTML = html;
  }
}

function success_res(data) {
  console.log(data);
  if (data.status == 200) {
    const swalWithBootstrapButtons = Swal.mixin({
      customClass: {
        confirmButton: 'btn btn-success',
        cancelButton: 'btn btn-danger'
      },
      buttonsStyling: false
    });
    swalWithBootstrapButtons
      .fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'success',
        showCancelButton: true,
        confirmButtonText: 'Lihat Preview Rapat',
        cancelButtonText: 'Tambah Kegiatan',
        reverseButtons: true
      })
      .then(result => {
        if (result.isConfirmed) {
          window.location.href = '/rapat/preview/' + $('#agenda').val();
        } else {
          $('#nama_kegiatan').val('');
          $('#tempat_kegiatan').val('');
          $('#tanggal_kegiatan').val('');
          $('#biaya').val('');
          $('#bukti').val('');
          refresh_csrf();
        }
      });
    // Swal.fire({
    //   position: 'center',
    //   icon: 'success',
    //   title: data.message,
    //   showConfirmButton: false,
    //   timer: 1500,
    //   customClass: {
    //     confirmButton: 'btn btn-primary waves-effect waves-light'
    //   },
    //   buttonsStyling: false
    // });
    // swal('Login Berhasil', data.message, 'success');
    // window.location.href = '/kegiatan/rembuisment';
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
