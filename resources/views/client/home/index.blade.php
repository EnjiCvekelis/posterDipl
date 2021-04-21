@extends('client._layouts.base')

@section('js')
@endsection

@section('css')
@endsection


@section('content')
    <div class="container">
        <div class="feed owl-carousel">
            @foreach($feed as $item)
                <div class="feed-item" style="background: url({{assetImage($item->icon_image)}}) no-repeat center; background-size: cover;">

                </div>
            @endforeach
        </div>
    </div>
@endsection
