$(document).ready(function () {
    'use strict';

    var form_edit = $('#form_edit_payment');
    form_edit.validate({
        rules: {
            nama_bank_payment: {
                required: true,
                minlength: 3
            },
            rekening_payment: {
                required: true,
                minlength: 3
            },
            pemilik_rek_payment: {
                required: true,
                minlength: 3
            },
            jenis_payment: {
                required: true
            }
        },
        messages: {
            username_users: {
                required: "Tolong masukkan username pengguna",
                minlength: 'Setidaknya form berisi 3 karakter'
            },
            nama_bank_payment: {
                required: 'Tolong masukkan nama bank',
                minlength: 'Setidaknya form berisi 3 karakter'
            },
            rekening_payment: {
                required: 'Tolong masukkan nomor rekening bank',
                minlength: 'Setidaknya form berisi 3 karakter'
            },
            pemilik_rek_payment: {
                required: 'Tolong masukkan nama pemilik rekening',
                minlength: 'Setidaknya form berisi 2 karakter'
            },
            jenis_payment: {
                required: 'Jenis pembayaran harus di set'
            }
        },
    });

    $('#editor_step_payment').summernote({
        height: 250,
        placeholder: 'Isi tata cara pembayaran disini....',
        toolbar: [
            ['style', [
                'bold', 'italic', 'underline'
            ]],

            ['para', [
                'ul', 'ol', 'paragraph'
            ]],
            ['fontsize', [
                'fontsize', 'height'
            ]],
            ['misc', [
                'fullscreen', 'undo', 'redo'
            ]],
            ['fontsize', [
                'fontsize',
                'fontname'
            ]],
        ],
        onfocus: function (e) {
            $('body').addClass('overlay-disabled');
        },
        onblur: function (e) {
            $('body').removeClass('overlay-disabled');
        }
    });

    /**
     * Digunakan untuk memasukkan text summernote kedalam suatu wadah
     * todo : summernote harus di destroy dahulu baru di create ulang, ini dikarenakan
     *        summernote sudah digunakan pada modul konten, cari cara yang lebih efektif
     */
    $('#btn_submit').on('click',function() {
        var body = $('#editor_step_payment').code();
        $('#val_step_payment').val(body);
    });

});
