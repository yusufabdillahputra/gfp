$(document).ready(function () {
    'use strict'

    $('#btn_append_reqfeed').on('click', function () {

        var limit_db = $('#_limit_db').val();
        var offset_sekarang = $('#_offset_now').val();
        var offset_selanjutnya = Number(offset_sekarang) + Number(limit_db);

        $.ajax({
            url: 'reqfeed/ajaxAppendRequestFeed',
            data: {
                '_token': $('#_csrf').val(),
                'limit': limit_db,
                'offset': offset_selanjutnya
            },
            method: 'POST',
            success: function (html) {
                $('#AJAX_list_reqfeed').append(html);
                $('#_offset_now').val(offset_selanjutnya)
            }
        });
    });

});
