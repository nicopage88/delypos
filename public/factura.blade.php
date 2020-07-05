

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{$venta->id}}</title>
    
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <style>
      <style>
      @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap');
      h3,h6{
              font-family: "Roboto !important";
            }
            .titulo{
              font-weight: 500;
              font-size: 25px;
              color: #2471A3 !important;
            }
            .direccion{
              font-size: 12px !important;
              color: #424949 !important;
            }
      </style>

</head>
<body>

    <div class="container">
        <div class="card" style="margin-top:40px">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-12 form-group">
                      <table style="width:100%;">
                        <tr>
 
                          <td>
                            <p class="text-left titulo">"{{$factura->nombre_comercial}}"</p>
                            <p class="text-left" style="margin-bottom: 0px;">{{$factura->razon_social}}</p>
                            
                            
                          </td>
                          <td class="">
                            <img src="{{ public_path().'/img/'.$config->logo}}" style="width:180px">
                            
                          </td>
                          <td>
                            <p class="text-center" style="margin-bottom: 0px;"><b>RUC: </b>{{$factura->ruc}}</p>
                            <h3 class="text-center" style="color:#18C024">{{$venta->tipo_factura}}</h3>
                            <p class="text-center"><b>N° </b>{{str_pad($venta->serie,3,'0',STR_PAD_LEFT)}} - {{str_pad($venta->correlativo,7,'0',STR_PAD_LEFT)}}</p>
                          </td>
                          
                        </tr>
                      </table>
                        
                    </div>
                </div>
                <table class="table table-bordered">
                  <tr>
                    <td style="width:110px"><b>Razón social:</b></td>
                    <td>{{$venta->razon_social}}</td>
                    <td style="width:80px"><b>Fecha:</b></td>
                    <td>{{$venta->fecha}} - {{$venta->hora}}</td>
                  </tr>
                </table>
                <table class="table table-bordered">
                    <thead>
                      <tr>
                        <th>Producto</th>
                        <th>Precio</th>
                        <th>Cantidad</th>
                        <th>Subtotal</th>
                      </tr>
                    </thead>
                    @foreach ($detalle as $item)
                    <tbody>
                      <tr>
                        <td>{{$item->titulo}}</td>
                        <td>{{$config->prefijo_moneda}}{{$item->precio_venta}}</td>
                        <td>{{$item->cantidad}} {{$item->presentacion}}</td>
                        <td>{{$config->prefijo_moneda}}<?php echo $item->precio_venta * $item->cantidad?></td>
                      </tr> 
                    </tbody>
                    @endforeach
                    <tr>
                      <td colspan="3"><b>Total</b></td>
                      <td><b>{{$venta->total_pagar}}</b></td>
                    </tr>
                  </table>
                  <div class="row">
                    <div class="col-lg-12 form-group">
                      <table style="width:100%;">
                        <tr>
 
                          <td>
                            <h3 class="text-left">{{$config->titulo}}</h3>
                            <p class="text-left direccion"><?php echo nl2br($factura->direccion)?></p>
                          </td>
                         
                          <td>
                            <h5 class="text-right">Fecha y Hora</h5>
                            <p class="text-right direccion">{{$venta->fecha}} - {{$venta->hora}}</p>
                          </td>
                          
                        </tr>
                      </table>
                        
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</body>
</html>