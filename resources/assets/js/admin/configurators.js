// window.CKEDITOR_BASEPATH = '/js/ckeditor/';
// require('ckeditor');

$(function () {
    // CKEditorConfigurator.init();
    ImageUploadConfigurator.init();
    Select2Configurator.init();
    FileUploadConfigurator.init();
});
//
// /*========================== CKEditorConfigurator ==========================*/
// var CKEditorConfigurator = {
//   init: function() {
//       // CKEDITOR.editorConfig = function( config ) {
//       //     // Define changes to default configuration here. For example:
//       //     // config.language = 'fr';
//       //     // config.uiColor = '#AADC6E';
//       //     config.extraPlugins = "base64image";
//       // };
//       CKEDITOR.config.extraPlugins = "base64image";
//       CKEDITOR.config.height = '400px';
//       CKEDITOR.config.allowedContent = true;
//       CKEDITOR.replaceAll('field-ext-editor');
//   }
// };


/*========================== ImageUploadConfigurator ==========================*/
var ImageUploadConfigurator = {
    init: function(){
        $('.image-preview').css('background-image', function() {
            return 'url(' + $(this).attr('data-init-image') + ')';
        });

        $('.btn-image-upload').click(function() {
            let input = $(this).parents('.image-edit').find('.image-upload');
            input.trigger('click');
        });

        $(".image-upload").change(function () {

            let input = this;
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    let imagePreview = $(input).parents('.image-upload-container').find('.image-preview');
                    imagePreview.css('background-image', 'url(' + e.target.result + ')');
                    imagePreview.hide();
                    imagePreview.fadeIn(650);
                };
                reader.readAsDataURL(input.files[0]);
            }
        });
    }
};

/*========================== Select2Configurator ==========================*/
var Select2Configurator = {
    init: function(){
        $(".select2-control").select2({
            dir: "rtl",
            allowClear: true,
            width: '100%'
        });
    }
};

/*========================== FileUploadConfigurator ==========================*/
var FileUploadConfigurator = {
    init: function(){
        $('.upload-file .btn-browse').click(function () {
            $(this).parents('.upload-file')
                .find('input[type=file]').trigger('click');
        });

        $('.upload-file .btn-delete').click(function () {
            let form = $(this).parents('.upload-file');
            $(form).find('input[type=file]').val('');
            $(form).find('input[type=text]').val('');
            $(form).find('.delete-file').val('1');
        });

        $(".upload-file input[type=file]").change(function () {

            var fieldVal = $(this).val();

            // Change the node's value by removing the fake path (Chrome)
            fieldVal = fieldVal.replace("C:\\fakepath\\", "");

            if (fieldVal) {
                let form = $(this).parents('.upload-file');
                $(form).find("input[type=text]").val(fieldVal);
                $(form).find('.delete-file').val('0');
            }
        });
    }
};