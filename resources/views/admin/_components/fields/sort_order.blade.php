<div class="form-group {{ !isset($thRequired) || $thRequired ? 'required' : '' }} ">
    <label class="control-label col-sm-2" for="{{ isset($thName) ? $thName : 'sort_order' }}">{{ isset($thCaption) ? $thCaption : 'Sort order' }}</label>
    <div class="col-sm-5">
        <input id="{{isset($thName) ? $thName : 'sort_order' }}" type="number" name="{{ isset($thName) ? $thName : 'sort_order' }}" class="form-control"
               value="{{
                isset($thValue) ? $thValue :
                (isset($entity) ? old(isset($thName) ? $thName : 'sort_order', $entity->{isset($thName) ? $thName : 'sort_order'}) : '')
                    }}">
    </div>
</div>