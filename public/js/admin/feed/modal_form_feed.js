$(document).ready(function () {
    'use strict';

    $(document).on("click", ".modal_delete_e_feed", function () {
        var id_img_feed = $(this).data('d_id_img_feed');
        var path_img_feed = $(this).data('d_path_img_feed');
        $('.modal-body #d_id_img_feed').val(id_img_feed);
        $('.modal-body #d_path_img_feed').html('<img class="img-fluid" src="'+path_img_feed+'">');
    });

    $(document).on("click", ".modal_thumbnail_e_feed", function () {
        var id_img_feed = $(this).data('t_id_img_feed');
        var id_feed = $(this).data('t_id_feed');
        var updated_by = $(this).data('t_updated_by');
        var path_img_feed = $(this).data('t_path_img_feed');
        $('.modal-body #t_id_img_feed').val(id_img_feed);
        $('.modal-body #t_id_feed').val(id_feed);
        $('.modal-body #t_updated_by').val(updated_by);
        $('.modal-body #t_path_img_feed').html('<img class="img-fluid" src="'+path_img_feed+'">');
    });

});
