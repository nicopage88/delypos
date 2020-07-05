@extends('layouts.admin')
@section('contenido')
<div class="c-subheader justify-content-between px-3">
    <ol class="breadcrumb border-0 m-0 px-0 px-md-3">
        <li class="breadcrumb-item">Dashboard</li>
        <li class="breadcrumb-item"><a href="{{route('index.producto')}}">Productos</a></li>
        <li class="breadcrumb-item active"><a>Registro de producto</a></li>
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

                <div class="row" id="contenido" style="display:none">

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
                    <div class="col-lg-10 col-md-12 form-group">
                       <div class="row">
                        <div class="col-lg-12 form-group">
                            <div class="card" style="border-radius:0px !important">
                                <div class="card-header" style="background: #4949e7 !important">
                                <b><h5 style="margin-bottom: 0px !important;color:white">Registro de nuevo producto</h5></b>
                                </div>
                                <div class="card-body">
                                <form action="{{route('update.producto',$producto->id)}}" method="POST" enctype="multipart/form-data" autocomplete="off">
                                        {{ csrf_field() }}
                                        <input name="_method" type="hidden" value="PATCH">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="row">
                                                    <div class="col-lg-3 col-md-3">
                                                        <img src="{{asset('poster/'.$producto->poster)}}" id="blah" style="width:100%">
                                                        <hr>
                                                        <svg id="barcode" style="width:100%;height:90px !important"></svg>
                                                        <input type="file" id="imgInp" name="poster" class="form-control mt-4 {{ $errors->has('poster') ? ' is-invalid' : '' }}">
                                                        @if ($errors->has('poster'))
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $errors->first('poster') }}</strong>
                                                            </span>
                                                        @endif
                                                        <center><button type="submit" class="btn btn-download mt-4" style="background-color: #69e781;">Actualizar</button></center>
                                                    </div>
                                                    <div class="col-lg-9 col-md-9  form-group">
                                                        <div class="row">
                                                            <div class="col-lg-12 form-group">
                                                                <label><b>Título del producto</b></label>
                                                                <input type="text" name="titulo" class="form-control {{ $errors->has('titulo') ? ' is-invalid' : '' }}" value="{{$producto->titulo}}" placeholder="Nombre del producto">
                                                                @if ($errors->has('titulo'))
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $errors->first('titulo') }}</strong>
                                                                    </span>
                                                                @endif
                                                            </div>
                                                        
                                                            <div class="col-lg-4 form-group">
                                                                <label><b>Categoría</b></label>
                                                                <select name="categoria" class="mdb-select md-form" searchable="buscar.." >
                                                                    @foreach ($categorias as $item)
                                                                        @if ($producto->categoria == trim($item))
                                                                            <option selected value="{{$item}}">{{$item}}</option>
                                                                        @else
                                                                            <option value="{{$item}}">{{$item}}</option>
                                                                        @endif
                                                                    @endforeach
                                                                </select>
                                                                @if ($errors->has('categoria'))
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $errors->first('categoria') }}</strong>
                                                                    </span>
                                                                @endif
                                                            </div>
                                                            <div class="col-lg-4 form-group">
                                                                <label><b>Marca</b></label>
                                                                <select class="mdb-select md-form" searchable="buscar.." name="marca">
                                                                  
                                                                    @foreach ($marcas as $item)
                                                                        @if ($producto->marca == trim($item))
                                                                            <option selected value="{{$item}}">{{$item}}</option>
                                                                        @else
                                                                            <option value="{{$item}}">{{$item}}</option>
                                                                        @endif
                                                                    @endforeach
                                                                </select>
                                                                @if ($errors->has('marca'))
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $errors->first('marca') }}</strong>
                                                                    </span>
                                                                @endif
                                                            </div>
                                                            <div class="col-lg-4 form-group">
                                                                <label><b>Precio de venta</b></label>
                                                                <input type="text" name="precio_venta" class="form-control amount {{ $errors->has('precio_venta') ? ' is-invalid' : '' }}"  id="currency-field" pattern="^\$\d{1,3}(,\d{3})*(\.\d+)?$" value="{{$producto->precio_venta}}" data-type="currency" placeholder="$0">
                                                                @if ($errors->has('precio_venta'))
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $errors->first('precio_venta') }}</strong>
                                                                    </span>
                                                                @endif
                                                            </div>
                                                            <div class="col-lg-4 form-group">
                                                                <label><b>Código</b></label>  
                                                                <input type="text" name="codigo" class="form-control amount {{ $errors->has('codigo') ? ' is-invalid' : '' }}" value="{{$producto->codigo}}">
                                                                @if ($errors->has('codigo'))
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $errors->first('codigo') }}</strong>
                                                                    </span>
                                                                @endif
                                                            </div>
                                                            <div class="col-lg-4 form-group">
                                                                <label><b>Cantidad</b></label>
                                                                
                                                                <div class="input-group" id="show_hide_password">
                                                                    <input type="number" name="cantidad" class="form-control amount {{ $errors->has('cantidad') ? ' is-invalid' : '' }}" value="{{$producto->cantidad}}" placeholder="Cantidad" min="0"> 
                                                                    @if ($errors->has('cantidad'))
                                                                        <span class="invalid-feedback" role="alert">
                                                                            <strong>{{ $errors->first('cantidad') }}</strong>
                                                                        </span>
                                                                    @endif
                                                                    <div class="input-group-addon">
                                                                    <select name="presentacion" class="form-control">
                                                                            @foreach ($presentaciones as $item)
                                                                            @if ($producto->presentaciones == trim($item))
                                                                                    <option selected value="{{$item}}">{{$item}}</option>
                                                                                @else
                                                                                    <option value="{{$item}}">{{$item}}</option>
                                                                                @endif
                                                                            @endforeach
                                                                    </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            
                                                            <div class="col-lg-4 form-group">
                                                                <label><b>Estado</b></label>
                                                                <select class="mdb-select md-form" name="estado">
                                                                  
                                                                        @if ($producto->estado == 'Disponible')
                                                                            <option value="Disponible" selected>Disponible</option>
                                                                            <option value="En espera">En espera</option>
                                                                        @else
                                                                            <option value="Disponible" >Disponible</option>
                                                                            <option value="En espera" selected>En espera</option>
                                                                        @endif
                                                                
                                                                </select>
                                                                @if ($errors->has('estado'))
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $errors->first('estado') }}</strong>
                                                                    </span>
                                                                @endif
                                                            </div>
                                                            <div class="col-lg-12 form-group">
                                                                <label><b>Descripción</b></label>
                                                                <textarea name="descripcion" class="form-control {{ $errors->has('descripcion') ? ' is-invalid' : '' }}" placeholder="Breve descripción del producto" style="height:150px">{{$producto->descripcion}}</textarea>
                                                                @if ($errors->has('descripcion'))
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $errors->first('descripcion') }}</strong>
                                                                    </span>
                                                                @endif
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
       
    JsBarcode("#barcode", "<?php echo $producto->codigo?>");


  
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                
                reader.onload = function(e) {
                $('#blah').attr('src', e.target.result);
                }
                
                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#imgInp").change(function() {
            readURL(this);
        });


        $("input[data-type='currency']").on({
            keyup: function() {
            formatCurrency($(this));
            },
            blur: function() { 
            formatCurrency($(this), "blur");
            }
        });


        function formatNumber(n) {
        return n.replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",")
        }


        function formatCurrency(input, blur) {
            var input_val = input.val();
            
            // don't validate empty input
            if (input_val === "") { return; }
            
            // original length
            var original_len = input_val.length;

            // initial caret position 
            var caret_pos = input.prop("selectionStart");
                
            // check for decimal
            if (input_val.indexOf(".") >= 0) {

                // get position of first decimal
                // this prevents multiple decimals from
                // being entered
                var decimal_pos = input_val.indexOf(".");

                // split number by decimal point
                var left_side = input_val.substring(0, decimal_pos);
                var right_side = input_val.substring(decimal_pos);

                // add commas to left side of number
                left_side = formatNumber(left_side);

                // validate right side
                right_side = formatNumber(right_side);
                
                // On blur make sure 2 numbers after decimal
                if (blur === "blur") {
                right_side += "00";
                }
                
                // Limit decimal to only 2 digits
                right_side = right_side.substring(0, 2);

                // join number by .
                input_val = "<?php $config->prefijo_moneda?>" + left_side + "." + right_side;

            } else {
                // no decimal entered
                // add commas to number
                // remove all non-digits
                input_val = formatNumber(input_val);
                input_val = "<?php $config->prefijo_moneda?>" + input_val;
                
                // final formatting
                if (blur === "blur") {
                input_val += ".00";
                }
            }
            
            // send updated string to input
            input.val(input_val);

            var updated_len = input_val.length;
            caret_pos = updated_len - original_len + caret_pos;
            input[0].setSelectionRange(caret_pos, caret_pos);
        }

    </script>
@endpush
@endsection