$(document).ready(function () {
    'use strict';
    var form_edit = $('#form_edit');
    form_edit.validate({
        rules: {
            judul_konten: {
                required: true,
                minlength: 3
            }
        },
        messages: {
            judul_konten: {
                required: "Tolong masukkan judul konten",
                minlength: 'Setidaknya form berisi 3 karakter'
            }
        },
    });
});
