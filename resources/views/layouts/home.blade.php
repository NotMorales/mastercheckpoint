<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
		<base href="">
		<meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Check Point</title>
        <meta name="description" content="Updates and statistics">

        <link rel="shortcut icon" href="{{asset('css/logo.svg')}}" />

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

		<!--begin::Fonts -->
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700|Roboto:300,400,500,600,700">

		<!--end::Fonts -->

		<link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css" >

		<!--end::Layout Skins -->
        <script src="{{ asset('js/app.js') }}"></script>

        {{-- LOGIN --}}
        <link href="{{ asset('css/login-6.css') }}" rel="stylesheet" type="text/css" />
        <!-- DataTable -->
        <link href="{{ asset('css/jquery.dataTables.css') }}" rel="stylesheet">
        <script src="{{ asset('js/jquery.dataTables.js') }}" defer></script>

        <script src="{{ asset('js/datatable.js') }}" defer></script>
	</head>
<body class="kt-quick-panel--right kt-demo-panel--right kt-offcanvas-panel--right kt-header--fixed kt-header-mobile--fixed kt-subheader--enabled kt-subheader--fixed kt-subheader--solid kt-aside--enabled kt-aside--fixed kt-page--loading">
    <div id="app">
        <main class="py-4">
            <div id="kt_header_mobile" class="kt-header-mobile  kt-header-mobile--fixed ">
                <div class="kt-header-mobile__logo">
                    <a href="{{route('inicio')}}">
                        <img alt="Logo" src="{{ asset('assets/media/logos/logo.svg') }}" width="135" />
                    </a>
                </div>
                <div class="kt-header-mobile__toolbar">
                    <button class="kt-header-mobile__toggler kt-header-mobile__toggler--left" id="kt_aside_mobile_toggler"><span></span></button>

                    <button class="kt-header-mobile__topbar-toggler" id="kt_header_mobile_topbar_toggler"><i class="flaticon-more"></i></button>
                </div>
            </div>

            <!-- end:: Header Mobile -->
            <div class="kt-grid kt-grid--hor kt-grid--root">
                <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--ver kt-page">

                    <!-- begin:: Aside -->

                    <!-- Uncomment this to display the close button of the panel
            <button class="kt-aside-close " id="kt_aside_close_btn"><i class="la la-close"></i></button>
            -->
                    <div class="kt-aside  kt-aside--fixed  kt-grid__item kt-grid kt-grid--desktop kt-grid--hor-desktop" id="kt_aside">

                        <!-- begin:: Aside -->
                        <div class="kt-aside__brand kt-grid__item " id="kt_aside_brand">
                            <div class="kt-aside__brand-logo">
                                <a href="{{route('inicio')}}">
                                    <img alt="Logo" src="{{ asset('assets/media/logos/logo.svg') }}" width="150"/>
                                </a>
                            </div>
                            <div class="kt-aside__brand-tools">
                                <button class="kt-aside__brand-aside-toggler" id="kt_aside_toggler">
                                    <span><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <polygon points="0 0 24 0 24 24 0 24" />
                                                <path d="M5.29288961,6.70710318 C4.90236532,6.31657888 4.90236532,5.68341391 5.29288961,5.29288961 C5.68341391,4.90236532 6.31657888,4.90236532 6.70710318,5.29288961 L12.7071032,11.2928896 C13.0856821,11.6714686 13.0989277,12.281055 12.7371505,12.675721 L7.23715054,18.675721 C6.86395813,19.08284 6.23139076,19.1103429 5.82427177,18.7371505 C5.41715278,18.3639581 5.38964985,17.7313908 5.76284226,17.3242718 L10.6158586,12.0300721 L5.29288961,6.70710318 Z" fill="#000000" fill-rule="nonzero" transform="translate(8.999997, 11.999999) scale(-1, 1) translate(-8.999997, -11.999999) " />
                                                <path d="M10.7071009,15.7071068 C10.3165766,16.0976311 9.68341162,16.0976311 9.29288733,15.7071068 C8.90236304,15.3165825 8.90236304,14.6834175 9.29288733,14.2928932 L15.2928873,8.29289322 C15.6714663,7.91431428 16.2810527,7.90106866 16.6757187,8.26284586 L22.6757187,13.7628459 C23.0828377,14.1360383 23.1103407,14.7686056 22.7371482,15.1757246 C22.3639558,15.5828436 21.7313885,15.6103465 21.3242695,15.2371541 L16.0300699,10.3841378 L10.7071009,15.7071068 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" transform="translate(15.999997, 11.999999) scale(-1, 1) rotate(-270.000000) translate(-15.999997, -11.999999) " />
                                            </g>
                                        </svg></span>
                                    <span><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <polygon points="0 0 24 0 24 24 0 24" />
                                                <path d="M12.2928955,6.70710318 C11.9023712,6.31657888 11.9023712,5.68341391 12.2928955,5.29288961 C12.6834198,4.90236532 13.3165848,4.90236532 13.7071091,5.29288961 L19.7071091,11.2928896 C20.085688,11.6714686 20.0989336,12.281055 19.7371564,12.675721 L14.2371564,18.675721 C13.863964,19.08284 13.2313966,19.1103429 12.8242777,18.7371505 C12.4171587,18.3639581 12.3896557,17.7313908 12.7628481,17.3242718 L17.6158645,12.0300721 L12.2928955,6.70710318 Z" fill="#000000" fill-rule="nonzero" />
                                                <path d="M3.70710678,15.7071068 C3.31658249,16.0976311 2.68341751,16.0976311 2.29289322,15.7071068 C1.90236893,15.3165825 1.90236893,14.6834175 2.29289322,14.2928932 L8.29289322,8.29289322 C8.67147216,7.91431428 9.28105859,7.90106866 9.67572463,8.26284586 L15.6757246,13.7628459 C16.0828436,14.1360383 16.1103465,14.7686056 15.7371541,15.1757246 C15.3639617,15.5828436 14.7313944,15.6103465 14.3242754,15.2371541 L9.03007575,10.3841378 L3.70710678,15.7071068 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" transform="translate(9.000003, 11.999999) rotate(-270.000000) translate(-9.000003, -11.999999) " />
                                            </g>
                                        </svg></span>
                                </button>

                                <!--
                <button class="kt-aside__brand-aside-toggler kt-aside__brand-aside-toggler--left" id="kt_aside_toggler"><span></span></button>
                -->
                            </div>
                        </div>

                        <!-- end:: Aside -->

                        <!-- begin:: Aside Menu -->
                        @include('includes.navDerecho')
                        <!-- end:: Aside Menu -->
                    </div>

                    <!-- end:: Aside -->
                    <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor kt-wrapper" id="kt_wrapper">

                        <!-- begin:: Header -->
                        @include('includes.header')
                        <!-- end:: Header -->

                        @yield('content')

                        <!-- begin:: Footer -->
                        @include('includes.footer')
                        <!-- end:: Footer -->
                    </div>
                </div>
            </div>

            <!-- end:: Page -->

            <!-- begin::Quick Panel -->
            <div id="kt_quick_panel" class="kt-quick-panel">
                <a href="#" class="kt-quick-panel__close" id="kt_quick_panel_close_btn"><i class="flaticon2-delete"></i></a>
                <div class="kt-quick-panel__nav">
                    <ul class="nav nav-tabs nav-tabs-line nav-tabs-bold nav-tabs-line-3x nav-tabs-line-brand  kt-notification-item-padding-x" role="tablist">
                        <li class="nav-item active">
                            <a class="nav-link active" data-toggle="tab" href="#kt_quick_panel_tab_notifications" role="tab">Notificationes</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#kt_quick_panel_tab_logs" role="tab">Mensajes</a>
                        </li>
                    </ul>
                </div>
                <div class="kt-quick-panel__content">
                    <div class="tab-content">
                        <div class="tab-pane fade show kt-scroll active" id="kt_quick_panel_tab_notifications" role="tabpanel">
                            <div class="kt-notification">
                                @php
                                    $notificaciones = App\notificacion::where('userId', Auth::user()->userId)->orderBy('fecha', 'desc')->get();
                                @endphp
                                @foreach ($notificaciones as $notifi)
                                    <a href="#" class="kt-notification__item">
                                        <div class="kt-notification__item-icon">
                                            <i class="@if ($notifi->estado == 0)
                                                flaticon-bell kt-font-danger
                                            @else
                                                flaticon-alarm kt-font-success
                                            @endif"></i>
                                        </div>
                                        <div class="kt-notification__item-details">
                                            <div class="kt-notification__item-title">
                                                {{$notifi->notificacion}}
                                            </div>
                                            <div class="kt-notification__item-time">
                                                {{$notifi->fecha}}
                                            </div>
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                        <div class="tab-pane fade kt-scroll" id="kt_quick_panel_tab_logs" role="tabpanel">
                            <div class="kt-notification-v2">

                                @php
                                    $Mensajes = App\mensaje::where('userId', Auth::user()->userId)->orderBy('fecha', 'desc')->get();
                                @endphp
                                @foreach ($Mensajes as $msn)
                                    <a href="#" class="kt-notification-v2__item">
                                        <div class="kt-notification-v2__item-icon">
                                            <i class="@if ($msn->estado == 0)
                                                flaticon-multimedia kt-font-danger
                                            @else
                                                flaticon-envelope kt-font-success
                                            @endif"></i>
                                        </div>
                                        <div class="kt-notification-v2__item-details">
                                            <div class="kt-notification-v2__item-title">
                                                {{$msn->titulo}}
                                            </div>
                                            <div class="kt-notification-v2__item-time">
                                                {{$msn->fecha}}
                                            </div>
                                        </div>
                                    </a>
                                @endforeach

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- end::Quick Panel -->

            <!-- begin::Scrolltop -->
            <div id="kt_scrolltop" class="kt-scrolltop">
                <i class="fa fa-arrow-up"></i>
            </div>

            <!-- end::Scrolltop -->


            <!-- begin::Global Config(global config for global JS sciprts) -->
            <script>
                var KTAppOptions = {
                    "colors": {
                        "state": {
                            "brand": "#5d78ff",
                            "dark": "#282a3c",
                            "light": "#ffffff",
                            "primary": "#5867dd",
                            "success": "#34bfa3",
                            "info": "#36a3f7",
                            "warning": "#ffb822",
                            "danger": "#fd3995"
                        },
                        "base": {
                            "label": [
                                "#c5cbe3",
                                "#a1a8c3",
                                "#3d4465",
                                "#3e4466"
                            ],
                            "shape": [
                                "#f0f3ff",
                                "#d9dffa",
                                "#afb4d4",
                                "#140138"
                                // "#646c9a"
                            ]
                        }
                    }
                };
            </script>

            <!-- end::Global Config -->

            <!--begin::Global Theme Bundle(used by all pages) -->
            <script src="{{ asset('assets/plugins/global/plugins.bundle.js')}}" type="text/javascript"></script>
            <script src="{{ asset('assets/js/scripts.bundle.js')}}" type="text/javascript"></script>

            <!--end::Global Theme Bundle -->

            <!--begin::Page Vendors(used by this page) -->
            <script src="{{ asset('assets/plugins/custom/fullcalendar/fullcalendar.bundle.js')}}" type="text/javascript"></script>
            <script src="//maps.google.com/maps/api/js?key=AIzaSyBTGnKT7dt597vo9QgeQ7BFhvSRP4eiMSM" type="text/javascript"></script>
            <script src="{{ asset('assets/plugins/custom/gmaps/gmaps.js')}}" type="text/javascript"></script>

            <!--end::Page Vendors -->

            <!--begin::Page Scripts(used by this page) -->
            <script src="{{ asset('assets/js/pages/dashboard.js')}}" type="text/javascript"></script>

        </main>
    </div>
</body>
</html>
