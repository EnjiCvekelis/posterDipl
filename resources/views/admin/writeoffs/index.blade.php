@extends('admin._layouts.grid-form')

@section('form_page_id'){{ 'admin-portfolio-grid' }}@endsection
@section('form_header') Списания @endsection
@section('form_grid_search_url'){{ route('admin.writeoffs') }}@endsection
@section('form_grid_add_url'){{ routeWithQuery('admin.writeoffs.add') }}@endsection
{{--@section('form_grid_json_url'){{ route('admin.locales.json') }}@endsection--}}

@section('form_grid_table_header')

    {{--    <th class="text-center">ID</th>--}}
    <th class="text-center">Наименование</th>
    <th class="text-center">Количество</th>
    <th class="text-center">Цена за единицу</th>
    <th class="text-center">Сумма</th>
    <th class="text-center" colspan="2"></th>

@endsection

@section('form_grid_table_data_rows')

    @foreach($writeoffs as $gridItem)
        <tr>
            <td>{{ $gridItem->goods->name }}</td>
            <td>{{ $gridItem->amount }}</td>
            <td>{{ $gridItem->price }}</td>
            <td>{{ $gridItem->total }}</td>
            @include('admin._components.grid_action_buttons', ['thRouteActionKey' => 'writeoffs'])
        </tr>
    @endforeach

@endsection