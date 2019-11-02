$(document).ready(function () {
    'use strict';

    $(document).on("click", ".modal_delete_admin", function () {
        var id_users = $(this).data('d_id_users');
        var nama_users = $(this).data('d_nama_users');
        $('.modal-body #id_users').val(id_users);
        $('.modal-body #nama_users').val(nama_users);
    });

});
