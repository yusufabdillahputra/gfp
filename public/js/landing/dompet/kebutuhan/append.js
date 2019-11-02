$(document).ready(function () {
    'use strict'

    $('#btn_append_kebutuhan').on('click', function () {

        var limit_db = $('#_limit_db').val();
        var offset_sekarang = $('#_offset_now').val();
        var offset_selanjutnya = Number(offset_sekarang) + Number(limit_db);

        $.ajax({
            url: 'ajaxAppendKebutuhan',
            data: {
                '_token': $('#_csrf').val(),
                'limit': limit_db,
                'offset': offset_selanjutnya
            },
            method: 'POST',
            success: function (html) {
                $('#AJAX_list_kebutuhan').append(html);
                $('#_offset_now').val(offset_selanjutnya)
            }
        });
    });

});
