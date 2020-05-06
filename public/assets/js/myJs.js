$(document).on('collapsed.lte.pushmenu', function(){
  $('.main-sidebar a img').hide(200);
});

$(document).on('shown.lte.pushmenu', function(){
  $('.main-sidebar a img').show(200);
});

$('.datatables-basic').DataTable({
  'ordering': false,
  // 'responsive': true,
  'language': {
    "sEmptyTable":   "Tidak ada data yang tersedia pada tabel ini",
    "sProcessing":   "Sedang memproses...",
    "sLengthMenu":   "Tampilkan _MENU_ data",
    "sZeroRecords":  "Tidak ditemukan data yang sesuai",
    "sInfo":         "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
    "sInfoEmpty":    "Menampilkan 0 sampai 0 dari 0 data",
    "sInfoFiltered": "(disaring dari _MAX_ data keseluruhan)",
    "sInfoPostFix":  "",
    "sSearch":       "Cari :",
    "sUrl":          "",
    "oPaginate": {
      "sFirst":    "Pertama",
      "sPrevious": "<i class='fas fa-arrow-left'></i>",
      "sNext":     "<i class='fas fa-arrow-right'></i>",
      "sLast":     "Terakhir"
    }
  }
});