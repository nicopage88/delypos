@extends('layouts.admin')
@section('contenido')
<div class="c-subheader justify-content-between px-3">

    <ol class="breadcrumb border-0 m-0 px-0 px-md-3">
        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
        <li class="breadcrumb-item active"><a>Banners</a></li>

    </ol>
    <div class="c-subheader-nav d-md-down-none mfe-2">
        <a class="c-subheader-nav-link" href="#">
            <svg class="c-icon">
                <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-speech"></use>
            </svg>
        </a>
        @include('general.migajas')
    </div>
</div>
<div class="c-body">
    <main class="c-main">
        <div class="container-fluid">
            <div id="ui-view"></div>
            <div>
                @include('load')
                <div class="row" id="contenido" style="display:none">
                    <div class="row">
                        @if(Session::has('success'))
                            <div class="col-lg-12">
                                <div class="alert alert-success alert-dismissible fade show mb-4" role="alert" style="background: #69e781 !important">
                                    {{Session::get('success')}}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            </div>
                        @endif 
                        
                        @if(Session::has('danger'))
                            <div class="col-lg-12">
                                <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert" style="color: #ffffff;background-color: #ed2b2b;">
                                    {{Session::get('danger')}}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            </div>
                        @endif 
                    </div>

                    <div class="row">
                        <div class="col-lg-2 mx-auto">
                            <button class="btn btn-primary btn-block" data-toggle="modal" data-target="#saven">
                                Nuevo banner
                            </button>
                            <div class="modal fade" id="saven" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                <form action="{{route('banner_store.config')}}" method="POST" enctype="multipart/form-data">
                                    @csrf
                            
                                    <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 600px !important;">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalCenterTitle">Subir nuevo banner</h5>
                                            <button style="padding:0px" type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                            </div>
                                        <div class="file-upload-wrapper">
                                            <input required name="imagen" type="file" id="input-file-now-custom-1" class="file-upload" data-default-file="https://mdbootstrap.com/img/Photos/Others/images/89.jpg" />
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>&nbsp;
                                            <button type="submit" class="btn btn-primary">Aceptar</button>
                                        </div>
                                    </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-4">
                        @foreach ($banners as $item)
                            <div class="col-lg-3 col-md-4 col-sm-6 form-group">
                                <img src="{{asset('banners/'.$item->imagen)}}" style="width:100%">
                                <div class="card-footer text-right">
                                    <button class="btn btn-danger" data-toggle="modal" data-target="#modal-{{$item->id}}">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                                @include('banner.modal')
                            </div>
                        @endforeach 
                    </div>
                  
                </div>
            </div>
        </div>
    </main>
    
 
</div>
@push('scripts')
    <script>
        $('.file-upload').file_upload();
        window.onload = function(){
           var loader = document.getElementById('loader');
           var contenido = document.getElementById('contenido');

            contenido.style.display = 'block';
 
            $('#loader').remove();
       }

    </script>
@endpush
@endsection