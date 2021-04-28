@extends('admin._layouts.grid-form')

@section('form_page_id'){{ 'admin-portfolio-grid' }}@endsection
@section('form_header') Поставки @endsection
@section('form_grid_search_url'){{ route('admin.deliveries') }}@endsection
@section('form_grid_add_url'){{ routeWithQuery('admin.deliveries.add') }}@endsection
{{--@section('form_grid_json_url'){{ route('admin.locales.json') }}@endsection--}}

@section('form_grid_table_header')

    {{--    <th class="text-center">ID</th>--}}
    <th class="text-center">Наименование</th>
    <th class="text-center">Количество</th>
    <th class="text-center">Цена за единицу</th>
    <th class="text-center">Сумма</th>
    <th class="text-center">Склад</th>
    <th class="text-center" colspan="2"></th>

@endsection

@section('form_grid_table_data_rows')

    @foreach($deliveries as $gridItem)
        <tr>
            <td>{{ $gridItem->goods->name }}</td>
            <td>{{ $gridItem->amount }}</td>
            <td>{{ $gridItem->price }}</td>
            <td>{{ $gridItem->total }}</td>
            <td>
                @if($gridItem->storage == 1)
                    Склад 1
                @else
                    Склад 2
                @endif
            </td>
            @include('admin._components.grid_action_buttons', ['thRouteActionKey' => 'deliveries'])
        </tr>
    @endforeach

@endsection