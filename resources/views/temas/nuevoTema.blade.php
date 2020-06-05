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
                        {{$experiencia->docente->persona->Tema}}</a>
                    <span class="kt-subheader__breadcrumbs-separator"></span>
                    <a href="" class="kt-subheader__breadcrumbs-link">
                        Temas </a>
                    <span class="kt-subheader__breadcrumbs-separator"></span>
                    <a href="" class="kt-subheader__breadcrumbs-link">
                        Nuevo </a>
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
                                Datos del tema
                            </h3>
                        </div>
                    </div>

                    <!--begin::Form-->
                    <form method="POST" action="{{ route('registrartema') }}" enctype="multipart/form-data" class="kt-form">
                        @csrf
                        <div class="kt-portlet__body">
                            <div class="form-group">
                                <label name="Tema">Nombre del Tema</label>
                                <input name="Tema" value="{{ old('Tema') }}" type="text" class="@error('Tema') is-invalid @enderror form-control"  placeholder="Tema">
                            </div>
                            <div class="form-group">
                                <label class="">Fecha del Tema</label>
                                    <div class="input-daterange input-group" id="kt_datepicker_5">
                                        <input type="date" class="form-control" name="start" />
                                        <div class="input-group-append">
                                            <span class="input-group-text"><i class="la la-ellipsis-h"></i></span>
                                        </div>
                                        <input type="date" class="form-control" name="end" />
                                    </div>
                            </div>
                            <input type="hidden" name="experiencia" value="{{$experiencia->experienciaEducativaId}}">
                        </div>
                        <div class="kt-portlet__foot">
                            <div class="kt-form__actions">
                                <button type="submit" class="btn btn-primary">Registrar</button>

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
{{-- <script src="{{asset('js/bootstrap-datepicker.js')}}" type="text/javascript"></script> --}}
@endsection
