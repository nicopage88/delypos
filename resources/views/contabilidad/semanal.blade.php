@extends('layouts.admin')
@section('contenido')
<div class="c-subheader justify-content-between px-3">

    <ol class="breadcrumb border-0 m-0 px-0 px-md-3">
        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{route('index.contabilidad')}}">Caja</a></li>
        <li class="breadcrumb-item active"><a>Ganancias semanales</a></li>
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
                        <div class="col-lg-8">
                            <div class="card">
                                <div class="card-header centrar">
                                    <svg class="c-icon" style="max-width: 64px;margin-top:0px">
                                        <use xlink:href="/sprites/linear.svg#cil-bar-chart">
                                            <svg id="cil-bar-chart" viewBox="0 0 512 512">
                                                <path d="M136,416h88a24.0275,24.0275,0,0,0,24-24V184a24.0275,24.0275,0,0,0-24-24H136a24.0275,24.0275,0,0,0-24,24V392A24.0275,24.0275,0,0,0,136,416Zm8-224h72V384H144Z" class="cls-1"></path>  <path d="M424,16H336a24.0275,24.0275,0,0,0-24,24V392a24.0275,24.0275,0,0,0,24,24h88a24.0275,24.0275,0,0,0,24-24V40A24.0275,24.0275,0,0,0,424,16Zm-8,368H344V48h72Z" class="cls-1"></path>  <polygon points="48 16 16 16 16 496 496 496 496 464 48 464 48 16" class="cls-1"></polygon>
                                            </svg>
                                        </use>
                                    </svg> &nbsp;
                                    Estadisticas de caja mensual al año - {{$current_year}}
                                    <div class="card-header-actions"></div>
                                </div>
                                <div class="card-body">
                                    <div class="c-chart-wrapper">
                                        <div class="chartjs-size-monitor">
                                            <div class="chartjs-size-monitor-expand">
                                                <div class=""></div>
                                            </div>
                                            <div class="chartjs-size-monitor-shrink">
                                                <div class=""></div>
                                            </div>
                                        </div>
                                        <canvas id="canvas-1" width="387" height="192" class="chartjs-render-monitor" style="display: block; height: 154px; width: 310px;"></canvas>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    {!! Form::open(array('url'=>'panel/ganancias/mensual','method'=>'GET','autocomplete'=>'off','role'=>'search'))!!}
                                        <div class="row">
                                            <div class="col-lg-4">
                                                Filtrar año
                                                <select class="mdb-select md-form colorful-select dropdown-primary" name="year">
                                                    <option value="2020">2020</option>
            
                                                </select>
                                                
                                            </div>
                                            <div class="col-lg-2 centrar">
                                                <button class="btn btn-primary btn-sm ">Filtrar</button>
                                            </div>
                                        </div>
                                    {{Form::close()}}
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="card">
                                <div class="card-header centrar">
                                    <svg class="c-icon" style="max-width: 64px;margin-top:0px">
                                        <use xlink:href="/sprites/linear.svg#cil-align-left">
                                            <svg id="cil-align-left" viewBox="0 0 512 512">
                                                <rect width="480" height="32" x="16" y="64" class="cls-1"></rect>  <rect width="328" height="32" x="16" y="152" class="cls-1"></rect>  <rect width="480" height="32" x="16" y="240" class="cls-1"></rect>  <rect width="328" height="32" x="16" y="328" class="cls-1"></rect>  <rect width="480" height="32" x="16" y="416" class="cls-1"></rect>
                                            </svg>
                                        </use>
                                    </svg>
                                    &nbsp;
                                    Datos
                                </div>
                                <div class="card-body">
                                    <table class="table table-responsive-sm table-hover table-outline mb-0 table-sm">
                                        <thead class="thead-dark">
                                            <th class="text-center">Dato</th>
                                            <th class="text-center">Valor</th>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>Monto base total mes anterior</td>
                                                <td class="text-center">{{$config->prefijo_moneda}}{{$caja_mes_anterior->monto}}</td>
                                            </tr>
                                            <tr>
                                                <td>Monto de cierre total mes anterior</td>
                                                <td class="text-center">{{$config->prefijo_moneda}}{{$caja_mes_anterior->monto_cierre}}</td>
                                            </tr>
                                            <tr>
                                                <td>Monto base actual</td>
                                                <td class="centrar">
                                                    @if ($caja_mes_actual->monto <= $caja_mes_anterior->monto)
                                                    <img src="{{asset('img/down.png')}}" style="width:15px">
                                                    @else
                                                    <img src="{{asset('img/up.png')}}" style="width:15px">
                                                    @endif
                                                    &nbsp;
                                                    {{$config->prefijo_moneda}}{{$caja_mes_actual->monto}}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Monto cierre actual</td>
                                                <td class="centrar">
                                                    @if ($caja_mes_actual->monto_cierre <= $caja_mes_anterior->monto_cierre)
                                                    <img src="{{asset('img/down.png')}}" style="width:15px">
                                                    @else
                                                    <img src="{{asset('img/up.png')}}" style="width:15px">
                                                    @endif
                                                    &nbsp;
                                                    {{$config->prefijo_moneda}}{{$caja_mes_actual->monto_cierre}}
                                                </td>
                                            </tr>
                                            
                                        </tbody>
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
        
    var base = ["<?php echo $caja_1->monto?>","<?php echo $caja_2->monto?>","<?php echo $caja_3->monto?>","<?php echo $caja_4->monto?>","<?php echo $caja_5->monto?>","<?php echo $caja_6->monto?>","<?php echo $caja_7->monto?>","<?php echo $caja_8->monto?>","<?php echo $caja_9->monto?>","<?php echo $caja_10->monto?>","<?php echo $caja_11->monto?>","<?php echo $caja_12->monto?>"];

    var cierre = ["<?php echo $caja_1->monto_cierre?>","<?php echo $caja_2->monto_cierre?>","<?php echo $caja_3->monto_cierre?>","<?php echo $caja_4->monto_cierre?>","<?php echo $caja_5->monto_cierre?>","<?php echo $caja_6->monto_cierre?>","<?php echo $caja_7->monto_cierre?>","<?php echo $caja_8->monto_cierre?>","<?php echo $caja_9->monto_cierre?>","<?php echo $caja_10->monto_cierre?>","<?php echo $caja_11->monto_cierre?>","<?php echo $caja_12->monto_cierre?>"];


    var lineChart=new Chart(document.getElementById('canvas-1'), {
        type:'line', data: {
            labels:['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'], datasets:[ {
                label: 'Monto base', backgroundColor: '#8AB2FFba', borderColor: '#124AB7', pointBackgroundColor: '#8AB2FF', pointBorderColor: '#fff', data:  base
            }
            , {
                label: 'Monto de cierre', backgroundColor: '#E0FFE6ba', borderColor: '#1CC63F', pointBackgroundColor: '#E0FFE6', pointBorderColor: '#fff', data: cierre
            }
            ]
        }
        , options: {
            responsive: true
        }
    }

    );

    </script>
@endpush
@endsection