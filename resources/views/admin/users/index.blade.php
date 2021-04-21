@extends('admin._layouts.grid-form')

@section('form_page_id'){{ 'admin-portfolio-grid' }}@endsection
@section('form_header') Users @endsection
@section('form_grid_search_url'){{ route('admin.users') }}@endsection
@section('form_grid_add_url'){{ routeWithQuery('admin.users.add') }}@endsection

@section('form_grid_table_header')

    <th class="text-center">Name</th>
    <th class="text-center">Email</th>
    <th class="text-center" colspan="2">Actions</th>

@endsection

@section('form_grid_table_data_rows')

    @foreach($gridItems as $gridItem)
        <tr>
            <td>{{ $gridItem->name }}</td>
            <td>{{ $gridItem->email }}</td>
            @include('admin._components.grid_action_buttons', ['thRouteActionKey' => 'users'])
        </tr>
    @endforeach

@endsection