@extends('layouts.admin')
@section('contenido')
<div class="c-subheader justify-content-between px-3">

    <ol class="breadcrumb border-0 m-0 px-0 px-md-3">
        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
        <li class="breadcrumb-item active"><a>Configuracion general</a></li>

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
               <div class="row" id="contenido" style="display: none">
                    <div class="row">
                        @if(Session::has('success'))
                        <div class="col-lg-10">
                            <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
                                {{Session::get('success')}}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        </div>
                    @endif 
                    @if(Session::has('dander'))
                        <div class="col-lg-10">
                            <div class="alert alert-dander alert-dismissible fade show mb-4" role="alert">
                                {{Session::get('dander')}}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        </div>
                    @endif 
                   <div class="col-lg-10">
                       <div class="card">
                       
                           <div class="card-body">
                               {{-- FORMULARIO DE CONFIG --}}
                               <form action="{{route('editar_config.config',1)}}" method="POST">
                                @csrf
                                @method('PATCH')
                                    <div class="row form-group">
                                        <div class="col-lg-6">
                                            <h5>Número de serie</h5>
                                            <span class="text-muted">Secuancia de la serie y correlativo.</span>
                                            @if ($errors->has('serie'))
                                                <span class="invalid-feedback" role="alert" style="display:block">
                                                    <strong>ERROR: {{ $errors->first('serie') }}</strong>
                                                </span>
                                            @endif
                                            @if ($errors->has('correlativo'))
                                                <span class="invalid-feedback" role="alert" style="display:block">
                                                    <strong>ERROR: {{ $errors->first('correlativo') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="row">
                                                <div class="col-lg-3">
                                                    <input type="text" name="serie" class="form-control" value="{{str_pad($config->serie,3,'0',STR_PAD_LEFT)}}">
                                                </div>
                                                <div class="col-lg-5">
                                                    <input type="text" name="correlativo" class="form-control" value="{{str_pad($config->correlativo,7,'0',STR_PAD_LEFT)}}">
                                                </div>
                                                
                                            </div>
                                        </div>
                                    </div>
                                
                                    <div class="row form-group">
                                        <div class="col-lg-6">
                                            <h5>Nombre del sistema</h5>
                                            <span class="text-muted">Nombre para el sistema, esto apareccerá en una parte de la factura.</span>
                                            @if ($errors->has('titulo'))
                                                <span class="invalid-feedback" role="alert" style="display:block">
                                                    <strong>ERROR: {{ $errors->first('titulo') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        <div class="col-lg-6">
                                            <input type="text" class="form-control" name="titulo" value="{{$config->titulo}}">
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                            <div class="col-lg-6">
                                                <h5>Logo de la empresa</h5>
                                                <span class="text-muted">Este logo es el perteneciente a la emmpresa y aparecerá en la factura.</span>
                                                @if ($errors->has('logo'))
                                                    <span class="invalid-feedback" role="alert" style="display:block">
                                                        <strong>ERROR: {{ $errors->first('logo') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="file-upload-wrapper">
                                                    <input type="file" id="input-file-now-custom-1" name="logo" class="file-upload" data-default-file="{{asset('img/'.$config->logo)}}" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                                <div class="col-lg-6">
                                                    <h5>Denomicaciones</h5>
                                                    <span class="text-muted">Monedas y billetes por denomicación para el arqueo de caja.</span>
                                                    @if ($errors->has('denominaciones'))
                                                        <span class="invalid-feedback" role="alert" style="display:block">
                                                            <strong>ERROR: {{ $errors->first('denominaciones') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                                <div class="col-lg-6">
                                                    <textarea name="denomicaciones" class="form-control" style="height:200px">{{($config->denomicaciones)}}</textarea>
                                                </div>
                                        </div>
                                        <div class="row form-group">
                                                <div class="col-lg-6">
                                                    <h5>Marcas</h5>
                                                    <span class="text-muted">Listado de marcas, sirven para poder registrar los productos.</span>
                                                    @if ($errors->has('marcas'))
                                                        <span class="invalid-feedback" role="alert" style="display:block">
                                                            <strong>ERROR: {{ $errors->first('marcas') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                                <div class="col-lg-6">
                                                    <textarea name="marcas" class="form-control" style="height:200px">{{$config->marcas}}</textarea>
                                                </div>
                                        </div>
                                    <div class="row form-group">
                                            <div class="col-lg-6">
                                                <h5>Categorías</h5>
                                                <span class="text-muted">Listado de categorias, para definir el tipo de producto.</span>
                                                @if ($errors->has('categorias'))
                                                    <span class="invalid-feedback" role="alert" style="display:block">
                                                        <strong>ERROR: {{ $errors->first('categorias') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                            <div class="col-lg-6">
                                                <textarea name="categorias" class="form-control" style="height:200px">{{$config->categorias}}</textarea>
                                            </div>
                                    </div>
                                    <div class="row form-group">
                                            <div class="col-lg-6">
                                                <h5>Presentaciones</h5>
                                                <span class="text-muted">Listado de presentaciones, para definir la unidad de producto.</span>
                                                @if ($errors->has('presentaciones'))
                                                    <span class="invalid-feedback" role="alert" style="display:block">
                                                        <strong>ERROR: {{ $errors->first('presentaciones') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                            <div class="col-lg-6">
                                                <textarea name="presentaciones" class="form-control" style="height:200px">{{$config->presentaciones}}</textarea>
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <div class="col-lg-6">
                                                <h5>Moneda</h5>
                                                <span class="text-muted">Nombre del tipo de moneda.</span>
                                                @if ($errors->has('moneda'))
                                                    <span class="invalid-feedback" role="alert" style="display:block">
                                                        <strong>ERROR: {{ $errors->first('moneda') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                            <div class="col-lg-6">
                                                <input type="text" class="form-control" name="tipo_moneda" value="{{$config->tipo_moneda}}">
                                            </div>
                                    </div>
                                        <div class="row form-group">
                                            <div class="col-lg-6">
                                                <h5>Currency</h5>
                                                <span class="text-muted">Denominación del tipo de moneda.</span>
                                                @if ($errors->has('currency'))
                                                    <span class="invalid-feedback" role="alert" style="display:block">
                                                        <strong>ERROR: {{ $errors->first('currency') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                            <div class="col-lg-6">
                                                <input type="text" class="form-control" name="currency" value="{{$config->currency}}">
                                            </div>
                                    </div>
                                    <div class="row form-group">
                                            <div class="col-lg-6">
                                                <h5>Prefijo de moneda</h5>
                                                <span class="text-muted">Simbolo de la moneda.</span>
                                                @if ($errors->has('prefijo_moneda'))
                                                    <span class="invalid-feedback" role="alert" style="display:block">
                                                        <strong>ERROR: {{ $errors->first('prefijo_moneda') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                            <div class="col-lg-6">
                                                <input type="text" class="form-control" name="prefijo_moneda" value="{{$config->prefijo_moneda}}">
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <div class="col-lg-6">
                                                <h5>Cajas disponibles</h5>
                                                <span class="text-muted">Todas las cajas disponibles para las ventas.</span>
                                                @if ($errors->has('cajas'))
                                                    <span class="invalid-feedback" role="alert" style="display:block">
                                                        <strong>ERROR: {{ $errors->first('cajas') }}</strong>
                                                    </span>
                                                @endif
                                                </div>
                                            <div class="col-lg-6">
                                                <textarea name="cajas" class="form-control" style="height:200px">{{$config->cajas}}</textarea>
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <div class="col-lg-6">
                                                <h5>IGV</h5>
                                                <span class="text-muted">Impuesto general a la venta, se calcula automaticamente en el precio de los productos.</span>
                                                @if ($errors->has('igv'))
                                                    <span class="invalid-feedback" role="alert" style="display:block">
                                                        <strong>ERROR: {{ $errors->first('igv') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                            <div class="col-lg-6">
                                                <input name="igv" type="number" class="form-control" value="{{$config->igv}}">
                                            </div>
                                        </div>
                                </div>
                                <div class="card-footer">
                                    <button class="btn btn-primary" type="submit">Guardar cambios</button>
                                </div>
                            </form>
                            {{-- FORMULARIO DE CONFIG --}}
                       </div>
                   </div>
                    </div>
               </div>
            </div>
        </div>
    </main>
    <style>
        #invoice{
            padding: 30px;
        }

        .invoice {
            position: relative;
            background-color: #FFF;
            min-height: 680px;
            padding: 15px
        }

        .invoice header {
            padding: 10px 0;
            margin-bottom: 20px;
            border-bottom: 1px solid #3989c6
        }

        .invoice .company-details {
            text-align: right
        }

        .invoice .company-details .name {
            margin-top: 0;
            margin-bottom: 0
        }

        .invoice .contacts {
            margin-bottom: 20px
        }

        .invoice .invoice-to {
            text-align: left
        }

        .invoice .invoice-to .to {
            margin-top: 0;
            margin-bottom: 0
        }

        .invoice .invoice-details {
            text-align: right
        }

        .invoice .invoice-details .invoice-id {
            margin-top: 0;
            color: #3989c6
        }

        .invoice main {
            padding-bottom: 50px
        }

        .invoice main .thanks {
            margin-top: -100px;
            font-size: 2em;
            margin-bottom: 50px
        }

        .invoice main .notices {
            padding-left: 6px;
            border-left: 6px solid #3989c6
        }

        .invoice main .notices .notice {
            font-size: 1.2em
        }

        .invoice table {
            width: 100%;
            border-collapse: collapse;
            border-spacing: 0;
            margin-bottom: 20px
        }

        .invoice table td,.invoice table th {
            padding: 15px;
            background: #eee;
            border-bottom: 1px solid #fff
        }

        .invoice table th {
            white-space: nowrap;
            font-weight: 400;
            font-size: 16px
        }

        .invoice table td h3 {
            margin: 0;
            font-weight: 400;
            color: #3989c6;
            font-size: 1.2em
        }

        .invoice table .qty,.invoice table .total,.invoice table .unit {
            text-align: right;
            font-size: 1.2em
        }

        .invoice table .no {
            color: #fff;
            font-size: 1.6em;
            background: #3989c6
        }

        .invoice table .unit {
            background: #ddd
        }

        .invoice table .total {
            background: #3989c6;
            color: #fff
        }

        .invoice table tbody tr:last-child td {
            border: none
        }

        .invoice table tfoot td {
            background: 0 0;
            border-bottom: none;
            white-space: nowrap;
            text-align: right;
            padding: 10px 20px;
            font-size: 1.2em;
            border-top: 1px solid #aaa
        }

        .invoice table tfoot tr:first-child td {
            border-top: none
        }

        .invoice table tfoot tr:last-child td {
            color: #3989c6;
            font-size: 1.4em;
            border-top: 1px solid #3989c6
        }

        .invoice table tfoot tr td:first-child {
            border: none
        }

        .invoice footer {
            width: 100%;
            text-align: center;
            color: #777;
            border-top: 1px solid #aaa;
            padding: 8px 0
        }

        @media print {
            .invoice {
                font-size: 11px!important;
                overflow: hidden!important
            }

            .invoice footer {
                position: absolute;
                bottom: 10px;
                page-break-after: always
            }

            .invoice>div:last-child {
                page-break-before: always
            }
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
    $('.file-upload').file_upload();
</script>
@endpush
@endsection