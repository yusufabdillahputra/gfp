Dropzone.autoDiscover = false;
$(document).ready(function () {
    var myDropzone = new Dropzone('form#dz_foto_users',{
        dictDefaultMessage: "Arahkan gambar ke form / klik disini...",
        paramName: "foto_users",
        maxFiles: 1,
        maxFilesize: 1, //MB
        addRemoveLinks: true,
        maxfilesexceeded: function(file) {
            this.removeAllFiles();
            this.addFile(file);
        },
        init: function() {
            this.on("success", function(file){
                location.reload();
            });
            // this.on("maxfilesexceeded", function(file){
            //     alert("No more files please!");
            // });
        }
    });
});
