@extends('layouts.home')
@section('content')
<div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">

    <!-- begin:: Subheader -->
    <div class="kt-subheader   kt-grid__item" id="kt_subheader">
        <div class="kt-container  kt-container--fluid ">
            <div class="kt-subheader__main">
                <h3 class="kt-subheader__title"><a href="{{route('verExperiencia',['experiencia' => $experiencia->experienciaEducativaId])}}">
                    {{$experiencia->nombreExperiencia}} </a></h3>
                <span class="kt-subheader__separator kt-hidden"></span>
                <div class="kt-subheader__breadcrumbs">
                    <a href="#" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
                    <span class="kt-subheader__breadcrumbs-separator"></span>
                    <a href="" class="kt-subheader__breadcrumbs-link">
                        {{$experiencia->docente->persona->nombre}}</a>
                    <span class="kt-subheader__breadcrumbs-separator"></span>
                    <a href="" class="kt-subheader__breadcrumbs-link">
                        Participaciones </a>
                    <span class="kt-subheader__breadcrumbs-separator"></span>
                    <a href="" class="kt-subheader__breadcrumbs-link">
                        Detalle </a>
                    <span class="kt-subheader__breadcrumbs-separator"></span>
                    <a href="" class="kt-subheader__breadcrumbs-link">
                        Editar </a>
                    <span class="kt-subheader__breadcrumbs-separator"></span>

                    <!-- <span class="kt-subheader__breadcrumbs-link kt-subheader__breadcrumbs-link--active">Active link</span> -->
                </div>
            </div>
        </div>
    </div>

    <!-- end:: Subheader -->

    <!-- begin:: Content -->
    <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
        <div class="row">
            <div class="col-md-12">

                <!--begin::Portlet-->
                <div class="kt-portlet">
                    <div class="kt-portlet__head">
                        <div class="kt-portlet__head-label">
                            <h3 class="kt-portlet__head-title">
                                Participacion: {{$participacion->experienciaestudiante->user->persona->nombre}} {{$participacion->experienciaestudiante->user->persona->apellidoPaterno}} {{$participacion->experienciaestudiante->user->persona->apellidoMaterno}}
                            </h3>
                        </div>
                    </div>

                    <!--begin::Form-->
                    <form method="POST" action="{{route('guardarParticipacionCambio')}}" enctype="multipart/form-data" class="kt-form">
                        @csrf
                        <div class="kt-portlet__body">
                            <div class="form-group">
                                <label name="Tema" for="exampleSelect1">Tema:</label>
                                <select name="Tema" class="form-control @error('Tema') is-invalid @enderror" id="exampleSelect1">
                                    @foreach ($temas as $tema)
                                        <option value="{{$tema->temaId}}" @if ( $tema->temaId == $participacion->temaId) selected @endif>{{$tema->nombreTema}}</option>
                                    @endforeach

                                </select>
                            </div>
                            <div class="form-group">
                                <label name="Participacion">Participaciones:</label>
                                <input name="Participacion" value="{{ $participacion->numeroParticipaciones }}" type="number" class="@error('Participacion') is-invalid @enderror form-control" >
                            </div>
                            <div class="form-group">
                                <label name="Motivo">Motivo:</label>
                                <input name="Motivo" value="{{$participacion->descripcion}}" type="text"class="form-control @error('Fecha') is-invalid @enderror" placeholder="Justifique el cambio.">
                            </div>
                            <input type="hidden" name="detalle" value="{{$participacion->participacionId}}">
                        </div>
                        <div class="kt-portlet__foot">
                            <div class="kt-form__actions">
                                <button type="submit" class="btn btn-primary">Guardar</button>
                            </div>
                        </div>
                    </form>

                    <!--end::Form-->
                </div>

                <!--end::Portlet-->
            </div>
        </div>
    </div>

    <!-- end:: Content -->
</div>
<script src="{{asset('js/bootstrap-touchspin.js')}}"></script>
@endsection
