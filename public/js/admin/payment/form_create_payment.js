$(document).ready(function () {
    'use strict';
    var form_create = $('#form_create');
    form_create.validate({
        rules: {
            nama_bank_payment: {
                required: true,
                minlength: 3
            }
        },
        messages: {
            nama_bank_payment: {
                required: "Tolong masukkan nama bank",
                minlength: 'Setidaknya form berisi 3 karakter'
            }
        },
    });
});
