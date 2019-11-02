$(document).ready(function () {
    'use strict';

    Dropzone.options.myAwesomeDropzone = {
        paramName: "path_img_subk",
        autoProcessQueue: false,
        parallelUploads: 10,
        uploadMultiple: true,
        maxFilesize: 1, //MB
        addRemoveLinks: true,
        init: function() {
            var myDropzone = this;
            var btn_submit = document.querySelector('#btn_submit_img');
            btn_submit.addEventListener('click', function () {
                myDropzone.processQueue();
            });
            this.on("success", function(file){
                location.reload();
            });
        }
    };

    $('#isi_subk').summernote({
        height: 400,
        placeholder: 'Isi sub konten disini....',
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
            ['misc',[
                'fullscreen', 'undo', 'redo'
            ]]
        ],
        onfocus: function(e) {
            $('body').addClass('overlay-disabled');
        },
        onblur: function(e) {
            $('body').removeClass('overlay-disabled');
        }
    });
});
