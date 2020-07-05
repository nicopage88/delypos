<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class DetallesController extends Controller
{
    public function data_caja(Request $request,$codigo){
        $caja = DB::table('caja')
        ->where('codigo','=',$codigo)
        ->first();

        $venta = DB::table('venta')
        ->where('idcaja','=',$codigo)
        ->orderBy('id','desc')
        ->paginate(20);

        $config = DB::table('configuraciones')->first();

        if($request->ajax()){
            return response()->json(view('ventas.venta_caja_ajax',compact('venta','config','caja'))->render());
        }

        return view('ventas.venta_caja',compact('venta','config','caja'));
    }
}
