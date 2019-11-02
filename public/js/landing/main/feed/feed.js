$(document).ready(function () {
    'use strict'

    const slick_feed = $('.slick_feed');

    slick_feed.slick({
        dots: true,
        slidesToShow: 1,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 3000,
        infinite: true,
        speed: 600,
        centerMode: false
    });

    $('#btn_append_donasi_uang').on('click', function () {

        let limit_db = $('#_limit_db').val();
        let offset_sekarang = $('#_offset_now').val();
        let offset_selanjutnya = Number(offset_sekarang) + Number(limit_db);

        $.ajax({
            url: 'ajaxAppendDaftarDonasiUang',
            data: {
                '_token': $('#_csrf').val(),
                'limit': limit_db,
                'offset': offset_selanjutnya,
                'id_feed' : $('#id_feed').val(),
            },
            method: 'POST',
            success: function (html) {
                $('#AJAX_list_donasi_uang').append(html);
                $('#_offset_now').val(offset_selanjutnya)
            }
        });
    });

    $('#btn_append_donasi_kebutuhan').on('click', function () {

        let limit_db = $('#k_limit_db').val();
        let offset_sekarang = $('#k_offset_now').val();
        let offset_selanjutnya = Number(offset_sekarang) + Number(limit_db);

        $.ajax({
            url: 'ajaxAppendDaftarDonasiKebutuhan',
            data: {
                '_token': $('#k_csrf').val(),
                'limit': limit_db,
                'offset': offset_selanjutnya,
                'id_feed' : $('#k_id_feed').val(),
            },
            method: 'POST',
            success: function (html) {
                $('#AJAX_list_donasi_kebutuhan').append(html);
                $('#_offset_now').val(offset_selanjutnya)
            }
        });
    });

});
