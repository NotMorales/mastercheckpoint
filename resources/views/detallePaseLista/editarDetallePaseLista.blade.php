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
                        Pase de Lista </a>
                    <span class="kt-subheader__breadcrumbs-separator"></span>
                    <a href="" class="kt-subheader__breadcrumbs-link">
                        Detalles </a>
                    <span class="kt-subheader__breadcrumbs-separator"></span>
                    <a href="" class="kt-subheader__breadcrumbs-link">
                        Modificar </a>
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
                                Modificar pase de lista:
                            </h3>
                        </div>
                    </div>

                    <!--begin::Form-->
                    <form method="POST" action="{{ route('guardarDetallePaseLista') }}" enctype="multipart/form-data" class="kt-form">
                        @csrf
                        <div class="kt-portlet__body">
                            <div class="form-group">
                                <label name="Matricula">Matricula del estudiante:</label>
                                <input name="Matricula" value="{{ $detallesPaseLista->user->matricula }}" type="text" disabled="disabled" class="form-control" >
                            </div>
                            <div class="form-group">
                                <label name="Matricula">Nombre del estudiante:</label>
                                <input name="Matricula" value="{{ $detallesPaseLista->user->persona->nombre }} {{ $detallesPaseLista->user->persona->apellidoPaterno }} {{ $detallesPaseLista->user->persona->apellidoMaterno }}" type="text" disabled="disabled" class="form-control" >
                            </div>
                            <div class="form-group">
                                <label name="Matricula">Fecha del Pase de lista:</label>
                                <input name="Matricula" value="{{ $pase->fecha }}" type="date" disabled="disabled" class="form-control" >
                            </div>
                            <div class="form-group">
                                <label name="tipo" for="exampleSelect1">Asistencia:</label>
                                <select name="tipo" class="form-control @error('Fecha') is-invalid @enderror" id="exampleSelect1">
                                    <option value="0" @if ( $detallesPaseLista->tipo == 0) selected @endif>Falta</option>
                                    <option value="1" @if ( $detallesPaseLista->tipo == 1) selected @endif>Asistencia</option>
                                    <option value="2" @if ( $detallesPaseLista->tipo == 2) selected @endif>Retardo</option>
                                    <option value="3" @if ( $detallesPaseLista->tipo == 3) selected @endif>Justificante</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label name="Motivo">Motivo:</label>
                                <input name="Motivo" value="{{$detallesPaseLista->descripcion}}" type="text"class="form-control @error('Fecha') is-invalid @enderror" placeholder="Justifique el cambio.">
                            </div>
                            <input type="hidden" name="detalle" value="{{$detallesPaseLista->listaAsistenciaEstudianteId }}">
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
@endsection
