$(document).ready(function () {
    'use strict';

    $(document).on("click", ".modal_delete_e_subk", function () {
        var id_img_subk = $(this).data('d_id_img_subk');
        var path_img_subk = $(this).data('d_path_img_subk');
        $('.modal-body #d_id_img_subk').val(id_img_subk);
        $('.modal-body #d_path_img_subk').html('<img class="img-fluid" src="'+path_img_subk+'">');
    });

    $(document).on("click", ".modal_thumbnail_e_subk", function () {
        var id_img_subk = $(this).data('t_id_img_subk');
        var id_subk = $(this).data('t_id_subk');
        var updated_by = $(this).data('t_updated_by');
        var path_img_subk = $(this).data('t_path_img_subk');
        $('.modal-body #t_id_img_subk').val(id_img_subk);
        $('.modal-body #t_id_subk').val(id_subk);
        $('.modal-body #t_updated_by').val(updated_by);
        $('.modal-body #t_path_img_subk').html('<img class="img-fluid" src="'+path_img_subk+'">');
    });

});
