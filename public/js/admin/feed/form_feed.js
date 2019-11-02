$(document).ready(function () {
    'use strict';

    $('[data-toggle="tooltip"]').tooltip();

    var val_created_at = new Date($('#val_created_at').val());
    var form_feed = $('#form_feed');

    form_feed.submit(function (event) {
        var val_isi_feed = $('#raw_isi_feed').code();
        $('#val_isi_feed').val(val_isi_feed);

        var val_keterangan_feed = $('#raw_keterangan_feed').code();
        $('#val_keterangan_feed').val(val_keterangan_feed);

        var raw_ended_at_feed = $('#raw_ended_at_feed').val();
        var d = raw_ended_at_feed.split("/")[0];
        var m = raw_ended_at_feed.split("/")[1];
        var y = raw_ended_at_feed.split("/")[2];
        $("#val_ended_at_feed").val(y+"-"+m+"-"+d+" 00:00:00");

        jQuery.validator.setDefaults({
            debug: true,
            success: "valid"
        });
        form_feed.validate({
            rules: {
                judul_feed: {
                    required: true
                },
                alamat_feed: {
                    required: true
                },
                kota_feed: {
                    required: true
                },
                provinsi_feed: {
                    required: true
                },
                min_donasi_feed: {
                    required: true
                },
                talent_feed: {
                    required: true
                },
                telp_talent_feed: {
                    required: true
                },
                email_talent_feed: {
                    email: true
                }
            },
            messages: {
                judul_feed: {
                    required: "Judul tidak boleh kosong",
                },
                alamat_feed: {
                    required: "Alamat tidak boleh kosong",
                },
                kota_feed: {
                    required: "Kota tidak boleh kosong",
                },
                provinsi_feed: {
                    required: "Provinsi tidak boleh kosong",
                },
                min_donasi_feed: {
                    required: "Minimal donasi tidak boleh kosong",
                },
                talent_feed: {
                    required: "Nama talent tidak boleh kosong",
                },
                telp_talent_feed: {
                    required: "Nomor telp. talent tidak kosong",
                },
                email_talent_feed: {
                    email: "Format email anda salah",
                }
            }
        });
        return form_feed.valid();
    });

    $('#raw_min_donasi_feed').autoNumeric('init',{
        aSep: '.',
        aDec: ',',
        mDec: '0'
    });

    $('#raw_min_donasi_feed').keyup(function () {
        var value = $('#raw_min_donasi_feed').autoNumeric('get');
        $('#val_min_donasi_feed').val(value);
    });

    $('#raw_max_donasi_feed').autoNumeric('init',{
        aSep: '.',
        aDec: ',',
        mDec: '0'
    });

    $('#raw_max_donasi_feed').keyup(function () {
        var value = $('#raw_max_donasi_feed').autoNumeric('get');
        $('#val_max_donasi_feed').val(value);
    });


    Dropzone.options.myAwesomeDropzone = {
        paramName: "path_img_feed",
        autoProcessQueue: false,
        parallelUploads: 10,
        uploadMultiple: true,
        maxFilesize: 1, //MB
        addRemoveLinks: true,
        init: function () {
            var myDropzone = this;
            var btn_submit = document.querySelector('#btn_submit_img');
            btn_submit.addEventListener('click', function () {
                myDropzone.processQueue();
            });
            this.on("success", function (file) {
                location.reload();
            });
        }
    };

    $('#raw_ended_at_feed').datepicker({
        startDate: val_created_at,
        format: 'dd/mm/yyyy'
    });

    $('#raw_isi_feed').summernote({
        height: 400,
        placeholder: 'Isi feed disini....',
        toolbar: [
            ['style', [
                'bold', 'italic', 'underline', 'clear'
            ]],
            ['fontsize', [
                'fontsize'
            ]],
            ['color', [
                'color'
            ]],
            ['height', [
                'height'
            ]],
            ['fontname', [
                'fontname'
            ]],
            ['table', [
                'table'
            ]],
            ['para', [
                'ul', 'ol', 'paragraph'
            ]],
            ['misc', [
                'fullscreen', 'undo', 'redo'
            ]]
        ],
        onfocus: function (e) {
            $('body').addClass('overlay-disabled');
        },
        onblur: function (e) {
            $('body').removeClass('overlay-disabled');
        }
    });

    $('#raw_keterangan_feed').summernote({
        height: 400,
        placeholder: 'Isi deskripsi disini....',
        toolbar: [
            ['style', [
                'bold', 'italic', 'underline', 'clear'
            ]],
            ['fontsize', [
                'fontsize'
            ]],
            ['color', [
                'color'
            ]],
            ['height', [
                'height'
            ]],
            ['fontname', [
                'fontname'
            ]],
            ['table', [
                'table'
            ]],
            ['para', [
                'ul', 'ol', 'paragraph'
            ]],
            ['misc', [
                'fullscreen', 'undo', 'redo'
            ]]
        ],
        onfocus: function (e) {
            $('body').addClass('overlay-disabled');
        },
        onblur: function (e) {
            $('body').removeClass('overlay-disabled');
        }
    });
});
