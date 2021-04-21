@extends('admin._layouts.edit-form')

@section('form_page_id'){{ 'admin-products-form' }}@endsection
@section('form_header') Товары @endsection
@section('form_grid_url_caption') Товары @endsection

@section('form_fields')

    <ul class="nav nav-tabs" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="btn-edit-general" data-toggle="tab" href="#tbp-edit-general" role="tab"
               aria-controls="home" aria-selected="true">Основное</a>
        </li>
    </ul>

    <div class="tab-content admin-form__tab-content">
        <div class="tab-pane fade show active" id="tbp-edit-general" role="tabpanel" aria-labelledby="btn-edit-general">
            @include('admin._components.fields.text', ['thCaption' => 'Название', 'thName' => 'name'])
        </div>
    <div class="form-group">
        <div class="btn-actions__wrap">
            <button type="submit" class="btn-save">Сохранить</button>
            <a href="{{ $returnToListUrl }}" class="btn-return">Назад</a>
        </div>
    </div>

    </div>

@endsection