<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Caja;
use App\Venta;
use App\Cliente;
use App\Producto;
use App\DetalleVenta;
use Carbon\Carbon;
use DateTime;
use DateTimeZone;
use Illuminate\Support\Facades\Mail;
use App\Mail\FacturaMail;
use Session;

class VentaController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function registro(){

        $ventas = DB::table('venta')
        ->get();

        $config = DB::table('configuraciones')->first();
        $d_serie = $config->serie;
        $d_correlativo = $config->correlativo;

        if(count($ventas) == 0){

            $serie = str_pad($d_serie,3,'0',STR_PAD_LEFT);
            $correlativo = str_pad($d_correlativo + 1,7,'0',STR_PAD_LEFT);
        }else{
            if($d_correlativo=='9999999'){
                $serie = str_pad($d_serie + 1,3,'0',STR_PAD_LEFT);
                $correlativo = str_pad(1,7,'0',STR_PAD_LEFT);
            }else{
                $venta = DB::table('venta')
                ->orderby('id','desc')
                ->first();
                $serie = str_pad($d_serie,3,'0',STR_PAD_LEFT);
                $correlativo = str_pad($venta->{'correlativo'}+ 1,7,'0',STR_PAD_LEFT);
            }
            
            
        }

        try {
            $caja = Caja::where([
                ['codigo','=',auth()->user()->caja],
                ['estado','=','Abierta']
            ])
            ->firstOrFail();
        } catch (\Exception $e) {
            Session::flash('danger', 'El usuario aun no aperturó alguna caja este día');
            return redirect()->back();
        }

