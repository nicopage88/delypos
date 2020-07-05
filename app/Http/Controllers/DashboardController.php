<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class DashboardController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    public function index(){
        $today = getdate();
        $data_month = ['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'];
        $config = DB::table('configuraciones')->first();
        $current_month = $today['mon'];
        $current_year = $today['year'];

        $total_pagado = DB::table('venta')
        ->select(DB::raw("sum(total_pagar) as monto"))
        ->where('estado','=','Procesado')
        ->first();

        $total_mes = DB::table('venta')
        ->select(DB::raw("sum(total_pagar) as monto"))
        ->where([
            ['estado','=','Procesado'],
            ['mes','=',$current_month],
            ['year','=',$current_year]
        ])
        ->first();

        $productos = DB::table('producto')
        ->get();

        $usuarios = DB::table('users')
        ->get();

        $mes_actual =$data_month[$current_month - 1];

        $stock = DB::table('producto')
        ->where('cantidad','<',10)
        ->orderby('cantidad','asc')
        ->get();

        $banner = DB::table('banner')
        ->get();


        return view('dashboard',compact('total_pagado','config','total_mes','mes_actual','productos','usuarios','stock','banner'));
    }
}
