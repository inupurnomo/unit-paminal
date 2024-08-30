  $(document).ready(function () {
    var no = 1;
            $(document).on('click', '#tambah_terlapor', function () {
          no++;
          console.log(no);
          var inputGroup = $(
            `
            <div class="bb-add row">
              <div class="col-md-12 d-flex flex-row justify-content-between align-items-center"></div>

              <div class="col-10">
                <div class="form-floating form-floating-outline mb-2">
                  <input type="text" name="terlapor[]" class="form-control" id="bs-validation-name" placeholder="Nama Terlapor" required="">
                  <label for="bs-validation-name">Nama Terlapor</label>
                  <div class="valid-feedback"> Looks good! </div>
                  <div class="invalid-feedback"> Please enter your name. </div>
                </div>
              </div>
              <div class="col-2">
                <button type="button" class="btn btn-danger remove_attach" title='Hapus'><i class="mdi mdi-delete me-1"></i></button>
              </div>
            </div>`
          );

          $('#terlapor').append(inputGroup);
        });

        $(document).on('click', '.remove_attach', function (e) {
          if (e.type == 'click') {
            if (no > 1) {
              $(this).parents('.bb-add').fadeOut();
              $(this).parents('.bb-add').remove();
              no--;
            }
          }
        });
  });