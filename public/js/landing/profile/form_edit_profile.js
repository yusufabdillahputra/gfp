$(document).ready(function () {
    'use strict';
    var form_edit = $('#form_edit');
    form_edit.validate({
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
            rsc: {
                username_users: {
                    required: true,
                    minlength: 3
                },
                nama_users: {
                    required: true,
                    minlength: 2
                },
                email_users: {
                    required: true,
                    email: true
                }
            },
        },
        messages: {
            rsc: {
                username_users: {
                    required: "Tolong masukkan username pengguna",
                    minlength: 'Setidaknya form berisi 3 karakter'
                },
                nama_users: {
                    required: 'Tolong masukkan nama lengkap pengguna',
                    minlength: 'Setidaknya form berisi 2 karakter'
                },
                email_users: {
                    required: 'Tolong masukkan email pengguna',
                    email: 'Tolong masukkan format email yang benar'
                }
            },
        },
    });
});
