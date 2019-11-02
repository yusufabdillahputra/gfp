$(document).ready(function () {
    'use strict';
    var form_create = $('#form_create');
    form_create.validate({
        rules: {
            judul_feed: {
                required: true,
                minlength: 3
            }
        },
        messages: {
            judul_feed: {
                required: "Tolong masukkan judul feed",
                minlength: 'Setidaknya form berisi 3 karakter'
            }
        },
    });
});
