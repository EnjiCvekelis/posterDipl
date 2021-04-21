@extends('admin._layouts.base')

@section('content')
<div id="@yield('form_page_id')" class="container-fluid">
    <div class="row">
        <div class="col-md-12 page-title">
            <h4 class="text-center text-uppercase">{{ empty($entity->id) ? 'ADD' : 'EDIT' }} @yield('form_header')</h4>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.home') }}">PANEL</a>
                </li>
                <li class="breadcrumb-item"><a href="{{ $returnToListUrl }}">@yield('form_grid_url_caption')</a></li>
                <li class="breadcrumb-item active">{{ empty($entity->id) ? 'Add' : 'Edit' }}</li>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <b>Errors:</b>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @elseif(!empty($success))
                <div class="alert alert-success">
                    <b>Data saved successfully!</b> (<a href="{{ $returnToListUrl }}">Return to the list</a>)
                </div>
            @endif
            <form class="form-horizontal" method="post" action="{{ urlWithQuery() }}" enctype="multipart/form-data">
                {{ csrf_field() }}
                <input type="hidden" name="id" value="{{ $entity->id }}">

                @yield('form_fields')

            </form>
        </div>
    </div>
</div>
@endsection