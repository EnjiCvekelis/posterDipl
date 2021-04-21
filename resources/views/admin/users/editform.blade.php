@extends('admin._layouts.edit-form')

@section('form_page_id'){{ 'admin-products-form' }}@endsection
@section('form_header') Users @endsection
@section('form_grid_url_caption') Users @endsection

@section('form_fields')
    @if(session()->has('error'))
        <div class="alert alert-danger">
            <b>Errors:</b>
            <ul>
                    <li>{{ session('error') }}</li>
            </ul>
        </div>
    @endif
    <ul class="nav nav-tabs" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="btn-edit-general" data-toggle="tab" href="#tbp-edit-general" role="tab"
               aria-controls="home" aria-selected="true">Main</a>
        </li>
    </ul>

    <div class="tab-content admin-form__tab-content">
        <div class="tab-pane fade show active" id="tbp-edit-general" role="tabpanel" aria-labelledby="btn-edit-general">
            @include('admin._components.fields.text', ['thCaption' => 'User Name', 'thName' => 'name', 'thRequired' => ''])
            @include('admin._components.fields.text', ['thCaption' => 'User Email', 'thName' => 'email', 'thRequired' => ''])
            <div class="form-group required">
                <label class="control-label col-sm-4" for="password">Old User Password</label>
                <div class="col-sm-5">
                    <input id="password" type="password" name="password" class="form-control"
                           value="">
                </div>
            </div>
            <div class="form-group required">
                <label class="control-label col-sm-4" for="password">New User Password</label>
                <div class="col-sm-5">
                    <input id="password" type="password" name="password_new" class="form-control"
                           value="">
                </div>
            </div>
            <div class="form-group required">
                <label class="control-label col-sm-4" for="password">Repeat New User Password</label>
                <div class="col-sm-5">
                    <input id="password" type="password" name="password_new_second" class="form-control"
                           value="">
                </div>
            </div>
        </div>

        <div class="form-group">
            <div class="btn-actions__wrap">
                <button type="submit" class="btn-save">Save</button>
                <a href="{{ $returnToListUrl }}" class="btn-return">Return to list</a>
            </div>
        </div>
    </div>

@endsection