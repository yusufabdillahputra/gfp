$(document).ready(function () {
    'use strict';

    $(document).on("click", ".modal_delete_feed", function () {
        var id_feed = $(this).data('d_id_feed');
        var judul_feed = $(this).data('d_judul_feed');
        $('.modal-body #d_id_feed').val(id_feed);
        $('.modal-body #d_judul_feed').val(judul_feed);
    });

});
