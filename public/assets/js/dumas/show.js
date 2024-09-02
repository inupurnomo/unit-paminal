$(document).ready(function () {
  var no = 1;
  var noBukti = 1;
  var noSprin = 1;
  $(document).on('click', '#tambah_saksi', function () {
    no++;
    var inputGroup = $(
      `
      <div class="saksi-add row mt-2">
        <div class="row">
          <div class="col-sm-12 col-md-6">
            <div class="form-floating form-floating-outline mb-2">
              <input type="text" name="witness[]" class="form-control" id="bs-validation-name" placeholder="Nama Saksi" required="">
              <label for="bs-validation-name">Nama Saksi</label>
              <div class="valid-feedback"> Looks good! </div>
              <div class="invalid-feedback"> Please enter the witness. </div>
            </div>
          </div>
          <div class="col-sm-12 col-md-6">
            <div class="form-floating form-floating-outline mb-2">
              <input type="text" name="witness_phone[]" class="form-control" id="bs-validation-name" placeholder="Nomor Telephone" required="" oninput="this.value = this.value.replace(/[^0-9+]/g, '');" maxlength="15">
              <label for="bs-validation-name">Nomor Telephone Saksi</label>
              <div class="valid-feedback"> Looks good! </div>
              <div class="invalid-feedback"> Please enter the phone number. </div>
            </div>
          </div>
          <div class="col-sm-12 col-md-6">
            <div class="form-floating form-floating-outline mb-2">
              <input type="date" name="witness_date[]" class="form-control" id="bs-validation-name" placeholder="Tanggal Klarifikasi" required="">
              <label for="bs-validation-name">Tanggal Klarifikasi</label>
              <div class="valid-feedback"> Looks good! </div>
              <div class="invalid-feedback"> Please enter the date. </div>
            </div>
          </div>
        </div>
        <div class="col-2">
          <button type="button" class="btn btn-danger remove_attach" title='Hapus'><i class="mdi mdi-delete me-1"></i></button>
        </div>
      </div>`
    );

    $('#saksi').append(inputGroup);
  });
  $(document).on('click', '#tambah_bukti', function () {
    noBukti++;
    var inputGroup = $(
      `
      <div class="bukti-add row mt-2">
        <div class="row">
          <div class="form-floating form-floating-outline col-sm-12 col-md-4">
            <select id="evi${noBukti}" name="evidence_type[]" class="select2 form-select form-select-lg" data-allow-clear="true" required="">
              <option value="">Pilih Type</option>
              @foreach ($evidence_type as $item)
                  <option value="{{ $item->id }}">{{ $item->name }}</option>
              @endforeach
            </select>
            <label for="evi${noBukti}">Pilih Type</label>
          </div>
          <div class="col-sm-12 col-md-8 mt-2">
            <div class="form-floating form-floating-outline mb-2">
              <input type="text" name="evidence_name[]" class="form-control" id="bs-validation-name" placeholder="Nama Bukti" required=""">
              <label for="bs-validation-name">Nama Bukti</label>
              <div class="valid-feedback"> Looks good! </div>
              <div class="invalid-feedback"> Please enter the name of evidence. </div>
            </div>
          </div>
          <div class="col-sm-12 col-md-12 mt-2">
            <div class="form-floating form-floating-outline mb-2">
              <input type="file" name="evidence_file[]" class="form-control" id="evi_name${noBukti}" required="">
              <label for="evi_name${noBukti}">Pilih File</label>
              <div class="valid-feedback"> Looks good! </div>
              <div class="invalid-feedback"> Please choose file. </div>
            </div>
          </div>
        </div>
        <div class="col-2">
          <button type="button" class="btn btn-danger remove_attach_bukti" title='Hapus'><i class="mdi mdi-delete me-1"></i></button>
        </div>
      </div>`
    );

    $('#bukti').append(inputGroup);
  });
  $(document).on('click', '#tambah_sprin', function () {
    noSprin++;
    var inputGroupSprin = $(
      `
      <div class="sprin-add mt-2">
        <div class="row">
          <div class="col-sm-12 col-md-6">
            <div class="form-floating form-floating-outline mb-4">
              <input type="file" name="sprin_file" class="form-control" id="bs-validation-name" required="" accept="application/pdf">
              <label for="bs-validation-name">Dokumen SPRIN</label>
              <div class="valid-feedback"> Looks good! </div>
              <div class="invalid-feedback"> Please select ND file. </div>
            </div>
          </div>
          <div class="col-sm-12 col-md-6">
            <div class="form-floating form-floating-outline mb-4">
              <input type="date" name="sprin_date" class="form-control" id="bs-validation-date" required="">
              <label for="bs-validation-date">Berlaku Hingga</label>
              <div class="valid-feedback"> Looks good! </div>
              <div class="invalid-feedback"> Please select date. </div>
            </div>
          </div>
        </div> 
        <div class="col-2">
          <button type="button" class="btn btn-danger remove_attach_sprin" title='Hapus'><i class="mdi mdi-delete me-1"></i></button>
        </div>
      </div>`
    );

    $('#sprinRow').append(inputGroupSprin);
    $('#sprinBtn').hide();
  });

  $(document).on('click', '.remove_attach', function (e) {
    if (e.type == 'click') {
      if (no > 1) {
        $(this).parents('.saksi-add').fadeOut();
        $(this).parents('.saksi-add').remove();
        no--;
      }
    }
  });
  $(document).on('click', '.remove_attach_bukti', function (e) {
    if (e.type == 'click') {
      if (noBukti > 1) {
        $(this).parents('.bukti-add').fadeOut();
        $(this).parents('.bukti-add').remove();
        noBukti--;
      }
    }
  });
  $(document).on('click', '.remove_attach_sprin', function (e) {
    if (e.type == 'click') {
      if (noSprin > 1) {
        $(this).parents('.sprin-add').fadeOut();
        $(this).parents('.sprin-add').remove();
        noSprin--;
      }
    }
    $('#sprinBtn').show();
  });
});

