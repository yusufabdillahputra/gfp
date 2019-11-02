$(document).ready(function () {
    'use strict';
    var form_edit = $('#form_edit');
    form_edit.validate({
        rules: {
            nama_donasi: {
                required: true,
                minlength: 3
            }
        },
        messages: {
            nama_donasi: {
                required: "Tolong masukkan nama jenis donasi",
                minlength: 'Setidaknya form berisi 3 karakter'
            }
        },
    });
});
