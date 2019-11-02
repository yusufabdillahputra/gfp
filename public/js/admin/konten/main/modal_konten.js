$(document).ready(function () {
    'use strict';

    function main_url() {
        var url = window.location.href;
        var split_url = url.split("/");
        var str_url = split_url[0]+'//'+split_url[2]+'/';
        return str_url;
    }

    $(document).on("click", ".modal_delete_konten", function () {
        var id_konten = $(this).data('d_id_konten');
        var csrf = $(this).data('d_csrf');
        var judul_konten = $(this).data('d_judul_konten');
        $.ajax({
            async: false,
            global: false,
            dataType: 'html',
            url: main_url()+'konten/ajaxCekSubKonten',
            data: {
                'id_konten' : id_konten,
                '_token' : csrf
            },
            method: 'POST',
            success: function (parsing_data) {
                var sub_konten = JSON.parse(parsing_data);
                $('.modal-body #d_id_konten').val(id_konten);
                $('.modal-body #d_judul_konten').val(judul_konten);
                /**
                 * Jika sub konten ada dilarang submit
                 */
                if (sub_konten.data == true) {
                    $('.modal-header #info_hapus').html('<p class="text-danger"><i class="fa fa-info-circle"></i> Konten hanya bisa dihapus apabila semua sub konten telah dihapus</p>');
                    $('#submit_button').prop('disabled', true);
                } else if (sub_konten.data == false) {
                    $('.modal-header #info_hapus').html('<p class="text-success"><i class="fa fa-info-circle"></i> Konten bisa dihapus</p>');
                    $('#submit_button').prop('disabled', false);
                }
            }
        });
    });

    $(document).on("click", ".modal_edit_konten", function () {
        var id_konten = $(this).data('e_id_konten');
        var judul_konten = $(this).data('e_judul_konten');
        $('.modal-body #e_id_konten').val(id_konten);
        $('.modal-body #e_judul_konten').val(judul_konten);
    });

});
