@extends('layouts.admin')
@section('contenido')
<div class="c-subheader justify-content-between px-3">

    <ol class="breadcrumb border-0 m-0 px-0 px-md-3">
        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
        <li class="breadcrumb-item active"><a>Contabilidad</a></li>

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
                                    
                                    <div class="col-lg-3">
                                        <a class="btn btn-dark btn-lg btn-block centrar" href="{{route('abrir_caja.contabilidad')}}">
                                            <img src="{{asset('img/dinero.png')}}" style="width: 2.1rem !important;">
                                            &nbsp;<span style="margin-left: 5px;">Abrir caja</span></a>
                                    </div>
                                    <div class="col-lg-3">
                                        <a class="btn btn-danger btn-lg btn-block centrar" href="{{route('registro.venta')}}">
                                            <img src="{{asset('img/tienda.png')}}" style="width: 2.1rem !important;">
                                            &nbsp;<span style="margin-left: 5px;">Facturar</span></a>
                                    </div>
                                    <div class="col-lg-3">
                                        <a class="btn btn-primary btn-lg btn-block centrar" href="{{route('grafico.venta')}}">
                                            <img src="{{asset('img/grafica.png')}}" style="width: 2.1rem !important;">
                                            &nbsp;<span style="margin-left: 5px;">Rendimiento</span></a>
                                       
                                    </div>
                                    <div class="col-lg-3">
                                        <a class="btn btn-success btn-lg btn-block centrar" href="{{route('historial.contabilidad')}}">
                                            <img src="{{asset('img/libro.png')}}" style="width: 2.1rem !important;">
                                            &nbsp;<span style="margin-left: 5px;">Historial</span></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-lg-12">
                        
                        <div class="card">
                            <div class="card-header">
                                PANEL DE CONTABILIDAD
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-6 form-group">
                                        {!! Form::open(array('url'=>'panel/contabilidad','method'=>'GET','autocomplete'=>'off','role'=>'search'))!!}
                                        <div class="row">
                                            
                                            <div class="col-md-5">
                                                <input class="form-control" type="date" name="from" value="{{$from}}">
                                            </div>
                                            <div class="col-md-5">
                                                <input class="form-control" type="date" name="to" value="{{$to}}" >
                                            </div>
                                        </div>
                                        {{Form::close()}}
                                    </div>
                                   
                                    <div class="col-lg-12 ventas">
                                        <table class="table table-responsive-sm table-hover table-outline mb-0 table-sm">
                                            <thead class="thead-light">
                                                <tr>
                                                    <th class="text-center">Fecha</th>
                                                    <th class="text-center">Razón social</th>
                                                    <th class="text-center">Tipo de factura</th>
                                                    <th class="text-center">Número de serie</th>
                                                    <th class="text-center">Total pagado</th>
                                                    <th class="text-center">Estado</th>
                                                    
                                                    <th class="text-center">Opciones</th>
                                                </tr>
                                            </thead>
                                            @foreach ($venta as $item)
                                                <tbody>
                                                    <tr>
                                                        <td class="text-center">{{$item->fecha}}</td>
                                                        <td class="text-center">{{$item->razon_social}}</td>
                                                        <td class="text-center">{{$item->tipo_factura}}</td>
                                                        <td class="text-center">{{str_pad($item->serie,3,'0',STR_PAD_LEFT)}}-{{str_pad($item->correlativo,7,'0',STR_PAD_LEFT)}}</td>
                                                        <td class="text-center">{{$config->prefijo_moneda}}{{$item->total_pagar}}</td>
                                                        <td class="text-center">
                                                            @if ($item->estado == 'Procesado')
                                                                <span class="badge badge-primary">Procesado</span>
                                                            @else
                                                                <span class="badge badge-danger">Cancelado</span>
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
                                                                    <a class="dropdown-item" data-toggle="modal" data-target="#data-{{$item->id}}">
                                                                        <svg class="c-icon" style="max-width: 64px">
                                                                            <use xlink:href="/sprites/brand.svg#cib-libreoffice">
                                                                                <svg id="cib-libreoffice" viewBox="0 0 32 32">
                                                                                    <path d="M21.818 0c-0.318-0.005-0.609 0.177-0.74 0.469-0.12 0.292-0.052 0.625 0.172 0.849l6.646 6.661c0.224 0.219 0.557 0.286 0.849 0.177 0.286-0.12 0.474-0.396 0.484-0.708v-6.677c-0.021-0.422-0.359-0.76-0.781-0.771zM3.547 0c-0.427 0.005-0.776 0.354-0.776 0.786v30.427c0 0.432 0.349 0.781 0.776 0.786h24.896c0.432 0 0.786-0.354 0.786-0.786v-19.594c0-0.208-0.083-0.411-0.229-0.557l-10.766-10.818c-0.151-0.156-0.349-0.24-0.563-0.245zM4.333 1.578h13.005l10.313 10.359v18.484h-23.318z"></path>
                                                                                  </svg>
                                                                            </use>
                                                                        </svg>
                                                                        &nbsp;Ver detalles</a>
                                                                        
                                                                    <a class="dropdown-item" href="{{route('factura.venta',$item->id)}}" target="_blank">
                                                                        <svg class="c-icon" style="max-width: 64px">
                                                                            <use xlink:href="/sprites/linear.svg#cil-clipboard">
                                                                                <svg id="cil-clipboard" viewBox="0 0 512 512">
                                                                                    <path d="M432,56H376V88h48V464H88V88h48V56H80A24.0275,24.0275,0,0,0,56,80V472a24.0275,24.0275,0,0,0,24,24H432a24.0275,24.0275,0,0,0,24-24V80A24.0275,24.0275,0,0,0,432,56Z" class="cls-1"></path>  <path d="M192,140H320a24.0275,24.0275,0,0,0,24-24V16H168V116A24.0275,24.0275,0,0,0,192,140Zm8-92H312v60H200Z" class="cls-1"></path>
                                                                                </svg>
                                                                            </use>
                                                                            </svg>
                                                                         &nbsp;Factura física</a>

                                                                         <a class="dropdown-item" href="{{route('detalles.venta',$item->id)}}">
                                                                            <svg class="c-icon" style="max-width: 64px">
                                                                                <use xlink:href="/sprites/linear.svg#cil-description">
                                                                                    <svg id="cil-description" viewBox="0 0 512 512">
                                                                                        <path d="M334.627,16H48V496H472V153.3726ZM440,166.6274V168H320V48h1.373ZM80,464V48H288V200H440V464Z" class="cls-1"></path>  <rect width="224" height="32" x="136" y="296" class="cls-1"></rect>  <rect width="224" height="32" x="136" y="376" class="cls-1"></rect>
                                                                                    </svg>
                                                                                </use>
                                                                            </svg>
                                                                             &nbsp;Factura por email</a>

                                                                            @if ($item->estado=='Procesado')
                                                                                <a class="dropdown-item" data-toggle="modal" data-target="#modal-{{$item->id}}">
                                                                                    <svg class="c-icon" style="max-width: 64px">
                                                                                        <use xlink:href="/sprites/linear.svg#cil-x-circle">
                                                                                            <svg id="cil-x-circle" viewBox="0 0 512 512">
                                                                                                <polygon points="348.071 141.302 260.308 229.065 172.545 141.302 149.917 163.929 237.681 251.692 149.917 339.456 172.545 362.083 260.308 274.32 348.071 362.083 370.699 339.456 282.935 251.692 370.699 163.929 348.071 141.302" class="cls-1"></polygon>  <path d="M425.7056,86.2939A240,240,0,0,0,86.2944,425.7061,240,240,0,0,0,425.7056,86.2939ZM256,464C141.3086,464,48,370.6914,48,256S141.3086,48,256,48s208,93.3086,208,208S370.6914,464,256,464Z" class="cls-1"></path>
                                                                                            </svg>
                                                                                        </use>
                                                                                    </svg>
                                                                                    &nbsp;Cancelar venta</a>
                                                                             @endif
                                                                </div>
                                                                @include('ventas.cancelar')
                                                                <!--DETALLES--------------------------->
                                                                <div class="modal fade" id="data-{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                                                                    <div class="modal-dialog" role="document" style="max-width: 800px">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <h5 class="modal-title" id="exampleModalLongTitle">Venta: {{str_pad($item->serie,3,'0',STR_PAD_LEFT)}}-{{str_pad($item->correlativo,7,'0',STR_PAD_LEFT)}}</h5>
                                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="padding:0px">
                                                                                                                                                                                                                        <span aria-hidden="true">&times;</span>
                                                                                                                                                                                                                    </button>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                <?php
                                                                                
                                                                                $user = DB::table('users')
                                                                                ->where('id','=',$item->iduser)
                                                                                ->first();

                                                                                $detalle_venta = DB::table('detalleventa as d')
                                                                                ->join('producto as p','d.idproducto','=','p.id')
                                                                                ->select('p.titulo','d.cantidad','d.precio_venta')
                                                                                ->where('idventa','=',$item->id)
                                                                                ->get();
                                                                                
                                                                                ?>
                                                                                <div class="row">
                                                                                    <div class="col-lg-12">
                                                                                        <table style="width: 100%">
                                                                                            <tr>
                                                                                                <th><b>Razón social:</b></th>
                                                                                                <td>{{$item->razon_social}}</td>

                                                                                                <th><b>Tipo facturación:</b></th>
                                                                                                <td>{{$item->tipo_factura}}</td>

                                                                                                <th><b>Razón social:</b></th>
                                                                                                <td>{{$item->razon_social}}</td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <th><b>Fecha y fecha:</b></th>
                                                                                                <td>{{$item->fecha}} {{$item->hora}}</td>

                                                                                                <th><b>Vendedor:</b></th>
                                                                                                <td>{{$user->name}}</td>

                                                                                                <th><b>Total pagado:</b></th>
                                                                                                <td>{{$config->prefijo_moneda}}{{$item->total_pagar}}</td>
                                                                                            </tr>
                                                                                            
                                                                                        </table>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <table class="table table-responsive-sm table-hover table-outline mb-0 table-sm">
                                                                                <thead class="thead-light">
                                                                                    <tr>
                                                                                        <th class="text-center">Producto</th>
                                                                                        <th class="text-center">Cantidad</th>
                                                                                        <th class="text-center">Precio</th>
                                                                                        <th class="text-center">Subtotal</th>
                                                                                    </tr>
                                                                                </thead>
                                                                                @foreach ($detalle_venta as $row)
                                                                                    <tbody>
                                                                                        <tr>
                                                                                            <td>{{$row->titulo}}</td>
                                                                                            <td>{{$row->cantidad}}</td>
                                                                                            <td>{{$config->prefijo_moneda}}{{$row->precio_venta}}</td>
                                                                                            <td><?php echo $config->prefijo_moneda; echo $row->precio_venta * $row->cantidad?></td>
                                                                                        </tr>
                                                                                    </tbody>
                                                                                @endforeach
                                                                                <tfoot class="thead-light">
                                                                                    <th colspan="3">
                                                                                        <b>Total:</b>
                                                                                    </th>
                                                                                    <th>{{$config->prefijo_moneda}}{{$item->total_pagar}}</th>
                                                                                </tfoot>
                                                                            </table>
                                                                            <div class="modal-footer">
                                                                
                                                                                <button type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!--DETALLES--------------------------->
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            @endforeach
                                        </table>
                                        
                                        <div class="row mt-4">
                                            {{$venta->render()}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <span>Solos nos usuarios que abrieron caja la pueden cerrar.</span>
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
       
        /*PAGINACION*/
        $(document).on("click", ".pagination a", function(e) {
            e.preventDefault();
            var page = $(this).attr('href').split('page=')[1];
            var route = "{{route('open_gistorial.venta')}}";
            
            $.ajax({
                url: route,
                data: {page: page},
                type: 'GET',
                dataType: 'json',
                success: function(data){
                    $('.ventas').html(data);
                    
                }

            })
        });
    </script>
@endpush
@endsection