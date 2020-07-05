@extends('layouts.admin')
@section('contenido')
<div class="c-subheader justify-content-between px-3">
    <ol class="breadcrumb border-0 m-0 px-0 px-md-3">
        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{route('index.usuario')}}">Usuarios</a></li>
        <li class="breadcrumb-item active"><a>Edición de usuario</a></li>
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
                <div class="row" style="display:none" id="contenido">

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
                    <div class="col-lg-10 col-md-12 form-group">
                       <div class="row">
                        <div class="col-lg-12 form-group">
                            <form action="{{route('update.usuario',$user->id)}}" method="POST" enctype="multipart/form-data" autocomplete="off">
                                {{ csrf_field() }}
                                @method('PATCH')
                            <div class="card" style="border-radius:0px !important">
                                <div class="card-header" style="background: #4949e7 !important">
                                    <b><h5 style="margin-bottom: 0px !important;color:white">Editar usuario</h5></b>
                                </div>
                                <div class="card-body">
                                    
                                        
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="row">
                                                        <div class="col-lg-3 col-md-3">
                                                            <div class="file-upload-wrapper">
                                                                <input type="file" id="input-file-now-custom-1" name="poster" class="file-upload" data-default-file="{{asset('perfiles/'.$user->poster)}}" />
                                                            </div>
                                                            @if ($errors->has('poster'))
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $errors->first('poster') }}</strong>
                                                                </span>
                                                            @endif
                                                            
                                                        </div>
                                                        <div class="col-lg-9 col-md-9  form-group">
                                                        <div class="row">
                                                                <div class="col-lg-6 form-group">
                                                                    <label><b>Nombres completos</b></label>
                                                                    <input type="text" name="name" class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}" value="{{$user->name}}" placeholder="Datos de usuario">
                                                                    @if ($errors->has('name'))
                                                                        <span class="invalid-feedback" role="alert">
                                                                            <strong>{{ $errors->first('name') }}</strong>
                                                                        </span>
                                                                    @endif
                                                                </div>
                                                                <div class="col-lg-6 form-group">
                                                                    <label><b>Correo electrónico</b></label>
                                                                    <input type="text" name="email" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" value="{{$user->email}}" placeholder="Correo electrónico de acceso" autocomplete="new-text">
                                                                    @if ($errors->has('email'))
                                                                        <span class="invalid-feedback" role="alert">
                                                                            <strong>{{ $errors->first('email') }}</strong>
                                                                        </span>
                                                                    @endif
                                                                </div>
                                                                <div class="col-lg-6 form-group">
                                                                    <label><b>Nueva contraseña</b></label>
                                                                    <input type="password" name="password" class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}"  placeholder="Ingrese una nueva contraseña" maxlength="20" autocomplete="new-password">
                                                                    @if ($errors->has('password'))
                                                                        <span class="invalid-feedback" role="alert">
                                                                            <strong>{{ $errors->first('password') }}</strong>
                                                                        </span>
                                                                    @endif
                                                                </div>
                                                                <div class="col-lg-6 form-group">
                                                                    <label><b>Confirmar contraseña</b></label>
                                                                    <input type="password" name="password_confirmation" class="form-control" placeholder="Ingrese nuevamente la contraseña" maxlength="20">     
                                                                </div>
                                                                <div class="col-lg-6 form-group">
                                                                    <label><b>Número de documento</b></label>
                                                                    <input type="number" name="dni" class="form-control {{ $errors->has('dni') ? ' is-invalid' : '' }}"  placeholder="Número de identificación (DNI)" maxlength="8" value="{{$user->dni}}">
                                                                    @if ($errors->has('dni'))
                                                                        <span class="invalid-feedback" role="alert">
                                                                            <strong>{{ $errors->first('dni') }}</strong>
                                                                        </span>
                                                                    @endif
                                                                </div>
                                                                <div class="col-lg-6 form-group">
                                                                    <label><b>Rol</b></label>
                                                                    <select class="mdb-select md-form colorful-select dropdown-primary" name="role">
                                                                        @if ($user->role == 'ADMIN')
                                                                            <option value="ADMIN" selected>ADMIN</option>
                                                                            <option value="VENDEDOR">VENDEDOR</option>
                                                                        @else
                                                                            <option value="ADMIN">ADMIN</option>
                                                                            <option value="VENDEDOR" selected>VENDEDOR</option> 
                                                                        @endif      
                                                                    </select>
                                                                    @if ($errors->has('role'))
                                                                        <span class="invalid-feedback" role="alert">
                                                                            <strong>{{ $errors->first('role') }}</strong>
                                                                        </span>
                                                                    @endif
                                                                </div>
                                                        </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                            </div>
                                    
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-download" style="background-color: #69e781;">Actualizar</button>
                                </div>
                            </div>
                        </form>
                        </div>
                       </div>    
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