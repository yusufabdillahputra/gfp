$(document).ready(function() {
    'use strict'

    $(window).keydown(function(event){
        if(event.keyCode == 13) {
            event.preventDefault();
            return false;
        }
    });

    $('#id_payment').select2();

    $('#form_topup').validate({
        errorClass: "invalid-feedback animated fadeInDown",
        errorElement: "div",
        errorPlacement: function(e, r) {
            jQuery(r).parents(".form-group").append(e)
            console.log(e);
        },
        highlight: function(e) {
            jQuery(e).closest(".form-group").removeClass("is-invalid").addClass("is-invalid")
        },
        success: function(e) {
            jQuery(e).closest(".form-group").removeClass("is-invalid"), jQuery(e).remove()
        },
        rules: {
            raw_saldo_transaksi: {
                required: true,
                minlength: 6,
                maxlength: 10,
            }
        },
        messages: {
            raw_saldo_transaksi: {
                required: 'Tolong masukkan nominal saldo.',
                minlength: jQuery.validator.format('Minimal transaksi Rp. 10,000,-'),
                maxlength: jQuery.validator.format('Maximal transaksi dibawah Rp. 100,000,000,-')
            }
        }
    });

    $('#saldo_transaksi').autoNumeric('init',{
        aSep: '.',
        aDec: ',',
        mDec: '0'
    });

    $('#id_payment').prop('disabled', true);
    $('#jenis_payment').prop('disabled', true);
    $('#saldo_transaksi').keyup(function () {
        var value = $('#saldo_transaksi').autoNumeric('get');
        if (value >= 10000) {
            $('#id_payment').prop('disabled', false);
            $('#jenis_payment').prop('disabled', false);
        } if (value < 10000) {
            $('#id_payment').prop('disabled', true);
            $('#jenis_payment').prop('disabled', true);
        }
    });

    $('#form_topup').submit(function(){
        var form = $(this);
        $('input').each(function(i){
            var self = $(this);
            try{
                var v = self.autoNumeric('get');
                self.autoNumeric('destroy');
                self.val(v);
            }catch(err){
                console.log("Not an autonumeric field: " + self.attr("name"));
            }
        });
        return true;
    });

    $('#jenis_payment').on('change', function () {
        $.ajax({
            url: 'ajax/getNamaBank',
            method: 'POST',
            data: {
                '_token' : $('#_csrf').val(),
                'jenis_payment' : $('#jenis_payment').val()
            },
            success: function (parsing_data) {
                $('#AJAX_BankPayment').html(parsing_data);
            }
        });
    });

});
