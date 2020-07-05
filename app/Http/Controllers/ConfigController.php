<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Configuraciones;
use App\Banner;
use Session;


class ConfigController extends Controller
{
    public function __construct(){
        $this->middleware('admin');
    }
    
    public function general(){
        $config = DB::table('configuraciones')->first();
        return view('config.general',compact('config'));
    }

    public function factura(){
        $config = DB::table('factura')->first();
         
        $factura = file_get_contents(base_path().'/resources/views/ventas/factura.blade.php',FILE_USE_INCLUDE_PATH);
        

        return view('config.factura',compact('config','factura'));
    }

    public function save_cambios(Request $request){

        try {
            $code = $request->get('code');
        
            file_put_contents(base_path().'/resources/views/ventas/factura.blade.php',$code);
            Session::flash('success', 'Se guardó los cambios de la configuración');
            return redirect()->back();
        } catch (\Exception $e) {
            dd($e);
        }
    }

    public function editar_config(Request $request,$id){
        $validator = $request->validate([
            'titulo'=>'required|max:50',	
            'logo'=>'max:5000',
            'marcas'=>'required',
            'categorias'=>'required',
            'presentaciones'=>'required',
            'denomicaciones'=>'required',	
            'currency'=>'required|max:20',
            'tipo_moneda'=>'required|max:50',	
            'prefijo_moneda'=>'required|max:6',
            'cajas'=>'required',	
            'serie'=>'required|max:3',
            'correlativo'=>'required|max:7',	
            'igv'=>'required|numeric',
        ]);
        
        try {
           
            $config = Configuraciones::findOrFail($id);
            $config->titulo = $request->get('titulo');
            if($request->logo){
                if($extension == 'png' || $extension == 'jpeg' || $extension == 'jpg' || $extension == 'webp'){
                    $imgname = uniqid();
                    $extension = $request->logo->extension();
                    $imageName = $imgname.'.'.$request->logo->extension();  
                    $request->logo->move(public_path('img'), $imageName);
                    $producto->logo = $imageName;
                }
            }
            $config->marcas = preg_replace("/[\r\n|\n|\r]+/", " ",$request->get('marcas'));
            $config->categorias = $request->get('categorias');
            $config->presentaciones = preg_replace("/[\r\n|\n|\r]+/", " ",$request->get('presentaciones'));
            $config->denomicaciones = preg_replace("/[\r\n|\n|\r]+/", " ",$request->get('denomicaciones'));
            $config->currency = $request->get('currency');
            $config->tipo_moneda = $request->get('tipo_moneda');
            $config->prefijo_moneda = $request->get('prefijo_moneda');
            $config->cajas = preg_replace("/[\r\n|\n|\r]+/", " ",$request->get('cajas'));
            $config->serie = $request->get('serie');
            $config->correlativo = $request->get('correlativo');
            $config->igv = $request->get('igv');
            $config->update();
            Session::flash('success', 'Se guardó los cambios de la configuración');

            return redirect()->back();
        } catch (\Exception $e) {
            Session::flash('danger', 'Ocurrió un error al completar el formulario');

            return redirect()->back();
        }
    }

    public function banner(){

        $banners = DB::table('banner')
        ->get();

        return view('banner.index',compact('banners'));
    }

    public function banner_store(Request $request){
        
        $validator = $request->validate([
            
            'imagen'=>'required|max:5000',
           
        ]);

        try {

            $imgname = uniqid();
            $extension = $request->imagen->extension();

            if($extension == 'png' || $extension == 'jpeg' || $extension == 'jpg' || $extension == 'webp'){
                $banner = new Banner;
                $imageName = $imgname.'.'.$request->imagen->extension();  
                $request->imagen->move(public_path('banners'), $imageName);
                $banner->imagen = $imageName;
                $banner->save();

                
                Session::flash('success', 'Se guardó el banner con exito');
                return redirect()->back();
            }else{
          
                Session::flash('danger', 'El formato de la imagen no se acepta');
                return redirect()->back();
            }

        } catch (\Exception $e) {
            Session::flash('danger', 'Ocurrió un error al enviar el banner');
            return redirect()->back();
        }

    }

    public function banner_delete($id){
        try {
            $banner = Banner::findOrFail($id);
            $banner->destroy($id);

            Session::flash('success', 'Se eliminó el banner con exito');
            return redirect()->back();
        } catch (\Exception $e) {
            Session::flash('danger', 'Ocurrió un error al enviar el banner');
            return redirect()->back();
        }
    }
}
