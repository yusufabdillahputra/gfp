$(document).ready(function () {
    var form_login = $('#form-login');
    form_login.validate({
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
            username_users: {
                required: true
            },
            password_users: {
                required: true
            }
        },
        messages: {
            username_users: {
                required: "Tolong masukkan username anda"
            },
            password_users: {
                required: 'Tolong masukkan password anda'
            }
        },
    });
});
