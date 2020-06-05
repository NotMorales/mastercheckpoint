@extends('layouts.home')

@section('content')

<div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">

    <!-- begin:: Subheader -->
    <div class="kt-subheader   kt-grid__item" id="kt_subheader">
        <div class="kt-container  kt-container--fluid ">
            <div class="kt-subheader__main">
                <h3 class="kt-subheader__title">
                    Crear nueva Experiencia Educativa </h3>
                <span class="kt-subheader__separator kt-hidden"></span>
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
                                Datos de la experiencia
                            </h3>
                        </div>
                    </div>

                    <!--begin::Form-->
                    <form method="POST" action="{{ route('registrarexperiencia') }}" enctype="multipart/form-data" class="kt-form">
                        @csrf
                        <div class="kt-portlet__body">
                            <div class="form-group form-group-last">
                                <div class="alert alert-secondary" role="alert">
                                    <div class="alert-icon"><i class="flaticon-warning kt-font-brand"></i></div>
                                    <div class="alert-text">
                                        Las experiencias educativas registradas no podran ser eliminadas despues...
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label name="Nombre">Nombre de la Experiencia Educativa</label>
                                <input name="Nombre" value="{{ old('Nombre') }}" type="text" class="@error('Nombre') is-invalid @enderror form-control" aria-describedby="emailHelp" placeholder="Experiencia Educativa">
                            </div>
                            <div class="form-group ">
                                <label name="Descripcion" for="exampleTextarea">Descripcion de la Experiencia Educativa</label>
                                <textarea name="Descripcion" value="{{ old('Descripcion') }}" class="@error('Descripcion') is-invalid @enderror form-control" id="exampleTextarea" rows="4"></textarea>
                            </div>
                            <div class="form-group ">
                                <label name="Imagen">Imagen de la materia</label>
                                <div class="custom-file">
                                    <input name="Imagen" type="file" class="custom-file-input" id="customFile">
                                    <label class="custom-file-label" for="customFile">Seleccionar imagen</label>
                                </div>
                            </div>
                            <div class="form-group ">
                                <label name="Color" for="example-color-input" class="col-2 col-form-label">Color</label>
                                <input name="Color" value="#563d7c" class="form-control" type="color"  id="example-color-input">
                            </div>
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

@endsection
