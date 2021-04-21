<?php
/*
Params:
    $thRequired         - обязательное ли поле (если не передан, по умолчанию required);
    $thCaption          - подпись контрола (если не передан, по умолчанию '');
    $thName             - имя контрола и его id (обязательное поле);
    $thList             - массив объектов - элементов для выпадающего списка (обязательное поле);
    $thListKey          - свойство-ключ массива объектов (если не передан, то id);
    $thListName         - свойство-значение массива объектов  (если не передан, то name);
    $thListSelectedIds  - массив выбранных объектов - элементов (обязательное поле);
*/
?>

<div class="form-group {{ !isset($thRequired) || $thRequired ? 'required' : '' }}">
    <label class="control-label col-sm-2">{{ isset($thCaption) ? $thCaption : '' }}</label>
    <div class="col-sm-5">
        <select name="{{ $thName }}[]" class="form-control select2-control" multiple="multiple">
            @foreach($thList as $item)
                <option value="{{ $item->{isset($thListKey) ? $thListKey : 'id'} }}" {{ in_array($item->{isset($thListKey) ? $thListKey : 'id'}, old($thName, $thListSelectedIds)) ? 'selected=selected' : '' }}>{{ $item->{isset($thListName) ? $thListName : 'name'} }}</option>
            @endforeach
        </select>
    </div>
</div>