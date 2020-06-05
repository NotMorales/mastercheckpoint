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
                        Asignar </a>
                    <span class="kt-subheader__breadcrumbs-separator"></span>

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
                        Asignar Participaciones
                    </h3>
                </div>
            </div>
            <div class="kt-portlet__body">

                <!--begin: Datatable -->
                <table class="table table-striped- table-bordered table-hover table-checkable" id="kt_table_1">
                    <thead>
                        <tr>
                            <th>Matricula</th>
                            <th>Nombre</th>
                            <th>Tema</th>
                            <th>Asignar</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($estudiantes as $estudiante)
                        <tr>
                            <td>{{$estudiante->user->matricula}}</td>
                            <td>{{$estudiante->user->persona->nombre}} {{$estudiante->user->persona->apellidoPaterno}} {{$estudiante->user->persona->apellidoMaterno}}</td>
                            <td>
                                @if ( $tema )
                                    {{$tema->nombreTema}}
                                @else
                                    No hay tema
                                @endif
                            </td>
                            <td>
                                <form method="POST" action="{{route('asignarParticipacion')}}">
                                    @csrf
                                    <div class="input-group">
                                        <div class="col-lg-4 col-md-9 col-sm-12">
                                            <input type="hidden" name="estudiante" value="{{$estudiante->experienciaEstudianteId}}">
                                            <input type="hidden" name="tema" value="@if($tema){{$tema->temaId}}@endif">
                                            <input id="kt_touchspin_4" type="text" class="form-control bootstrap-touchspin-vertical-btn" value="1" name="participacion">
                                        </div>
                                        <div class="input-group-append">
                                            <input type="submit" class="btn btn-primary" value="Asignar">
                                        </div>
                                    </div>
                                </form>
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
<script src="{{asset('js/bootstrap-touchspin.js')}}"></script>
@endsection
