<?php
/*
Params:
    $thRequired     - обязательное ли поле (если не передан, по умолчанию required);
    $thCaption      - подпись контрола (если не передан, по умолчанию '');
    $thName         - имя контрола и его id (обязательное поле);
    $thList         - массив объектов - элементов для выпадающего списка (обязательное поле);
    $thListKey      - свойство-ключ массива объектов (если не передан, то id);
    $thListName     - свойство-значение массива объектов  (если не передан, то name);
    $thValue        - значение (если параметр не передан, и существует переменная-объект $entity,
                      то $thName - имя его свойства, из которого берется значение)
*/
?>

<div class="form-group {{ !isset($thRequired) || $thRequired ? 'required' : '' }}">
    <label class="control-label col-sm-4">{{ isset($thCaption) ? $thCaption : '' }}</label>
    <div class="col-sm-5">
        <select id="{{ $thName }}" name="{{ $thName }}" class="form-control">
            @foreach($thList as $item)
                <option value="{{ $item->{isset($thListKey) ? $thListKey : 'id'}  }}" {{ $item->{isset($thListKey) ? $thListKey : 'id'} ==
                        (isset($thValue) ? $thValue : (isset($entity) ? old($thName, $entity->{$thName}) : ''))
                            ? 'selected=selected' : '' }}>{{ $item->{isset($thListName) ? $thListName : 'name'} }}</option>
            @endforeach
        </select>
    </div>
    @if (isset($thHint))
        <span style="margin-left: 15px" class="text-muted"><small>* {{ $thHint }}</small></span>
    @endif
</div>