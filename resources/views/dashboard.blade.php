@extends('layouts.admin')
@section('contenido')
<div class="c-subheader justify-content-between px-3">

    <ol class="breadcrumb border-0 m-0 px-0 px-md-3">
        <li class="breadcrumb-item active">Dashboard</li>

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
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card-group mb-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="text-muted text-right mb-4">
                                        <svg class="c-icon c-icon-2xl" style="max-width: 64px">
                                            <use xlink:href="/sprites/linear.svg#cil-dollar">
                                                <svg id="cil-dollar" viewBox="0 0 512 512">
                                                    <path fill="currentColor" d="M296,240H216a46.2222,46.2222,0,1,1,0-92.4443H344v-32H276V56H244v59.5557H216A78.2222,78.2222,0,1,0,216,272h80a46.2747,46.2747,0,0,1,46.2222,46.2217v3.5566A46.2747,46.2747,0,0,1,296,368H160.5928v32H244v56h32V400h20a78.31,78.31,0,0,0,78.2222-78.2217v-3.5566A78.31,78.31,0,0,0,296,240Z"></path>
                                                  </svg>
                                            </use>
                                        </svg>
                                    </div>
                                    <div class="text-value-lg">{{$config->prefijo_moneda}}{{$total_pagado->monto}}</div><small class="text-muted text-uppercase font-weight-bold">Total ganado</small>
                                    <div class="progress progress-xs mt-3 mb-0">
                                        <div class="progress-bar bg-gradient-info" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-body">
                                    <div class="text-muted text-right mb-4">
                                        <svg class="c-icon c-icon-2xl">
                                            <use xlink:href="/sprites/linear.svg#cil-calendar-check">
                                                <svg id="cil-calendar-check" viewBox="0 0 512 512">
                                                    <path d="M472,96H384V40H352V96H160V40H128V96H40a24.0275,24.0275,0,0,0-24,24V456a24.0275,24.0275,0,0,0,24,24H472a24.0275,24.0275,0,0,0,24-24V120A24.0275,24.0275,0,0,0,472,96Zm-8,352H48V128h80v40h32V128H352v40h32V128h80Z" class="cls-1"></path>  <polygon points="243.397 313.373 189.012 258.988 166.385 281.616 243.397 358.627 369.012 233.012 346.384 210.385 243.397 313.373" class="cls-1"></polygon>
                                                </svg>
                                            </use>
                                        </svg>
                                    </div>
                                    <div class="text-value-lg">
                                        @if ($total_mes->monto == null)
                                        {{$config->prefijo_moneda}} 0.0
                                        @else
                                        {{$config->prefijo_moneda}}{{$total_mes->monto}}
                                        @endif
                                        </div><small class="text-muted text-uppercase font-weight-bold">Total {{$mes_actual}}</small>
                                    <div class="progress progress-xs mt-3 mb-0">
                                        <div class="progress-bar bg-gradient-success" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-body">
                                    <div class="text-muted text-right mb-4">
                                        <svg class="c-icon c-icon-2xl">
                                            <use xlink:href="/sprites/linear.svg#cil-home">
                                                <svg id="cil-home" viewBox="0 0 512 512">
                                                    <path fill="currentColor" d="M469.6659,216.45,271.0778,33.749a34.0007,34.0007,0,0,0-47.0618.98L41.3726,217.3726,32,226.7451V496H208V328h96V496H480V225.9576ZM448,464H336V328a32,32,0,0,0-32-32H208a32,32,0,0,0-32,32V464H64V240L246.6435,57.3564a2.0006,2.0006,0,0,1,2.7684-.0577L448,240Z"></path>
                                                  </svg>
                                            </use>
                                        </svg>
                                    </div>
                                    <div class="text-value-lg">{{count($productos)}}</div><small class="text-muted text-uppercase font-weight-bold">Productos</small>
                                    <div class="progress progress-xs mt-3 mb-0">
                                        <div class="progress-bar bg-gradient-warning" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-body">
                                    <div class="text-muted text-right mb-4">
                                        <svg class="c-icon c-icon-2xl">
                                            <use xlink:href="/sprites/linear.svg#cil-user">
                                                <svg id="cil-user" viewBox="0 0 512 512">
                                                    <path fill="currentColor" d="M411.6,343.6563l-72.8223-47.334,27.4551-50.334A80.2394,80.2394,0,0,0,376,207.6807V128a112,112,0,0,0-224,0v79.6807a80.2376,80.2376,0,0,0,9.7681,38.3081l27.4546,50.3335-72.8213,47.334A79.7236,79.7236,0,0,0,80,410.7319V496H448V410.7319A79.7257,79.7257,0,0,0,411.6,343.6563ZM416,464H112V410.7319a47.8355,47.8355,0,0,1,21.8408-40.2456l97.6607-63.48-41.64-76.3408A48.1439,48.1439,0,0,1,184,207.6807V128a80,80,0,0,1,160,0v79.6807a48.1457,48.1457,0,0,1-5.8608,22.9848L296.498,307.0068l97.6617,63.48h0A47.8345,47.8345,0,0,1,416,410.7319Z"></path>
                                                  </svg>
                                            </use>
                                        </svg>
                                    </div>
                                    <div class="text-value-lg">{{count($usuarios)}}</div><small class="text-muted text-uppercase font-weight-bold">Trabajadores</small>
                                    <div class="progress progress-xs mt-3 mb-0">
                                        <div class="progress-bar" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-body">
                                    <div class="text-muted text-right mb-4">
                                        <svg class="c-icon c-icon-2xl">
                        <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-speedometer"></use>
                        </svg>
                                    </div>
                                    <div class="text-value-lg">5:34:11</div><small class="text-muted text-uppercase font-weight-bold">Avg. Time</small>
                                    <div class="progress progress-xs mt-3 mb-0">
                                        <div class="progress-bar bg-gradient-danger" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-5">
                        <div class="card">
                            <div class="card-header"  style="background: #e02b2b !important; color: white !important">
                                ALERTA DE STOCK
                            </div>
                            <div class="table-wrapper-scroll-y my-custom-scrollbar">
                                <table class="table table-responsive-sm table-hover table-outline mb-0 table-sm">
                                    <thead class="thead-light">
                                        <tr>
                                            <th class="text-center">
                                                Producto
                                            </th>
                                            <th class="text-center">Stock</th>
                                            
                                        </tr>
                                    </thead>
                                    @foreach ($stock as $item)
                                        <tr>
                                            <td class="text-center">{{substr($item->titulo,0,35)}}..</td>
                                            <td class="text-center"><span class="badge badge-danger"><b>{{$item->cantidad}}</b></span></td>
                                        </tr>
                                    @endforeach
                               </table>
                           </div>
                        </div>
                    </div>
                    <div class="col-lg-7">
                        <div class="card">
                            <div class="card-header"> Notificaciónes<small> banners</small></div>
                            <div class="card-body">
                                <div class="carousel slide" id="carouselExampleIndicators" data-ride="carousel">
                                    <ol class="carousel-indicators">
                                        <li class="active" data-target="#carouselExampleIndicators" data-slide-to="0"></li>
                                        <li data-target="#carouselExampleIndicators" data-slide-to="1" class=""></li>
                                        <li data-target="#carouselExampleIndicators" data-slide-to="2" class=""></li>
                                    </ol>
                                    <div class="carousel-inner">
                                        @foreach ($banner as $key => $item)
                                            @if ($key == 0)
                                                <div class="carousel-item active"><img class="d-block w-100" data-src="holder.js/800x400?auto=yes&amp;bg=777&amp;fg=555&amp;text=First slide" alt="First slide [800x400]" src="{{asset('banners/'.$item->imagen)}}"
                                                data-holder-rendered="true"></div>
                                            @elseif($key != 0)
                                            <div class="carousel-item"><img class="d-block w-100" data-src="holder.js/800x400?auto=yes&amp;bg=777&amp;fg=555&amp;text=First slide" alt="First slide [800x400]" src="{{asset('banners/'.$item->imagen)}}"
                                                data-holder-rendered="true"></div>
                                            @endif
                                        @endforeach
                                        
                                    </div><a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev"><span class="carousel-control-prev-icon" aria-hidden="true"></span><span class="sr-only">Previous</span></a><a class="carousel-control-next"
                                        href="#carouselExampleIndicators" role="button" data-slide="next"><span class="carousel-control-next-icon" aria-hidden="true"></span><span class="sr-only">Next</span></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    
    <style>
        .my-custom-scrollbar {
            position: relative;
            height: 370px;
            overflow: auto;
        }
        .table-wrapper-scroll-y {
            display: block;
        }
    </style>
</div>
@push('scripts')
<script></script>
@endpush
@endsection