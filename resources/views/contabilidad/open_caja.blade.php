@extends('layouts.admin')
@section('contenido')
<div class="c-subheader justify-content-between px-3">

    <ol class="breadcrumb border-0 m-0 px-0 px-md-3">
        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{route('index.contabilidad')}}">Contabilidad</a></li>
        <li class="breadcrumb-item active"><a>Apertura de caja</a></li>

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
                <div class="row" id="contenido" style="display:none !important">
                    @if(count($caja)<=0)
                        <div class="col-lg-12">
                            <div class="alert alert-primary alert-dismissible fade show mb-4" role="alert">
                                Esta caja es la primera del sistema, ingrese el monto total de la caja.
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        </div>
                    @endif 
                    
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
                    <form action="{{route('store_abrir_caja.contabilidad')}}" method="POST">

                        {{ csrf_field() }}
    
                        <div class="row">
                    
                            <div class="col-lg-5 col-md-5 col-sm-12">
                                <input type="hidden" name="monto" id="monto" value="0">
                                <div class="card">
                                    <div class="card-header centrar">
                                        Apertura de bolso
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
                                    <div class="col-lg-12  col-md-7 col-sm-12">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-lg-4">
                                                        <label><b>Seleccione la caja</b></label>
                                                        <select class="mdb-select md-form colorful-select dropdown-primary" name="caja">
                                                            @foreach ($cajas as $item)
                                                                <option value="{{$item}}">{{$item}}</option>
                                                            @endforeach
                                                            
                                                        </select>
                                                        
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
                                                                    <label class="form-check-label" for="chk-c">Confirmar la correcta apertura de caja</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-footer">
                                                <button type="submit" id="btnsub" disabled class="btn btn-download btn-sm" style="background-color: #69e781;">
                                                    Abrir caja
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