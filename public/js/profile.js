$(document).ready(function () {
  getData();
});
// Example starter JavaScript for disabling form submissions if there are invalid fields
(function () {
  'use strict';

  // Fetch all the forms we want to apply custom Bootstrap validation styles to
  var formsEdit = document.querySelectorAll('.forms-edit-validation');
  var formsPassword = document.querySelectorAll('.forms-ubah-password');

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
          ajaxPostJson(`/profile/update`, $('#formedituser').serialize(), 'success_res', 'error_res');
        }

        form.classList.add('was-validated');
      },
      false
    );
  });

  Array.prototype.slice.call(formsPassword).forEach(function (form) {
    form.addEventListener(
      'submit',
      function (event) {
        if (!form.checkValidity()) {
          event.preventDefault();
          event.stopPropagation();
        } else {
          event.preventDefault();
          ajaxPostJson(`/profile/ubah-password`, $('#formubahpassword').serialize(), 'success_res', 'error_res');
        }

        form.classList.add('was-validated');
      },
      false
    );
  });

})();

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
    window.location.href = '/profile';
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