function handleClick(checkbox) {
  var isChecked = $(checkbox).prop('checked')
  var table = $(checkbox).data('table');
  var id = $(checkbox).data('id');

  $.ajax({
    data: {
      table: table,
      id: id
    },
    url: "".concat(baseUrl, "dumas/arsip/") + id,
    type: 'POST',
    success: function success(response) {
      var iconType;
      if (response.status == 200) {
        iconType = 'success';
      } else {
        iconType = 'error';
        checkbox.checked = !isChecked;
      }
      // sweetalert
      Swal.fire({
        icon: response.status == 200 ? 'success' : 'error',
        title: response.status == 200 ? 'Success' : 'Error',
        text: response.message,
        customClass: {
          confirmButton: 'btn btn-success'
        }
      })
    },
    error: function error(err) {
      // Revert checkbox state to its previous status if AJAX fails
      checkbox.checked = !isChecked;
      Swal.fire({
        title: 'Error!',
        text: 'Internal server Error',
        icon: 'error',
        customClass: {
          confirmButton: 'btn btn-success'
        }
      })
    }
  });
};

function handleDelete(checkbox) {
  var table = $(checkbox).data('table');
  var id = $(checkbox).data('id');

  Swal.fire({
        icon: 'warning',
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        showCancelButton: true,
        confirmButtonText: 'Yes, delete it!',
        customClass: {
          confirmButton: 'btn btn-primary me-3 waves-effect waves-light',
          cancelButton: 'btn btn-outline-secondary waves-effect',
        },
        buttonsStyling: false
      }).then(function (result) {
        if (result.value) {
          $.ajax({
            data: {
              table: table,
              id: id
            },
            url: "".concat(baseUrl, "dumas/document/") + id,
            type: 'DELETE',
            success: function success(response) {
              var iconType;
              if (response.status == 200) {
                iconType = 'success';
              } else {
                iconType = 'error';
              }
              // sweetalert
              Swal.fire({
                icon: response.status == 200 ? 'success' : 'error',
                title: response.status == 200 ? 'Success' : 'Error',
                text: response.message,
                customClass: {
                  confirmButton: 'btn btn-success'
                }
              }).then((result) => {
                    if (result.isConfirmed) {
                        // Redirect to another page
                        window.location.reload();
                    }
                });
            },
            error: function error(err) {
              // Revert checkbox state to its previous status if AJAX fails
              Swal.fire({
                title: 'Error!',
                text: 'Internal server Error',
                icon: 'error',
                customClass: {
                  confirmButton: 'btn btn-success'
                }
              })
            }
          });
        }
      });
};