        $productos = DB::table('producto')
        ->orderby('titulo','asc')
        ->get();
        
    
        return view('ventas.registrar',compact('serie','correlativo','caja','productos','config'));
    }

    public function store(Request $request){

        try {
            $ventas_totales = DB::table('venta')
            ->get();

            $today = getdate();
            $hora = new DateTime("now", new DateTimeZone('America/Lima'));

            $clientes_data = DB::table('clientes')
            ->get();
            $email_exist = false;

            $venta = new Venta;
            $venta->razon_social = $request->get('razon_social');
            $venta->tipo_factura = $request->get('tipo_factura');
            $venta->serie = $request->get('serie');
            foreach ($ventas_totales as $key => $item) {
                if($request->get('correlativo') == $item->correlativo){
                    $venta->correlativo = str_pad($request->get('correlativo') + 1,7,'0',STR_PAD_LEFT);
                }else{
                    $venta->correlativo = str_pad($request->get('correlativo'),7,'0',STR_PAD_LEFT);
                }
            }
           /*   */
            
            $venta->idcaja = $request->get('idcaja');
            $venta->email = $request->get('email');
            $venta->iduser = auth()->user()->id;
            $venta->mes = $today['mon'];
            $venta->year = $today['year'];
            $mytime = Carbon::now('America/Lima');
            $venta->fecha = $mytime->format('Y-m-d');
            $venta->hora = $hora->format('H:i:s');
            $venta->total_pagar = substr($request->get('total_pagar'),1);
            $venta->efectivo_pago = $request->get('efectivo_pago');
            $venta->estado = 'Procesado';
            $venta->save();

            foreach ($clientes_data as $key => $item) {
                if($item->email == $request->get('email')){
                    $email_exist = true;
                }
                else{
                    $email_exist = false;
                }
            }

            if(!$email_exist){
                $cliente = new Cliente;
                $cliente->nombres = $request->get('razon_social');
                $cliente->email = $request->get('email');
                $cliente->save();
            }

            $idproducto=$request->get('idproducto');
            $precio_venta=$request->get('precio_venta');
            $cantidad=$request->get('cantidad');

            $data = count($idproducto);
            $cont = 0;

            while($cont<$data){
                $detalle = new DetalleVenta;
                $detalle->idproducto=$idproducto[$cont];
                $detalle->precio_venta=$precio_venta[$cont];
                $detalle->cantidad=$cantidad[$cont];
                $detalle->idventa=$venta->id;
                $detalle->save();

                $producto = Producto::findOrFail($idproducto[$cont]);
                $producto->cantidad = $producto->cantidad - $cantidad[$cont];
                $producto->save();

                $cont = $cont+1;
            }

            //DESCARGAR FACTURA

            return redirect()->route('open_gistorial.venta');
        } catch (\Exception $e) {
           dd($e);
        }
    }
   
    public function open_gistorial(Request $request){

        $from = $request->get('from');
        $to = $request->get('to');

        $month = date('m');
        $day = date('d');
        $year = date('Y');

        if($from && $to){
            $venta = DB::table('venta')
            ->whereBetween('fecha', [$from,  $to])
            ->orderBy('id','desc')
            ->paginate(20);
        }else{
            $venta = DB::table('venta')
            ->orderBy('id','desc')
            ->paginate(20);
            
            $from = '2000-01-01';
            $to = $year . '-' . $month . '-' . $day;
        }

        $config = DB::table('configuraciones')->first();

        if($request->ajax()){
            return response()->json(view('ventas.ajax',compact('from','to','venta','config'))->render());
        }

        return view('ventas.historial',compact('from','to','venta','config'));
    }

    public function factura($id){
        $venta = DB::table('venta')
        ->where('id','=',$id)
        ->first();

        $detalle = DB::table('detalleventa as dv')
        ->join('producto as p','dv.idproducto','=','p.id')
        ->select('p.titulo','dv.precio_venta','dv.cantidad','p.presentacion')
        ->where('idventa','=',$id)
        ->get();

        $config = DB::table('configuraciones')->first();
        $factura = DB::table('factura')->first();

        return \PDF::loadView('ventas.factura', compact('venta','detalle','config','factura'))
        ->stream('archivo.pdf');

       /* return view('ventas.factura', compact('venta','detalle','config','factura')); */
    }

    public function detalles($id){
        $venta = DB::table('venta')
        ->where('id','=',$id)
        ->first();

        $detalle = DB::table('detalleventa as dv')
        ->join('producto as p','dv.idproducto','=','p.id')
        ->select('p.titulo','dv.precio_venta','dv.cantidad','p.presentacion')
        ->where('idventa','=',$id)
        ->get();

        $config = DB::table('configuraciones')->first();
        $factura = DB::table('factura')->first();

        return view('ventas.detalles', compact('venta','detalle','config','factura'));
    }

    public function enviar_correo($id){
        $venta = DB::table('venta')
        ->where('id','=',$id)
        ->first();

        $detalle = DB::table('detalleventa as dv')
        ->join('producto as p','dv.idproducto','=','p.id')
        ->select('p.titulo','dv.precio_venta','dv.cantidad','p.presentacion')
        ->where('idventa','=',$id)
        ->get();

        $config = DB::table('configuraciones')->first();
        $factura = DB::table('factura')->first();

        $email = trim($venta->{'email'});

        $subject = "Factura de venta";
        $for = $email;

        /* Mail::send('ventas.mail',compact('venta','detalle','config','factura'), function($message) use ($email, $subject) {
            $message->to($email)->subject($subject);
        }); */
       
        Mail::send('ventas.mail',compact('venta','detalle','config','factura'), function($msj) use($subject,$for,$config){
            $msj->from($config->{'email'},$config->{'titulo'});
            $msj->subject($subject);
            $msj->to($for);
        });
        Session::flash('success', 'Se envió el correo al correo del cliente con exito');
        return redirect()->back();
    
    }

    public function grafico(Request $request){
        $today = getdate();
        $data_month = ['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'];
        $current_month = $today['mon'];

        if(is_null($request->get('year'))){
            $current_year = $today['year'];
        }else{
            $current_year = $request->get('year');
        }

        $config = DB::table('configuraciones')->first();

        $caja_1 = DB::table('venta')
        ->select(DB::raw("sum(total_pagar) as monto"))
        ->where([
            ['mes','=',1],
            ['year','=',$current_year]
        ])
        ->first();

        $caja_2 = DB::table('venta')
        ->select(DB::raw("sum(total_pagar) as monto"))
        ->where([
            ['mes','=',2],
            ['year','=',$current_year]
        ])
        ->first();



        $caja_3 = DB::table('venta')
        ->select(DB::raw("sum(total_pagar) as monto"))
        ->where([
            ['mes','=',3],
            ['year','=',$current_year]
        ])
        ->first();

  
  
        $caja_4 = DB::table('venta')
        ->select(DB::raw("sum(total_pagar) as monto"))
        ->where([
            ['mes','=',4],
            ['year','=',$current_year]
        ])
        ->first();

    

        $caja_5 = DB::table('venta')
        ->select(DB::raw("sum(total_pagar) as monto"))
        ->where([
            ['mes','=',5],
            ['year','=',$current_year]
        ])
        ->first();

  

        $caja_6 = DB::table('venta')
        ->select(DB::raw("sum(total_pagar) as monto"))
        ->where('mes','=',6)
        ->first();



        $caja_7 = DB::table('venta')
        ->select(DB::raw("sum(total_pagar) as monto"))
        ->where([
            ['mes','=',7],
            ['year','=',$current_year]
        ])
        ->first();


        $caja_8 = DB::table('venta')
        ->select(DB::raw("sum(total_pagar) as monto"))
        ->where([
            ['mes','=',8],
            ['year','=',$current_year]
        ])
        ->first();


      
        $caja_9 = DB::table('venta')
        ->select(DB::raw("sum(total_pagar) as monto"))
        ->where([
            ['mes','=',9],
            ['year','=',$current_year]
        ])
        ->first();


        $caja_10 = DB::table('venta')
        ->select(DB::raw("sum(total_pagar) as monto"))
        ->where([
            ['mes','=',10],
            ['year','=',$current_year]
        ])
        ->first();



        $caja_11 = DB::table('venta')
        ->select(DB::raw("sum(total_pagar) as monto"))
        ->where([
            ['mes','=',11],
            ['year','=',$current_year]
        ])
        ->first();


        $caja_12 = DB::table('venta')
        ->select(DB::raw("sum(total_pagar) as monto"))
        ->where([
            ['mes','=',12],
            ['year','=',$current_year]
        ])
        ->first();

        $venta_pro = DB::table('venta')
        ->where([
            ['estado','=','Procesado'],
            ['year','=',$current_year]
        ])
        ->get();

        $venta_can = DB::table('venta')
        ->where([
            ['estado','=','Cancelado'],
            ['year','=',$current_year]
        ])
        ->get();

        $venta_total =DB::table('venta')
        ->select(DB::raw("sum(total_pagar) as monto"))
        ->first();

        return view('ventas.grafico',compact('caja_1','caja_2','caja_3','caja_4','caja_5','caja_6','caja_7','caja_8','caja_9','caja_10','caja_11','caja_12','current_year','config','venta_pro','venta_can','venta_total'));
    }

    public function cancelar_venta($id){
        try {
            $venta = Venta::findOrFail($id);
            $venta->estado = 'Cancelado';
            $venta->update();

            $detalles = DB::table('detalleventa')
            ->where('idventa','=',$id)
            ->get();
            
            foreach ($detalles as $key => $item) {
                $producto = Producto::findOrFail($item->idproducto);
                $producto->cantidad = $producto->cantidad + $item->cantidad;
                $producto->update();
            }

            Session::flash('success', 'Se se cancelo la venta con exito');
            return redirect()->back();
        } catch (\Exception $e) {
            Session::flash('danger', 'Ocurrió un error en la cancelación, vuelva a intentar.');
            return redirect()->back();
        }

    }
}
