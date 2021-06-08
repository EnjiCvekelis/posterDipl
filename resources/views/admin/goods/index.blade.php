@extends('admin._layouts.grid-form')

@section('form_page_id'){{ 'admin-portfolio-grid' }}@endsection
@section('form_header') Товары @endsection
@section('form_grid_search_url'){{ route('admin.goods') }}@endsection
@section('form_grid_add_url'){{ routeWithQuery('admin.goods.add') }}@endsection
{{--@section('form_grid_json_url'){{ route('admin.locales.json') }}@endsection--}}

@section('form_grid_table_header')

    <th class="text-center">Название</th>
    <th class="text-center">Производитель</th>
    <th class="text-center">Импортер</th>
    <th class="text-center" colspan="2">Действия</th>

@endsection

@section('form_grid_table_data_rows')

    @foreach($gridItems as $gridItem)
        <tr>
            <td>{{ $gridItem->name }}</td>
            <td>{{ $gridItem->manufacturer }}</td>
            <td>{{ $gridItem->importer }}</td>
            @include('admin._components.grid_action_buttons', ['thRouteActionKey' => 'goods'])
        </tr>
    @endforeach

@endsection