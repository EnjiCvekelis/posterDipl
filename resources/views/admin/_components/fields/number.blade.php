<div class="form-group {{ !isset($thRequired) || $thRequired ? 'required' : '' }} ">
    <label class="control-label col-sm-2" for="{{ isset($thName) ? $thName : 'number' }}">{{ isset($thCaption)? $thCaption : 'Sort order' }}</label>
    <div class="col-sm-5">
        <input id="{{ $thName or 'number' }}" type="number" name="{{ isset($thName) ? $thName : 'number' }}" class="form-control"
               value="{{
                isset($thValue) ? $thValue :
                (isset($entity) ? old(isset($thName) ? $thName : 'number', $entity->{isset($thName) ? $thName : 'number'}) : '')
                    }}">
    </div>
</div>