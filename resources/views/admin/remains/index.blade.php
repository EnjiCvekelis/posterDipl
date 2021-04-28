@extends('admin._layouts.grid-form')

@section('form_page_id'){{ 'admin-portfolio-grid' }}@endsection
@section('form_header') Остатки @endsection
@section('form_grid_search_url'){{ route('admin.deliveries') }}@endsection
{{--@section('form_grid_add_url'){{ routeWithQuery('admin.deliveries.add') }}@endsection--}}
{{--@section('form_grid_json_url'){{ route('admin.locales.json') }}@endsection--}}

@section('form_grid_table_header')

    {{--    <th class="text-center">ID</th>--}}
    <th class="text-center">Наименование</th>
    <th class="text-center">Количество</th>
    <th class="text-center">Сумма</th>

@endsection

@section('form_grid_table_data_rows')

    @foreach($remains as $gridItem)
        <tr>
            <td>{{ $gridItem->name }}</td>
            <td>{{ $gridItem->amount }}</td>
            <td>{{ $gridItem->total }}</td>
        </tr>
    @endforeach

@endsection