@extends('layouts.admin')
@section('contenido')
<div class="c-subheader justify-content-between px-3">

    <ol class="breadcrumb border-0 m-0 px-0 px-md-3">
        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
        <li class="breadcrumb-item active"><a>Mensajería</a></li>

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
                

                <div class="row" style="display: none" id="contenido">
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
                    </div>
                    
                   <div class="row">
                       <div class="col-lg-8">
                           <form action="{{route('store.mail')}}" method="POST">
                            {{ csrf_field() }}
                                <div class="row">
                                    <div class="col-lg-12 form-group">
                                        <input type="text" class="form-control" placeholder="Asunto del mensaje" name="asunto">
                                    </div>
                                    <div class="col-lg-12">
                                        <textarea name="mensaje" id="editor" cols="30" rows="10"></textarea>
                                    </div>
                                    <div class="col-lg-12 text-center mt-4">
                                        <button type="submit" id="btn-one" class="btn btn-primary mb-4">Enviar correo</button>
                                    </div>
                                </div>
                           </form>
                       </div>
                       <div class="col-lg-4">
                           <div class="card">
                               <div class="card-header text-center">
                                   Cartera de clientes
                               </div>
                               <div class="table-wrapper-scroll-y my-custom-scrollbar">
                                    <table class="table table-responsive-sm table-hover table-outline mb-0 table-sm">
                                        <thead class="thead-light">
                                            <tr>
                                                <th class="text-center">
                                                Nombres
                                                </th>
                                                <th class="text-center">Correo</th>
                                                
                                            </tr>
                                        </thead>
                                        @foreach ($clientes as $item)
                                            <tr>
                                                <td><i class="fas fa-user"></i> {{$item->nombres}}</td>
                                                <td><b><i class="fas fa-at"></i> {{$item->email}}</b></td>
                                            </tr>
                                        @endforeach
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
<style>
    .my-custom-scrollbar {
        position: relative;
        height: 483px;
        overflow: auto;
    }
    .table-wrapper-scroll-y {
        display: block;
    }
</style>
@push('scripts')
   <script>
       window.onload = function(){
           var loader = document.getElementById('loader');
           var contenido = document.getElementById('contenido');

            contenido.style.display = 'block';
 
            $('#loader').remove();
       }

       $('#btn-one').click(function() {
            $('#btn-one').html('<span class="spinner-border spinner-border-sm mr-2" role="status" aria-hidden="true"></span>Enviando...').addClass('disabled');
        });
   </script>
@endpush
@endsection