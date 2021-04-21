<?php
/*

Создается таблица с id = "table-gallery"

Params:
    $thList - массив объектов с обязательными свойствами: id, image;

*/
?>
<div class="table-responsive col-md-6">
    <table id="table-gallery" class="table table-bordered">
        <tbody class="table-gallery-body">
        <tr class="table-gallery-row-template">
            <td>
                <div class="upload-file">
                    <div class="input-group">
                        <input name="gallery_image_delete_0" class="delete-file" type="hidden" value="0">
                        <input name="gallery_image_0" type="file" />
                        <input type="text" class="form-control" placeholder="Choose file"
                               aria-describedby="basic-addon2" disabled="disabled" value="">
                        <div class="input-group-append">
                            <button class="btn btn-outline-secondary btn-browse" type="button">Overview</button>
                            <button class="btn btn-outline-secondary btn-delete" type="button"><i class="fa fa-trash"></i></button>
                        </div>
                    </div>
                </div>
            </td>
        </tr>
        @if (count($thList) == 0)
            <tr class="table-gallery-row table-gallery-row-empty">
                <td>List is empty</td>
            </tr>
        @else
            @foreach($thList as $gallery)
                <tr class="table-gallery-row">
                    <td>
                        <div class="upload-file">
                            <div class="input-group">
                                <input name="gallery_image_delete[{{ $gallery->id }}]" class="delete-file" type="hidden" value="0">
                                <input name="gallery_image[{{ $gallery->id }}]" type="file" />
                                <input type="text" class="form-control" placeholder="Choose file"
                                       aria-describedby="basic-addon2" disabled="disabled" value="{{ $gallery->image }}">
                                <div class="input-group-append">
                                    <button class="btn btn-outline-secondary btn-browse" type="button">Overview</button>
                                    <button class="btn btn-outline-secondary btn-delete" type="button"><i class="fa fa-trash"></i></button>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
            @endforeach
        @endif
        <tr class="table-gallery-row">
            <td colspan="2"><button class="btn btn-primary btn-add-gallery-image"><i class="fa fa-plus"></i></button></td>
        </tr>
        </tbody>
    </table>
</div>