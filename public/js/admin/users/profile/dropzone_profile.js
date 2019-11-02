$(document).ready(function () {
    'use strict';
    Dropzone.options.myAwesomeDropzone = {
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
    };
});
