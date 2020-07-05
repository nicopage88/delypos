@extends('layouts.admin')
@section('contenido')
<div class="c-subheader justify-content-between px-3">

    <ol class="breadcrumb border-0 m-0 px-0 px-md-3">
        <li class="breadcrumb-item">Dashboard</li>
        <li class="breadcrumb-item active"><a>Productos</a></li>

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

                <div class="row" id="contenido" style="display: none">
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
                    <div class="col-lg-12 col-md-12 form-group">   
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-5 form-group">
                                        <div class="row">
                                            <div class="col-md-12">
                                                {!! Form::open(array('url'=>'panel/productos','method'=>'GET','autocomplete'=>'off','role'=>'search'))!!}
                                                <div class="input-group">
                                                    <input class="form-control" id="basics" type="search" name="buscar" value="{{$buscar}}" placeholder="Titulo o código del producto" >
                                                    <span class="input-group-append">
                                                        <button class="btn btn-primary" >
                                                            <svg class="c-icon" style="margin-top: 0px;">
                                                            <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-magnifying-glass">
                                                                <svg id="cil-magnifying-glass" viewBox="0 0 24 24">
                                                                    <title>magnifying-glass</title><path d="M22.481 18.737l-3.801-3.801-2.923-1.208c0.934-1.314 1.493-2.951 1.493-4.719 0-0.003 0-0.006 0-0.009v0c0-4.549-3.701-8.25-8.25-8.25s-8.25 3.701-8.25 8.25 3.701 8.25 8.25 8.25c0.003 0 0.006 0 0.009 0 1.783 0 3.433-0.569 4.779-1.534l-0.025 0.017 1.205 2.916 3.801 3.801c0.475 0.478 1.133 0.773 1.86 0.773 1.45 0 2.625-1.175 2.625-2.625 0-0.727-0.296-1.385-0.773-1.86l-0-0zM2.25 9c0-3.722 3.028-6.75 6.75-6.75s6.75 3.028 6.75 6.75-3.028 6.75-6.75 6.75-6.75-3.028-6.75-6.75zM21.42 21.388c-0.204 0.203-0.485 0.329-0.795 0.329s-0.592-0.126-0.796-0.329l-3.589-3.589-1.12-2.711 2.711 1.12 3.589 3.589c0.203 0.204 0.329 0.485 0.329 0.795s-0.126 0.592-0.329 0.796l0-0z"></path>
                                                                </svg>
                                                            </use>
                                                            </svg>
                                                        </button>
                                                        
                                                    </span>
                                                </div>
                                                {{Form::close()}}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-7 form-group">

                                       
                                       
                                        <button class="btn btn-danger btn-ladda ladda-button" data-style="contract">
                                            <span class="ladda-label">
                                                <a href="{{route('index.producto')}}" style="color: white">Restablecer 
                                                    <svg class="c-icon" style="max-width: 64px;margin-top: 0px;">
                                                        <use xlink:href="/sprites/linear.svg#cil-backspace">
                                                            <svg id="cil-backspace" viewBox="0 0 512 512">
                                                                <polygon points="227.313 363.313 312 278.627 396.687 363.313 419.313 340.687 334.627 256 419.313 171.313 396.687 148.687 312 233.373 227.313 148.687 204.687 171.313 289.373 256 204.687 340.687 227.313 363.313" class="cls-1"></polygon>  <path d="M472,64H194.6436a24.0963,24.0963,0,0,0-17.42,7.4917L16,241.623v28.754L177.2236,440.5083A24.0963,24.0963,0,0,0,194.6436,448H472a24.0275,24.0275,0,0,0,24-24V88A24.0275,24.0275,0,0,0,472,64Zm-8,352H198.084L48,257.623v-3.246L198.084,96H464Z" class="cls-1"></path>
                                                            </svg> 
                                                        </use>
                                                    </svg>
                                                </a>
                                            </span>
                                            <span class="ladda-spinner"></span>
                                        </button>

                                        <div class="btn-group">
                                            <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Opciones 
                                                <svg class="c-icon" style="max-width: 64px;;margin-top: 0px">
                                                    <use xlink:href="/sprites/linear.svg#cil-settings">
                                                        <svg id="cil-settings" viewBox="0 0 512 512">
                                                            <path d="M245.1511,168a88,88,0,1,0,88,88A88.1,88.1,0,0,0,245.1511,168Zm0,144a56,56,0,1,1,56-56A56.0632,56.0632,0,0,1,245.1511,312Z" class="cls-1"></path>  <path d="M464.697,322.3193l-31.7695-26.1538a193.0943,193.0943,0,0,0,0-80.331l31.7695-26.1538a19.9409,19.9409,0,0,0,4.6065-25.4385l-32.6123-56.4834a19.9376,19.9376,0,0,0-24.337-8.73l-38.5615,14.4468a192.0446,192.0446,0,0,0-69.54-40.1919l-6.7627-40.57A19.9358,19.9358,0,0,0,277.7625,16H212.54a19.9357,19.9357,0,0,0-19.7275,16.7119L186.05,73.2837a192.045,192.045,0,0,0-69.54,40.1919L77.9451,99.0273a19.9366,19.9366,0,0,0-24.334,8.7305L20.9978,164.2446a19.94,19.94,0,0,0,4.61,25.4385l31.7666,26.1514a193.09,193.09,0,0,0,0,80.331l-31.77,26.1538a19.9408,19.9408,0,0,0-4.6064,25.4385l32.6123,56.4834a19.9369,19.9369,0,0,0,24.3369,8.73L116.51,398.5244a192.0436,192.0436,0,0,0,69.54,40.1919l6.7627,40.57A19.9356,19.9356,0,0,0,212.54,496h65.2227A19.9359,19.9359,0,0,0,297.49,479.2881l6.7627-40.5718a192.0432,192.0432,0,0,0,69.54-40.1919l38.5645,14.4483a19.937,19.937,0,0,0,24.334-8.73l32.6132-56.4868A19.94,19.94,0,0,0,464.697,322.3193Zm-50.6357,57.12-48.1094-18.024-7.2852,7.334a159.9528,159.9528,0,0,1-72.625,41.9727l-10.0039,2.6362L267.5964,464H222.7058l-8.4414-50.6421-10.0039-2.6362a159.9533,159.9533,0,0,1-72.625-41.9727l-7.2852-7.334L76.241,379.439,53.7947,340.5615l39.6289-32.624-2.7031-9.9722a160.8885,160.8885,0,0,1,0-83.9306l2.7031-9.9722L53.7947,171.439,76.241,132.561,124.35,150.585l7.2852-7.334a159.9533,159.9533,0,0,1,72.625-41.9727l10.0039-2.6362L222.7058,48h44.8906l8.4414,50.6421,10.0039,2.6362a159.9528,159.9528,0,0,1,72.625,41.9727l7.2852,7.334,48.1094-18.024,22.4463,38.8775-39.6289,32.624,2.7031,9.9722a160.8913,160.8913,0,0,1,0,83.9306l-2.7031,9.9722,39.6289,32.6235Z" class="cls-1"></path>
                                                        </svg>
                                                    </use>
                                                </svg>
                                            </button>
                                            <div class="dropdown-menu" x-placement="bottom-start" style="will-change: transform; margin: 0px;">
                                                <a class="dropdown-item" href="{{route('create.producto')}}">
                                                    <svg class="c-icon" style="max-width: 64px">
                                                        <use xlink:href="/sprites/linear.svg#cil-notes">
                                                            <svg id="cil-notes" viewBox="0 0 512 512">
                                                                <rect width="288" height="32" x="112" y="152" class="cls-1"></rect>  <rect width="288" height="32" x="112" y="240" class="cls-1"></rect>  <rect width="152" height="32" x="112" y="328" class="cls-1"></rect>  <path d="M32,48V464H480V48ZM448,432H64V80H448Z" class="cls-1"></path>
                                                            </svg>
                                                        </use>
                                                    </svg> &nbsp;
                                                    Registrar producto
                                                </a>
                                                <a class="dropdown-item" href="{{route('inventario.producto','lang=es')}}" target="_blank">
                                                    <svg class="c-icon" style="max-width: 64px">
                                                        <use xlink:href="/sprites/linear.svg#cil-view-module">
                                                            <svg id="cil-view-module" viewBox="0 0 512 512">
                                                                <path fill="currentColor" d="M16,64V448H496V64ZM464,240H352V96H464Zm-272,0V96H320V240Zm128,32V416H192V272ZM160,96V240H48V96ZM48,272H160V416H48ZM352,416V272H464V416Z"></path>
                                                              </svg>
                                                        </use>
                                                    </svg>
                                                    &nbsp; Imprimir inventario
                                                </a>
                                                <a class="dropdown-item" href="{{route('ingresos.producto')}}">
                                                    <svg class="c-icon" style="max-width: 64px">
                                                        <use xlink:href="/sprites/linear.svg#cil-list">
                                                            <svg id="cil-list" viewBox="0 0 512 512">
                                                                <rect width="264" height="32" x="208" y="80" class="cls-1"></rect>  <path d="M104,32a64,64,0,1,0,64,64A64.0724,64.0724,0,0,0,104,32Zm0,96a32,32,0,1,1,32-32A32.0364,32.0364,0,0,1,104,128Z" class="cls-1"></path>  <rect width="264" height="32" x="208" y="240" class="cls-1"></rect>  <path d="M104,192a64,64,0,1,0,64,64A64.0724,64.0724,0,0,0,104,192Zm0,96a32,32,0,1,1,32-32A32.0364,32.0364,0,0,1,104,288Z" class="cls-1"></path>  <rect width="264" height="32" x="208" y="400" class="cls-1"></rect>  <path d="M104,352a64,64,0,1,0,64,64A64.0724,64.0724,0,0,0,104,352Zm0,96a32,32,0,1,1,32-32A32.0364,32.0364,0,0,1,104,448Z" class="cls-1"></path>
                                                            </svg>
                                                        </use>
                                                    </svg> &nbsp;

                                                    Historial de actividad</a>
                                                <div class="dropdown-divider"></div>
                                                <a class="dropdown-item" href="{{route('imprimir_codigos.producto')}}" target="_blank">
                                                    <svg class="c-icon" style="max-width: 64px">
                                                        <use xlink:href="/sprites/linear.svg#cil-barcode">
                                                            <svg id="cil-barcode" viewBox="0 0 512 512">
                                                                <path d="M16,56V464H496V56ZM464,432H48V88H464Z" class="cls-1"></path>  <rect width="32" height="256" x="80" y="128" class="cls-1"></rect>  <rect width="32" height="192" x="144" y="128" class="cls-1"></rect>  <rect width="32" height="256" x="208" y="128" class="cls-1"></rect>  <rect width="32" height="192" x="272" y="128" class="cls-1"></rect>  <rect width="32" height="192" x="336" y="128" class="cls-1"></rect>  <rect width="32" height="256" x="400" y="128" class="cls-1"></rect>  <rect width="32" height="32" x="144" y="352" class="cls-1"></rect>  <rect width="32" height="32" x="272" y="352" class="cls-1"></rect>  <rect width="32" height="32" x="336" y="352" class="cls-1"></rect>
                                                            </svg>
                                                        </use>
                                                    </svg>
                                                    &nbsp;
                                                    Imprimir códigos
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 mt-4">
                                        <div class="row productos">
                                            @foreach ($productos as $item)
                                                <div class="col-lg-3 form-group">
                                                    <div class="card material-tooltip-main" data-toggle="tooltip"
                                                    data-placement="right" title="{{$item->titulo}}">
                                                        <img src="{{asset('poster/'.$item->poster)}}" style="width:100%">
                                                        <div class="card-footer text-right">
                                                            <div class="btn-group">
                                                                <button class="btn btn-transparent dropdown-toggle p-0" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color: #797979 !important;box-shadow: none !important;">
                                                                    <svg class="c-icon">
                                                                        <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-settings">
                                                                            <svg id="cil-settings" viewBox="0 0 24 24">
                                                                                <title>settings</title><path d="M11.491 7.875c-2.278 0-4.125 1.847-4.125 4.125s1.847 4.125 4.125 4.125c2.278 0 4.125-1.847 4.125-4.125v0c-0.003-2.277-1.848-4.122-4.125-4.125h-0zM11.491 14.625c-1.45 0-2.625-1.175-2.625-2.625s1.175-2.625 2.625-2.625c1.45 0 2.625 1.175 2.625 2.625v0c-0.002 1.449-1.176 2.623-2.625 2.625h-0z"></path><path d="M21.783 15.109l-1.489-1.226c0.126-0.566 0.198-1.216 0.198-1.883s-0.072-1.317-0.209-1.943l0.011 0.060 1.489-1.226c0.21-0.173 0.342-0.432 0.342-0.723 0-0.173-0.047-0.335-0.129-0.474l0.002 0.004-1.529-2.648c-0.164-0.283-0.466-0.469-0.811-0.469-0.119 0-0.232 0.022-0.337 0.062l0.006-0.002-1.808 0.677c-0.908-0.823-1.996-1.467-3.196-1.866l-0.064-0.018-0.317-1.902c-0.075-0.447-0.459-0.783-0.922-0.783-0.001 0-0.002 0-0.003 0h-3.057c-0.001 0-0.002 0-0.003 0-0.463 0-0.847 0.336-0.921 0.778l-0.001 0.005-0.317 1.902c-1.263 0.417-2.351 1.061-3.267 1.891l0.008-0.007-1.808-0.677c-0.098-0.038-0.211-0.060-0.33-0.060-0.345 0-0.646 0.187-0.808 0.465l-0.002 0.004-1.529 2.648c-0.079 0.135-0.126 0.296-0.126 0.469 0 0.291 0.133 0.55 0.341 0.722l0.002 0.001 1.489 1.226c-0.126 0.566-0.198 1.216-0.198 1.883s0.072 1.317 0.209 1.943l-0.011-0.060-1.489 1.226c-0.21 0.173-0.342 0.432-0.342 0.723 0 0.173 0.047 0.335 0.129 0.474l-0.002-0.004 1.529 2.648c0.164 0.283 0.466 0.47 0.811 0.47 0.119 0 0.232-0.022 0.337-0.062l-0.006 0.002 1.808-0.677c0.908 0.823 1.996 1.467 3.196 1.866l0.064 0.018 0.317 1.902c0.075 0.447 0.459 0.783 0.922 0.783 0.001 0 0.002 0 0.003 0h3.057c0.001 0 0.002 0 0.003 0 0.463 0 0.847-0.336 0.921-0.778l0.001-0.005 0.317-1.902c1.263-0.417 2.351-1.061 3.267-1.891l-0.008 0.007 1.808 0.677c0.098 0.038 0.211 0.060 0.33 0.060 0.345 0 0.646-0.187 0.808-0.465l0.002-0.004 1.529-2.648c0.079-0.135 0.126-0.296 0.126-0.469 0-0.291-0.133-0.55-0.341-0.722l-0.002-0.001zM19.409 17.786l-2.255-0.845-0.341 0.344c-0.914 0.921-2.064 1.605-3.352 1.955l-0.053 0.012-0.469 0.124-0.396 2.374h-2.104l-0.396-2.374-0.469-0.124c-1.341-0.362-2.491-1.047-3.404-1.967l-0-0-0.341-0.344-2.255 0.845-1.052-1.822 1.858-1.529-0.127-0.467c-0.166-0.59-0.261-1.267-0.261-1.967s0.095-1.377 0.274-2.020l-0.013 0.053 0.127-0.467-1.858-1.529 1.052-1.822 2.255 0.845 0.341-0.344c0.914-0.921 2.064-1.605 3.352-1.955l0.053-0.012 0.469-0.124 0.396-2.374h2.104l0.396 2.374 0.469 0.124c1.341 0.362 2.491 1.047 3.404 1.967l0 0 0.341 0.344 2.255-0.845 1.052 1.822-1.858 1.529 0.127 0.467c0.166 0.59 0.261 1.267 0.261 1.967s-0.095 1.377-0.274 2.020l0.013-0.053-0.127 0.467 1.858 1.529z"></path>
                                                                                </svg>
                                                                        </use>
                                                                    </svg>
                                                                </button>
                                                                <div class="dropdown-menu dropdown-menu-right">
                                                                    <a class="dropdown-item" href="{{route('edit.producto',$item->codigo)}}">
                                                                        <svg class="c-icon" style="max-width: 64px">
                                                                            <use xlink:href="/sprites/linear.svg#cil-pencil">
                                                                                <svg id="cil-pencil" viewBox="0 0 512 512">
                                                                                    <path fill="currentColor" d="M469.9614,42.0391a88.8318,88.8318,0,0,0-125.6274,0L71.8379,314.5352,23.666,456.541a24.8442,24.8442,0,0,0,5.9971,25.709l.0869.0869a24.8445,24.8445,0,0,0,17.6123,7.3418A25.19,25.19,0,0,0,55.46,488.334l142.0053-48.1719L469.9609,167.666a88.8312,88.8312,0,0,0,.0005-125.6269ZM180.1157,412.2563,58.4824,453.5176,99.7437,331.8843,308.5005,123.1274,388.8726,203.5ZM447.3335,145.0386,411.5,180.8726l-80.3721-80.3721L366.9619,64.666a56.8317,56.8317,0,1,1,80.3716,80.3726Z"></path>
                                                                                  </svg>
                                                                            </use>
                                                                        </svg> &nbsp;Editar producto</a>
                                                                    <a class="dropdown-item" href="{{route('codigo.producto',$item->codigo)}}" target="_blank">
                                                                        <svg class="c-icon" style="max-width: 64px">
                                                                            <use xlink:href="/sprites/linear.svg#cil-print">
                                                                                <svg id="cil-print" viewBox="0 0 512 512">
                                                                                    <path d="M420,128.1016V16H92V128.1016A80.0983,80.0983,0,0,0,16,208V400H84V368H48V208a48.054,48.054,0,0,1,48-48H416a48.054,48.054,0,0,1,48,48V368H420v32h76V208A80.0983,80.0983,0,0,0,420,128.1016ZM388,128H124V48H388Z" class="cls-1"></path>  <rect width="32" height="32" x="396" y="200" class="cls-1"></rect>  <path d="M428,296V264H76v32h40V496H388V296h40ZM356,464H148V296H356Z" class="cls-1"></path>
                                                                                </svg>
                                                                            </use>
                                                                        </svg>&nbsp; Imprimir código</a>
                                                                    <a class="dropdown-item" data-toggle="modal" data-target="#stock-{{$item->id}}">
                                                                        <svg class="c-icon" style="max-width: 64px">
                                                                            <use xlink:href="/sprites/linear.svg#cil-plus">
                                                                                <svg id="cil-plus" viewBox="0 0 512 512">
                                                                                    <polygon fill="currentColor" points="440 240 272 240 272 72 240 72 240 240 72 240 72 272 240 272 240 440 272 440 272 272 440 272 440 240"></polygon>
                                                                                  </svg>
                                                                            </use>
                                                                        </svg>
                                                                            &nbsp; Aumentar stock</a>
                                                                    <div class="dropdown-divider"></div>
                                                                    <a class="dropdown-item" data-toggle="modal" data-target="#modal-{{$item->id}}">
                                                                        <svg class="c-icon" style="max-width: 64px">
                                                                            <use xlink:href="/sprites/linear.svg#cil-trash">
                                                                                <svg id="cil-trash" viewBox="0 0 512 512">
                                                                                    <path d="M96,472a23.82,23.82,0,0,0,23.5791,24H392.4209A23.82,23.82,0,0,0,416,472V152H96Zm32-288H384V464H128Z" class="cls-1"></path>  <rect width="32" height="200" x="168" y="216" class="cls-1"></rect>  <rect width="32" height="200" x="240" y="216" class="cls-1"></rect>  <rect width="32" height="200" x="312" y="216" class="cls-1"></rect>  <path d="M328,88V40c0-13.458-9.4878-24-21.6-24H205.6C193.4878,16,184,26.542,184,40V88H64v32H448V88ZM216,48h80V88H216Z" class="cls-1"></path>
                                                                                </svg>
                                                                            </use>
                                                                        </svg>
                                                                        &nbsp;
                                                                        Eliminar producto</a>
                                                                </div>
                                                            </div>
                                                            
                                                        </div>
                                                    </div>
                                                </div>
                                                @include('productos.stock')
                                                @include('productos.modal')
                                            @endforeach
                                            <div class="col-lg-12">
                                                {{$productos->render()}}
                                            </div>
                                        </div>
                                       
                                        
                                    </div>
                                    
                                </div>
                                
                            </div>
                         
                        </div>
                    </div>
                    
                  
                  
                </div>
            </div>
        </div>
    </main>
    
 <style>
     .easy-autocomplete{
         width: 80% !important;
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

        /*PAGINACION*/
        $(document).on("click", ".pagination a", function(e) {
            e.preventDefault();
            var page = $(this).attr('href').split('page=')[1];
            var route = "{{route('index.producto')}}";
            
            $.ajax({
                url: route,
                data: {page: page},
                type: 'GET',
                dataType: 'json',
                success: function(data){
                    $('.productos').html(data);
                    
                }

            })
        });

        /*BUSQUEDA*/
        var options = {
	        data: <?php echo json_encode($fil_productos)?>,
            list: {
                maxNumberOfElements: 7,
                match: {
                    enabled: true
                },
                showAnimation: {
                    type: "fade", //normal|slide|fade
                    time: 400,
                    callback: function() {}
                },

                hideAnimation: {
                    type: "slide", //normal|slide|fade
                    time: 400,
                    callback: function() {}
                },
                sort: {
                    enabled: true
                }
            }
        };

        $("#basics").easyAutocomplete(options);
        
        $(function () {
            $('.material-tooltip-main').tooltip({
                template: '<div class="tooltip md-tooltip-main"><div class="tooltip-arrow md-arrow"></div><div class="tooltip-inner md-inner-main"></div></div>'
            });
        })

    </script>
@endpush
@endsection