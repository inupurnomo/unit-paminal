/**
 * Account Settings - Security
 */

'use strict';

document.addEventListener('DOMContentLoaded', function (e) {
  (function () {
    const formChangePass = document.getElementById('formAccountSettings');

    // Form validation for Change password
    if (formChangePass) {
      const fv = FormValidation.formValidation(formChangePass, {
        fields: {
          currentPassword: {
            validators: {
              notEmpty: {
                message: 'Please current password'
              },
            }
          },
          password: {
            validators: {
              notEmpty: {
                message: 'Please enter new password'
              },
              stringLength: {
                min: 8,
                message: 'Password must be more than 8 characters'
              }
            }
          },
          password_confirmation: {
            validators: {
              notEmpty: {
                message: 'Please confirm new password'
              },
              identical: {
                compare: function () {
                  return formChangePass.querySelector('[name="newPassword"]').value;
                },
                message: 'The password and its confirm are not the same'
              },
              stringLength: {
                min: 8,
                message: 'Password must be more than 8 characters'
              }
            }
          }
        },
        plugins: {
          trigger: new FormValidation.plugins.Trigger(),
          bootstrap5: new FormValidation.plugins.Bootstrap5({
            eleValidClass: '',
            rowSelector: '.col-md-6'
          }),
          submitButton: new FormValidation.plugins.SubmitButton(),
          autoFocus: new FormValidation.plugins.AutoFocus()
        },
        init: instance => {
          instance.on('plugins.message.placed', function (e) {
            if (e.element.parentElement.classList.contains('input-group')) {
              e.element.parentElement.insertAdjacentElement('afterend', e.messageElement);
            }
          });
        }
      }).on('core.form.valid', function () {
        $.ajax({
          data: $('#formAccountSettings').serialize(),
          url: "".concat(baseUrl, "profile/security"),
          type: 'POST',
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
                  window.location.href = "/";
              }
          });
          },
          error: function error(err) {
            Swal.fire({
              title: 'Error!',
              text: 'Internal server Error',
              icon: 'error',
              customClass: {
                confirmButton: 'btn btn-success'
              }
            });
          }
        });
      });
    }

  })();
});

// Select2 (jquery)
$(function () {
  var select2 = $('.select2');

  // Select2 API Key
  if (select2.length) {
    select2.each(function () {
      var $this = $(this);
      select2Focus($this);
      $this.wrap('<div class="position-relative"></div>');
      $this.select2({
        dropdownParent: $this.parent()
      });
    });
  }
});
