@extends('admin._layouts.edit-form')

@section('form_page_id'){{ 'admin-products-form' }}@endsection
@section('form_header') Tracks @endsection
@section('form_grid_url_caption') Tracks @endsection

@section('form_fields')

    <ul class="nav nav-tabs" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="btn-edit-general" data-toggle="tab" href="#tbp-edit-general" role="tab"
               aria-controls="home" aria-selected="true">Main</a>
        </li>
    </ul>

    <div class="tab-content admin-form__tab-content">
        <div class="tab-pane fade show active" id="tbp-edit-general" role="tabpanel" aria-labelledby="btn-edit-general">
            @include('admin._components.fields.text', ['thCaption' => 'Track Name', 'thName' => 'name'])
            @include('admin._components.fields.editor', ['thCaption' => 'Track Description', 'thName' => 'description'])
            @include('admin._components.fields.image', ['thWidth' => '160px', 'thHeight' => '160px', 'thName' => 'cover', 'thCaption' => 'Track Cover'])
            @include('admin._components.fields.multi_select', ['thCaption'=>'Parent SubCategory', 'thName'=>'parent', 'thList' => $categories,
'thListSelectedIds' => $selectedIds])
            <div class="form-group">
                <label class="control-label" for="track">Track</label>
                <div class="col-sm-5">
                    <input id="track" type="file" name="track" class="form-control" value="">
                    <div style="margin-top: 5px;font-size: 12px">
                        Currently uploaded:
                        {{$entity->track}}
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label" for="sort_order">Sort Order</label>
                <div class="col-sm-5">
                    <input id="sort_order"  type="number" name="sort_order" class="form-control"
                           value="{{$entity->sort_order}}">
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