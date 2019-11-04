Dropzone.autoDiscover = false;
$(document).ready(function () {
    var myDropzone = new Dropzone('form#dz_path_img_feed',{
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
    });
});
