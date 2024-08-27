(function () {
  // Snow Theme
  // --------------------------------------------------------------------
  // const snowEditor = new Quill('#snow-editor', {
  //   bounds: '#snow-editor',
  //   modules: {
  //     formula: true,
  //     toolbar: '#snow-toolbar'
  //   },
  //   theme: 'snow'
  // });

  // const snowEditormisi = new Quill('#snow-editor-misi', {
  //   bounds: '#snow-editor-misi',
  //   modules: {
  //     formula: true,
  //     toolbar: '#snow-toolbar-misi'
  //   },
  //   theme: 'snow'
  // });

  // snowEditormisi.on('text-change', function (delta, oldDelta, source) {
  //   document.querySelector("input[name='misi']").value = snowEditormisi.root.innerHTML;
  // });

  // snowEditor.on('text-change', function (delta, oldDelta, source) {
  //   document.querySelector("input[name='visi']").value = snowEditor.root.innerHTML;
  // });

  // Bubble Theme
  // --------------------------------------------------------------------
  // const bubbleEditor = new Quill('#bubble-editor', {
  //   modules: {
  //     toolbar: '#bubble-toolbar'
  //   },
  //   theme: 'bubble'
  // });

  // Full Toolbar
  // --------------------------------------------------------------------
  const fullToolbar = [
    [
      {
        font: []
      },
      {
        size: []
      }
    ],
    ['bold', 'italic', 'underline', 'strike'],
    [
      {
        color: []
      },
      {
        background: []
      }
    ],
    [
      {
        script: 'super'
      },
      {
        script: 'sub'
      }
    ],
    [
      {
        header: '1'
      },
      {
        header: '2'
      },
      'blockquote',
      'code-block'
    ],
    [
      {
        list: 'ordered'
      },
      {
        list: 'bullet'
      },
      {
        indent: '-1'
      },
      {
        indent: '+1'
      }
    ],
    [{ direction: 'rtl' }],
    ['link', 'image', 'video', 'formula'],
    ['clean']
  ];

  var forms = document.querySelectorAll('.needs-validation');

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
          let form = new FormData($('#form-perusahaan')[0]);
          ajaxPostFile('/pengaturan/perusahaan-update', form, 'success_res', 'error_res');
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
    location.reload();
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
