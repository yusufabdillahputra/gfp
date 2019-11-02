$(document).ready(function () {
    'use strict';
    var form_edit = $('#form_edit');
    form_edit.validate({
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
