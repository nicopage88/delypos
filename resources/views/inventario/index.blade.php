@extends('layouts.admin')
@section('contenido')
<div class="c-subheader justify-content-between px-3">

    <ol class="breadcrumb border-0 m-0 px-0 px-md-3">
        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
        <li class="breadcrumb-item active"><a>Inventario</a></li>

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
                                    <table class="table table-bordered" id="laravel_datatable" style="width:100%">
                                        <thead>
                                           <tr>
                                              <th>Codigo</th>
                                              <th>Producto</th>
                                              <th>Categoría</th>
                                              <th>Cantidad</th>
                                              <th style="width:50px">Presentación</th>
                                              <th>Precio de venta</th>
                                           </tr>
                                        </thead>
                                     </table>
                                </div>
                            </div>
                        </div>
                 
                  
                  
                </div>
            </div>
        </div>
    </main>
    <style>
        .dt-buttons {
            padding-bottom: 10px;
        }
        a.paginate_button {
            padding: 3px 10px !important;
        }
        #laravel_datatable_paginate{
            padding-top: 10px;
        }
    </style>
 
</div>
@push('scripts')
    <script>
        $(document).ready( function () {
                $('#laravel_datatable').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: "{{ route('data.inventario') }}",
                    dom: 'Bfrtip',
                    buttons: [
                        'copyHtml5',
                        'excelHtml5',
                        'csvHtml5',
                        'pdfHtml5'
                    ],
                    pageLength: 50,
                    language: {
                        "decimal": "",
                        "emptyTable": "No hay información",
                        "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
                        "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
                        "infoFiltered": "(Filtrado de _MAX_ total entradas)",
                        "infoPostFix": "",
                        "thousands": ",",
                        "lengthMenu": "Mostrar _MENU_ Entradas",
                        "loadingRecords": "Cargando...",
                        "processing": "Procesando...",
                        "search": "",
                        "zeroRecords": "Sin resultados encontrados",
                        "paginate": {
                            "first": "Primero",
                            "last": "Ultimo",
                            "next": "Siguiente",
                            "previous": "Anterior"
                        }
                    },
                    columns: [
                        { data: 'codigo', name: 'codigo' },
                        { data: 'titulo', name: 'titulo' },
                        { data: 'categoria', name: 'categoria' },
                        { data: 'cantidad', name: 'cantidad'  },
                        { data: 'presentacion', name: 'presentacion'  },
                        { data: 'precio_venta', name: 'precio_venta'  },
                    ]
                });

                $('#laravel_datatable_filter input').addClass('form-control');
                $('#laravel_datatable_filter input').attr('placeholder','Buscar producto');
                $('.dt-buttons button').addClass('btn btn-primary');
            });
    </script>
@endpush
@endsection