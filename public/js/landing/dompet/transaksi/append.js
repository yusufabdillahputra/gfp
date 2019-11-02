$(document).ready(function () {
    'use strict'

    $('#btn_append_transaksi').on('click', function () {

        var limit_db = $('#_limit_db').val();
        var offset_sekarang = $('#_offset_now').val();
        var offset_selanjutnya = Number(offset_sekarang) + Number(limit_db);

        $.ajax({
            url: 'ajaxAppendTransaksi',
            data: {
                '_token': $('#_csrf').val(),
                'limit': limit_db,
                'offset': offset_selanjutnya
            },
            method: 'POST',
            success: function (html) {
                $('#AJAX_list_transaksi').append(html);
                $('#_offset_now').val(offset_selanjutnya)
            }
        });
    });

});
