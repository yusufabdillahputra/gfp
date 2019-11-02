$(document).ready(function () {
    'use strict';

    $(document).on("click", ".modal_delete_label", function () {
        var id_label = $(this).data('d_id_label');
        var judul_label = $(this).data('d_judul_label');
        $('.modal-body #d_id_label').val(id_label);
        $('.modal-body #d_judul_label').val(judul_label);
    });

    $(document).on("click", ".modal_edit_label", function () {
        var id_label = $(this).data('e_id_label');
        var judul_label = $(this).data('e_judul_label');
        $('.modal-body #e_id_label').val(id_label);
        $('.modal-body #e_judul_label').val(judul_label);
    });

});
