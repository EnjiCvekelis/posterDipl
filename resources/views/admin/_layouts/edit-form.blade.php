@extends('admin._layouts.base')

@section('content')
    <div class="breadcrumbs">
        {{--        @foreach($breadcrumbs as $breadcrumb)--}}
        {{--            <a @if(isset($breadcrumb['current'])) class="active" @endif href="{{$breadcrumb['href']}}">{{$breadcrumb['name']}} </a>--}}
        {{--            <span class="breadcrumbs-separator">--}}
        {{--                <svg--}}
        {{--                        xmlns="http://www.w3.org/2000/svg"--}}
        {{--                        xmlns:xlink="http://www.w3.org/1999/xlink"--}}
        {{--                        width="6px" height="10px">--}}
        {{--                <path fill-rule="evenodd" fill="rgb(173, 181, 189)"--}}
        {{--                      d="M0.159,4.849 L4.246,8.898 C4.426,9.075 4.717,9.075 4.897,8.898 C5.076,8.721 5.076,8.433 4.897,8.256 L1.133,4.528 L4.896,0.801 C5.075,0.624 5.075,0.336 4.896,0.158 C4.717,-0.019 4.425,-0.019 4.246,0.158 L0.158,4.207 C-0.018,4.382 -0.018,4.675 0.159,4.849 Z"/>--}}
        {{--                </svg>--}}
        {{--            </span>--}}
        {{--        @endforeach--}}
    </div>
    <div class="content-panel content-form">
        <div class="col-md-12 page-title">
            <h4 class="text-center text-uppercase">{{ empty($entity->id) ? 'СОЗДАТЬ' : 'РЕДАКТИРОВАТЬ' }} @yield('form_header')</h4>
        </div>
        <div class="col-md-12">
            @if (count($errors) > 0)
                <div class="errors-wrap">
                    <div class="icon">
                        <svg
                                xmlns="http://www.w3.org/2000/svg"
                                xmlns:xlink="http://www.w3.org/1999/xlink"
                                width="31px" height="30px">
                            <path fill-rule="evenodd"  fill="rgb(255, 255, 255)"
                                  d="M25.611,4.389 C19.758,-1.463 10.240,-1.463 4.387,4.389 C-1.463,10.240 -1.463,19.761 4.387,25.613 C7.314,28.538 11.157,30.000 15.000,30.000 C18.843,30.000 22.685,28.538 25.611,25.613 C31.463,19.761 31.463,10.240 25.611,4.389 ZM21.189,19.422 C21.678,19.911 21.678,20.702 21.189,21.191 C20.945,21.434 20.625,21.557 20.305,21.557 C19.985,21.557 19.665,21.434 19.421,21.191 L15.000,16.768 L10.580,21.189 C10.335,21.433 10.015,21.556 9.696,21.556 C9.376,21.556 9.056,21.433 8.812,21.189 C8.323,20.700 8.323,19.909 8.812,19.421 L13.232,15.000 L8.811,10.579 C8.322,10.090 8.322,9.299 8.811,8.811 C9.298,8.322 10.090,8.322 10.579,8.811 L15.000,13.232 L19.421,8.811 C19.910,8.322 20.700,8.322 21.189,8.811 C21.678,9.299 21.678,10.090 21.189,10.579 L16.768,15.000 L21.189,19.422 Z"/>
                        </svg>
                    </div>
                    <div class="alert alert-danger">
                        <b>Errors:</b>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>

            @elseif(!empty($success))
                <div class="succes-wrap">
                    <div class="icon">
                        <svg
                                xmlns="http://www.w3.org/2000/svg"
                                xmlns:xlink="http://www.w3.org/1999/xlink"
                                width="30px" height="30px">
                            <path fill-rule="evenodd"  fill="rgb(255, 255, 255)"
                                  d="M15.000,-0.000 C6.729,-0.000 -0.000,6.729 -0.000,15.000 C-0.000,23.270 6.729,30.000 15.000,30.000 C23.271,30.000 30.000,23.270 30.000,15.000 C30.000,6.729 23.271,-0.000 15.000,-0.000 ZM23.383,11.053 L13.797,20.564 C13.233,21.128 12.331,21.165 11.729,20.601 L6.654,15.977 C6.053,15.413 6.015,14.473 6.541,13.872 C7.105,13.270 8.045,13.233 8.646,13.797 L12.669,17.481 L21.240,8.910 C21.842,8.308 22.782,8.308 23.383,8.910 C23.985,9.511 23.985,10.451 23.383,11.053 Z"/>
                        </svg>
                    </div>
                    <div class="alert alert-success">
                        <b>Data saved successfully!</b>
{{--                        (<a href="{{ $returnToListUrl }}">Return to the list</a>)--}}
                    </div>
                </div>
            @endif
            <form class="form-horizontal" method="post" action="{{ urlWithQuery() }}" enctype="multipart/form-data">
                {{ csrf_field() }}
                <input type="hidden" name="id" value="{{ $entity->id }}">

                @yield('form_fields')

            </form>
        </div>
    </div>
    <div id="@yield('form_page_id')" class="container-fluid">
        <div class="row">

        </div>
    </div>
@endsection