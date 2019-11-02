$(document).ready(function () {
    'use strict'

    const filter_feed = $('#filter_feed');

    $('#id_label').change(function () {
        $('#_offset_now').val('');
        let limit_db = $('#_limit_db').val();
        let offset_sekarang = $('#_offset_now').val();
        let offset_selanjutnya = Number(offset_sekarang) + Number(limit_db);
        $.ajax({
            url: 'landing/ajaxAppendFeed',
            data: {
                '_token': $('#_csrf').val(),
                'id_label': $('#id_label').val()
            },
            method: 'POST',
            success: function (html) {
                $('#AJAX_list_feeds').empty();
                $('#AJAX_list_feeds').append(html);
            }
        });
    });

    $('#btn_append_feed').on('click', function () {

        let limit_db = $('#_limit_db').val();
        let offset_sekarang = $('#_offset_now').val();
        let offset_selanjutnya = Number(offset_sekarang) + Number(limit_db);

        $.ajax({
            url: 'landing/ajaxAppendFeed',
            data: {
                '_token': $('#_csrf').val(),
                'limit': limit_db,
                'offset': offset_selanjutnya,
                'id_label': $('#id_label').val()
            },
            method: 'POST',
            success: function (html) {
                $('#AJAX_list_feeds').append(html);
                $('#_offset_now').val(offset_selanjutnya)
            }
        });
    });

    filter_feed.select2({

    });

});
