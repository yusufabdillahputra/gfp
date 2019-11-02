$(document).ready(function () {
    'use strict'

    $(window).keydown(function(event){
        if(event.keyCode == 13) {
            event.preventDefault();
            return false;
        }
    });

    let val_minimal_donasi = Number($('#val_min_donasi_feed').val());
    let saldo_aktif = Number($('#composers_saldo_dompet').val());
    let val_maksimal_donasi = Number($('#val_maks_donasi_feed').val());
    let val_saldo_transaksi = Number($('#val_saldo_transaksi').val());

    $('#raw_saldo_transaksi').autoNumeric('init',{
        aSep: '.',
        aDec: ',',
        mDec: '0'
    });

    $('#raw_saldo_transaksi').keyup(function () {
        let value = Number($('#raw_saldo_transaksi').autoNumeric('get'));
        $('#val_saldo_transaksi').val(value);
    });

    jQuery.validator.addMethod("minimumSaldo", function(value, element){
        let val = Number(value.replace(".",""));
        if (val <= saldo_aktif) {
            return true;
        } else {
            return false;
        }
    }, 'Saldo penarikan anda melebihi saldo aktif anda');

    jQuery.validator.addMethod("min_maxSaldoFeed", function(value, element){
        let val = Number(value.replace(".",""));
        return (val >= val_minimal_donasi) && (val <= val_maksimal_donasi) ? true : false;
    }, 'Minimal donasi Rp. '+val_minimal_donasi+',- dan '+ 'Maksimal donasi Rp. '+val_maksimal_donasi+',-');

    let form_donasi = $('#form_donasi').validate({
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
                required: true,
                minimumSaldo: true,
                min_maxSaldoFeed: true,
                maxlength: 10
            }
        },
        messages: {
            raw_saldo_transaksi: {
                required: 'Tolong masukkan nominal saldo.',
                maxlength: jQuery.validator.format('Maximal donasi dibawah Rp. 100,000,000,-')
            }
        }
    });

    $('#btn_valid_donasi').on('click',function () {
        if ((Number($('#val_saldo_transaksi').val()) >= Number($('#val_min_donasi_feed').val())) && (Number($('#val_saldo_transaksi').val()) <= Number($('#val_maks_donasi_feed').val()))) {
            form_donasi.resetForm();
            $('#modal_verifi_donasi').modal('show');
        } if (Number($('#val_saldo_transaksi').val()) < Number($('#composers_saldo_dompet').val())) {
            return false;
        } else if (form_donasi.form()) {
            $('#modal_verifi_donasi').modal('show');
        }
    });
    
    $('#btn_submit_donasi_uang').click(function() {
        form_donasi.destroy();
        $('#form_donasi').submit();
    });

});
