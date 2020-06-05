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
                        Estudiantes </a>
                    <span class="kt-subheader__breadcrumbs-separator"></span>
                    <a href="" class="kt-subheader__breadcrumbs-link">
                        Agregar Estudiante </a>
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
                        Datos del estudiante
                    </h3>
                </div>
                <div class="kt-portlet__head-toolbar">
                    <div class="kt-portlet__head-wrapper">
                        <div class="kt-portlet__head-actions">
                            &nbsp;
                            <a href="{{route('importarExcelEstudiantes', ['experiencia' => $experiencia->experienciaEducativaId ])}}" class="btn btn-brand btn-elevate btn-icon-sm">
                                <i class="la la-file-excel-o"></i>
                                Importar Excel
                            </a>
                            &nbsp;
                            <a href="{{route('experienciasDocente', ['experiencia' => $experiencia->experienciaEducativaId ])}}" class="btn btn-brand btn-elevate btn-icon-sm">
                                <i class="la la-file-text"></i>
                                Tomar de otra Materia
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="kt-portlet__body">

                <!--begin: Datatable -->
                <form method="POST" action="{{route('crearEstudiante')}}" enctype="multipart/form-data" class="kt-form">
                    @csrf
                    <div class="kt-portlet__body">
                        <div class="form-group form-group-last">
                            <div class="alert alert-secondary" role="alert">
                                <div class="alert-icon"><i class="flaticon-warning kt-font-brand"></i></div>
                                <div class="alert-text">
                                    La <strong>contraseña</strong> del estudiante sera la misma que su <strong>matricula</strong>, los datos del estudiante <strong>no</strong> podran ser modificados...
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label name="Nombre">Nombre del estudiante</label>
                            <input name="Nombre" value="{{old('Nombre')}}" type="text" class="@error('Nombre') is-invalid @enderror form-control"  placeholder="Nombre">
                        </div>
                        <div class="form-group">
                            <label name="Paterno">Apellido Paterno del estudiante</label>
                            <input name="Paterno" value="{{old('Paterno')}}" type="text" class="@error('Paterno') is-invalid @enderror form-control"  placeholder="Paterno">
                        </div>
                        <div class="form-group">
                            <label name="Materno">Apellido Materno del estudiante</label>
                            <input name="Materno" value="{{old('Materno')}}" type="text" class="@error('Materno') is-invalid @enderror form-control"  placeholder="Materno">
                        </div>
                        <div class="form-group">
                            <label name="Telefono">Telefono del estudiante</label>
                            <input name="Telefono" value="{{old('Telefono')}}" type="phone" class="@error('Telefono') is-invalid @enderror form-control"  placeholder="Telefono">
                        </div>
                        <div class="form-group">
                            <label name="Matricula">Matricula del estudiante</label>
                            <input name="Matricula" value="{{old('Matricula')}}" type="text" class="@error('Matricula') is-invalid @enderror form-control"  placeholder="Matricula">
                        </div>
                        <div class="form-group">
                            <label name="Correo">Correo del estudiante</label>
                            <input name="Correo" value="{{old('Correo')}}" type="text" class="@error('Correo') is-invalid @enderror form-control"  placeholder="Correo">
                        </div>
                        <input type="hidden" name="experiencia" value="{{$experiencia->experienciaEducativaId}}">
                    </div>
                    <div class="kt-portlet__foot">
                        <div class="kt-form__actions">
                            <button type="submit" class="btn btn-primary">Registrar</button>

                        </div>
                    </div>
                </form>
                <!--end: Datatable -->
            </div>
        </div>
    </div>

    <!-- end:: Content -->
</div>
@endsection
