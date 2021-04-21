<?php
/*
Params:
    $thRequired - обязательное ли поле (если не передан, по умолчанию required);
    $thCaption  - подпись контрола (если не передан, по умолчанию '');
    $thName     - имя контрола и его id (обязательное поле);
    $thValue    - значение (если параметр не передан, и существует переменная-объект $entity,
                  то $thName - имя его свойства, из которого берется значение)
    $thHint     - подсказка, которая будет выводится под контролом
*/
?>
<div class="form-group {{ !isset($thRequired) || $thRequired ? 'required' : '' }} ">
    <label class="control-label" for="{{ $thName }}">{{ isset($thCaption) ? $thCaption : '' }}</label>
    <div class="col-sm-5">
        <input id="{{ $thName }}"  type="text" name="{{ $thName }}" class="form-control"
               value="{{
               isset($thValue) ?
                $thValue :
                (isset($entity) ? old($thName, $entity->{$thName}) : '')
                    }}">
        @if (isset($thHint))
            <span class="text-muted"><small>* {{ $thHint }}</small></span>
        @endif
    </div>
</div>