@foreach ($productos as $item)
<div class="col-lg-3 form-group">
    <div class="card material-tooltip-main" data-toggle="tooltip"
    data-placement="right" title="{{$item->titulo}}">
        <img src="{{asset('poster/'.$item->poster)}}" style="width:100%">
        <div class="card-footer text-right">
            <div class="btn-group">
                <button class="btn btn-transparent dropdown-toggle p-0" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color: #797979 !important;box-shadow: none !important;">
                    <svg class="c-icon">
                        <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-settings">
                            <svg id="cil-settings" viewBox="0 0 24 24">
                                <title>settings</title><path d="M11.491 7.875c-2.278 0-4.125 1.847-4.125 4.125s1.847 4.125 4.125 4.125c2.278 0 4.125-1.847 4.125-4.125v0c-0.003-2.277-1.848-4.122-4.125-4.125h-0zM11.491 14.625c-1.45 0-2.625-1.175-2.625-2.625s1.175-2.625 2.625-2.625c1.45 0 2.625 1.175 2.625 2.625v0c-0.002 1.449-1.176 2.623-2.625 2.625h-0z"></path><path d="M21.783 15.109l-1.489-1.226c0.126-0.566 0.198-1.216 0.198-1.883s-0.072-1.317-0.209-1.943l0.011 0.060 1.489-1.226c0.21-0.173 0.342-0.432 0.342-0.723 0-0.173-0.047-0.335-0.129-0.474l0.002 0.004-1.529-2.648c-0.164-0.283-0.466-0.469-0.811-0.469-0.119 0-0.232 0.022-0.337 0.062l0.006-0.002-1.808 0.677c-0.908-0.823-1.996-1.467-3.196-1.866l-0.064-0.018-0.317-1.902c-0.075-0.447-0.459-0.783-0.922-0.783-0.001 0-0.002 0-0.003 0h-3.057c-0.001 0-0.002 0-0.003 0-0.463 0-0.847 0.336-0.921 0.778l-0.001 0.005-0.317 1.902c-1.263 0.417-2.351 1.061-3.267 1.891l0.008-0.007-1.808-0.677c-0.098-0.038-0.211-0.060-0.33-0.060-0.345 0-0.646 0.187-0.808 0.465l-0.002 0.004-1.529 2.648c-0.079 0.135-0.126 0.296-0.126 0.469 0 0.291 0.133 0.55 0.341 0.722l0.002 0.001 1.489 1.226c-0.126 0.566-0.198 1.216-0.198 1.883s0.072 1.317 0.209 1.943l-0.011-0.060-1.489 1.226c-0.21 0.173-0.342 0.432-0.342 0.723 0 0.173 0.047 0.335 0.129 0.474l-0.002-0.004 1.529 2.648c0.164 0.283 0.466 0.47 0.811 0.47 0.119 0 0.232-0.022 0.337-0.062l-0.006 0.002 1.808-0.677c0.908 0.823 1.996 1.467 3.196 1.866l0.064 0.018 0.317 1.902c0.075 0.447 0.459 0.783 0.922 0.783 0.001 0 0.002 0 0.003 0h3.057c0.001 0 0.002 0 0.003 0 0.463 0 0.847-0.336 0.921-0.778l0.001-0.005 0.317-1.902c1.263-0.417 2.351-1.061 3.267-1.891l-0.008 0.007 1.808 0.677c0.098 0.038 0.211 0.060 0.33 0.060 0.345 0 0.646-0.187 0.808-0.465l0.002-0.004 1.529-2.648c0.079-0.135 0.126-0.296 0.126-0.469 0-0.291-0.133-0.55-0.341-0.722l-0.002-0.001zM19.409 17.786l-2.255-0.845-0.341 0.344c-0.914 0.921-2.064 1.605-3.352 1.955l-0.053 0.012-0.469 0.124-0.396 2.374h-2.104l-0.396-2.374-0.469-0.124c-1.341-0.362-2.491-1.047-3.404-1.967l-0-0-0.341-0.344-2.255 0.845-1.052-1.822 1.858-1.529-0.127-0.467c-0.166-0.59-0.261-1.267-0.261-1.967s0.095-1.377 0.274-2.020l-0.013 0.053 0.127-0.467-1.858-1.529 1.052-1.822 2.255 0.845 0.341-0.344c0.914-0.921 2.064-1.605 3.352-1.955l0.053-0.012 0.469-0.124 0.396-2.374h2.104l0.396 2.374 0.469 0.124c1.341 0.362 2.491 1.047 3.404 1.967l0 0 0.341 0.344 2.255-0.845 1.052 1.822-1.858 1.529 0.127 0.467c0.166 0.59 0.261 1.267 0.261 1.967s-0.095 1.377-0.274 2.020l0.013-0.053-0.127 0.467 1.858 1.529z"></path>
                                </svg>
                        </use>
                    </svg>
                </button>
                <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item" href="{{route('edit.producto',$item->codigo)}}">
                        <svg class="c-icon" style="max-width: 64px">
                            <use xlink:href="/sprites/linear.svg#cil-pencil">
                                <svg id="cil-pencil" viewBox="0 0 512 512">
                                    <path fill="currentColor" d="M469.9614,42.0391a88.8318,88.8318,0,0,0-125.6274,0L71.8379,314.5352,23.666,456.541a24.8442,24.8442,0,0,0,5.9971,25.709l.0869.0869a24.8445,24.8445,0,0,0,17.6123,7.3418A25.19,25.19,0,0,0,55.46,488.334l142.0053-48.1719L469.9609,167.666a88.8312,88.8312,0,0,0,.0005-125.6269ZM180.1157,412.2563,58.4824,453.5176,99.7437,331.8843,308.5005,123.1274,388.8726,203.5ZM447.3335,145.0386,411.5,180.8726l-80.3721-80.3721L366.9619,64.666a56.8317,56.8317,0,1,1,80.3716,80.3726Z"></path>
                                  </svg>
                            </use>
                        </svg> &nbsp;Editar producto</a>
                    <a class="dropdown-item" href="{{route('codigo.producto',$item->codigo)}}" target="_blank">
                        <svg class="c-icon" style="max-width: 64px">
                            <use xlink:href="/sprites/linear.svg#cil-print">
                                <svg id="cil-print" viewBox="0 0 512 512">
                                    <path d="M420,128.1016V16H92V128.1016A80.0983,80.0983,0,0,0,16,208V400H84V368H48V208a48.054,48.054,0,0,1,48-48H416a48.054,48.054,0,0,1,48,48V368H420v32h76V208A80.0983,80.0983,0,0,0,420,128.1016ZM388,128H124V48H388Z" class="cls-1"></path>  <rect width="32" height="32" x="396" y="200" class="cls-1"></rect>  <path d="M428,296V264H76v32h40V496H388V296h40ZM356,464H148V296H356Z" class="cls-1"></path>
                                </svg>
                            </use>
                        </svg>&nbsp; Imprimir código</a>
                    <a class="dropdown-item" data-toggle="modal" data-target="#stock-{{$item->id}}">
                        <svg class="c-icon" style="max-width: 64px">
                            <use xlink:href="/sprites/linear.svg#cil-plus">
                                <svg id="cil-plus" viewBox="0 0 512 512">
                                    <polygon fill="currentColor" points="440 240 272 240 272 72 240 72 240 240 72 240 72 272 240 272 240 440 272 440 272 272 440 272 440 240"></polygon>
                                  </svg>
                            </use>
                        </svg>
                            &nbsp; Aumentar stock</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" data-toggle="modal" data-target="#modal-{{$item->id}}">
                        <svg class="c-icon" style="max-width: 64px">
                            <use xlink:href="/sprites/linear.svg#cil-trash">
                                <svg id="cil-trash" viewBox="0 0 512 512">
                                    <path d="M96,472a23.82,23.82,0,0,0,23.5791,24H392.4209A23.82,23.82,0,0,0,416,472V152H96Zm32-288H384V464H128Z" class="cls-1"></path>  <rect width="32" height="200" x="168" y="216" class="cls-1"></rect>  <rect width="32" height="200" x="240" y="216" class="cls-1"></rect>  <rect width="32" height="200" x="312" y="216" class="cls-1"></rect>  <path d="M328,88V40c0-13.458-9.4878-24-21.6-24H205.6C193.4878,16,184,26.542,184,40V88H64v32H448V88ZM216,48h80V88H216Z" class="cls-1"></path>
                                </svg>
                            </use>
                        </svg>
                        &nbsp;
                        Eliminar producto</a>
                </div>
            </div>
            
        </div>
    </div>
</div>
@include('productos.stock')
@include('productos.modal')
@endforeach
<div class="col-lg-12">
    {{$productos->render()}}
</div>