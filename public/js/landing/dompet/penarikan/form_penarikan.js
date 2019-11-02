$(document).ready(function() {
    'use strict'

    $(window).keydown(function(event){
        if(event.keyCode == 13) {
            event.preventDefault();
            return false;
        }
    });

    $('#form_penarikan').validate({
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
            raw_saldo_transaksi: {
                minimumSaldo: true,
                validateBank: true,
                validateRekening: true,
                validateNomorRekening: true,
                required: true,
            }
        },
        messages: {
            raw_saldo_transaksi: {
                required: 'Tolong masukkan nominal saldo.'
            }
        }
    });

    jQuery.validator.addMethod("minimumSaldo", function(value, element){
        var val = Number($('#val_saldo_transaksi').val());
        var saldo_aktif = Number($('#composers_saldo_dompet').val());
        if (val <= saldo_aktif) {
            return true;
        } else {
            return false;
        };
    }, 'Saldo penarikan anda melebihi saldo aktif anda');

    jQuery.validator.addMethod("validateBank", function(value, element){
        var val = $('#valid_nama_bank').val();
        if (val === "") {
            return false;
        } else {
            return true;
        };
    }, '<i class="fa fa-info-circle"></i> Tolong diisi terdahulu nama bank anda di form profile');

    jQuery.validator.addMethod("validateRekening", function(value, element){
        var val = $('#valid_rekening').val();
        if (val === "") {
            return false;
        } else {
            return true;
        };
    }, '<i class="fa fa-info-circle"></i> Tolong diisi terdahulu nomor rekening anda di form profile');

    jQuery.validator.addMethod("validateNomorRekening", function(value, element){
        var val = $('#valid_nm_rek').val();
        if (val === "") {
            return false;
        } else {
            return true;
        };
    }, '<i class="fa fa-info-circle"></i> Tolong diisi terdahulu atas nama rekening anda di form profile');

    $('#raw_saldo_transaksi').autoNumeric('init',{
        aSep: '.',
        aDec: ',',
        mDec: '0'
    });

    $('#raw_saldo_transaksi').keyup(function () {
        var value = $('#raw_saldo_transaksi').autoNumeric('get');
        $('#val_saldo_transaksi').val(value);
    });

});
