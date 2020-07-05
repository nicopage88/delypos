@extends('layouts.admin')
@section('contenido')
<div class="c-subheader justify-content-between px-3">

    <ol class="breadcrumb border-0 m-0 px-0 px-md-3">
        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{route('index.producto')}}">Productos</a></li>
        <li class="breadcrumb-item active"><a>Historial de actividad</a></li>
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
                    <div class="col-lg-5 mb-4">
                        {!! Form::open(array('url'=>'panel/productos/historial','method'=>'GET','autocomplete'=>'off','role'=>'search'))!!}
                        <div class="row">
                            <div class="col-lg-4">
                                <label><b>Desde:</b></label>
                                <input type="date" class="form-control" id="from" name="from" value="{{$from}}" value="2000-01-01">
                            </div>
                            <div class="col-lg-4">
                                <label><b>Hasta:</b></label>
                                <input type="date" class="form-control" name="to" value="{{$to}}">
                            </div>
                            <div class="col-lg-4">
                                <label><b>*</b></label>
                                <button class="btn btn-primary btn-sm btn-block">Filtrar</button>
                            </div>
                        </div>
                            
                        
                            
                            
                        {{Form::close()}}
                    </div>
                    <div class="col-lg-10">
                        <div class="card">
                            <div class="card-body">
                                <table class="table table-responsive-sm table-hover table-outline mb-0 table-sm">
                                    <thead class="thead-light">
                                        <tr>
                                            <th class="text-center">
                                               Producto
                                            </th>
                                            <th class="text-center">Fecha</th>
                                            <th class="text-center">Usuario</th>
                                            <th class="text-center">Acción</th>
                                           
                                        </tr>
                                    </thead>
                                    @foreach ($ingreso as $item)
                                        <tbody>
                                            <tr>
                                                <td>{{$item->titulo}}</td>
                                                <td>{{$item->createAt}}</td>
                                                <td>{{$item->name}}</td>
                                                <td><i class="fas fa-caret-up"></i> {{$item->mensaje}}</td>
                                            </tr>              
                                        </tbody>
                                    @endforeach
                                </table>
                                
                            </div>
                            {{$ingreso->render()}}
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