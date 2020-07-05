@extends('layouts.admin')
@section('contenido')
<div class="c-subheader justify-content-between px-3">

    <ol class="breadcrumb border-0 m-0 px-0 px-md-3">
        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{route('index.contabilidad')}}">Historial de ventas</a></li>
        <li class="breadcrumb-item active"><a>Registro de venta</a></li>
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
            <style>
                .bot{
                    margin-left: 0px;
                    margin-top: 0px;
                    border-top-left-radius: 0px;
                    border-bottom-left-radius: 0px;
                }
            </style>
            <div>
              
               <div class="row" id="contenido" >
                <form action="{{route('store.venta')}}" method="POST">
                    @csrf
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
    
    
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header">
                                    <div class="date">
                                       
                                        <span id="hours" class="hours"></span> :
                                        <span id="minutes" class="minutes"></span> :
                                        <span id="seconds" class="seconds"></span>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-3 col-md-4">
                                            <label><b>Razón social:</b></label>
                                            <input type="text" class="form-control" name="razon_social" placeholder="Razón social">
                                        </div>
                                        <div class="col-lg-2 col-md-4">
                                            <label><b>Tipo de factura:</b></label>
                                            <select class="mdb-select md-form" name="tipo_factura">
                                                <option value="" disabled selected>Selecciona</option>
                                                <option value="Boleta">Boleta</option>
                                                <option value="Factura">Factura</option>
                                            </select>
                                        </div>
                                        <div class="col-lg-3 col-md-4">
                                            <label><b>Número de serie:</b></label>
                                            <div class="row">
                                                <div class="col-lg-5 col-md-5" style="padding-right: 0px;">
                                                    <input type="text" readonly class="form-control" name="serie" value="{{$serie}}">
                                                </div>
                                                <div class="col-lg-7 col-md-7">
                                                    <input type="text" readonly class="form-control" name="correlativo" value="{{$correlativo}}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-5">
                                            <label><b>Caja asignada:</b></label>
                                            <div class="row">
                                                <div class="col-lg-6 col-md-6"  style="padding-right: 0px;">
                                                    <input type="text" class="form-control" name="idcaja" value="{{strtoupper(auth()->user()->caja)}}" readonly>
                                                </div>
                                                <div class="col-lg-6 col-md-6">
                                                    <input type="text" class="form-control" value="{{$caja->caja}}" readonly>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <label><b>Productos</b></label>
                                            <select class="mdb-select md-form" searchable="buscar.." name="categoria" id="producto">
                                                <option value="SELECCIONAR" selected disabled>SELECCIONAR</option>
                                                @foreach ($productos as $item)
                                                    <option value="{{$item->id}}_{{$item->titulo}}_{{$item->poster}}_{{$item->cantidad}}_{{$item->precio_venta}}_{{$item->presentacion}}" data-icon="{{asset('poster/'.$item->poster)}}">{{$item->titulo}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-lg-3">
                                            <label><b>Precio</b></label>
                                            <div class="row">
                                                <div class="col-lg-6" style="padding-right:0px">
                                                    <input type="text" class="form-control" id="precio_venta" readonly>
                                                </div>
                                                <div class="col-lg-6">
                                                    <input type="text" class="form-control" id="cantidad" readonly>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-2">
                                            <label><b>Cantidad</b></label>
                                            <input type="number" min="0" value="0" class="form-control" id="cantidad_data">
                                        </div>
                                        <div class="col-lg-1">
                                            <label><b>(*)</b></label>
                                            <button class="btn btn-primary btn-block" id="btnsend" type="button"><i class="fas fa-plus"></i></button>
                                        </div>
                                    </div>
                                </div>
                                <table id="detalles" class="table table-responsive-sm table-hover table-outline mb-0 table-sm">
                                    <thead class="thead-light">
                                        <tr>
                                            <th class="text-center">Producto</th>
                                            <th class="text-center">Precio</th>
                                            <th class="text-center">Cantidad</th>
                                            <th class="text-center">Subtotal</th>
                                            <th class="text-center">Opciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                    </tbody>
                                    <tr>
                                        <td class="text-center"></td>
                                        <td class="text-center"></td>
                                        <td class="text-center"><h6>Sin IGV</h6></td>
                                        <td class="text-center"><h6 id="sin_igv">$0.0</h6></td>
                                    </tr>
                                    <tr>
                                        <td class="text-center"></td>
                                        <td class="text-center"></td>
                                        <td class="text-center"><h6>IGV</h6></td>
                                        <td class="text-center"><h6 id="igv">$0.0</h6></td>
                                    </tr>
                                    <tr>
                                        <td class="text-center"></td>
                                        <td class="text-center"></td>
                                        <td class="text-center"><h6>Total</h6></td>
                                        <td class="text-center"><h6 id="total">$0.0</h6></td>
                                    </tr>	
                                    
                                </table>
                            </div>
                        </div>
    
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header">
                                    Información de pagos.
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-2">
                                            <label><b>Total a pagar:</b></label>
                                            <input type="text" class="form-control" readonly id="total_pagar" value="$0.00" name="total_pagar">
                                        </div>
                                        <div class="col-lg-2">
                                            <label><b>Efectivo pago:</b></label>
                                            <input type="number" min="0"class="form-control" required id="efectivo_pago" name="efectivo_pago">
                                        </div>
                                        <div class="col-lg-2">
                                            <label><b>Efectivo cambio:</b></label>
                                            <input type="text" min="0" readonly class="form-control" id="efectivo_cambio" value="$0.00" >
                                        </div>
                                        <div class="col-lg-3">
                                            <label><b>Enviar factura por correo:</b></label>
                                            <input type="email" class="form-control" required placeholder="correo@server.com" name="email">
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button class="btn btn-primary">Registrar venta</button>
                                </div>
                            </div>
                        </div>
                      
                    </div>
                </form>
               </div>
            </div>
        </div>
    </main>
    
 
</div>
@push('scripts')
    <script>
        
       
        var idproducto;
        var titulo;
        var poster;
        var cantidad_total;
        var precio;
        var precio_sin_igv;
        var presentacion;
        var cantidad;
        var cont = 0;
        subtotal =[];
        subtotal_sin_igv = [];
        total = 0;
        total_sin_igv=0;
        var igv = "<?php echo $config->igv?>";
        var total_igv = 0;
        

        $('#producto').change(function(){
                var data_producto = $('#producto').val();
                var data = data_producto.split("_");
                idproducto = data[0];
                titulo = data[1];
                poster = data[2];
                cantidad_total = data[3];
                precio = parseFloat(data[4].substr(1)) + parseFloat(((data[4].substr(1)*igv)/100).toFixed(2));
                precio_sin_igv = data[4].substr(1);
                presentacion = data[5];


                $('#precio_venta').val(precio);
                $('#cantidad').val(cantidad_total +' '+presentacion);
        });
        
        $('#btnsend').click(function(){
            send();
        });

        
        
        function send(){
            var cantidad_data = $('#cantidad_data').val();  

            if(cantidad_data == "" || cantidad_data == "0" || cantidad_data >= cantidad_total){
                $('#cantidad_data').addClass('is-invalid');
                $('#producto').addClass('is-invalid');
                $('#precio_venta').addClass('is-invalid');
                $('#cantidad').addClass('is-invalid');
                toastr.error('Ocurrió un error al agregar producto.');


            }else{
                $('#cantidad_data').removeClass('is-invalid');
                $('#producto').removeClass('is-invalid');
                $('#precio_venta').removeClass('is-invalid');
                $('#cantidad').removeClass('is-invalid');

                subtotal[cont]=(cantidad_data*precio);
                subtotal_sin_igv[cont]=(parseFloat(cantidad_data)*parseFloat(precio_sin_igv));

                total = total + subtotal[cont];
                total_sin_igv = total_sin_igv + subtotal_sin_igv[cont];
                total_igv = (total_sin_igv*igv)/100;

                var row = "<tr id='fila"+cont+"'><td class='text-center'> <div class='c-avatar'> <img style='border-radius:0px' class='c-avatar-img' title='"+titulo+"' src='<?php echo asset('poster/"+poster+"')?>'></div></td><td class='text-center'><input type='hidden' value='"+idproducto+"' name='idproducto[]'><input type='hidden' value='"+precio+"' name='precio_venta[]'>$"+precio+" </td><td class='text-center'> <input type='hidden' value='"+cantidad_data+"' name='cantidad[]'>"+cantidad_data+' '+presentacion+"</td><td class='text-center'>$"+subtotal[cont].toFixed(2)+"</td><td class='text-center'> <button class='btn btn-danger' onclick='eliminar("+cont+")'> <i class='fas fa-trash'></i> </button> </td></tr>";
                cont++;
                $('#detalles').append(row);
                $('#cantidad_data').val('0');
                $('#total').html("$"+total.toFixed(2));
                $('#total_pagar').val("$"+total.toFixed(2));
                $('#igv').html("$"+total_igv.toFixed(2));
                $('#sin_igv').html("$"+total_sin_igv.toFixed(2));
            }

        }

        function eliminar(index){
            total = total - subtotal[index];
            total_sin_igv = total_sin_igv - subtotal_sin_igv[index];
            total_igv = (total_sin_igv*igv)/100;
            $('#total').html("$"+total.toFixed(2));
            $('#total_pagar').val("$"+total.toFixed(2));
            $('#sin_igv').html("$"+total_sin_igv.toFixed(2));
            $('#igv').html("$"+total_igv.toFixed(2));
            $('#fila' + index).remove(); 
        }

        $('#efectivo_pago').keyup(function(){
            var total_pagar = $('#total_pagar').val().substr(1);
            var efectivo_pago = $('#efectivo_pago').val();
            var vuelto = efectivo_pago - total_pagar;

            $('#efectivo_cambio').val('$'+vuelto.toFixed(2));

            if(vuelto<0){
                $('#efectivo_pago').addClass('is-invalid');
            }else{
                $('#efectivo_pago').removeClass('is-invalid');
            }
        });
    </script>
@endpush
@endsection