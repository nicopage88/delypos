<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Session;
use Illuminate\Support\Facades\Redirect;
use App\Producto;
use App\Ingreso;
use DateTime;

class ProductoController extends Controller
{

    public function __construct(){
        $this->middleware('auth');
        $this->middleware('admin')->only('ingresos');
    }

    public function index(Request $request){
        
      
        $buscar =$request->get('buscar');
        $productos = DB::table('producto')
        ->where('titulo','LIKE','%'.$buscar.'%')
        ->orwhere('codigo','=',$buscar)
        ->orderby('id','desc')
        ->paginate(12);

        $productos_all = DB::table('producto')
        ->get();

        $fil_productos= [];
        foreach ($productos_all as $key => $item) {
            array_push($fil_productos,$item->titulo);
        }

        if($request->ajax()){
            return response()->json(view('productos.ajax',compact('buscar','productos','fil_productos'))->render());
        }

        return view('productos.index',compact('buscar','productos','fil_productos'));
    }

    public function create(){

        $config = DB::table('configuraciones')
        ->first();

        $categorias = explode(",",$config->categorias);
        $marcas = explode(",",$config->marcas);
        $presentaciones = explode(",",$config->presentaciones);

        $codigo = strtoupper(uniqid());
        return view('productos.create',compact('codigo','categorias','marcas','presentaciones','config'));
    }

    public function store(Request $request){
        $validator = $request->validate([
            'titulo'=>'required|max:250|unique:producto',
            'descripcion'=>'required',
            'marca'=>'required|max:100',
            'categoria'=>'required|max:50',
            'presentacion'=>'required|max:50',
            'cantidad'=>'required|numeric',
            'precio_venta'=>'required|max:20',
            'poster'=>'required|max:5000',
            'codigo'=>'required',
            'estado'=>'required',
        ]);
        try {
            $imgname = uniqid();
            $extension = $request->poster->extension();

            if($extension == 'png' || $extension == 'jpeg' || $extension == 'jpg' || $extension == 'webp'){
                $producto = new Producto;
                $producto->titulo = $request->get('titulo');
                $producto->descripcion = $request->get('descripcion');
                $producto->marca = $request->get('marca');
                $producto->categoria = $request->get('categoria');
                $producto->presentacion = $request->get('presentacion');
                $producto->cantidad = $request->get('cantidad');
                $producto->precio_venta = $request->get('precio_venta');
                $producto->estado = $request->get('estado');
                $producto->codigo = $request->get('codigo');
                $producto->createAt = new DateTime();
                $imageName = $imgname.'.'.$request->poster->extension();  
                $request->poster->move(public_path('poster'), $imageName);
                $producto->poster = $imageName;
                $producto->save();

                $ingreso = new Ingreso;
                $ingreso->iduser = auth()->user()->id;
                $ingreso->idproducto = $producto->id;
                $ingreso->createAt = new DateTime();
                $ingreso->mensaje = 'Se registró un producto';
                $ingreso->save();

                Session::flash('success', 'Se registró su producto con exito');
                return Redirect::to('panel/productos');
            }else{
          
                Session::flash('danger', 'El formato de la imagen no se acepta');
                return redirect()->back();
            }

        } catch (\Exception $e) {
      
            Session::flash('danger', 'Hubo un error al completar el formulario');
            return redirect()->back();
        }
    }

    public function edit($codigo){
        $config = DB::table('configuraciones')
        ->first();

        $producto = Producto::where('codigo','=',$codigo)->firstOrFail();

        $categorias = explode(",",$config->categorias);
        $marcas = explode(",",$config->marcas);
        $presentaciones = explode(",",$config->presentaciones);
      
        return view('productos.edit',compact('categorias','marcas','presentaciones','producto','config'));
    }

    public function codigo($codigo){

        return view('productos.codigo',compact('codigo'));
    }

    public function inventario(){
        $productos = DB::table('producto')
        ->orderby('id','desc')
        ->get();

        $res = new DateTime();
        $fecha = $res->format('Y-m-d H:i:s');

        return view('productos.inventario', compact('productos','fecha'));
    }



