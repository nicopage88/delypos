@extends('layouts.admin')
@section('contenido')
<div class="c-subheader justify-content-between px-3">

    <ol class="breadcrumb border-0 m-0 px-0 px-md-3">
        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{route('index.contabilidad')}}">Contabilidad</a></li>
        <li class="breadcrumb-item active"><a>Cierre de caja</a></li>

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
                    @if(Session::has('warning'))
                        <div class="col-lg-12">
                            <div class="alert alert-warning alert-dismissible fade show mb-4" role="alert">
                                {{Session::get('warning')}}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        </div>
                    @endif 
                    <form action="{{route('store_cerrar_caja.contabilidad',$caja->id)}}" method="POST">

                        {{ csrf_field() }}
                        @method('PATCH')
    
                        <div class="row">
                    
                            <div class="col-lg-5 col-md-5 col-sm-12">
                                <input type="hidden" name="monto" id="monto" value="0">
                                <div class="card">
                                    <div class="card-header centrar">
                                        Cierre de bolso
                                    </div>
                                    <div class="card-body">
                                       <table class="table table-sm">
                                           <thead class="thead-dark">
                                               <th class="text-center">Denominación</th>
                                               <th class="text-center">Cantidad</th>
                                               <th class="text-center">Valor</th>
                                           </thead>
                                        @foreach ($deno as $key => $item)
                                           
                                            <tbody>
                                                <td class="text-center">
                                                    {{$item->denominacion}}
                                                    <input type="hidden" name="denominacion[]" value="{{$item->denominacion}}">
                                                </td>
                                                <td class="text-center">
                                                    <input type="number" data-cantidad="{{$key}}" class="cantidad" min="0" id="cantidad-{{$key}}" value="0" style="width:100%;text-align: center;" name="cantidad[]">
                                                </td>
                                                <td>
                                                    <input type="number" readonly id="valor-{{$key}}" value="{{$item->valor}}" style="width:100%;text-align: center;" name="valor[]">
                                                </td>
                                                <td class="display: hidden">
                                                    <input type="hidden" id="subtotal-{{$key}}" style="width:100%" value="0">
                                                </td>
                                            </tbody>
                                           
                                            
                                        @endforeach
                                       </table>
                                    </div>
                                    <div class="card-footer">
                                        Monto: {{$config->prefijo_moneda}}<span id="total">0.00 </span> {{$config->currency}}
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-7 col-md-7 col-sm-12">
                                <div class="row">
                                    <div class="col-lg-12 col-md-7 col-sm-12">
                                       <div class="row">
                                           <div class="col-lg-6 col-md-12">
                                                <div class="card overflow-hidden">
                                                    <div class="card-body p-0 d-flex align-items-center">
                                                        <div class="bg-gradient-info p-4 mfe-3">
                                                            <svg class="c-icon c-icon-xl">
                                                                <use xlink:href="/sprites/linear.svg#cil-money">
                                                                    <svg id="cil-money" viewBox="0 0 512 512">
                                                                        <path d="M432,64H16V384H432ZM400,352H48V96H400Z" class="cls-1"></path>  <polygon points="464 144 464 416 96 416 96 448 496 448 496 144 464 144" class="cls-1"></polygon>  <path d="M224,302.46c39.7012,0,72-35.1368,72-78.3262s-32.2988-78.3262-72-78.3262-72,35.1367-72,78.3262S184.2988,302.46,224,302.46Zm0-124.6524c22.0557,0,40,20.7822,40,46.3262S246.0557,270.46,224,270.46s-40-20.7823-40-46.3262S201.9443,177.8076,224,177.8076Z" class="cls-1"></path>  <rect width="32" height="176" x="80" y="136" class="cls-1"></rect>  <rect width="32" height="176" x="336" y="136" class="cls-1"></rect>
                                                                    </svg>
                                                                </use>
                                                            </svg>
                                                        </div>
                                                        <div>
                                                            <div class="text-value text-primary">{{$config->prefijo_moneda}}<span id="total">{{$caja->monto}} </span> {{$config->currency}}</div>
                                                            <div class="text-muted text-uppercase font-weight-bold small">Monto base</div>
                                                        </div>
                                                    </div>
                                                </div>
                                           </div>
                                           <div class="col-lg-6 col-md-12">
                                            <div class="card overflow-hidden">
                                                <div class="card-body p-0 d-flex align-items-center">
                                                        <div class="bg-gradient-warning p-4 mfe-3">
                                                            <svg class="c-icon c-icon-xl">
                                                                <use xlink:href="/sprites/linear.svg#cil-av-timer">
                                                                    <svg id="cil-av-timer" viewBox="0 0 512 512">
                                                                        <rect width="32" height="32" x="240" y="384" class="cls-1"></rect>  <rect width="32" height="32" x="96" y="240" class="cls-1"></rect>  <rect width="32" height="32" x="384" y="240" class="cls-1"></rect>  <path d="M414.39,97.61A222.27,222.27,0,0,0,272,32.57V32H240v96h32V64.67C370.41,72.83,448,155.52,448,256c0,105.87-86.13,192-192,192S64,361.87,64,256a191.62,191.62,0,0,1,56.41-135.94L236,265.94l25.08-19.88L124.6,73.83,112,84.42a224,224,0,1,0,302.4,13.19Z" class="cls-1"></path>
                                                                    </svg>
                                                                </use>
                                                            </svg>
                                                        </div>
                                                        <div>
                                                            <div class="text-value text-primary">{{$caja->hora}}</div>
                                                            <div class="text-muted text-uppercase font-weight-bold small">Hora de apertura</div>
                                                        </div>
                                                    </div>
                                                </div>
                                               
                                           </div>
    
                                       </div>
                                    </div>
                                   
                                    <div class="col-lg-12 col-md-7 col-sm-12">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-lg-12 form-group">
                                                        <div class="date">
                                                            <span id="weekDay" class="weekDay"></span>, 
                                                            <span id="day" class="day"></span> de
                                                            <span id="month" class="month"></span> del
                                                            <span id="year" class="year"></span> ,
                                                            <span id="hours" class="hours"></span> :
                                                            <span id="minutes" class="minutes"></span> :
                                                            <span id="seconds" class="seconds"></span>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-12">
                                                        <div class="row">
                                                            <div class="col-lg-4 hidden-md-down">
                                                                <img src="{{asset('perfiles/'.auth()->user()->poster)}}" style="width:100%">
                                                            </div>
                                                            <div class="col-lg-8 col-md-12">
                                                                <table class="table table-sm">
                                                                    <tbody>
                                                                        <tr>
                                                                            <td><b>Nombres</b></td>
                                                                            <td>{{auth()->user()->name}}</td>   
                                                                        </tr>
                                                                        <tr>
                                                                            <td><b>Correo Electónico</b></td>
                                                                            <td>{{auth()->user()->email}}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td><b>Tipo de usuario</b></td>
                                                                            <td>{{auth()->user()->role}}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td><b>DNI</b></td>
                                                                            <td>{{auth()->user()->dni}}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td><b>Fecha de apertura</b></td>
                                                                            <td>{{$fecha}}</td>
                                                                        </tr>
                                                                        
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                           
                                                            <div class="col-lg-12">
                                                                <hr>
                                                                <div class="form-check">
                                                                    <input type="checkbox" class="form-check-input" id="chk-c">
                                                                    <label class="form-check-label" for="chk-c">Confirmar el cierre correcto de la caja</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-footer">
                                                <button type="submit" id="btnsub" disabled class="btn btn-download btn-sm" style="background-color: #69e781;">
                                                    Cerrar caja
                                                </button>
                                            </div>
                                        </div>
                                    </div>
    
                                   
                                </div>
                                
                            </div>
              
                        </div>
                    </form>
                </div>
                
            </div>
        </div>
    </main>
    <style>
        .select-wrapper input.select-dropdown{
        margin-bottom: 0px !important
    }
    </style>
 
