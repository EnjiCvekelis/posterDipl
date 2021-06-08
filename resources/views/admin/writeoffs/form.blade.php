@extends('admin._layouts.edit-form')

@section('form_page_id'){{ 'admin-products-form' }}@endsection
@section('form_header') Списания @endsection
@section('form_grid_url_caption') Списания @endsection

@section('form_fields')

    <ul class="nav nav-tabs" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="btn-edit-general" data-toggle="tab" href="#tbp-edit-general" role="tab"
               aria-controls="home" aria-selected="true">Основные</a>
        </li>
    </ul>

    <div class="tab-content admin-form__tab-content">
        <div class="tab-pane fade show active" id="tbp-edit-general" role="tabpanel" aria-labelledby="btn-edit-general">
            <div class="form-group">
                <label class="control-label col-sm-4">Товар</label>
                <div class="col-sm-5">
{{--                    {{dd($errors)}}--}}
                    <select id="goods_id" name="goods_id" class="form-control js-example-basic-single">
                        @foreach($goods as $item)
                            <option value="{{ $item->id }}" {{ $item->id ==
                        (isset($thValue) ? $thValue : (isset($entity) ? old('goods_id', $entity->goods_id   ) : ''))
                            ? 'selected=selected' : '' }}>{{ $item->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            @include('admin._components.fields.number', ['thCaption' => 'Количество', 'thName' => 'amount'])
            @include('admin._components.fields.text', ['thCaption' => 'Цена за единицу', 'thName' => 'price'])
        </div>
    <div class="form-group">
        <div class="btn-actions__wrap">
            <button type="submit" class="btn-save">Сохранить</button>
            <a href="{{ $returnToListUrl }}" class="btn-return">Назад</a>
        </div>
    </div>
        <script>
            $(document).ready(function() {
                $('.js-example-basic-single').select2();
            });
        </script>

    </div>

@endsection