<div id="kt_header" class="kt-header kt-grid__item  kt-header--fixed ">

    <!-- begin:: Header Menu -->

    <!-- Uncomment this to display the close button of the panel
<button class="kt-header-menu-wrapper-close" id="kt_header_menu_mobile_close_btn"><i class="la la-close"></i></button>
-->
    <div class="kt-header-menu-wrapper" id="kt_header_menu_wrapper">

    </div>

    <!-- end:: Header Menu -->

    <!-- begin:: Header Topbar -->
    <div class="kt-header__topbar">


        <!--begin: Quick panel toggler -->
        <div class="kt-header__topbar-item kt-header__topbar-item--quick-panel" data-toggle="kt-tooltip" title="Quick panel" data-placement="right">
            <span class="kt-header__topbar-icon" id="kt_quick_panel_toggler_btn">
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                        <rect x="0" y="0" width="24" height="24" />
                        <rect fill="#000000" x="4" y="4" width="7" height="7" rx="1.5" />
                        <path d="M5.5,13 L9.5,13 C10.3284271,13 11,13.6715729 11,14.5 L11,18.5 C11,19.3284271 10.3284271,20 9.5,20 L5.5,20 C4.67157288,20 4,19.3284271 4,18.5 L4,14.5 C4,13.6715729 4.67157288,13 5.5,13 Z M14.5,4 L18.5,4 C19.3284271,4 20,4.67157288 20,5.5 L20,9.5 C20,10.3284271 19.3284271,11 18.5,11 L14.5,11 C13.6715729,11 13,10.3284271 13,9.5 L13,5.5 C13,4.67157288 13.6715729,4 14.5,4 Z M14.5,13 L18.5,13 C19.3284271,13 20,13.6715729 20,14.5 L20,18.5 C20,19.3284271 19.3284271,20 18.5,20 L14.5,20 C13.6715729,20 13,19.3284271 13,18.5 L13,14.5 C13,13.6715729 13.6715729,13 14.5,13 Z" fill="#000000" opacity="0.3" />
                    </g>
                </svg> </span>
        </div>

        <!--end: Quick panel toggler -->


        <!--begin: User Bar -->
        <div class="kt-header__topbar-item kt-header__topbar-item--user">
            <div class="kt-header__topbar-wrapper" data-toggle="dropdown" data-offset="0px,0px">
                <div class="kt-header__topbar-user">
                    <span class="kt-header__topbar-welcome kt-hidden-mobile">Hola,</span>
                    <span class="kt-header__topbar-username kt-hidden-mobile">{{ Auth::user()->persona->nombre }} {{ Auth::user()->persona->apellidoPaterno }}</span>
                    <img class="" alt="Pic" src="@if(Auth::user()->avatar) {{route('user.avatar', ['filename' => Auth::user()->avatar  ])}} @else {{asset('assets/media/users/user.png')}} @endif" />

                    <!--use below badge element instead the user avatar to display username's first letter(remove kt-hidden class to display it) -->
                    {{-- <span class="kt-badge kt-badge--username kt-badge--unified-success kt-badge--lg kt-badge--rounded kt-badge--bold"></span> --}}
                </div>
            </div>
            <div class="dropdown-menu dropdown-menu-fit dropdown-menu-right dropdown-menu-anim dropdown-menu-top-unround dropdown-menu-xl">

                <!--begin: Head -->
                <div class="kt-user-card kt-user-card--skin-dark kt-notification-item-padding-x" style="background-image: url({{ asset('assets/media/misc/bg-1.jpg')}})">
                    <div class="kt-user-card__avatar">
                        <img class="" alt="Pic" src="@if(Auth::user()->avatar) {{route('user.avatar', ['filename' => Auth::user()->avatar  ])}} @else {{asset('assets/media/users/user.png')}} @endif" />

                        <!--use below badge element instead the user avatar to display username's first letter(remove kt-hidden class to display it) -->
                        {{-- <span class="kt-badge kt-badge--lg kt-badge--rounded kt-badge--bold kt-font-success">S</span> --}}
                    </div>
                    <div class="kt-user-card__name">
                        {{ Auth::user()->persona->nombre }} {{ Auth::user()->persona->apellidoPaterno }}
                    </div>

                </div>

                <!--end: Head -->

                <!--begin: Navigation -->
                <div class="kt-notification">
                    <a href="{{ route('miperfil')}}" class="kt-notification__item">
                        <div class="kt-notification__item-icon">
                            <i class="flaticon2-calendar-3 kt-font-success"></i>
                        </div>
                        <div class="kt-notification__item-details">
                            <div class="kt-notification__item-title kt-font-bold">
                                Mi perfil
                            </div>
                            <div class="kt-notification__item-time">
                                Configuraciones de cuenta
                            </div>
                        </div>
                    </a>
                    <a href="{{ route('mensajes', ['mensaje' => 0 ]) }}" class="kt-notification__item">
                        <div class="kt-notification__item-icon">
                            <i class="flaticon2-mail kt-font-warning"></i>
                        </div>
                        <div class="kt-notification__item-details">
                            @php
                                $mensajesNuevos  = 0;
                                $mensajesNuevos = App\mensaje::
                                    where([
                                        ['userId', Auth::user()->userId],
                                        ['estado', 0],])
                                    ->count();
                            @endphp
                            <div class="kt-notification__item-title kt-font-bold">
                                Mis mensajes @if ($mensajesNuevos > 0) <span class="kt-badge kt-badge--danger kt-badge--inline kt-badge--pill kt-badge--rounded">{{$mensajesNuevos}}</span>@endif
                            </div>
                            <div class="kt-notification__item-time">
                                Conversaciones y mensajes
                            </div>
                        </div>
                    </a>
                    <a href="{{ route('notificaciones', ['notificacion' => 0 ]) }}" class="kt-notification__item">
                        <div class="kt-notification__item-icon">
                            <i class="flaticon2-rocket-1 kt-font-danger"></i>
                        </div>
                        <div class="kt-notification__item-details">
                            @php
                                $notificacionesNuevos  = 0;
                                $notificacionesNuevos = App\notificacion::
                                    where([
                                        ['userId', Auth::user()->userId],
                                        ['estado', 0],])
                                    ->count();
                            @endphp
                            <div class="kt-notification__item-title kt-font-bold">
                                Mis notificaciones @if ($notificacionesNuevos > 0) <span class="kt-badge kt-badge--danger kt-badge--inline kt-badge--pill kt-badge--rounded">{{$notificacionesNuevos}}</span>@endif
                            </div>
                            <div class="kt-notification__item-time">
                                Todas las notificaciones
                            </div>
                        </div>
                    </a>

                    <div class="kt-notification__custom kt-space-between">
                        <a target="_blank" class="btn btn-label btn-label-brand btn-sm btn-bold" href="{{ route('logout') }}"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Cerrar Sesion</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST">
                            @csrf
                        </form>
                        <a href="custom/user/login-v2.html" target="_blank" class="btn btn-clean btn-sm btn-bold">Donar</a>
                    </div>
                </div>

                <!--end: Navigation -->
            </div>
        </div>

        <!--end: User Bar -->
    </div>

    <!-- end:: Header Topbar -->
</div>
