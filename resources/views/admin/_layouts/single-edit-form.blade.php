@extends('admin._layouts.base')

@section('content')
<div id="@yield('form_page_id')" class="container-fluid">
    <div class="row">
        <div class="col-md-12 page-title">
            <h4 class="text-center text-uppercase">@yield('form_header')</h4>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <ul class="breadcrumb">
                <li><a href="{{ route('admin.home') }}">Panel</a>/</li>
                <li class="active">@yield('form_header')</li>
            </ul>
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
                    <b>Data saved successfully!</b>
                </div>
            @endif
            <form class="form-horizontal" method="post" action="{{ urlWithQuery() }}" enctype="multipart/form-data">
                {{ csrf_field() }}
                <input type="hidden" name="id" value="{{ $entity->id }}">

                @yield('form_fields')

                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection