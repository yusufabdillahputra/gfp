$(document).ready(function () {
    'use strict';

    $(document).on("click", ".modal_delete_payment", function () {
        var id_payment = $(this).data('d_id_payment');
        var nama_bank_payment = $(this).data('d_nama_bank_payment');
        $('.modal-body #d_id_payment').val(id_payment);
        $('.modal-body #d_nama_bank_payment').val(nama_bank_payment);
    });

    $(document).on("click", ".modal_edit_payment", function () {
        var id_payment = $(this).data('e_id_payment');
        var nama_bank_payment = $(this).data('e_nama_bank_payment');
        $('.modal-body #e_id_payment').val(id_payment);
        $('.modal-body #e_nama_bank_payment').val(nama_bank_payment);
    });

});