</div>

@push('scripts')
    <script>

        window.onload = function(){
           var loader = document.getElementById('loader');
           var contenido = document.getElementById('contenido');

            contenido.style.display = 'block';
 
            $('#loader').remove();
       }

        $(document).ready(function() {
        $('.mdb-select').materialSelect();
        });

        var count = "<?php echo count($deno)?>";

        var total = 0.00;


        $('.cantidad').change(function(e){
         
         
            var idcantidad = $(this).attr('id');
            var identificador = $(this).attr('data-cantidad');
            
            var cantidad = document.getElementById(idcantidad).value;
            var valor = document.getElementById('valor-'+identificador).value;
            var subtotal = cantidad * valor;

            $('#subtotal-'+identificador).val(subtotal);
            
            total= 0;
            for(var i = 0; i < count; i++){
                    let sub = document.getElementById('subtotal-'+i).value;
                    console.log(sub);
                    
                    total = total + parseInt(sub);
                    console.log(total);
                    
            }
            $('#total').text(total.toFixed(2));
            $('#monto').val(total.toFixed(2));
        });

      
        
        $( '#chk-c' ).on( 'click', function() {
            if( $(this).is(':checked') ){
                $('#btnsub').prop('disabled', false);
            } else {
   
                $('#btnsub').prop('disabled', true);
            }
        });
       


    </script>
@endpush
@endsection