$(document).ready(function () {
    'use strict';

    var form_pass = $('#form_pass');
    form_pass.validate({
        errorClass: "invalid-feedback animated fadeInDown",
        errorElement: "div",
        errorPlacement: function(e, r) {
            jQuery(r).parents(".form-group").append(e)
        },
        highlight: function(e) {
            jQuery(e).closest(".form-group").removeClass("is-invalid").addClass("is-invalid")
        },
        success: function(e) {
            jQuery(e).closest(".form-group").removeClass("is-invalid"), jQuery(e).remove()
        },
        rules: {
            users_password_baru: {
                required: true,
                minlength: 3
            },
            users_password_baru_re: {
                required: true,
                minlength: 3,
                equalTo: "#users_password_baru"
            }
        },
        messages: {
            users_password_baru: {
                required: "Masukkan password baru",
                minlength: 'Minimal password 3 karakter'
            },
            users_password_baru_re: {
                required: "Ketik kembali password baru",
                minlength: 'Minimal password 3 karakter',
                equalTo: 'Password baru tidak sesuai'
            }
        }
    });

});