function handleDeleteWitness(witness) {
  var id = $(witness).data('id');

  Swal.fire({
        icon: 'warning',
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        showCancelButton: true,
        confirmButtonText: 'Yes, delete it!',
        customClass: {
          confirmButton: 'btn btn-primary me-3 waves-effect waves-light',
          cancelButton: 'btn btn-outline-secondary waves-effect',
        },
        buttonsStyling: false
      }).then(function (result) {
        if (result.value) {
          $.ajax({
            url: "".concat(baseUrl, "dumas/witness/") + id,
            type: 'DELETE',
            success: function success(response) {
              var iconType;
              if (response.status == 200) {
                iconType = 'success';
              } else {
                iconType = 'error';
              }
              // sweetalert
              Swal.fire({
                icon: response.status == 200 ? 'success' : 'error',
                title: response.status == 200 ? 'Success' : 'Error',
                text: response.message,
                customClass: {
                  confirmButton: 'btn btn-success'
                }
              }).then((result) => {
                    if (result.isConfirmed) {
                        // Redirect to another page
                        window.location.reload();
                    }
                });
            },
            error: function error(err) {
              // Revert checkbox state to its previous status if AJAX fails
              Swal.fire({
                title: 'Error!',
                text: 'Internal server Error',
                icon: 'error',
                customClass: {
                  confirmButton: 'btn btn-success'
                }
              })
            }
          });
        }
      });
};

function handleDeleteEvidence(evidence) {
  var id = $(evidence).data('id');

  Swal.fire({
        icon: 'warning',
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        showCancelButton: true,
        confirmButtonText: 'Yes, delete it!',
        customClass: {
          confirmButton: 'btn btn-primary me-3 waves-effect waves-light',
          cancelButton: 'btn btn-outline-secondary waves-effect',
        },
        buttonsStyling: false
      }).then(function (result) {
        if (result.value) {
          $.ajax({
            url: "".concat(baseUrl, "dumas/evidence/") + id,
            type: 'DELETE',
            success: function success(response) {
              var iconType;
              if (response.status == 200) {
                iconType = 'success';
              } else {
                iconType = 'error';
              }
              // sweetalert
              Swal.fire({
                icon: response.status == 200 ? 'success' : 'error',
                title: response.status == 200 ? 'Success' : 'Error',
                text: response.message,
                customClass: {
                  confirmButton: 'btn btn-success'
                }
              }).then((result) => {
                    if (result.isConfirmed) {
                        // Redirect to another page
                        window.location.reload();
                    }
                });
            },
            error: function error(err) {
              // Revert checkbox state to its previous status if AJAX fails
              Swal.fire({
                title: 'Error!',
                text: 'Internal server Error',
                icon: 'error',
                customClass: {
                  confirmButton: 'btn btn-success'
                }
              })
            }
          });
        }
      });
};

function addParamToUrl(param, value) {
  // Mendapatkan URL saat ini
  let currentUrl = window.location.href;
  
  // Membuat URL baru dengan parameter
  let newUrl = new URL(currentUrl);
  newUrl.searchParams.set(param, value); // Menambahkan atau mengganti parameter
  
  // Memperbarui URL tanpa reload halaman
  window.history.pushState({}, '', newUrl);
}