$(document).ready(function () {
    'use strict';

    $(document).on("click", ".modal_edit_kebutuhan", function () {
        var id_feed_donasi = $(this).data('e_id_feed_donasi');
        var status_feed_donasi = $(this).data('e_status_feed_donasi');
        $('.modal-body #e_id_feed_donasi').val(id_feed_donasi);
        $('.modal-header #e_status_feed_donasi').val(status_feed_donasi);
    });

});
