$(document).ready(function () {
    'use strict';

    function main_url() {
        var url = window.location.href;
        var split_url = url.split("/");
        var str_url = split_url[0]+'//'+split_url[2]+'/';
        return str_url;
    }

    var users_data = function () {
        var tmp = null;
        $.ajax({
            async: false,
            global: false,
            dataType: 'html',
            url: main_url()+'users/ajaxGetSession',
            method: 'GET',
            success: function (parsing_data) {
                tmp = JSON.parse(parsing_data)
            }
        });
        return tmp;
    }();

    var form_pass = $('#form_pass');
    form_pass.validate({
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
            users_password_lama: {
                required: true,
                minlength: 3,
                cekPasswordLama: $('#users_password_lama').val()
            },
            users_password_baru: {
                required: true,
                minlength: 3,
                notEqualTo : $('#users_password_lama').val()
            },
            users_password_baru_re: {
                required: true,
                minlength: 3,
                equalTo: "#users_password_baru"
            }
        },
        messages: {
            users_password_lama: {
                required: "Masukkan password lama",
                minlength: 'Minimal password 3 karakter',
                cekPasswordLama: "Password lama anda salah"
            },
            users_password_baru: {
                required: "Masukkan password baru",
                minlength: 'Minimal password 3 karakter',
                notEqualTo : 'Password baru anda tidak boleh sama dengan password lama'
            },
            users_password_baru_re: {
                required: "Ketik kembali password baru",
                minlength: 'Minimal password 3 karakter',
                equalTo: 'Password baru tidak sesuai'
            }
        }
    });

    jQuery.validator.addMethod("cekPasswordLama", function (value, element, param) {
        return this.optional(element) || value == users_data['password_users'];
    });

    jQuery.validator.addMethod("notEqualTo", function (value, element, param) {
        return this.optional(element) || value !== users_data['password_users'];
    });

});
