@extends('layouts.home')

@section('content')

<div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">

    <!-- begin:: Subheader -->
    <div class="kt-subheader   kt-grid__item" id="kt_subheader">
        <div class="kt-container  kt-container--fluid ">
            <div class="kt-subheader__main">
                <h3 class="kt-subheader__title">
                    <span class="kt-subheader__separator kt-hidden"></span>
                    Editar Experiencia de: {{$experiencia->nombreExperiencia}} </h3>
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
                    <form method="POST" action="{{route('actualizarExperiencia')}}" enctype="multipart/form-data" class="kt-form">
                        @csrf
                        <div class="kt-portlet__body">
                            <input type="hidden" value="{{$experiencia->experienciaEducativaId}}" name="experiencia">
                            <div class="form-group">
                                <label name="Nombre">Nombre de la Experiencia Educativa</label>
                                <input name="Nombre" value="{{$experiencia->nombreExperiencia}}" type="text" class="@error('Nombre') is-invalid @enderror form-control" aria-describedby="emailHelp" placeholder="Experiencia Educativa">
                            </div>
                            <div class="form-group ">
                                <label name="Descripcion" for="exampleTextarea">Descripcion de la Experiencia Educativa</label>
                                <textarea name="Descripcion" class="@error('Descripcion') is-invalid @enderror form-control" id="exampleTextarea" rows="4">{{$experiencia->descripcion}}</textarea>
                            </div>
                            <div class="form-group row">
                                <label class="col-xl-3 col-lg-3 col-form-label">Imagen</label>
                                <div class="col-lg-9 col-xl-6">
                                    <div class="kt-avatar kt-avatar--outline" id="kt_user_avatar_1">
                                        <div class="kt-avatar__holder" style="background-image: url(@if($experiencia->image) {{route('experiencia.avatar', ['filename' => $experiencia->image ])}} @else {{asset('assets/media/users/user.png')}} @endif)"></div>
                                        <label class="kt-avatar__upload" data-toggle="kt-tooltip" title="" data-original-title="Cambiar Imagen">
                                            <i class="fa fa-pen"></i>
                                            <input type="file" name="profile_avatar" accept=".png, .jpg, .jpeg">
                                        </label>
                                        <span class="kt-avatar__cancel" data-toggle="kt-tooltip" title="" data-original-title="Cancel">
                                            <i class="fa fa-times"></i>
                                        </span>
                                    </div>
                                    <span class="form-text text-muted">Tipo: png, jpg, jpeg.</span>
                                </div>
                            </div>

                            <div class="form-group ">
                                <label name="Color" for="example-color-input" class="col-2 col-form-label">Color</label>
                                <input name="Color" value="{{$experiencia->color}}" class="form-control" type="color"  id="example-color-input">
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
<script src="{{asset('js/ktavatar.js')}}" type="text/javascript"></script>
@endsection
