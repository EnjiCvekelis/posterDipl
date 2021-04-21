@extends('admin._layouts.base')

@section('content')
    <div class="breadcrumbs">
        @foreach($breadcrumbs as $breadcrumb)
            <a @if(isset($breadcrumb['current'])) class="active" @endif href="{{$breadcrumb['href']}}">{{$breadcrumb['name']}} </a>
            <span class="breadcrumbs-separator">
                <svg
                        xmlns="http://www.w3.org/2000/svg"
                        xmlns:xlink="http://www.w3.org/1999/xlink"
                        width="6px" height="10px">
                <path fill-rule="evenodd" fill="rgb(173, 181, 189)"
                      d="M0.159,4.849 L4.246,8.898 C4.426,9.075 4.717,9.075 4.897,8.898 C5.076,8.721 5.076,8.433 4.897,8.256 L1.133,4.528 L4.896,0.801 C5.075,0.624 5.075,0.336 4.896,0.158 C4.717,-0.019 4.425,-0.019 4.246,0.158 L0.158,4.207 C-0.018,4.382 -0.018,4.675 0.159,4.849 Z"/>
                </svg>
            </span>
        @endforeach
    </div>
    <div class="content-panel content-main">
    </div>
@endsection