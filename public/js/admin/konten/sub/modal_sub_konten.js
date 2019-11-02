$(document).ready(function () {
    'use strict';

    $(document).on("click", ".modal_delete_subk", function () {
        var id_subk = $(this).data('d_id_subk');
        var judul_subk = $(this).data('d_judul_subk');
        $('.modal-body #d_id_subk').val(id_subk);
        $('.modal-body #d_judul_subk').val(judul_subk);
    });

});
