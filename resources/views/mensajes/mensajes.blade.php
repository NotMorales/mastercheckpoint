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
                        <div class="kt-searchbar">
                            <div class="input-group">
                                {{-- btn-block para hacerlo grande --}}
                                <a href="{{route('nuevoMensaje')}}" class="btn btn-success">
                                    <i class="flaticon2-plus"></i> Nuevo mensaje
                                </a>
                            </div>
                        </div>
                        <div class="kt-widget kt-widget--users kt-mt-20">
                            <div class="kt-scroll kt-scroll--pull">
                                <div class="kt-widget__items">
                                @foreach ($personas as $personachat)

                                        <div class="kt-widget__item">
                                            <span class="kt-media kt-media--circle">
                                                <img src="{{asset('assets/media/users/default.jpg')}}" alt="image">
                                            </span>
                                            <div class="kt-widget__info">
                                                <div class="kt-widget__section">
                                                    <a href="{{route('mensajes', ['mensaje' => $personachat->users->userId ])}}" class="kt-widget__username">{{$personachat->users->persona->nombre}}</a>
                                                </div>
                                                <span class="kt-widget__desc">
                                                    @php
                                                        $mensaje = App\mensaje::
                                                            where([
                                                                ['userId', Auth::user()->userId],
                                                                ['userIdRemitente', $personachat->userId],])
                                                            ->orWhere([
                                                                ['userId', $personachat->userId],
                                                                ['userIdRemitente', Auth::user()->userId],])
                                                            ->orderBy('created_at', 'desc')
                                                            ->first();
                                                    @endphp
                                                    {{$mensaje->titulo}}
                                                </span>
                                            </div>
                                            <div class="kt-widget__action">
                                                <span class="kt-widget__date">{{$mensaje->fecha}}</span>

                                                    @php
                                                        $cont = 0;
                                                        $mensajeTem = App\mensaje::
                                                            where([
                                                                ['userId', Auth::user()->userId],
                                                                ['userIdRemitente', $personachat->userId],])
                                                            ->get();
                                                        foreach($mensajeTem as $msn){
                                                            if($msn->estado == 0){
                                                                $cont++;
                                                            }
                                                        }
                                                    @endphp
                                                    @if ($cont > 0)
                                                        <span class="kt-badge kt-badge--success kt-font-bold">{{$cont}}</span>
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
                            <div class="kt-chat__left">

                                <!--begin:: Aside Mobile Toggle -->
                                <button type="button" class="btn btn-clean btn-sm btn-icon btn-icon-md kt-hidden-desktop" id="kt_chat_aside_mobile_toggle">
                                    <i class="flaticon2-open-text-book"></i>
                                </button>

                            </div>
                            <div class="kt-chat__head ">
                                <div class="kt-chat__left">


                                </div>
                                <div class="kt-chat__center">
                                    @if ( count($mensajeMostrar) > 0 )
                                        <div class="kt-chat__label">
                                            <a href="#" class="kt-chat__title">
                                                @php
                                                    $nombre = "";
                                                    $apellidos = "";
                                                    if($mensajeMostrar[0]->userId == Illuminate\Support\Facades\Auth::user()->userId ){
                                                        $nombre = $mensajeMostrar[0]->usersRemitente->persona->nombre;
                                                        $apellidos = $mensajeMostrar[0]->usersRemitente->persona->apellidoPaterno . " " . $mensajeMostrar[0]->usersRemitente->persona->apellidoMaterno;
                                                    }else{
                                                        $nombre = $mensajeMostrar[0]->users->persona->nombre;
                                                        $apellidos = $mensajeMostrar[0]->users->persona->apellidoPaterno . " " . $mensajeMostrar[0]->users->persona->apellidoMaterno;;
                                                    }
                                                @endphp
                                                {{$nombre}}
                                            </a>
                                            <span class="kt-chat__status">
                                                <span class="kt-badge kt-badge--dot"></span> {{$apellidos}}
                                            </span>
                                        </div>
                                    @endif
                                </div>
                                <div class="kt-chat__right">

                                </div>
                            </div>
                        </div>
                        <div class="kt-portlet__body">
                            <div class="kt-scroll kt-scroll--pull" data-mobile-height="300">
                                <div class="kt-chat__messages">

                                    @foreach ($mensajeMostrar as $mensajeTem)
                                        @if ($mensajeTem->userId != Illuminate\Support\Facades\Auth::user()->userId )
                                            <div class="kt-chat__message kt-chat__message--right">
                                                <div class="kt-chat__user">
                                                    <span class="kt-chat__datetime">{{$mensajeTem->created_at}}</span>
                                                    <a href="#" class="kt-chat__username">Tu</span></a>
                                                    <span class="kt-media kt-media--circle kt-media--sm">
                                                        <img src="{{asset('assets/media/users/default.jpg')}}" alt="image">
                                                    </span>
                                                </div>
                                                <div class="kt-chat__text kt-bg-light-brand">
                                                    <p class="font-size-h4">{{$mensajeTem->titulo}}</p>
                                                    <p class="lead">{{$mensajeTem->mensaje}}</p>
                                                </div>
                                            </div>
                                        @else
                                            <div class="kt-chat__message">
                                                <div class="kt-chat__user">
                                                    <span class="kt-media kt-media--circle kt-media--sm">
                                                        <img src="{{asset('assets/media/users/default.jpg')}}" alt="image">
                                                    </span>
                                                    <a href="#" class="kt-chat__username">{{$mensajeTem->usersRemitente->persona->nombre}}</span></a>
                                                    <span class="kt-chat__datetime">{{$mensajeTem->created_at}}</span>
                                                </div>
                                                <div class="kt-chat__text kt-bg-light-success">
                                                    <p class="font-size-h4">{{$mensajeTem->titulo}}</p>
                                                    <p class="lead">{{$mensajeTem->mensaje}}</p>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach




                                </div>
                            </div>
                        </div>
                        <div class="kt-portlet__foot">
                            @if ( count($mensajeMostrar) > 0 )
                                <form method="POST" action="{{route('enviarMensaje')}}" enctype="multipart/form-data" class="kt-form">
                                    @csrf
                                    @php
                                        $Destino = 1;
                                        if($mensajeMostrar[0]->userId == Illuminate\Support\Facades\Auth::user()->userId ){
                                            $Destino = $mensajeMostrar[0]->userIdRemitente;
                                        }else{
                                            $Destino = $mensajeMostrar[0]->userId;
                                        }
                                    @endphp
                                    <input name="Destino"  type="hidden" value="{{$Destino}}" >
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

 <script src="{{asset('js/chat.js')}}" type="text/javascript"></script>

@endsection
