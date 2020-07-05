<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
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
    </head>
<body>
    <div class="container mt+4">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                     <div id="invoice">

                  
                         <div class="invoice overflow-auto">
                             <div style="min-width: 600px">
                                 <header>
                                     <div class="row">
                                         
                                         <div class="col company-details">
                                             <h2 class="name">
                                                 <a target="_blank" >
                                                 {{$factura->nombre_comercial}}
                                                 </a>
                                             </h2>
                                             <div><?php echo nl2br($factura->direccion)?></div>
                                             
                                         </div>
                                     </div>
                                 </header>
                                 <main>
                                     <div class="row contacts">
                                         <div class="col invoice-to">
                                             <div class="text-gray-light">CLIENTE:</div>
                                             <h2 class="to">{{$venta->razon_social}}</h2>
                                             <div class="address">RUC: {{$factura->ruc}}</div>
                                             <div class="email"><a href="">{{$config->titulo}}</a></div>
                                         </div>
                                         <div class="col invoice-details">
                                             <h3 class="invoice-id">{{$factura->razon_social}}</h3>
                                             <div class="date">Fecha: {{$venta->fecha}}</div>
                                             <div class="date">Hora: {{$venta->hora}}</div>
                                         </div>
                                     </div>
                                     <table border="0" cellspacing="0" cellpadding="0">
                                         <thead>
                                             <tr>
                                                 <th>#</th>
                                                 <th>Producto</th>
                                                 <th>Precio</th>
                                                 <th>Cantidad</th>
                                                 <th>Subtotal</th>
                                             </tr>
                                         </thead>
                                         
                                         @foreach ($detalle as $key => $item)
                                             <tbody>
                                                 <tr>
                                                     <td class="no">{{$key + 1}}</td>
                                                     <td class="text-left">
                                                         {{$item->titulo}}
                                                     </td>
                                                     <td class="unit">{{$config->prefijo_moneda}}{{$item->precio_venta}}</td>
                                                     <td class="qty">{{$item->cantidad}} {{$item->presentacion}}</td>
                                                     <td class="total">{{$config->prefijo_moneda}}<?php echo $item->precio_venta * $item->cantidad?></td>
                                                 </tr>                                  
                                             </tbody>
                                         @endforeach
                                         <tfoot>
                                             <tr>
                                                 <td colspan="2"></td>
                                                 <td colspan="2">IGV</td>
                                                 <td>Incluido</td>
                                             </tr>
                                             <tr>
                                                 <td colspan="2"></td>
                                                 <td colspan="2">TOTAL A PAGAR</td>
                                                 <td>{{$venta->total_pagar}}</td>
                                             </tr>
                                         </tfoot>
                                     </table>
                                     <div class="thanks">Gracias por tu compra!</div>
                                     <div class="notices">
                                         <div>Nota:</div>
                                         <div class="notice">Esta es una factura electrónica unicamente recibida por correo.</div>
                                     </div>
                                 </main>
                                 <footer>
                                     Derechos reservados a {{$config->titulo}} @2020
                                 </footer>
                             </div>
                             <!--DO NOT DELETE THIS div. IT is responsible for showing footer always at the bottom-->
                             <div></div>
                         </div>
                     </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</body>
</html>