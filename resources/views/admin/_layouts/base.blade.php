<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AMOOLET | ADMIN </title>

    <link href="{{ mix('/css/admin/vendor.css') }}" type="text/css" rel="stylesheet"/>
    <link href="{{ mix('/css/admin/app.css') }}" type="text/css" rel="stylesheet"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.3.1/themes/default/style.min.css">

    <script src="{{ mix('/js/admin/vendor.js') }}"></script>
    <script src="{{ mix('/js/admin/app.js') }}"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.3.4/jstree.min.js"></script>
    <link rel="shortcut icon" href="/images/favicon.png?v=1" type="image/png">
</head>
<body class="fixed-nav bg-dark" id="page-top">
<!-- Navigation-->
<nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav">
    <a class="navbar-brand" href="{{ route('admin.home') }}">
        <svg
                xmlns="http://www.w3.org/2000/svg"
                xmlns:xlink="http://www.w3.org/1999/xlink"
                width="24px" height="24px">
            <path fill-rule="evenodd" fill="#F1D8C1"
                  d="M21.890,24.000 L2.109,24.000 C0.945,24.000 -0.001,23.053 -0.001,21.890 L-0.001,7.031 L24.000,7.031 L24.000,21.890 C24.000,23.053 23.053,24.000 21.890,24.000 ZM14.109,12.000 C14.109,11.611 13.794,11.297 13.405,11.297 C13.181,11.297 3.811,11.297 3.515,11.297 C3.127,11.297 2.812,11.611 2.812,12.000 C2.812,12.000 2.812,20.284 2.812,20.437 C2.812,20.826 3.127,21.140 3.515,21.140 C3.515,21.140 18.863,21.140 19.030,21.140 C19.419,21.140 19.734,20.826 19.734,20.437 C19.734,20.254 19.734,14.959 19.734,14.812 C19.734,14.424 19.419,14.109 19.030,14.109 L14.109,14.109 L14.109,12.000 ZM21.140,9.187 C21.140,8.798 20.826,8.484 20.437,8.484 L16.218,8.484 C15.830,8.484 15.515,8.798 15.515,9.187 L15.515,12.000 C15.515,12.388 15.830,12.703 16.218,12.703 L20.437,12.703 C20.826,12.703 21.140,12.388 21.140,12.000 L21.140,9.187 ZM16.921,9.890 L19.734,9.890 L19.734,11.297 L16.921,11.297 L16.921,9.890 ZM14.109,18.328 L18.328,18.328 L18.328,19.734 L14.109,19.734 L14.109,18.328 ZM12.703,15.515 C12.962,15.515 17.822,15.515 18.328,15.515 L18.328,16.922 C18.079,16.922 13.014,16.922 12.703,16.922 L12.703,15.515 ZM8.484,12.703 L12.703,12.703 L12.703,14.109 L8.484,14.109 L8.484,12.703 ZM4.218,12.703 L7.077,12.703 L7.077,14.109 L4.218,14.109 L4.218,12.703 ZM11.296,16.922 C10.895,16.922 4.431,16.922 4.218,16.922 L4.218,15.515 C4.620,15.515 11.083,15.515 11.296,15.515 L11.296,16.922 ZM7.077,19.734 L4.218,19.734 L4.218,18.328 L7.077,18.328 L7.077,19.734 ZM12.703,19.734 L8.484,19.734 L8.484,18.328 C8.665,18.328 12.234,18.328 12.703,18.328 L12.703,19.734 ZM18.328,-0.000 L21.890,-0.000 C23.053,-0.000 24.000,0.946 24.000,2.109 L24.000,5.625 L18.328,5.625 L18.328,-0.000 ZM-0.001,2.109 C-0.001,0.946 0.945,-0.000 2.109,-0.000 L16.921,-0.000 L16.921,5.625 L-0.001,5.625 L-0.001,2.109 ZM12.000,4.218 L13.405,4.218 C13.794,4.218 14.109,3.904 14.109,3.515 C14.109,3.127 13.794,2.812 13.405,2.812 L12.000,2.812 C11.610,2.812 11.296,3.127 11.296,3.515 C11.296,3.904 11.610,4.218 12.000,4.218 ZM7.781,4.218 L9.187,4.218 C9.576,4.218 9.890,3.904 9.890,3.515 C9.890,3.127 9.576,2.812 9.187,2.812 L7.781,2.812 C7.392,2.812 7.077,3.127 7.077,3.515 C7.077,3.904 7.392,4.218 7.781,4.218 ZM3.515,4.218 L4.921,4.218 C5.310,4.218 5.624,3.904 5.624,3.515 C5.624,3.127 5.310,2.812 4.921,2.812 L3.515,2.812 C3.127,2.812 2.812,3.127 2.812,3.515 C2.812,3.904 3.127,4.218 3.515,4.218 Z"/>
        </svg>
        <span>Poster</span>
    </a>
    <button class="navbar-toggler navbar-toggler-left" type="button" data-toggle="collapse"
            data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false"
            aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse navbar-top">
        <ul class="navbar-nav navbar-sidenav">
            <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Пользователи">
                <a class="nav-link" href="{{ route('admin.users') }}">
                    <i class="fas fa-users"></i>
                    <span class="nav-link-category">Пользователи</span>
                </a>
            </li>
            <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Товары">
                <a class="nav-link" href="{{ route('admin.goods') }}">
                    <i class="fas fa-users"></i>
                    <span class="nav-link-category">Товары</span>
                </a>
            </li>
            <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Поставки">
                <a class="nav-link" href="{{ route('admin.deliveries') }}">
                    <i class="fas fa-users"></i>
                    <span class="nav-link-category">Поставки</span>
                </a>
            </li>
            <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Остатки">
                <a class="nav-link" href="{{ route('admin.remains') }}">
                    <i class="fas fa-users"></i>
                    <span class="nav-link-category">Остатки</span>
                </a>
            </li>
        </ul>
        <ul class="navbar-nav sidenav-toggler">
            <li class="nav-item">
                <a id="sidenavToggler" class="nav-link text-center">
                    <i class="fa fa-fw fa-angle-right"></i>
                </a>
            </li>
        </ul>

        <div class="navbar-panel">
            <div class="navbar-panel__humburger">
                <svg
                        xmlns="http://www.w3.org/2000/svg"
                        xmlns:xlink="http://www.w3.org/1999/xlink"
                        width="30px" height="24px">
                    <path fill-rule="evenodd" fill="#F1D8C1"
                          d="M28.827,11.666 L1.171,11.666 C0.524,11.666 -0.000,11.144 -0.000,10.500 C-0.000,9.855 0.524,9.333 1.171,9.333 L28.827,9.333 C29.475,9.333 29.999,9.855 29.999,10.500 C29.999,11.144 29.475,11.666 28.827,11.666 ZM28.827,2.333 L1.171,2.333 C0.524,2.333 -0.000,1.811 -0.000,1.166 C-0.000,0.522 0.524,-0.000 1.171,-0.000 L28.827,-0.000 C29.475,-0.000 29.999,0.522 29.999,1.166 C29.999,1.811 29.475,2.333 28.827,2.333 ZM1.171,18.666 L28.827,18.666 C29.475,18.666 29.999,19.189 29.999,19.833 C29.999,20.477 29.475,21.000 28.827,21.000 L1.171,21.000 C0.524,21.000 -0.000,20.477 -0.000,19.833 C-0.000,19.189 0.524,18.666 1.171,18.666 Z"/>
                </svg>
            </div>
        </div>

        <ul class="navbar-nav navbar-exit">
            <li class="nav-item">
                <p class="nav-username">
                    {{{ isset(Auth::user()->name) ? Auth::user()->name : Auth::user()->email }}}
                </p>
            </li>
            <li class="nav-item">
                <a class="nav-link nav-exit" href="{{ route('admin.logout') }}">
                    <svg
                            xmlns="http://www.w3.org/2000/svg"
                            xmlns:xlink="http://www.w3.org/1999/xlink"
                            width="20px" height="20px">
                        <path fill-rule="evenodd" fill="#F1D8C1"
                              d="M12.563,15.000 C10.089,15.000 7.784,13.764 6.397,11.694 C6.116,11.274 6.226,10.704 6.641,10.421 C7.058,10.137 7.622,10.247 7.904,10.667 C8.952,12.232 10.694,13.166 12.563,13.166 C15.661,13.166 18.181,10.624 18.181,7.500 C18.181,4.375 15.661,1.833 12.563,1.833 C10.688,1.833 8.943,2.772 7.896,4.343 C7.616,4.764 7.051,4.875 6.635,4.593 C6.218,4.311 6.107,3.741 6.387,3.321 C7.773,1.241 10.081,-0.000 12.563,-0.000 C16.663,-0.000 19.999,3.364 19.999,7.500 C19.999,11.635 16.663,15.000 12.563,15.000 ZM3.103,6.583 L13.636,6.583 C14.138,6.583 14.545,6.993 14.545,7.500 C14.545,8.006 14.138,8.416 13.636,8.416 L3.103,8.416 L4.279,9.602 C4.634,9.960 4.634,10.540 4.279,10.899 C4.101,11.078 3.869,11.167 3.636,11.167 C3.403,11.167 3.170,11.078 2.993,10.899 L0.266,8.148 C0.245,8.127 0.225,8.105 0.206,8.082 C0.202,8.076 0.198,8.070 0.193,8.064 C0.179,8.046 0.166,8.028 0.153,8.009 C0.149,8.004 0.146,7.998 0.143,7.993 C0.130,7.973 0.118,7.953 0.107,7.932 C0.105,7.928 0.103,7.924 0.101,7.920 C0.089,7.898 0.079,7.875 0.069,7.851 C0.068,7.848 0.067,7.846 0.066,7.843 C0.056,7.818 0.047,7.793 0.039,7.767 C0.038,7.764 0.038,7.761 0.036,7.758 C0.029,7.732 0.023,7.707 0.017,7.680 C0.016,7.673 0.015,7.665 0.014,7.657 C0.010,7.635 0.006,7.614 0.004,7.591 C0.001,7.561 -0.000,7.530 -0.000,7.500 C-0.000,7.469 0.001,7.438 0.004,7.408 C0.006,7.386 0.010,7.364 0.014,7.343 C0.015,7.335 0.016,7.327 0.017,7.319 C0.022,7.293 0.029,7.268 0.036,7.242 C0.038,7.239 0.038,7.236 0.039,7.233 C0.047,7.207 0.056,7.182 0.066,7.157 C0.067,7.154 0.068,7.151 0.069,7.148 C0.079,7.125 0.089,7.102 0.101,7.079 C0.103,7.075 0.105,7.071 0.107,7.067 C0.118,7.046 0.130,7.026 0.143,7.007 C0.146,7.001 0.149,6.996 0.153,6.990 C0.166,6.971 0.179,6.953 0.193,6.935 C0.198,6.930 0.202,6.924 0.206,6.918 C0.225,6.895 0.245,6.872 0.266,6.851 L2.993,4.101 C3.348,3.743 3.924,3.743 4.279,4.101 C4.634,4.459 4.634,5.039 4.279,5.397 L3.103,6.583 Z"/>
                    </svg>
                </a>
            </li>
        </ul>
    </div>
</nav>
<div class="content-wrapper">
    <div id="content-panel content-main">
        @yield('content')
    </div>
</div>
<footer>
</footer>

<div id="delete-confirm-dialog" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Delete</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete?</p>
            </div>
            <div class="modal-footer">
                <a id="delete-item" href="#" type="button" class="btn btn-default"><span class="btn-confirm">Yes</span></a>
                <button type="button" class="btn btn-default" data-dismiss="modal"><span class="btn-cancel">No</span>
                </button>
            </div>
        </div>
    </div>
</div>
</body>
</html>
