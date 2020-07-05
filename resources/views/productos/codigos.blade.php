<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Códigos de productos</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jsbarcode/3.6.0/JsBarcode.all.min.js"></script>
</head>
<body style="background: #f0f0f0">
    <div class="container">
        <div class="row mt-4">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" id="hide">
                        <button class="btn btn-primary btn-sm" onclick="imprimir()">
                            Imprimir
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            @foreach ($productos as $item)
                                <div class="col-md-3">
                                    <div class="card" style="    height: 220px;"> 
                                        <div class="card-body">
                                            <svg id="barcode-{{$item->id}}" style="width: 100%;height: 100px !important;"></svg>
                                            <hr>
                                            <p class="text-center" style="font-size: .8rem;
                                            line-height: 15px;"><b>{{$item->titulo}}</b></p>
                                        </div>
                                    </div>
                                </div>
                                <script>
    
                                    JsBarcode("#barcode-<?php echo $item->id?>", "<?php echo $item->codigo?>");
                                    
                                </script> 
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> 
    <script>

        function imprimir(){
            document.getElementById('hide').style.display='none';
            window.print();
            document.getElementById('hide').style.display='inline-block';
        }

    </script>
</body>
</html>