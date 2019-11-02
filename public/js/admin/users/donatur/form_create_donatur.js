$(document).ready(function () {
    'use strict';
    var form_create = $('#form_create');
    form_create.validate({
        rules: {
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
        messages: {
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
    });
});
