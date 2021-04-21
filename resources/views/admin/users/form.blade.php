@extends('admin._layouts.edit-form')

@section('form_page_id'){{ 'admin-products-form' }}@endsection
@section('form_header') Users @endsection
@section('form_grid_url_caption') Users @endsection

@section('form_fields')

    <ul class="nav nav-tabs" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="btn-edit-general" data-toggle="tab" href="#tbp-edit-general" role="tab"
               aria-controls="home" aria-selected="true">Main</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="btn-edit-test" data-toggle="tab" href="#tbp-edit-test" role="tab"
               aria-controls="test" aria-selected="true">Test</a>
        </li>
    </ul>

    <div class="tab-content admin-form__tab-content">
        <div class="tab-pane fade show active" id="tbp-edit-general" role="tabpanel" aria-labelledby="btn-edit-general">
            @include('admin._components.fields.text', ['thCaption' => 'User Name', 'thName' => 'name'])
            @include('admin._components.fields.text', ['thCaption' => 'User Email', 'thName' => 'email'])
            <div class="form-group required">
                <label class="control-label col-sm-4" for="password">User Password</label>
                <div class="col-sm-5">
                    <input id="password" type="password" name="password" class="form-control"
                           value="">
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="tbp-edit-test" role="tabpanel" aria-labelledby="btn-edit-test">

        </div>

        <div class="form-group">
            <div class="btn-actions__wrap">
                <button type="submit" class="btn-save">Save</button>
                <a href="{{ $returnToListUrl }}" class="btn-return">Return to list</a>
            </div>
        </div>
    </div>

@endsection