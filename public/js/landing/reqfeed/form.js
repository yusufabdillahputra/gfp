$(document).ready(function () {
    'use strict'

    const form_request_feed = $('#form_request_feed');
    let val_created_at = new Date($('#val_created_at').val());

    form_request_feed.validate({
        errorClass: "invalid-feedback animated fadeInDown",
        errorElement: "div",
        errorPlacement: function(e, r) {
            jQuery(r).parents(".form-group > div").append(e)
        },
        highlight: function(e) {
            jQuery(e).closest(".form-group").removeClass("is-invalid").addClass("is-invalid")
        },
        success: function(e) {
            jQuery(e).closest(".form-group").removeClass("is-invalid"), jQuery(e).remove()
        },
        rules: {
            judul_feed: {
                required: true
            },
            alamat_feed: {
                required: true
            },
            kota_feed: {
                required: true
            },
            provinsi_feed: {
                required: true
            },
            raw_min_donasi_feed: {
                required: true
            },
            talent_feed: {
                required: true
            },
            telp_talent_feed: {
                required: true
            },
            email_talent_feed: {
                email: true
            }
        },
        messages: {
            judul_feed: {
                required: "Judul tidak boleh kosong",
            },
            alamat_feed: {
                required: "Alamat tidak boleh kosong",
            },
            kota_feed: {
                required: "Kota tidak boleh kosong",
            },
            provinsi_feed: {
                required: "Provinsi tidak boleh kosong",
            },
            raw_min_donasi_feed: {
                required: "Minimal donasi tidak boleh kosong",
            },
            talent_feed: {
                required: "Nama talent tidak boleh kosong",
            },
            telp_talent_feed: {
                required: "Nomor telp. talent tidak kosong",
            },
            email_talent_feed: {
                email: "Format email anda salah",
            }
        }
    });

    $('#raw_min_donasi_feed').autoNumeric('init', {
        aSep: '.',
        aDec: ',',
        mDec: '0'
    });

    $('#raw_min_donasi_feed').keyup(function () {
        var value = $('#raw_min_donasi_feed').autoNumeric('get');
        $('#val_min_donasi_feed').val(value);
    });

    $('#raw_max_donasi_feed').autoNumeric('init', {
        aSep: '.',
        aDec: ',',
        mDec: '0'
    });

    $('#raw_max_donasi_feed').keyup(function () {
        var value = $('#raw_max_donasi_feed').autoNumeric('get');
        $('#val_max_donasi_feed').val(value);
    });

    $('#raw_ended_at_feed').datepicker({
        startDate: val_created_at,
        format: 'dd/mm/yyyy'
    });

    $('#isi_feed').summernote({
        height: 400,
        placeholder: 'Isi feed disini....',
        toolbar: [
            ['style', [
                'bold', 'italic', 'underline', 'clear'
            ]],
            ['fontsize', [
                'fontsize'
            ]],
            ['color', [
                'color'
            ]],
            ['height', [
                'height'
            ]],
            ['fontname', [
                'fontname'
            ]],
            ['table', [
                'table'
            ]],
            ['para', [
                'ul', 'ol', 'paragraph'
            ]],
            ['misc', [
                'fullscreen', 'undo', 'redo'
            ]]
        ],
        onfocus: function (e) {
            $('body').addClass('overlay-disabled');
        },
        onblur: function (e) {
            $('body').removeClass('overlay-disabled');
        }
    });

    $('#keterangan_feed').summernote({
        height: 400,
        placeholder: 'Isi deskripsi disini....',
        toolbar: [
            ['style', [
                'bold', 'italic', 'underline', 'clear'
            ]],
            ['fontsize', [
                'fontsize'
            ]],
            ['color', [
                'color'
            ]],
            ['height', [
                'height'
            ]],
            ['fontname', [
                'fontname'
            ]],
            ['table', [
                'table'
            ]],
            ['para', [
                'ul', 'ol', 'paragraph'
            ]],
            ['misc', [
                'fullscreen', 'undo', 'redo'
            ]]
        ],
        onfocus: function (e) {
            $('body').addClass('overlay-disabled');
        },
        onblur: function (e) {
            $('body').removeClass('overlay-disabled');
        }
    });

});
