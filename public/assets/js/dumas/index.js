function handleDone(dumas) {
  var id = $(dumas).data('id');

  Swal.fire({
    icon: 'warning',
    title: 'Anda yakin?',
    text: "Status dumas akan ditandai selesai",
    showCancelButton: true,
    confirmButtonText: 'Ya, selesaikan!',
    cancelButtonText: 'Batal',
    customClass: {
      confirmButton: 'btn btn-primary me-3 waves-effect waves-light',
      cancelButton: 'btn btn-outline-secondary waves-effect',
    },
    buttonsStyling: false
  }).then(function (result) {
    if (result.value) {
      $.ajax({
        url: "".concat(baseUrl, "dumas/") + id,
        type: 'PUT',
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

function handleDelete(dumas) {
  var id = $(dumas).data('id');

  Swal.fire({
    icon: 'warning',
    title: 'Anda yakin?',
    text: "Anda tidak dapat mengembalikannya!",
    showCancelButton: true,
    confirmButtonText: 'Ya, hapus!',
    cancelButtonText: 'Batal',
    customClass: {
      confirmButton: 'btn btn-primary me-3 waves-effect waves-light',
      cancelButton: 'btn btn-outline-secondary waves-effect',
    },
    buttonsStyling: false
  }).then(function (result) {
    if (result.value) {
      $.ajax({
        url: "".concat(baseUrl, "dumas/") + id,
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