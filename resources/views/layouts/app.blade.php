<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta name="description" content="CoreUI - Open Source Bootstrap Admin Template">
    <meta name="author" content="Łukasz Holeczek">
    <meta name="keyword" content="Bootstrap,Admin,Template,Open,Source,jQuery,CSS,HTML,RWD,Dashboard">
    <title>DevThemes</title>
    <link rel="icon" type="image/ico" href="{{ asset('img/icon.png') }}" sizes="any" />
    
   
    
    <link href="{{asset('css/mdb.lite.min.css')}}" rel="stylesheet">
    <link href="{{asset('css/style.css')}}" rel="stylesheet">
    <link href="{{asset('css/main.css')}}" rel="stylesheet">
</head>

<body class="c-app flex-row align-items-center" style="background: #005C97;  /* fallback for old browsers */
background: -webkit-linear-gradient(to bottom, #363795, #005C97);  /* Chrome 10-25, Safari 5.1-6 */
background: linear-gradient(to bottom, #363795, #005C97); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
">

        @yield('auth')
    

    <script src="{{asset('vendors/coreui/coreui-pro/js/coreui.bundle.min.js')}}"></script>
    <!--[if IE]><!-->
    <script src="{{asset('js/svgxuse.min.js')}}"></script>
    <script src="{{asset('js/all.js')}}"></script>

    <script src="{{asset('js/jquery.js')}}"></script>
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    <script src="{{asset('js/popper.min.js')}}"></script>
    <script src="{{asset('js/mdb.lite.min.js')}}"></script>
    <script src="{{asset('js/code.min.js')}}"></script>
    @stack('scripts')
   
    
   
</body>

</html>