    public function update(Request $request,$id){
        $validator = $request->validate([
            'titulo'=>'required|max:250|unique:producto,titulo,'.$request->get('titulo').',titulo',
            'descripcion'=>'required',
            'marca'=>'required|max:100',
            'categoria'=>'required|max:50',
            'presentacion'=>'required|max:50',
            'cantidad'=>'required|numeric',
            'precio_venta'=>'required|max:20',
            'poster'=>'max:5000',
            'estado'=>'required',
        ]);
        
        try {
                
                

                
                $producto = Producto::findOrFail($id);
                $producto->titulo = $request->get('titulo');
                $producto->descripcion = $request->get('descripcion');
                $producto->marca = $request->get('marca');
                $producto->categoria = $request->get('categoria');
                $producto->presentacion = $request->get('presentacion');
                $producto->cantidad = $request->get('cantidad');
                $producto->precio_venta = $request->get('precio_venta');
                $producto->estado = $request->get('estado');
                $producto->updateAt = new DateTime();

                if($request->poster){
                    if($extension == 'png' || $extension == 'jpeg' || $extension == 'jpg' || $extension == 'webp'){
                        $imgname = uniqid();
                        $extension = $request->poster->extension();
                        $imageName = $imgname.'.'.$request->poster->extension();  
                        $request->poster->move(public_path('poster'), $imageName);
                        $producto->poster = $imageName;
                    }else{
                        Session::flash('danger', 'El formato de la imagen no se acepta');
                        return redirect()->back();
                    }
                }

                $producto->update();

                $ingreso = new Ingreso;
                $ingreso->iduser = auth()->user()->id;
                $ingreso->idproducto = $producto->id;
                $ingreso->createAt = new DateTime();
                $ingreso->mensaje = 'Se editó los datos del producto';
                $ingreso->save();

                Session::flash('success', 'Se registró su producto con exito');
                return Redirect::to('panel/productos');
            

        } catch (\Exception $e) {
  
            Session::flash('danger', 'Hubo un error al completar el formulario');
            return redirect()->back();
        }
    }

    public function stock(Request $request, $id){
        $validator = $request->validate([
            'cantidad'=>'required|numeric',
        ]);
        try {
            $producto = Producto::findOrFail($id);
            $producto->cantidad = $producto->cantidad + $request->get('cantidad');
            $producto->update();

            $ingreso = new Ingreso;
            $ingreso->iduser = auth()->user()->id;
            $ingreso->idproducto = $producto->id;
            $ingreso->createAt = new DateTime();
            $ingreso->mensaje = 'Se aumentó el stock en '.$request->get('cantidad').' '. $producto->presentacion;
            $ingreso->save();

            Session::flash('success', 'Se aumento el stock del producto correctamente');
            return redirect()->back();
        } catch (\Exception $e) {
            Session::flash('danger', 'Hubo un error al completar el formulario');
            return redirect()->back();
        }
    }

    public function ingresos(Request $request){

        $from = $request->get('from');
        $to = $request->get('to');

        $month = date('m');
        $day = date('d');
        $year = date('Y');

        

        if($from && $to){
            $ingreso = DB::table('ingreso as i')
            ->join('producto as p','p.id','=','i.idproducto')
            ->join('users as u','u.id','=','i.iduser')
            ->whereBetween('i.createAt', [$from,  $to])
            ->orderBy('i.id','desc')
            ->paginate(30);
        }else{
            $ingreso = DB::table('ingreso as i')
            ->join('producto as p','p.id','=','i.idproducto')
            ->join('users as u','u.id','=','i.iduser')
            ->select('p.titulo','u.name','i.createAt','i.mensaje')
            ->orderBy('i.id','desc')
            ->paginate(30);
            $from = '2000-01-01';
            $to = $year . '-' . $month . '-' . $day;
        }

        

        return view('productos.ingresos',compact('ingreso','from','to'));
    }

    public function imprimir_codigos(){

        $productos = DB::table('producto')
        ->orderby('id','desc')
        ->paginate(20);

        return view('productos.codigos',compact('productos'));
    }

    public function eliminar($id){
       try {
            $producto = Producto::findOrFail($id);
            $producto->destroy($id);

            $ingreso = new Ingreso;
            $ingreso->iduser = auth()->user()->id;
            $ingreso->createAt = new DateTime();
            $ingreso->mensaje = 'Se elimino un producto';
            $ingreso->save();

            Session::flash('success', 'Se eliminó el producto correctamente');
            return redirect()->back();
       } catch (\Throwable $th) {
            Session::flash('danger', 'Hubo un error al eliminar el producto');
            return redirect()->back();
       }
    }
}
