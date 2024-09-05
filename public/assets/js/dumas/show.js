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

function handleDeleteProgress(progress) {
  var id = $(progress).data('id');

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
            url: "".concat(baseUrl, "dumas/progress/") + id,
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