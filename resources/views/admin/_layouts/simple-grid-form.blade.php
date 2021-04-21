@extends('admin._layouts.base')

@section('content')
<div id="@yield('form_page_id')" class="container-fluid">
    <div class="row">
        <div class="col-md-12 page-title">
            <h4 class="text-center">@yield('form_header')</h4>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <ul class="breadcrumb">
                <li><a href="{{ route('admin.home') }}">PANEL</a>/</li>
                <li class="active">@yield('form_grid_url_caption')</li>
            </ul>
        </div>
    </div>
    <div class="row search">
        <div class="col-md-4 search-wrap">
            <i id="btn-search" class="fa fa-search" aria-hidden="true"></i>
            <input type="text" class="form-control" id="search-single" data-url="@yield('form_grid_search_url')" value="{{ $query or '' }}" placeholder="Search">
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover">
                    <thead>
                    <tr>
                        @yield('form_grid_table_header')
                    </tr>
                    </thead>
                    <tbody>
                        @yield('form_grid_table_data_rows')
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="pagination-row">
                {{ $gridItems->links() }}
            </div>
        </div>
    </div>
</div>
@endsection