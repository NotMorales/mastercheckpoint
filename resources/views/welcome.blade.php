@extends('layouts.home')
@section('content')
<!-- end:: Header -->
<div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">

    <!-- begin:: Subheader -->
    <div class="kt-subheader   kt-grid__item" id="kt_subheader">
        <div class="kt-container  kt-container--fluid ">
            <div class="kt-subheader__main">
                <h3 class="kt-subheader__title">
                    Master Check Point </h3>
            </div>
        </div>
    </div>

    <!-- end:: Subheader -->
    <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
        @php
            $bandera = false;
            if( Hash::check(Auth::user()->matricula, Auth::user()->password) ){
                $bandera = true;
            }
        @endphp
        @if ($bandera)
            <div class="alert alert-light alert-elevate" role="alert">
                <div class="alert-icon"><i class="flaticon-warning kt-font-brand"></i></div>
                <div class="alert-text">
                    Es importante realizar tu cambio de contraseña, debido a que es la misma que tu matricula! Por la seguridad de tu informacion.
                    <br> Te invitamos a realizar el cambio <a class="kt-link kt-link--brand kt-font-bold" href="{{route('cambiarPass')}}">aqui.</a>
                </div>
            </div>
        @endif


        <div class="row">
            <div class="col-lg-6 col-xl-4 order-lg-1 order-xl-1">
                <!--begin:: Widgets/Blog-->
                <div class="kt-portlet kt-portlet--height-fluid kt-widget19">
                    <div class="kt-portlet__body kt-portlet__body--fit kt-portlet__body--unfill">
                        <div class="kt-widget19__pic kt-portlet-fit--top kt-portlet-fit--sides" style="min-height: 300px; background-image: url({{asset('assets/media/welcome/mapa.png')}})">
                            <h3 class="kt-widget19__title kt-font-light">
                                Mapa del Coronavirus
                            </h3>
                            <div class="kt-widget19__shadow"></div>
                            <div class="kt-widget19__labels">
                                <a href="#" class="btn btn-label-light-o2 btn-bold ">Reciente</a>
                            </div>
                        </div>
                    </div>
                    <div class="kt-portlet__body">
                        <div class="kt-widget19__wrapper">
                            <div class="kt-widget19__content">
                                <div class="kt-widget19__userpic">
                                    <img src="assets/media/users/user1.jpg" alt="">
                                </div>
                                <div class="kt-widget19__info">
                                    <a href="#" class="kt-widget19__username">
                                        Sarita Ladrom
                                    </a>
                                    <span class="kt-widget19__time">
                                        Rectora UV
                                    </span>
                                </div>
                                <div class="kt-widget19__stats">
                                    <span class="kt-widget19__number kt-font-brand">
                                        18
                                    </span>
                                    <a href="#" class="kt-widget19__comment">
                                        Visitas
                                    </a>
                                </div>
                            </div>
                            <div class="kt-widget19__text">
                                El mapa interactivo señala las regiones donde los pacientes han sido diagnosticados con coronavirus: cuantos más casos haya en una región, más grande será su punto en el mapa.
                                El mapa también rastrea muertes, en total y por ciudad.
                            </div>
                        </div>
                        <div class="kt-widget19__action">
                            <a href="https://cnnespanol.cnn.com/2020/03/26/este-mapa-te-muestra-la-situacion-del-coronavirus-en-el-mundo-en-tiempo-real/" target="_blank" class="btn btn-sm btn-label-brand btn-bold">Leer mas...</a>
                        </div>
                    </div>
                </div>

                <!--end:: Widgets/Blog-->
            </div>

            <div class="col-lg-6 col-xl-4 order-lg-1 order-xl-1">
                <!--begin:: Widgets/Blog-->
                <div class="kt-portlet kt-portlet--height-fluid kt-widget19">
                    <div class="kt-portlet__body kt-portlet__body--fit kt-portlet__body--unfill">
                        <div class="kt-widget19__pic kt-portlet-fit--top kt-portlet-fit--sides" style="min-height: 300px; background-image: url({{asset('assets/media/welcome/lavarse.png')}})">
                            <h3 class="kt-widget19__title kt-font-light">
                                La importancia de lavarse las manos
                            </h3>
                            <div class="kt-widget19__shadow"></div>
                            <div class="kt-widget19__labels">
                                <a href="#" class="btn btn-label-light-o2 btn-bold ">Reciente</a>
                            </div>
                        </div>
                    </div>
                    <div class="kt-portlet__body">
                        <div class="kt-widget19__wrapper">
                            <div class="kt-widget19__content">
                                <div class="kt-widget19__userpic">
                                    <img src="assets/media/users/user1.jpg" alt="">
                                </div>
                                <div class="kt-widget19__info">
                                    <a href="#" class="kt-widget19__username">
                                        Secretaria de salud
                                    </a>
                                    <span class="kt-widget19__time">
                                        Dr en nutricion
                                    </span>
                                </div>
                                <div class="kt-widget19__stats">
                                    <span class="kt-widget19__number kt-font-brand">
                                        180
                                    </span>
                                    <a href="#" class="kt-widget19__comment">
                                        Visitas
                                    </a>
                                </div>
                            </div>
                            <div class="kt-widget19__text">
                                sabías que el simple acto de lavarse las manos con agua y jabón elimina hasta en un 80% los microbios causantes de diversas enfermedades? Según la Organización Mundial de la Salud, el lavado de manos reduce considerablemente el contagio del Cornavirus.
                            </div>
                        </div>
                        <div class="kt-widget19__action">
                            <a href="https://rpp.pe/campanas/contenido-patrocinado/la-importancia-de-lavarse-las-manos-noticia-1105451" target="_blank" class="btn btn-sm btn-label-brand btn-bold">Leer mas...</a>
                        </div>
                    </div>
                </div>

                <!--end:: Widgets/Blog-->
            </div>
        </div>

    </div>
</div>
@endsection
