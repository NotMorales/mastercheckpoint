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
                    <a href="" class="kt-subheader__breadcrumbs-link">
                        Pases de Lista </a>
                    <span class="kt-subheader__breadcrumbs-separator"></span>
                    @if ( session('message') )
                        <span class="kt-font-primary kt-font-bold">
                            {{session('message')}}
                        </span>
                    @endif

                    <!-- <span class="kt-subheader__breadcrumbs-link kt-subheader__breadcrumbs-link--active">Active link</span> -->
                </div>
            </div>
        </div>
    </div>

    <!-- end:: Subheader -->

    <!-- begin:: Content -->
    <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
        <div class="kt-portlet kt-portlet--mobile">
            <div class="kt-portlet__head kt-portlet__head--lg">
                <div class="kt-portlet__head-label">
                    <span class="kt-portlet__head-icon">
                        <i class="kt-font-brand flaticon2-line-chart"></i>
                    </span>
                    <h3 class="kt-portlet__head-title">
                        Pases de Lista
                    </h3>
                </div>
            </div>
            <div class="kt-portlet__body">

                <!--begin: Datatable -->
                <table class="table table-striped- table-bordered table-hover table-checkable" id="table">
                    <thead>
                        <tr>
                            <th>Fecha</th>
                            <th>Horario</th>
                            <th>Asistencia</th>
                            <th>Estado</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($PasesLista as $PaseLista)
                        <tr>
                            <td>{{$PaseLista->fecha}}</td>
                            <td>{{$PaseLista->horaInicio}} - {{$PaseLista->horaFin}}</td>
                            <td>
                                @php
                                    $detalle = App\listaasistenciaestudiante::where('listaAsistenciaId', $PaseLista->listaAsistenciaId)
                                        ->where('userId', Auth::user()->userId)->first();
                                    $detalle  = $detalle->tipo;
                                @endphp
                                @if ( $detalle == 0)
                                    <span class="kt-font-danger kt-font-bold">Falta</span>
                                @else
                                    @if ( $detalle == 1)
                                        <span class="kt-font-success kt-font-bold">Asistencia</span>
                                    @else
                                        @if ( $detalle == 2)
                                            <span class="kt-font-primary kt-font-bold">Retardo</span>
                                        @else
                                            @if ( $detalle == 3 )
                                                <span class="kt-font-primary kt-font-bold">Justificante</span>
                                            @else
                                                <span class="kt-font-warning kt-font-bold">Hacks</span>
                                            @endif
                                        @endif
                                    @endif

                                @endif
                            </td>
                            <td>
                                @if ( $PaseLista->estado == 0)
                                    <a href="#" class="btn btn-label-danger btn-pill disabled" disabled>Cerrado</a>
                                @else
                                    @if ( $detalle == 0)
                                        <a href="{{route('checkEst', ['pase' => $PaseLista->listaAsistenciaId])}}" class="btn btn-label-success btn-pill">Presente</a>
                                    @else
                                        <a href="#" class="btn btn-label-success btn-pill disabled" disabled>Presente</a>
                                    @endif
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                <!--end: Datatable -->
            </div>
        </div>
    </div>

    <!-- end:: Content -->
</div>
@endsection
