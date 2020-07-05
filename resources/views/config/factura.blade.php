@extends('layouts.admin')
@section('contenido')
<div class="c-subheader justify-content-between px-3">

    <ol class="breadcrumb border-0 m-0 px-0 px-md-3">
        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
        <li class="breadcrumb-item active"><a>Configuracion general</a></li>

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
             
              <div class="row" >
                @if(Session::has('success'))
                    <div class="col-lg-12">
                        <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
                            {{Session::get('success')}}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    </div>
                @endif 
                  <div class="col-lg-12">
                    <form action="{{route('save_cambios.config')}}" method="POST">
                        @csrf
                        <div class="card">
                            <div class="card-header">
                                CODIGO FUENTE DE LA FACTURA
                            </div>
                            <textarea id="code" name="code">
                                <?php echo $factura?>
                            </textarea>
                            <div class="card-footer">
                                <button class="btn btn-primary" type="submit">Guardar cambios</button>
                            </div>
                        </div>
                    </form>
                  </div>
              </div>
            </div>
        </div>
    </main>
    <style>
        .CodeMirror {border-top: 1px solid black; border-bottom: 1px solid black;}
        .CodeMirror pre > * { text-indent: 0px; }
        pre.CodeMirror-line {
                padding-left: 10px !important;
            }
      </style>
 
</div>
@push('scripts')
<script>
    var editor = CodeMirror.fromTextArea(document.getElementById("code"), {
        lineNumbers: true,
        lineWrapping: true,
        mode: "text/html",
        
      });
      
      editor.refresh();
      editor.setOption("theme", 'monokai');
      editor.setSize('100%', 1000);
      
      
</script>
@endpush
@endsection