<div class="modal fade" id="stock-{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <form action="{{route('stock.producto',$item->id)}}" method="POST">
        @csrf
        @method('PATCH')
        <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 350px !important;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Aumento de stock</h5>
                <button style="padding:0px" type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
            <div class="modal-body">
            
                <div class="col-lg-12">
                    <label>Stock actual es de {{$item->cantidad}} {{$item->presentacion}}</label>
                    <input type="number" min="0" name="cantidad" class="form-control" placeholder="Stock expresado en {{$item->presentacion}}" autocomplete="off">
                </div>
            
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>&nbsp;
                <button type="submit" class="btn btn-primary">Aumentar</button>
            </div>
        </div>
        </div>
    </form>
</div>