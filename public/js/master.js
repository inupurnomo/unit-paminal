var optionerror = {
  text: 'Terjadi Kesalahan Pada Sistem!',
  pos: 'center',
  backgroundColor: '#e7515a'
};

$('.div_loader').hide();

var card_loading = `<div class="card"><div class="card-body">
<center>
<div class="loading">
<svg viewBox="0 0 187.3 93.7" height="200px" width="300px" class="svgbox">
<defs>
  <linearGradient y2="0%" x2="100%" y1="0%" x1="0%" id="gradient">
    <stop stop-color="pink" offset="0%"></stop>

       <stop stop-color="blue" offset="100%"></stop>
  </linearGradient>
</defs>

<path stroke="url(#gradient)" d="M93.9,46.4c9.3,9.5,13.8,17.9,23.5,17.9s17.5-7.8,17.5-17.5s-7.8-17.6-17.5-17.5c-9.7,0.1-13.3,7.2-22.1,17.1c-8.9,8.8-15.7,17.9-25.4,17.9s-17.5-7.8-17.5-17.5s7.8-17.5,17.5-17.5S86.2,38.6,93.9,46.4z"></path>
</svg>

</div>
</center>
</div></div>`;

async function ajaxGetJson(url, onsuccess, onerror) {
  $.ajax(url, {
    type: 'get',
    dataType: 'json',
    beforeSend: function () {
      $('.div_loader').show();
    },
    success: function (data, status, xhr) {
      // success callback function
      $('.div_loader').hide();
      window[onsuccess](data);
    },
    error: function (jqXhr, textStatus, errorMessage) {
      // error callback
      $('.div_loader').hide();
      let text =
        jqXhr.responseJSON?.message == undefined ? 'Terjadi Kesalahan Pada Sistem!' : jqXhr.responseJSON.message;
      var option = {
        text: text,
        pos: 'center',
        backgroundColor: '#e7515a'
      };
      Snackbar.show(option);
      window[onerror](errorMessage);
    }
  });
}

async function ajaxGetLoadingCard(url, onsuccess, onerror, div_id) {
  $.ajax(url, {
    type: 'get',
    dataType: 'json',
    beforeSend: function () {
      $('#' + div_id).html(card_loading);
    },
    success: function (data, status, xhr) {
      // success callback function

      window[onsuccess](data);
    },
    error: function (jqXhr, textStatus, errorMessage) {
      // error callback

      let text =
        jqXhr.responseJSON?.message == undefined ? 'Terjadi Kesalahan Pada Sistem!' : jqXhr.responseJSON.message;
      var option = {
        text: text,
        pos: 'center',
        backgroundColor: '#e7515a'
      };
      Snackbar.show(option);
      window[onerror](errorMessage);
    }
  });
}

async function ajaxGetWithoutLoading(url, onsuccess, onerror) {
  $.ajax(url, {
    type: 'get',
    dataType: 'json',
    // beforeSend: function () {
    //     $("#"+div_id).html(card_loading)
    // },
    success: function (data, status, xhr) {
      // success callback function
      window[onsuccess](data);
    },
    error: function (jqXhr, textStatus, errorMessage) {
      // error callback
      let text =
        jqXhr.responseJSON?.message == undefined ? 'Terjadi Kesalahan Pada Sistem!' : jqXhr.responseJSON.message;
      var option = {
        text: text,
        pos: 'center',
        backgroundColor: '#e7515a'
      };
      Snackbar.show(option);
      window[onerror](errorMessage);
    }
  });
}

async function ajaxPostJson(url, form, onsuccess, onerror) {
  $.ajax(url, {
    type: 'post',
    dataType: 'json',
    data: form,
    beforeSend: function () {
      $('.div_loader').show();
    },
    success: function (data, status, xhr) {
      // success callback function
      $('.div_loader').hide();
      window[onsuccess](data);
    },
    error: function (jqXhr, textStatus, errorMessage) {
      // error callback
      $('.div_loader').hide();
      console.log(errorMessage);
      window[onerror](errorMessage);
    }
  });
}

async function ajaxPostFile(url, form, onsuccess, onerror) {
  $.ajax(url, {
    type: 'post',
    data: form,
    processData: false,
    contentType: false,
    beforeSend: function () {
      $('.div_loader').show();
    },
    success: function (data, status, xhr) {
      // success callback function
      // $('.load_process').css('display', 'none')
      $('.div_loader').hide();
      window[onsuccess](data);
    },
    error: function (jqXhr, textStatus, errorMessage) {
      $('.div_loader').hide();
      console.log(errorMessage);
      window[onerror](errorMessage);
    }
  });
}
