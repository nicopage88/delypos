<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{$codigo}}</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jsbarcode/3.6.0/JsBarcode.all.min.js"></script>
    
</head>
<body>
        
    <div class="row" style="height:100vh;display: flex;
    justify-content: center;
    align-items: center;">
        <div class="col-lg-3 text-center mx-auto">  
                <svg id="barcode"></svg> 
                
        </div>
    </div>
    <script>
        JsBarcode("#barcode", "<?php echo $codigo?>");
        window.print();
    </script>
    <style>
        body{
            overflow-x: hidden
        }
    </style>
</body>



</html>
