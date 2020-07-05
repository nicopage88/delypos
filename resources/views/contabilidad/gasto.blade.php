@extends('layouts.admin')
@section('contenido')
<div class="c-subheader justify-content-between px-3">

    <ol class="breadcrumb border-0 m-0 px-0 px-md-3">
        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{route('index.contabilidad')}}">Caja</a></li>
        <li class="breadcrumb-item active">Gastos</li>
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
                

                <div class="row" style="display: none" id="contenido">
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
                       <div class="col-lg-8">
                           <div class="row">
                               <div class="col-lg-12">
                                    <form action="{{route('store_gasto.contabilidad')}}" method="POST">
                                        @csrf
                                        <div class="card">
                                            <div class="card-header">
                                                FORMAULARIO SOBRE GASTO
                                            </div>
                                            <div class="card-body">
                                                <div class="row mb-4">
                                                    <div class="col-lg-3">
                                                        <input type="number" name="precio_gasto" required class="form-control {{ $errors->has('precio_gasto') ? ' is-invalid' : '' }}" placeholder="Total pagado">
                                                        <input type="hidden" name="idcaja" value="{{$idcaja}}">
                                                        @if ($errors->has('precio_gasto'))
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $errors->first('precio_gasto') }}</strong>
                                                            </span>
                                                        @endif
                                                    </div>
                                                    <div class="col-lg-3">
                                                        @if ($caja->estado == 'Cerrada')
                                                        <button class="btn btn-primary" type="button" onclick="cerrada()">Registrar gasto</button>
                                                        @else
                                                            <button class="btn btn-primary" type="submit">Registrar gasto</button>
                                                        @endif
                                                       
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-lg-12">
                                                        <div class="row">
                                                            <div class="col-lg-6">
                                                                <textarea name="detalle" required class="form-control {{ $errors->has('detalle') ? ' is-invalid' : '' }}" placeholder="Detalles del gasto" style="height:80px"></textarea>
                                                                @if ($errors->has('detalle'))
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $errors->first('detalle') }}</strong>
                                                                    </span>
                                                                @endif
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <textarea name="nota" required class="form-control {{ $errors->has('nota') ? ' is-invalid' : '' }}" placeholder="Nota" style="height:80px"></textarea>
                                                                @if ($errors->has('nota'))
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $errors->first('nota') }}</strong>
                                                                    </span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                               </div>
                               <div class="col-lg-12 form-group">
                                    <div class="card">
                                        <div class="table-wrapper-scroll-y my-custom-scrollbar">
                                            <table class="table table-responsive-sm table-hover table-outline mb-0 table-sm">
                                                <thead class="thead-light">
                                                    <tr>
                                                        <th class="text-center">
                                                        Detalle
                                                        </th>
                                                        <th class="text-center">Monto</th>
                                                        <th class="text-center">Nota</th>
                                                    </tr>
                                                </thead>
                                                <?php $total=0;?>
                                                @foreach ($gastos as $item)
                                                    <tbody>
                                                        <tr>
                                                            <td class="text-center">{{$item->detalle}}</td>
                                                            <td class="text-center">{{$item->nota}}</td>
                                                            <td class="text-center">{{$config->prefijo_moneda}}{{$item->precio_gasto}}</td>
                                                        </tr>
                                                        <?php 
                                                      
                                                        $total = $total +  $item->precio_gasto;  
                                                        
                                                    ?>
                                                    </tbody>
                                                @endforeach
                                                <tfoot>
                                                    <td  class="text-center" colspan="2">
                                                        Total
                                                    </td>
                                                    <td  class="text-center">{{$config->prefijo_moneda}}<?php echo $total; ?>
                                                    </td>
                                                </tfoot>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                           </div>
                       </div>
                       <div class="col-lg-4">
                            <div class="card">
                                <div class="card-header text-center">
                                    INFORMACIÓN
                                </div>
                                <div class="table-wrapper-scroll-y my-custom-scrollbar">
                                    <table class="table table-responsive-sm table-hover table-outline mb-0 table-sm">
                                        <tr>
                                            <td><b>Usuario</b></td>
                                            <td>{{auth()->user()->name}}</td>
                                        </tr>
                                        <tr>
                                            <td><b>Caja</b></td>
                                            <td>{{strtoupper(auth()->user()->caja)}}</td>
                                        </tr>
                                        <tr>
                                            <td><b>Fecha</b></td>
                                            <td>{{$fecha}}</td>
                                        </tr>

                                    </table>
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

       $('#btn-one').click(function() {
            $('#btn-one').html('<span class="spinner-border spinner-border-sm mr-2" role="status" aria-hidden="true"></span>Enviando...').addClass('disabled');
        });

        function cerrada(){
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Ocurrió un problema!',
                footer: '<a href>No se puede agregar gastos mientras la caja este cerrada</a>'
            });
        }
   </script>
@endpush
@endsection