$(document).ready(function () {
    getData();
});

function getData() {
table = $('.datatables-logs').DataTable({
  processing: true,
  serverSide: true,
  searching: true,
  responsive: false,
  search: {
    regex: true
  },
  ajax: {
    url: '/log-activity/list',
    data: function (data) {
      data._token = $('meta[name="csrf-token"]').attr('content');
    },
    method: 'post',
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
      data: 'url',
      name: 'url',
      responsivePriority: -1
    },
    {
          data: "method",
          name: "method",
          responsivePriority: -1,
      },
      {
          data: "ip",
          name: "ip",
          responsivePriority: -1,
      },
      {
          data: "agent",
          name: "agent",
          responsivePriority: -1,
      },
      {
          data: "user",
          name: "user",
          responsivePriority: -1,
      }
  ],
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