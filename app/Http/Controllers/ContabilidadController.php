<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;
use App\Caja;
use App\Contabilidad;
use App\User;
use App\Gastos;
use DateTime;
use DateTimeZone;
use Illuminate\Support\Facades\Validator;
use Session;
use Illuminate\Support\Facades\Redirect;

class ContabilidadController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(Request $request){
        $buscar = $request->get('buscar');

        if(!$buscar){
            $mytime = Carbon::now('America/Lima');
            $buscar=$mytime->format('Y-m-d');
        }

        $config = DB::table('configuraciones')->first();
        $cajas = DB::table('caja')
        ->where('fecha','=',$buscar)
        ->get();

        return view('contabilidad.index',compact('buscar','cajas','config'));
    }

    public function abrir_caja(){
        $deno = DB::table('denomicacion')
        ->orderby('id','desc')
        ->get();

        $caja = DB::table('caja')
        ->get();

        $config = DB::table('configuraciones')->first();

        $cajas = explode(",",$config->cajas);

        
        $mytime = Carbon::now('America/Lima');
        $fecha=$mytime->format('Y-m-d');

        return view('contabilidad.open_caja',compact('deno','caja','config','fecha','cajas'));
    }

    public function store_abrir_caja(Request $request){
        try {

            /*OBTENER DATOS DE LA CAJA */
            $cantidades = $request->get('cantidad');
            $denominacion = $request->get('denominacion');
            $valor = $request->get('valor');

            $deno = $request->get('deno');
            $cont = 0;

            /*OBTENER LA FECHA */
            $mytime = Carbon::now('America/Lima');
            $fecha=$mytime->format('Y-m-d');

            /**OBTENER MES */
            $today = getdate();

            $valid_caja = DB::table('caja')
            ->where([
                ['caja','=',$request->get('caja')],
                ['fecha','=',$fecha]
            ])
            ->first();

            if($valid_caja){
                Session::flash('warning', 'Ya se aperturó una caja para ese cajero este día');
                return redirect()->back();
            };

            /**Obtener hora local*/
            $hora = new DateTime("now", new DateTimeZone('America/Lima'));

            /*OBTENER FECHA*/

            $codigo_caja = uniqid();

            $caja = new Caja;
            $caja->codigo = $codigo_caja;
            $caja->fecha = $fecha;
            $caja->hora = $hora->format('H:i:s');
            $caja->idusers=auth()->user()->id;
            $caja->monto = $request->get('monto');
            $caja->caja = $request->get('caja');
            $caja->estado = 'Abierta';
            $caja->mes=$today['mon'];
            $caja->monto_cierre = '0';
            $caja->year = $today['year'];
            $caja->save();

            $user = User::findOrFail(auth()->user()->id);
            $user->caja =$codigo_caja;
            $user->update();

            while($cont<count($cantidades)){
                $contabilidad = new Contabilidad;
                $contabilidad->denominacion = $denominacion[$cont];
                $contabilidad->valor = $valor[$cont];
                $contabilidad->cantidad = $cantidades[$cont];
                $contabilidad->idcaja =$caja->id;
                $contabilidad->modo = 'Apertura';
                $contabilidad->save();

                $cont = $cont+1;
            }
           

            Session::flash('success', 'Se abrió la caja para el día hoy: '. $fecha .' - '. $hora->format('H:i:s'));
            return Redirect::to('panel/contabilidad');
        } catch (\Exception $e) {
            dd($e);
            Session::flash('danger', 'Hubo un error al completar el formulario');
            return redirect()->back();
        }
    }

    public function cerrar_caja($id){
        $config = DB::table('configuraciones')->first();

        $deno = DB::table('denomicacion')
        ->orderby('id','desc')
        ->get();

        $caja = DB::table('caja')
        ->where('id','=',$id)
        ->first();

        $mytime = Carbon::now('America/Lima');
        $fecha=$mytime->format('Y-m-d');

        return view('contabilidad.close_caja',compact('config','deno','caja','fecha'));
    }

    public function store_cerrar_caja(Request $request,$id){
        try {
            $cantidades = $request->get('cantidad');
            $denominacion = $request->get('denominacion');
            $valor = $request->get('valor');

            $cont = 0;

            $mytime = Carbon::now('America/Lima');
            $fecha=$mytime->format('Y-m-d');

            $hora = new DateTime("now", new DateTimeZone('America/Lima'));

            $caja = Caja::findOrFail($id);
            if($request->get('monto') < $caja->monto ){
                Session::flash('warning', 'No se puede cerrar caja con un monto inferior al monto base.');
                return redirect()->back();
            }
            $caja->monto_cierre = $request->get('monto');
            $caja->estado = 'Cerrada';
            $caja->hora_cierre= $hora->format('H:i:s');
            $caja->update();

            $user = User::findOrFail(auth()->user()->id);
            $user->caja = null;
            $user->update();

            while($cont<count($cantidades)){
                $contabilidad = new Contabilidad;
                $contabilidad->denominacion = $denominacion[$cont];
                $contabilidad->valor = $valor[$cont];
                $contabilidad->cantidad = $cantidades[$cont];
                $contabilidad->idcaja =$caja->id;
                $contabilidad->modo = 'Clausura';
                $contabilidad->save();

                $cont = $cont+1;
            }

            Session::flash('success', 'Se cerró la caja el día hoy: '. $fecha .' - '. $hora->format('H:i:s'));
            return Redirect::to('panel/contabilidad');

        } catch (\Exception $e) {
            Session::flash('danger', 'Hubo un error al completar el formulario');
            return redirect()->back();
        }
    }

    public function semanal(Request $request){

        $today = getdate();
        $data_month = ['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'];
        $current_month = $today['mon'];
        

        if(is_null($request->get('year'))){
            $current_year = $today['year'];
        }else{
            $current_year = $request->get('year');
        }

        $config = DB::table('configuraciones')->first();

        $caja_mes_anterior = DB::table('caja')
        ->select(DB::raw("sum(monto) as monto"),DB::raw("sum(monto_cierre) as monto_cierre"))
        ->where([
            ['mes','=',$today['mon']-1],
            ['year','=',$current_year]
        ])
        ->first();

        $caja_mes_actual = DB::table('caja')
        ->select(DB::raw("sum(monto) as monto"),DB::raw("sum(monto_cierre) as monto_cierre"))
        ->where([
            ['mes','=',$today['mon']],
            ['year','=',$current_year]
        ])
        ->first();

        /*PORCENTAJES*/
   


        $caja_1 = DB::table('caja')
        ->select(DB::raw("sum(monto) as monto"),DB::raw("sum(monto_cierre) as monto_cierre"))
        ->where([
            ['mes','=',1],
            ['year','=',$current_year]
        ])
        ->first();

        $caja_2 = DB::table('caja')
        ->select(DB::raw("sum(monto) as monto"),DB::raw("sum(monto_cierre) as monto_cierre"))
        ->where([
            ['mes','=',2],
            ['year','=',$current_year]
        ])
        ->first();



        $caja_3 = DB::table('caja')
        ->select(DB::raw("sum(monto) as monto"),DB::raw("sum(monto_cierre) as monto_cierre"))
        ->where([
            ['mes','=',3],
            ['year','=',$current_year]
        ])
        ->first();

  
  
        $caja_4 = DB::table('caja')
        ->select(DB::raw("sum(monto) as monto"),DB::raw("sum(monto_cierre) as monto_cierre"))
        ->where([
            ['mes','=',4],
            ['year','=',$current_year]
        ])
        ->first();

    

        $caja_5 = DB::table('caja')
        ->select(DB::raw("sum(monto) as monto"),DB::raw("sum(monto_cierre) as monto_cierre"))
        ->where([
            ['mes','=',5],
            ['year','=',$current_year]
        ])
        ->first();

  

        $caja_6 = DB::table('caja')
        ->select(DB::raw("sum(monto) as monto"),DB::raw("sum(monto_cierre) as monto_cierre"))
        ->where('mes','=',6)
        ->first();



        $caja_7 = DB::table('caja')
        ->select(DB::raw("sum(monto) as monto"),DB::raw("sum(monto_cierre) as monto_cierre"))
        ->where([
            ['mes','=',7],
            ['year','=',$current_year]
        ])
        ->first();


        $caja_8 = DB::table('caja')
        ->select(DB::raw("sum(monto) as monto"),DB::raw("sum(monto_cierre) as monto_cierre"))
        ->where([
            ['mes','=',8],
            ['year','=',$current_year]
        ])
        ->first();


      
        $caja_9 = DB::table('caja')
        ->select(DB::raw("sum(monto) as monto"),DB::raw("sum(monto_cierre) as monto_cierre"))
        ->where([
            ['mes','=',9],
            ['year','=',$current_year]
        ])
        ->first();


        $caja_10 = DB::table('caja')
        ->select(DB::raw("sum(monto) as monto"),DB::raw("sum(monto_cierre) as monto_cierre"))
        ->where([
            ['mes','=',10],
            ['year','=',$current_year]
        ])
        ->first();



        $caja_11 = DB::table('caja')
        ->select(DB::raw("sum(monto) as monto"),DB::raw("sum(monto_cierre) as monto_cierre"))
        ->where([
            ['mes','=',11],
            ['year','=',$current_year]
        ])
        ->first();


        $caja_12 = DB::table('caja')
        ->select(DB::raw("sum(monto) as monto"),DB::raw("sum(monto_cierre) as monto_cierre"))
        ->where([
            ['mes','=',12],
            ['year','=',$current_year]
        ])
        ->first();


        return view('contabilidad.semanal',compact('caja_1','caja_2','caja_3','caja_4','caja_5','caja_6','caja_7','caja_8','caja_9','caja_10','caja_11','caja_12','current_year','caja_mes_anterior','config','caja_mes_actual'));
    }

    public function historial(Request $request){
        $buscar = $request->get('buscar');

        $config = DB::table('configuraciones')->first();

        $cajas = DB::table('caja')
        ->where('fecha','LIKE','%'.$buscar.'%')
        ->orderby('id','desc')
        ->paginate(15);

        if($request->ajax()){
            return response()->json(view('contabilidad.historial',compact('cajas','buscar','config'))->render());
        }

        return view('contabilidad.historial',compact('cajas','buscar','config'));
    }

    public function gastos(){
        $mytime = Carbon::now('America/Lima');
        $fecha=$mytime->format('Y-m-d');

        $caja = DB::table('caja')
        ->where('codigo','=',auth()->user()->caja)
        ->first();

        $config = DB::table('configuraciones')
        ->first();

        if($caja == null){
            Session::flash('danger', 'El usuario no cuenta con una caja asignada');
            return redirect()->back();
        }

        $idcaja = $caja->{'id'};

        $gastos = Gastos::where('idcaja','=',$idcaja)
        ->orderby('id','desc')
        ->get();

        return view('contabilidad.gasto',compact('fecha','idcaja','gastos','config','caja'));
    }

    public function store_gasto(Request $request){
        $validator = $request->validate([
            'idcaja' => 'required',	
            'detalle' => 'required',
            'precio_gasto' => 'required|numeric',
            'nota' => 'required',
        ]);
        try {
            $gasto = new Gastos;
            $gasto->idcaja = $request->get('idcaja');
            $gasto->detalle = $request->get('detalle');
            $gasto->precio_gasto = $request->get('precio_gasto');
            $gasto->nota = $request->get('nota');
            $gasto->save();

            Session::flash('success', 'Se agregó el gasto a su caja');
            return redirect()->back();

        } catch (\Exception $e) {
            Session::flash('danger', 'Hubo un error al completar el formulario');
            return redirect()->back();
        }
    }
}
