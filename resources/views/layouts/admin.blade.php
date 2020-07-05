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
    <link href="{{asset('css/mdb-file-upload.min.css')}}" rel="stylesheet">
    <link href="{{asset('css/main.css')}}" rel="stylesheet">
    <link href="{{asset('css/coreui-chartjs.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('code/theme/monokai.css')}}">
    <link href="{{asset('code/lib/codemirror.css')}}" rel="stylesheet">
    <link href="{{asset('css/easy-autocomplete.min.css')}}" rel="stylesheet">
    <link href="{{asset('css/easy-autocomplete.themes.min.css')}}" rel="stylesheet">

</head>

<body class="c-app c-legacy-theme">
 <?php ini_set('memory_limit', '-1');?>
    <div class="c-sidebar c-sidebar-dark c-sidebar-fixed c-sidebar-lg-show" id="sidebar">
        <div class="c-sidebar-brand d-md-down-none">
            <img src="{{asset('img/logo2.png')}}" style="width:50%;margin-right: 20px !important;">
                <img class="c-sidebar-brand-minimized" src="{{asset('img/logo3.png')}}" style="width:46px;height:46px;margin-right: 20px !important;">
        </div>
        <ul class="c-sidebar-nav">
            <li class="c-sidebar-nav-item">
                <a class="c-sidebar-nav-link" href="{{route('dashboard')}}">
                    <svg class="c-sidebar-nav-icon">
                        <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-speedometer">
                            <svg id="cil-speedometer" viewBox="0 0 24 24">
                                <title>speedometer</title><path d="M19.955 6.67c-2.036-2.036-4.848-3.295-7.955-3.295-6.213 0-11.25 5.037-11.25 11.25 0 0 0 0 0 0v0 4.125h6.75v-1.5h-5.25v-2.625c0-5.376 4.374-9.75 9.75-9.75s9.75 4.374 9.75 9.75v2.625h-5.25v1.5h6.75v-4.125c0-0.009 0-0.020 0-0.031 0-3.097-1.26-5.9-3.295-7.924l-0-0z"></path><path d="M3.75 12.375h1.5v1.5h-1.5v-1.5z"></path><path d="M11.25 6h1.5v1.5h-1.5v-1.5z"></path><path d="M6.375 7.875h1.5v1.5h-1.5v-1.5z"></path><path d="M18.75 12.375h1.5v1.5h-1.5v-1.5z"></path><path d="M13.932 15.708l3.244-6.758-1.352-0.649-3.243 6.756c-0.177-0.037-0.379-0.058-0.587-0.058-1.66 0-3.007 1.346-3.007 3.007s1.346 3.007 3.007 3.007c1.66 0 3.007-1.346 3.007-3.007 0-0.92-0.413-1.743-1.063-2.294l-0.004-0.004zM12 19.5c-0.828 0-1.5-0.672-1.5-1.5s0.672-1.5 1.5-1.5c0.828 0 1.5 0.672 1.5 1.5v0c-0.001 0.828-0.672 1.499-1.5 1.5h-0z"></path>
                                </svg>
                            </use>
                    </svg> Dashboard</a>
            </li>
            <li class="c-sidebar-nav-dropdown">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <svg class="c-sidebar-nav-icon">
                        <use xlink:href="/sprites/linear.svg#cil-notes">
                            <svg id="cil-notes" viewBox="0 0 512 512">
                                <rect width="288" height="32" x="112" y="152" class="cls-1"></rect>  <rect width="288" height="32" x="112" y="240" class="cls-1"></rect>  <rect width="152" height="32" x="112" y="328" class="cls-1"></rect>  <path d="M32,48V464H480V48ZM448,432H64V80H448Z" class="cls-1"></path>
                            </svg>
                        </use>
                    </svg> Productos</a>
                <ul class="c-sidebar-nav-dropdown-items">
                    <li class="c-sidebar-nav-item">
                        <a class="c-sidebar-nav-link" href="{{route('index.producto')}}">
                            <svg class="c-sidebar-nav-icon">
                                <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-calendar"></use>
                            </svg> Catalogo</a>
                    </li>
                    @if (auth::check())
                        @if (auth()->user()->role == 'ADMIN')
                            <li class="c-sidebar-nav-item">
                                <a class="c-sidebar-nav-link" href="{{route('ingresos.producto')}}">
                                    <svg class="c-sidebar-nav-icon">
                                        <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-calendar"></use>
                                    </svg> Vitacora<span class="badge badge-danger">ADMIN</span></a>
                            </li>
                            <li class="c-sidebar-nav-item">
                                <a class="c-sidebar-nav-link" href="{{route('index.inventario')}}">
                                    <svg class="c-sidebar-nav-icon">
                                        <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-calendar"></use>
                                    </svg> Inventario<span class="badge badge-danger">ADMIN</span></a>
                            </li>    
                        @endif
                    @endif
                </ul>
            </li>
            @if (auth::check())
                @if (auth()->user()->role == 'ADMIN')
                    <li class="c-sidebar-nav-dropdown">
                        <a class="c-sidebar-nav-dropdown-toggle" href="#">
                            <svg class="c-sidebar-nav-icon">
                                <use xlink:href="/sprites/linear.svg#cil-user">
                                    <svg id="cil-user" viewBox="0 0 512 512">
                                        <path fill="currentColor" d="M411.6,343.6563l-72.8223-47.334,27.4551-50.334A80.2394,80.2394,0,0,0,376,207.6807V128a112,112,0,0,0-224,0v79.6807a80.2376,80.2376,0,0,0,9.7681,38.3081l27.4546,50.3335-72.8213,47.334A79.7236,79.7236,0,0,0,80,410.7319V496H448V410.7319A79.7257,79.7257,0,0,0,411.6,343.6563ZM416,464H112V410.7319a47.8355,47.8355,0,0,1,21.8408-40.2456l97.6607-63.48-41.64-76.3408A48.1439,48.1439,0,0,1,184,207.6807V128a80,80,0,0,1,160,0v79.6807a48.1457,48.1457,0,0,1-5.8608,22.9848L296.498,307.0068l97.6617,63.48h0A47.8345,47.8345,0,0,1,416,410.7319Z"></path>
                                    </svg>
                                </use>
                            </svg> Usuarios </a>
                        <ul class="c-sidebar-nav-dropdown-items">
                            <li class="c-sidebar-nav-item">
                                <a class="c-sidebar-nav-link" href="{{route('index.usuario')}}">
                                    <svg class="c-sidebar-nav-icon">
                                        <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-calendar"></use>
                                    </svg> General<span class="badge badge-danger">ADMIN</span></a>
                            </li>
                        
                        </ul>
                    </li>
                    <li class="c-sidebar-nav-dropdown">
                        <a class="c-sidebar-nav-dropdown-toggle" href="#">
                            <svg class="c-sidebar-nav-icon">
                                <use xlink:href="/sprites/linear.svg#cil-settings">
                                    <svg id="cil-settings" viewBox="0 0 512 512">
                                        <path d="M245.1511,168a88,88,0,1,0,88,88A88.1,88.1,0,0,0,245.1511,168Zm0,144a56,56,0,1,1,56-56A56.0632,56.0632,0,0,1,245.1511,312Z" class="cls-1"></path>  <path d="M464.697,322.3193l-31.7695-26.1538a193.0943,193.0943,0,0,0,0-80.331l31.7695-26.1538a19.9409,19.9409,0,0,0,4.6065-25.4385l-32.6123-56.4834a19.9376,19.9376,0,0,0-24.337-8.73l-38.5615,14.4468a192.0446,192.0446,0,0,0-69.54-40.1919l-6.7627-40.57A19.9358,19.9358,0,0,0,277.7625,16H212.54a19.9357,19.9357,0,0,0-19.7275,16.7119L186.05,73.2837a192.045,192.045,0,0,0-69.54,40.1919L77.9451,99.0273a19.9366,19.9366,0,0,0-24.334,8.7305L20.9978,164.2446a19.94,19.94,0,0,0,4.61,25.4385l31.7666,26.1514a193.09,193.09,0,0,0,0,80.331l-31.77,26.1538a19.9408,19.9408,0,0,0-4.6064,25.4385l32.6123,56.4834a19.9369,19.9369,0,0,0,24.3369,8.73L116.51,398.5244a192.0436,192.0436,0,0,0,69.54,40.1919l6.7627,40.57A19.9356,19.9356,0,0,0,212.54,496h65.2227A19.9359,19.9359,0,0,0,297.49,479.2881l6.7627-40.5718a192.0432,192.0432,0,0,0,69.54-40.1919l38.5645,14.4483a19.937,19.937,0,0,0,24.334-8.73l32.6132-56.4868A19.94,19.94,0,0,0,464.697,322.3193Zm-50.6357,57.12-48.1094-18.024-7.2852,7.334a159.9528,159.9528,0,0,1-72.625,41.9727l-10.0039,2.6362L267.5964,464H222.7058l-8.4414-50.6421-10.0039-2.6362a159.9533,159.9533,0,0,1-72.625-41.9727l-7.2852-7.334L76.241,379.439,53.7947,340.5615l39.6289-32.624-2.7031-9.9722a160.8885,160.8885,0,0,1,0-83.9306l2.7031-9.9722L53.7947,171.439,76.241,132.561,124.35,150.585l7.2852-7.334a159.9533,159.9533,0,0,1,72.625-41.9727l10.0039-2.6362L222.7058,48h44.8906l8.4414,50.6421,10.0039,2.6362a159.9528,159.9528,0,0,1,72.625,41.9727l7.2852,7.334,48.1094-18.024,22.4463,38.8775-39.6289,32.624,2.7031,9.9722a160.8913,160.8913,0,0,1,0,83.9306l-2.7031,9.9722,39.6289,32.6235Z" class="cls-1"></path>
                                    </svg>
                                </use>
                            </svg> Configuraciones</a>
                        <ul class="c-sidebar-nav-dropdown-items">
                            <li class="c-sidebar-nav-item">
                                <a class="c-sidebar-nav-link" href="{{route('general.config')}}">
                                    <svg class="c-sidebar-nav-icon">
                                        <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-calendar"></use>
                                    </svg> General</a>
                            </li>
                            <li class="c-sidebar-nav-item">
                                <a class="c-sidebar-nav-link" href="{{route('factura.config')}}">
                                    <svg class="c-sidebar-nav-icon">
                                        <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-calendar"></use>
                                    </svg> Factura</a>
                            </li>
                            <li class="c-sidebar-nav-item">
                                <a class="c-sidebar-nav-link" href="{{route('banner.config')}}">
                                    <svg class="c-sidebar-nav-icon">
                                        <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-calendar"></use>
                                    </svg> Banners</a>
                            </li>
                        </ul>
                    </li>
                @endif
            @endif
            <li class="c-sidebar-nav-dropdown">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <svg class="c-sidebar-nav-icon">
                        <use xlink:href="/sprites/linear.svg#cil-screen-desktop">
                            <svg id="cil-screen-desktop" viewBox="0 0 512 512">
                                <path fill="currentColor" d="M472,48H40A24.0275,24.0275,0,0,0,16,72V368a24.0275,24.0275,0,0,0,24,24H240v72H160v32H352V464H272V392H472a24.0275,24.0275,0,0,0,24-24V72A24.0275,24.0275,0,0,0,472,48Zm-8,312H48V80H464Z"></path>
                            </svg>
                        </use>
                    </svg> Transacciones</a>
                <ul class="c-sidebar-nav-dropdown-items">
                    <li class="c-sidebar-nav-item">
                        <a class="c-sidebar-nav-link" href="{{route('index.contabilidad')}}">
                            <svg class="c-sidebar-nav-icon">
                                <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-calendar"></use>
                            </svg> Caja</a>
                    </li>
                    <li class="c-sidebar-nav-item">
                        <a class="c-sidebar-nav-link" href="{{route('open_gistorial.venta')}}">
                            <svg class="c-sidebar-nav-icon">
                                <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-calendar"></use>
                            </svg> Ventas</a>
                    </li>
                </ul>
            </li>
            
            <li class="c-sidebar-nav-item">
                <a class="c-sidebar-nav-link" href="{{route('index.mail')}}">
                    <svg class="c-sidebar-nav-icon">
                        <use xlink:href="/sprites/brand.svg#cib-gmail">
                            <svg id="cib-gmail" viewBox="0 0 32 32">
                                <path d="M32 6v20c0 1.135-0.865 2-2 2h-2v-18.151l-12 8.62-12-8.62v18.151h-2c-1.135 0-2-0.865-2-2v-20c0-0.568 0.214-1.068 0.573-1.422 0.359-0.365 0.859-0.578 1.427-0.578h0.667l13.333 9.667 13.333-9.667h0.667c0.568 0 1.068 0.214 1.427 0.578 0.359 0.354 0.573 0.854 0.573 1.422z"></path>
                              </svg>
                            </use>
                    </svg> Mensajería</a>
            </li>
        </ul>
        
    </div>
   
    <div class="c-wrapper">
        <header class="c-header c-header-light c-header-fixed">
            <button class="c-header-toggler c-class-
            er d-lg-none mfe-auto" type="button" data-target="#sidebar" data-class="c-sidebar-show">
                <svg class="c-icon c-icon-lg">
                    <use xlink:href="svg/free.svg#cil-menu"></use>
                </svg>
            </button>
            <a class="c-header-brand d-lg-none c-header-brand-sm-up-center" href="#">
                <svg width="118" height="46" alt="CoreUI Logo">
                    <use xlink:href="assets/brand/coreui-pro.svg#full"></use>
                </svg>
            </a>
            <button class="c-header-toggler c-class-toggler mfs-3 d-md-down-none" type="button" data-target="#sidebar" data-class="c-sidebar-lg-show" responsive="true">
                <svg class="c-icon c-icon-lg">
                    <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-menu">
                        <svg id="cil-menu" viewBox="0 0 24 24">
                            <title>menu</title><path d="M3.75 4.5h16.5v1.5h-16.5v-1.5z"></path><path d="M3.75 11.25h16.5v1.5h-16.5v-1.5z"></path><path d="M3.75 18h16.5v1.5h-16.5v-1.5z"></path>
                            </svg>
                    </use>
                </svg>
            </button>
            {{-- <ul class="c-header-nav d-md-down-none">
                <li class="c-header-nav-item px-3"><a class="c-header-nav-link" href="#">Dashboard</a></li>
                <li class="c-header-nav-item px-3"><a class="c-header-nav-link" href="#">Users</a></li>
                <li class="c-header-nav-item px-3"><a class="c-header-nav-link" href="#">Settings</a></li>
            </ul> --}}
            <ul class="c-header-nav mfs-auto">
                <li class="c-header-nav-item px-3 c-d-legacy-none">
                    <button class="c-class-toggler c-header-nav-btn" type="button" id="header-tooltip" data-target="body" data-class="c-dark-theme" data-toggle="c-tooltip" data-placement="bottom" title="Toggle Light/Dark Mode">
                        <svg class="c-icon c-d-dark-none">
                            <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-moon"></use>
                        </svg>
                        <svg class="c-icon c-d-default-none">
                            <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-sun"></use>
                        </svg>
                    </button>
                </li>
            </ul>
            <ul class="c-header-nav">
             
                @if (auth::check())
                <li class="c-header-nav-item dropdown mr-4">
                    <a class="c-header-nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                        <div class="c-avatar">
                                <img class="c-avatar-img" src="{{asset('img/user.png')}}" alt="{{auth()->user()->name}}" style="width:90%"> <span></span>    
                        </div>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right pt-0" style="padding: 0 !important">
                        <div class="dropdown-header bg-light py-2"><strong style="font-size: 15px;">Cuenta</strong></div>
                        <form method="POST" action="{{route('logout')}}">
                            {{csrf_field()}}
                            <button class="dropdown-item">
                                <svg class="c-icon mfe-2">
                                    <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-account-logout">
                                        <svg id="cil-account-logout" viewBox="0 0 24 24">
                                            <title>account-logout</title><path d="M3.617 12.752l12.872-0v-1.5h-12.872l3.518-3.518-1.061-1.061-5.329 5.329 5.329 5.329 1.061-1.061-3.518-3.518z"></path><path d="M7.5 0.75v1.5h14.25v19.5h-14.25v1.5h15.75v-22.5h-15.75z"></path>
                                        </svg>
                                    </use>
                                </svg> 
                                Cerrar Sesión
                            </button>
                           
                        </form>
                    </div>
                </li>
                @endif
               
            </ul>
            
        </header>
        @yield('contenido')
    </div>
    

    <script src="{{asset('vendors/coreui/coreui-pro/js/coreui.bundle.min.js')}}"></script>
    <!--[if IE]><!-->
    <script src="{{asset('js/svgxuse.min.js')}}"></script>
    <script src="{{asset('js/all.js')}}"></script>

    <script src="{{asset('js/jquery.js')}}"></script>
    <script src="{{asset('js/popper.min.js')}}"></script>
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    
    <script src="{{asset('js/mdb.lite.min.js')}}"></script>
    <script src="{{asset('js/code.min.js')}}"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <script src="{{asset('js/mdb-file-upload.min.js')}}"></script>
    <script src="{{asset('js/clock.js')}}"></script>
    <script src="{{asset('js/coreui-chartjs.bundle.js')}}"></script>
    <script src="{{asset('code/lib/codemirror.js')}}"></script>
    <script src="{{asset('code/mode/xml/xml.js')}}"></script>
    <script src="{{asset('js/jquery.easy-autocomplete.min.js')}}"></script>
    <link  href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.1/css/buttons.dataTables.min.css">
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.html5.min.js"></script>
    <script src="{{asset('tinymce/tinymce.min.js')}}"></script>
    <script src="{{asset('js/sweetalert2.js')}}"></script>
    <script>
        tinymce.init({
          selector: '#editor',
          height : "480px",
          language: 'es',
            plugins: [
            'print fullpage paste importcss searchreplace autolink directionality code visualblocks visualchars fullscreen  link  template table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists wordcount textpattern noneditable help charmap quickbars emoticons spellchecker linkchecker casechange'
            ],
            menubar: 'edit view format tools table',
            toolbar: 'casechange undo redo  bold italic underline strikethrough  fontselect fontsizeselect formatselect alignleft aligncenter alignright alignjustify outdent indent numlist bullist  forecolor backcolor removeformat pagebreak charmap emoticons fullscreen insertfile',
            
        });
	</script>
    @stack('scripts')
   
    <script>
        // Material Select Initialization
        $(document).ready(function() {
        $('.mdb-select').materialSelect();
        });
    </script>
   
</body>

</html>