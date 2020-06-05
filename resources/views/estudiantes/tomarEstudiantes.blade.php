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
                    <a href="" class="kt-subheader__breadcrumbs-link">
                        Importar de otra experiencia </a>
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
                        Mis experiencias
                    </h3>
                </div>
            </div>
            <div class="kt-portlet__body">

                <!--begin: Datatable -->
                <form method="POST" action="{{route('tomarEstudiantes')}}" class="kt-form">
                    @csrf
                    <input type="hidden" name="experiencia" value="{{$experiencia->experienciaEducativaId}}">
                    <div class="kt-portlet__body">
                        <div class="form-group form-group-marginless">
                            <label>Experiencia:</label>
                            <div class="row">
                                @foreach ($experienciasDocente as $experienciaDoc)
                                    <div class="col-lg-6 @error('expe') is-invalid @enderror">
                                        <label class="kt-option">
                                            <span class="kt-option__control">
                                                <span class="kt-radio">
                                                    <input type="radio" name="expe" value="{{$experienciaDoc->experienciaEducativaId}}">
                                                    <span></span>
                                                </span>
                                            </span>
                                            <span class="kt-option__label">
                                                <span class="kt-option__head">
                                                    <span class="kt-option__title">
                                                        {{$experienciaDoc->nombreExperiencia}}
                                                    </span>
                                                    <span class="kt-option__focus">
                                                        @php
                                                            $total = DB::table('experienciaestudiante')->where('experienciaEducativaId', $experienciaDoc->experienciaEducativaId)->count();
                                                        @endphp
                                                        Estudiantes: {{$total}}
                                                    </span>
                                                </span>
                                                <span class="kt-option__body">
                                                    {{$experienciaDoc->descripcion}}
                                                </span>
                                            </span>
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="kt-portlet__foot">
                        <div class="kt-form__actions">
                            <button type="submit" class="btn btn-primary">Importar</button>
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
