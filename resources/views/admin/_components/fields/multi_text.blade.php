<?php
/*
Params:
    $thRequired - обязательное ли поле (если не передан, по умолчанию required);
    $thCaption  - подпись контрола (если не передан, по умолчанию '');
    $thName     - имя контрола и его id (обязательное поле);
    $thRows     - количество строк к контроле (если не передан, по умолчанию 5);
    $thValue    - значение (если параметр не передан, и существует переменная-объект $entity,
                  то $thName - имя его свойства, из которого берется значение)
*/
?>
<div class="form-group {{ !isset($thRequired) || $thRequired ? 'required' : '' }} ">
    <label class="control-label col-sm-2" for="{{ $thName }}">{{ isset($thCaption) ? $thCaption : '' }}</label>
    <div class="col-sm-5">
        <textarea id="{{ $thName }}" rows="{{ isset($thRows) ? $thRows : 5 }}"
                  name="{{ $thName }}" class="form-control">{{
               isset($thValue) ?
                $thValue :
                (isset($entity) ? old($thName, $entity->{$thName}) : '')
                    }}</textarea>
    </div>
</div>