<?php
/*
Params:
    $thRequired - обязательное ли поле (если не передан, по умолчанию required);
    $thCaption  - подпись контрола (если не передан, по умолчанию '');
    $thName     - имя контрола и его id (обязательное поле);
    $thValue    - значение (если параметр не передан, и существует переменная-объект $entity,
                  то $thName - имя его свойства, из которого берется значение)
*/
?>
<div class="form-group  {{ !isset($thRequired) || $thRequired ? 'required' : '' }} ">
    <label class="control-label" for="{{ $thName }}">{{ isset($thCaption) ? $thCaption : '' }}</label>
    <div class="col-sm-5">
           <textarea id="{{ $thName }}"
                     name="{{ $thName }}" class="field-ext-editor">{{
               isset($thValue) ?
                $thValue :
                (isset($entity) ? old($thName, $entity->{$thName}) : '')
                    }}</textarea>
    </div>
    @if (isset($thHint))
        <span style="margin-left: 15px" class="text-muted"><small>* {{ $thHint }}</small></span>
    @endif
</div>