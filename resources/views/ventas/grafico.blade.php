@extends('layouts.admin')
@section('contenido')
<div class="c-subheader justify-content-between px-3">

    <ol class="breadcrumb border-0 m-0 px-0 px-md-3">
        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{route('open_gistorial.venta')}}">Ventas</a></li>
        <li class="breadcrumb-item active"><a>Rendimiento</a></li>
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
                    <div class="col-lg-8">
                        <div class="row">
                            <div class="col-lg-12 form-group">
                                <div class="card">
                                    <div class="card-header centrar">
                                        <svg class="c-icon" style="max-width: 64px;margin-top:0px">
                                            <use xlink:href="/sprites/linear.svg#cil-bar-chart">
                                                <svg id="cil-bar-chart" viewBox="0 0 512 512">
                                                    <path d="M136,416h88a24.0275,24.0275,0,0,0,24-24V184a24.0275,24.0275,0,0,0-24-24H136a24.0275,24.0275,0,0,0-24,24V392A24.0275,24.0275,0,0,0,136,416Zm8-224h72V384H144Z" class="cls-1"></path>  <path d="M424,16H336a24.0275,24.0275,0,0,0-24,24V392a24.0275,24.0275,0,0,0,24,24h88a24.0275,24.0275,0,0,0,24-24V40A24.0275,24.0275,0,0,0,424,16Zm-8,368H344V48h72Z" class="cls-1"></path>  <polygon points="48 16 16 16 16 496 496 496 496 464 48 464 48 16" class="cls-1"></polygon>
                                                </svg>
                                            </use>
                                        </svg> &nbsp;
                                        Estadisticas de ganancias mensuales al año - {{$current_year}}
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
                                   
                                </div>
                            </div>
                            <div class="col-lg-12 form-group">
                                <div class="card">
                                    <div class="card-header centrar">
                                        <svg class="c-icon" style="max-width: 64px;margin-top:0px">
                                            <use xlink:href="/sprites/linear.svg#cil-bar-chart">
                                                <svg id="cil-bar-chart" viewBox="0 0 512 512">
                                                    <path d="M136,416h88a24.0275,24.0275,0,0,0,24-24V184a24.0275,24.0275,0,0,0-24-24H136a24.0275,24.0275,0,0,0-24,24V392A24.0275,24.0275,0,0,0,136,416Zm8-224h72V384H144Z" class="cls-1"></path>  <path d="M424,16H336a24.0275,24.0275,0,0,0-24,24V392a24.0275,24.0275,0,0,0,24,24h88a24.0275,24.0275,0,0,0,24-24V40A24.0275,24.0275,0,0,0,424,16Zm-8,368H344V48h72Z" class="cls-1"></path>  <polygon points="48 16 16 16 16 496 496 496 496 464 48 464 48 16" class="cls-1"></polygon>
                                                </svg>
                                            </use>
                                        </svg> &nbsp;
                                        Estadisticas de ventas y cancelaciones del año - {{$current_year}}
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
                                            <canvas id="canvas-5" width="378" height="188" class="chartjs-render-monitor" style="display: block; height: 151px; width: 303px;"></canvas>
                                        </div>
                                    </div>
                                </div>
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
                                <h3 class="text-center">Ganancia total: {{$venta_total->monto}} {{$config->currency}}</h3>
                            </div>
                            <div class="card-footer">
                                {!! Form::open(array('url'=>'panel/ganancias/mensual','method'=>'GET','autocomplete'=>'off','role'=>'search'))!!}
                                            <div class="row">
                                                <div class="col-lg-5">
                                                    Filtrar año
                                                    <select class="mdb-select md-form colorful-select dropdown-primary" name="year">
                                                        <option value="2020">2020</option>
                
                                                    </select>
                                                    
                                                </div>
                                                <div class="col-lg-6 centrar">
                                                    <button class="btn btn-primary btn-sm btn-block">Filtrar</button>
                                                </div>
                                            </div>
                                {{Form::close()}}
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


        /************************************************************/


        
var base = ["<?php echo $caja_1->monto?>","<?php echo $caja_2->monto?>","<?php echo $caja_3->monto?>","<?php echo $caja_4->monto?>","<?php echo $caja_5->monto?>","<?php echo $caja_6->monto?>","<?php echo $caja_7->monto?>","<?php echo $caja_8->monto?>","<?php echo $caja_9->monto?>","<?php echo $caja_10->monto?>","<?php echo $caja_11->monto?>","<?php echo $caja_12->monto?>"];

   


    var lineChart=new Chart(document.getElementById('canvas-1'), {
        type:'line', data: {
            labels:['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'], datasets:[ {
                label: 'Ganancia mensual', backgroundColor: '#8AB2FFba', borderColor: '#124AB7', pointBackgroundColor: '#8AB2FF', pointBorderColor: '#fff', data:  base
            }
            
            ]
        }
        , options: {
            responsive: true
        }
    }

    );

    /**************************************************************************/




var data_pie = ["<?php echo count($venta_can)?>","<?php echo count($venta_pro)?>"];

var pieChart=new Chart(document.getElementById('canvas-5'), {
    type:'pie', data: {
        labels:['Canceladas', 'Procesados'], datasets:[ {
            data: data_pie, backgroundColor: ['#FF6384', '#36A2EB'], hoverBackgroundColor: ['#FF6384', '#36A2EB']
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