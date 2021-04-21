<div class="form-group {{ !isset($thRequired) || $thRequired ? 'required' : '' }}">
    <label class="control-label col-sm-4">{{ isset($thCaption) ? $thCaption : 'test' }}</label>
    @if (isset($thHint))
        <div style="margin-left: 15px" class="text-muted"><small>* {{ $thHint }}</small></div>
    @endif
    <div class="image-upload-container" style="max-width: {{ $thWidth }};">
        <div class="image-edit">
            <input class="image-upload" name="{{ isset($thName) ? $thName : 'image' }}" type='file' accept=".png, .jpg, .jpeg, .gif, .svg" />
            <label class="btn-image-upload"></label>
        </div>
        <div class="image-preview-container" style="width: {{ $thWidth }}; height: {{ $thHeight }}; position: relative;">
            <div class="image-preview" data-init-image="{{ assetImage($entity->{isset($thName) ? $thName : 'image'}) }}">
            </div>
        </div>
    </div>
</div>