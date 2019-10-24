
$(document).ready(function() {

    var fileInput = $('.fileInput');
    fileInput.fileinput().on("filebatchselected", function (event, files) {
        fileInput.fileinput("upload");
    });

    fileInput.fileinput().on('filepreupload', function(event, data, previewId, index) {
        var extraArray = data.extra;
        var galleryIdInput = '<input type="hidden" name="'+ extraArray.formName + '[' + extraArray.attributeName + ']' + '[gallery_id]' +'" value="'+ extraArray.galleryId +'" class="gallery-hidden-' + extraArray.attributeName + '" >';
        if (!$('*').is('.gallery-hidden-' + extraArray.attributeName + '')) {
            $(this).after(galleryIdInput);
        }
    });
});
