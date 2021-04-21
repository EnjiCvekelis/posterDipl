@extends('admin._layouts.grid-form')

@section('form_page_id'){{ 'admin-portfolio-grid' }}@endsection
@section('form_header') Locales @endsection
@section('form_grid_search_url'){{ route('admin.locales') }}@endsection
@section('form_grid_add_url'){{ routeWithQuery('admin.locales.add') }}@endsection
{{--@section('form_grid_json_url'){{ route('admin.locales.json') }}@endsection--}}

@section('form_grid_table_header')

    <th class="text-center">ID</th>
    <th class="text-center">Locale</th>
    <th class="text-center" colspan="2">Actions</th>

@endsection

@section('form_grid_table_data_rows')

    @foreach($gridItems as $gridItem)
        <tr>
            <td>{{ $gridItem->id }}</td>
            <td>{{ $gridItem->language }}</td>
            @include('admin._components.grid_action_buttons', ['thRouteActionKey' => 'locales'])
        </tr>
    @endforeach

@endsection