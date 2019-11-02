$(document).ready(function () {
    'use strict';

    $(document).on("click", ".modal_delete_donasi", function () {
        var id_donasi = $(this).data('d_id_donasi');
        var nama_donasi = $(this).data('d_nama_donasi');
        $('.modal-body #d_id_donasi').val(id_donasi);
        $('.modal-body #d_nama_donasi').val(nama_donasi);
    });

    $(document).on("click", ".modal_edit_donasi", function () {
        var id_donasi = $(this).data('e_id_donasi');
        var nama_donasi = $(this).data('e_nama_donasi');
        $('.modal-body #e_id_donasi').val(id_donasi);
        $('.modal-body #e_nama_donasi').val(nama_donasi);
    });

});
