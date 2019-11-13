$(document).ready(function () {
    let form_signin = $('#form-signin');

    form_signin.validate({
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
            nama_users: {
                required: true
            },
            username_users: {
                required: true
            },
            password_users: {
                required: true
            },
            email_users: {
                required: true,
                email: true
            },
            telp_users: {
                required: true
            }
        },
        messages: {
            nama_users: {
                required: "Tolong masukkan nama lengkap anda"
            },
            username_users: {
                required: "Tolong masukkan username anda"
            },
            password_users: {
                required: "Tolong masukkan password anda"
            },
            email_users: {
                required: 'Tolong masukkan email anda',
                email: 'Format email anda salah'
            },
            telp_users: {
                required: 'Tolong masukkan nomor telphone anda'
            },
        },
    });
});
