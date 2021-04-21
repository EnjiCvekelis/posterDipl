export default class GalleryUpload {
    constructor(containerId) {
        var self = this;

        this.containerId = containerId;
        let form = $(containerId);

        $(form).find('.btn-add-gallery-image').click(function (e) {

            e.preventDefault();

            let newRow = $(form).find('.table-gallery-row-template').clone();

            $(newRow).removeClass('table-gallery-row-template');
            $(newRow).addClass('table-gallery-row');
            $(form).find('.table-gallery-row:last').before($(newRow));
            $(form).find('.table-gallery-row-empty').hide();

            let newId = -(new Date()).getMilliseconds();
            $(newRow).find('input[type=hidden]').attr('name', 'gallery_image_delete[' + newId + ']')
            $(newRow).find('input[type=file]').attr('name', 'gallery_image[' + newId + ']')

            self.initUploadHandlers(newRow);
        });

        $(form).find('.upload-file').each(function () {
            self.initUploadHandlers(this);
        });
    }

    initUploadHandlers(control) {
        $(control).find('.btn-browse').click(function () {
            $(this).parents('.upload-file')
                .find('input[type=file]').trigger('click');
        });

        $(control).find('.btn-delete').click(function () {

            let form = $(this).parents('.upload-file');
            $(form).parents('.table-gallery-row').remove();
        });

        $(control).find('input[type=file]').change(function () {

            var fieldVal = $(this).val();

            // Change the node's value by removing the fake path (Chrome)
            fieldVal = fieldVal.replace("C:\\fakepath\\", "");

            if (fieldVal) {
                let form = $(this).parents('.upload-file');
                $(form).find("input[type=text]").val(fieldVal);
                $(form).find('.delete-file').val('0');

                let newId = -(new Date()).getMilliseconds();
                $(form).find('input[type=hidden]').attr('name', 'gallery_image_delete[' + newId + ']')
                $(form).find('input[type=file]').attr('name', 'gallery_image[' + newId + ']')
            }
        });
    }
}