@extends('layouts.home')
@section('content')
<div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">

    <!-- begin:: Content -->
    <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">

        <!--Begin::App-->
        <div class="kt-grid kt-grid--desktop kt-grid--ver kt-grid--ver-desktop kt-app">

            <!--Begin:: App Aside Mobile Toggle-->
            <button class="kt-app__aside-close" id="kt_chat_aside_close">
                <i class="la la-close"></i>
            </button>

            <!--End:: App Aside Mobile Toggle-->

            <!--Begin:: App Aside-->
            <div class="kt-grid__item kt-app__toggle kt-app__aside kt-app__aside--lg kt-app__aside--fit" id="kt_chat_aside">

                <!--begin::Portlet-->
                <div class="kt-portlet kt-portlet--last">
                    <div class="kt-portlet__body">
                        <div class="kt-widget kt-widget--users kt-mt-20">
                            <div class="kt-scroll kt-scroll--pull">
                                <div class="kt-widget__items">
                                    @foreach ($notificaciones as $notificacion)
                                        <div class="kt-widget__item">
                                            <span class="kt-media kt-media--circle">
                                                <img src="{{asset('assets/media/users/default.jpg')}}" alt="image">
                                            </span>
                                            <div class="kt-widget__info">
                                                <div class="kt-widget__section">
                                                    <a href="{{route('notificaciones', ['notificacion' => $notificacion->notificacionId])}}" class="kt-widget__username">{{$notificacion->usersRemitente->persona->nombre}}</a>
                                                </div>
                                                <span class="kt-widget__desc">
                                                    {{$notificacion->notificacion}}
                                                </span>
                                            </div>
                                            <div class="kt-widget__action">
                                                <span class="kt-widget__date">{{$notificacion->fecha}}</span>
                                                @if ($notificacion->estado == 0)
                                                    <span class="kt-badge kt-badge--success kt-font-bold">1</span>
                                                @endif
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!--end::Portlet-->
            </div>

            <!--End:: App Aside-->

            <!--Begin:: App Content-->
            <div class="kt-grid__item kt-grid__item--fluid kt-app__content" id="kt_chat_content">
                <div class="kt-chat">
                    <div class="kt-portlet kt-portlet--head-lg kt-portlet--last">
                        <div class="kt-portlet__head">
                            <div class="kt-chat__head ">
                                <div class="kt-chat__left">

                                </div>
                                <div class="kt-chat__center">
                                    <div class="kt-chat__label">
                                        @if ($notificacionMostrar)
                                            <a href="#" class="kt-chat__title">{{$notificacionMostrar->usersRemitente->persona->nombre}}</a>
                                            <span class="kt-chat__status">
                                                Notificacion
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="kt-chat__right">

                                </div>
                            </div>
                        </div>
                        <div class="kt-portlet__body">
                            <div class="kt-scroll kt-scroll--pull" data-mobile-height="300">
                                <div class="kt-chat__messages">

                                    @if ($notificacionMostrar)
                                        <div class="card card-custom gutter-b">
                                            <div class="card-header">
                                                <div class="card-title">
                                                    <h3 class="card-label">
                                                        {{$notificacionMostrar->notificacion}}
                                                    </h3>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                {{$notificacionMostrar->descripcion}}
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="kt-portlet__foot">
                            @if ($notificacionMostrar)
                                <p class="text-primary font-size-h1">Enviar Mensaje:</p>
                                <form method="POST" action="{{route('enviarMensaje')}}" enctype="multipart/form-data" class="kt-form">
                                    @csrf
                                    <input name="Destino"  type="hidden" value="{{$notificacionMostrar->userIdRemitente}}" >
                                    <div class="kt-chat__input">
                                        <div class="form-group">
                                            <label name="Asunto">Asunto:</label>
                                            <input name="Asunto" value="{{ old('Asunto') }}" type="text" class="form-control @error('Asunto') is-invalid @enderror" >
                                        </div>
                                        <div class="form-group mb-1">
                                            <label name="Mensaje" for="exampleTextarea">Mensaje:</label>
                                            <textarea name="Mensaje" class="form-control @error('Mensaje') is-invalid @enderror" id="exampleTextarea" rows="3">{{ old('Mensaje') }}</textarea>
                                        </div>
                                        <div class="kt-chat__toolbar">

                                            <div class="kt_chat__actions">
                                                <button type="submit" class="btn btn-brand btn-md btn-upper btn-bold">Enviar</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!--End:: App Content-->
        </div>

        <!--End::App-->
    </div>

    <!-- end:: Content -->
</div>

@endsection
