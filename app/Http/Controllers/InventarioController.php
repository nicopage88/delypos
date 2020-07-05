<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use DataTables;

class InventarioController extends Controller
{

    public function __construct(){
        $this->middleware('admin');
    }

    function index(Request $request){
        $data =DB::table('producto')
        ->get();

        
        return view('inventario.index');
    }

    function data(){
        $producto = DB::table('producto')->select('*');
        return datatables()->of($producto)
            ->make(true);
    }
}
