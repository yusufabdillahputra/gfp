$(document).ready(function () {
    'use strict';
    var form_create = $('#form_create');
    form_create.validate({
        rules: {
            judul_label: {
                required: true,
                minlength: 3
            }
        },
        messages: {
            judul_label: {
                required: "Tolong masukkan judul label",
                minlength: 'Setidaknya form berisi 3 karakter'
            }
        },
    });
});
