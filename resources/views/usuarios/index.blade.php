@extends('layouts.admin')
@section('contenido')
<div class="c-subheader justify-content-between px-3">

    <ol class="breadcrumb border-0 m-0 px-0 px-md-3">
        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
        <li class="breadcrumb-item active"><a>Usuarios</a></li>

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
                <div  class="text-center" id="loader" style="padding-top:210px">
                    <div class="lds-facebook"><div></div><div></div><div></div></div>
                </div>
                <div class="row" id="contenido" style="display:none">
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
                    
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-5 form-group">
                                        <div class="row">
                                            <div class="col-md-12">
                                                {!! Form::open(array('url'=>'panel/usuarios','method'=>'GET','autocomplete'=>'off','role'=>'search'))!!}
                                                <div class="input-group">
                                                    <input class="form-control" type="search" name="buscar" value="{{$buscar}}" placeholder="Nombres o DNI del usuario" >
                                                    <span class="input-group-append">
                                                        <button class="btn btn-primary" >
                                                            <svg class="c-icon" style="margin-top: 0px;">
                                                            <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-magnifying-glass">
                                                                <svg id="cil-magnifying-glass" viewBox="0 0 24 24">
                                                                    <title>magnifying-glass</title><path d="M22.481 18.737l-3.801-3.801-2.923-1.208c0.934-1.314 1.493-2.951 1.493-4.719 0-0.003 0-0.006 0-0.009v0c0-4.549-3.701-8.25-8.25-8.25s-8.25 3.701-8.25 8.25 3.701 8.25 8.25 8.25c0.003 0 0.006 0 0.009 0 1.783 0 3.433-0.569 4.779-1.534l-0.025 0.017 1.205 2.916 3.801 3.801c0.475 0.478 1.133 0.773 1.86 0.773 1.45 0 2.625-1.175 2.625-2.625 0-0.727-0.296-1.385-0.773-1.86l-0-0zM2.25 9c0-3.722 3.028-6.75 6.75-6.75s6.75 3.028 6.75 6.75-3.028 6.75-6.75 6.75-6.75-3.028-6.75-6.75zM21.42 21.388c-0.204 0.203-0.485 0.329-0.795 0.329s-0.592-0.126-0.796-0.329l-3.589-3.589-1.12-2.711 2.711 1.12 3.589 3.589c0.203 0.204 0.329 0.485 0.329 0.795s-0.126 0.592-0.329 0.796l0-0z"></path>
                                                                </svg>
                                                            </use>
                                                            </svg>
                                                        </button>
                                                        
                                                    </span>
                                                </div>
                                                {{Form::close()}}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-7 form-group">

                                       
                                       
                                        <button class="btn btn-danger btn-ladda ladda-button" data-style="contract">
                                            <span class="ladda-label">
                                                <a href="{{route('index.usuario')}}" style="color: white">Restablecer 
                                                    <svg class="c-icon" style="max-width: 64px;margin-top: 0px;">
                                                        <use xlink:href="/sprites/linear.svg#cil-backspace">
                                                            <svg id="cil-backspace" viewBox="0 0 512 512">
                                                                <polygon points="227.313 363.313 312 278.627 396.687 363.313 419.313 340.687 334.627 256 419.313 171.313 396.687 148.687 312 233.373 227.313 148.687 204.687 171.313 289.373 256 204.687 340.687 227.313 363.313" class="cls-1"></polygon>  <path d="M472,64H194.6436a24.0963,24.0963,0,0,0-17.42,7.4917L16,241.623v28.754L177.2236,440.5083A24.0963,24.0963,0,0,0,194.6436,448H472a24.0275,24.0275,0,0,0,24-24V88A24.0275,24.0275,0,0,0,472,64Zm-8,352H198.084L48,257.623v-3.246L198.084,96H464Z" class="cls-1"></path>
                                                            </svg> 
                                                        </use>
                                                    </svg>
                                                </a>
                                            </span>
                                            <span class="ladda-spinner"></span>
                                        </button>

                                        <button class="btn btn-primary btn-ladda ladda-button" data-style="contract">
                                            <span class="ladda-label">
                                                <a href="{{route('create.usuario')}}" style="color: white">Nuevo usuario 
                                                    <svg class="c-icon" style="max-width: 64px;margin-top: 0px;">
                                                        <use xlink:href="/sprites/linear.svg#cil-user-follow">
                                                            <svg id="cil-user-follow" viewBox="0 0 512 512">
                                                                <path d="M208,16A112.1271,112.1271,0,0,0,96,128v79.6807a80.2376,80.2376,0,0,0,9.7681,38.3081l27.4546,50.3335-72.8213,47.334A79.7236,79.7236,0,0,0,24,410.7319V496H312V464H56V410.7319a47.8355,47.8355,0,0,1,21.8408-40.2456l97.6607-63.48-41.64-76.3408A48.1439,48.1439,0,0,1,128,207.6807V128a80,80,0,0,1,160,0v79.6807a48.1457,48.1457,0,0,1-5.8608,22.9848L240.498,307.0068,312,353.4827V315.3168l-29.2227-18.9945,27.4551-50.334A80.2394,80.2394,0,0,0,320,207.6807V128A112.1271,112.1271,0,0,0,208,16Z" class="cls-1"></path>  <polygon points="424 400 424 336 392 336 392 400 328 400 328 432 392 432 392 496 424 496 424 432 488 432 488 400 424 400" class="cls-1"></polygon>
                                                            </svg>
                                                        </use>
                                                    </svg>
                                                </a>
                                            </span>
                                            <span class="ladda-spinner"></span>
                                        </button>
                                    </div>
                                    <div class="col-lg-12">
                                        <table class="table table-responsive-sm table-hover table-outline mb-0 table-sm">
                                            <thead class="thead-light">
                                                <tr>
                                                    
                                                    <th class="text-center">Nombres</th>
                                                    <th class="text-center">Correo electrónico</th>
                                                    <th class="text-center">Rol</th>
                                                    <th class="text-center">Estado</th>
                                                    <th class="text-center">Opciones</th>
                                                </tr>
                                            </thead>
                                            @foreach ($usuarios as $item)
                                            <tbody>
                                                <tr>
                                                    <td class="text-center">{{$item->name}}</td>
                                                    <td class="text-center">{{$item->email}}</td>
                                                    <td class="text-center">{{$item->role}}</td>
                                                    <td class="text-center">
                                                        @if ($item->estado=='Activo')
                                                            <span class="badge badge-success">Activo</span>
                                                        @else
                                                            <span class="badge badge-danger">No activo</span>
                                                        @endif
                                                    </td>
                                                    <td class="text-center">
                                                        <div class="btn-group">
                                                            <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                <svg class="c-icon" style="max-width: 64px">
                                                                    <use xlink:href="/sprites/linear.svg#cil-settings">
                                                                        <svg id="cil-settings" viewBox="0 0 512 512">
                                                                            <path d="M245.1511,168a88,88,0,1,0,88,88A88.1,88.1,0,0,0,245.1511,168Zm0,144a56,56,0,1,1,56-56A56.0632,56.0632,0,0,1,245.1511,312Z" class="cls-1"></path>  <path d="M464.697,322.3193l-31.7695-26.1538a193.0943,193.0943,0,0,0,0-80.331l31.7695-26.1538a19.9409,19.9409,0,0,0,4.6065-25.4385l-32.6123-56.4834a19.9376,19.9376,0,0,0-24.337-8.73l-38.5615,14.4468a192.0446,192.0446,0,0,0-69.54-40.1919l-6.7627-40.57A19.9358,19.9358,0,0,0,277.7625,16H212.54a19.9357,19.9357,0,0,0-19.7275,16.7119L186.05,73.2837a192.045,192.045,0,0,0-69.54,40.1919L77.9451,99.0273a19.9366,19.9366,0,0,0-24.334,8.7305L20.9978,164.2446a19.94,19.94,0,0,0,4.61,25.4385l31.7666,26.1514a193.09,193.09,0,0,0,0,80.331l-31.77,26.1538a19.9408,19.9408,0,0,0-4.6064,25.4385l32.6123,56.4834a19.9369,19.9369,0,0,0,24.3369,8.73L116.51,398.5244a192.0436,192.0436,0,0,0,69.54,40.1919l6.7627,40.57A19.9356,19.9356,0,0,0,212.54,496h65.2227A19.9359,19.9359,0,0,0,297.49,479.2881l6.7627-40.5718a192.0432,192.0432,0,0,0,69.54-40.1919l38.5645,14.4483a19.937,19.937,0,0,0,24.334-8.73l32.6132-56.4868A19.94,19.94,0,0,0,464.697,322.3193Zm-50.6357,57.12-48.1094-18.024-7.2852,7.334a159.9528,159.9528,0,0,1-72.625,41.9727l-10.0039,2.6362L267.5964,464H222.7058l-8.4414-50.6421-10.0039-2.6362a159.9533,159.9533,0,0,1-72.625-41.9727l-7.2852-7.334L76.241,379.439,53.7947,340.5615l39.6289-32.624-2.7031-9.9722a160.8885,160.8885,0,0,1,0-83.9306l2.7031-9.9722L53.7947,171.439,76.241,132.561,124.35,150.585l7.2852-7.334a159.9533,159.9533,0,0,1,72.625-41.9727l10.0039-2.6362L222.7058,48h44.8906l8.4414,50.6421,10.0039,2.6362a159.9528,159.9528,0,0,1,72.625,41.9727l7.2852,7.334,48.1094-18.024,22.4463,38.8775-39.6289,32.624,2.7031,9.9722a160.8913,160.8913,0,0,1,0,83.9306l-2.7031,9.9722,39.6289,32.6235Z" class="cls-1"></path>
                                                                        </svg>
                                                                    </use>
                                                                </svg>
                                                            </button>
                                                            <div class="dropdown-menu" x-placement="bottom-start" style="will-change: transform; margin: 0px;">
                                                                <a class="dropdown-item" href="{{route('edit.usuario',$item->dni)}}">
                                                                    <svg class="c-icon" style="max-width: 64px">
                                                                        <use xlink:href="/sprites/linear.svg#cil-pencil">
                                                                            <svg id="cil-pencil" viewBox="0 0 512 512">
                                                                                <path fill="currentColor" d="M469.9614,42.0391a88.8318,88.8318,0,0,0-125.6274,0L71.8379,314.5352,23.666,456.541a24.8442,24.8442,0,0,0,5.9971,25.709l.0869.0869a24.8445,24.8445,0,0,0,17.6123,7.3418A25.19,25.19,0,0,0,55.46,488.334l142.0053-48.1719L469.9609,167.666a88.8312,88.8312,0,0,0,.0005-125.6269ZM180.1157,412.2563,58.4824,453.5176,99.7437,331.8843,308.5005,123.1274,388.8726,203.5ZM447.3335,145.0386,411.5,180.8726l-80.3721-80.3721L366.9619,64.666a56.8317,56.8317,0,1,1,80.3716,80.3726Z"></path>
                                                                              </svg>
                                                                        </use>
                                                                    </svg> &nbsp; Editar usuario
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
            
                                         
                                            </tbody>
                                            @endforeach
                                        </table>
                                       
                                    </div>
                                </div>
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
        window.onload = function(){
           var loader = document.getElementById('loader');
           var contenido = document.getElementById('contenido');

            contenido.style.display = 'block';
 
            $('#loader').remove();
       }
    </script>
@endpush
@endsection