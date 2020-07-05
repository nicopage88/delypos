<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cliente;
use DB;
use Session;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(){
        $clientes = DB::table('clientes')
        ->get();
        return view('mensajeria.index',compact('clientes'));
    }

    public function store(Request $request){

        try {
            $emails = Cliente::pluck('email')->toArray();
            $config = DB::table('configuraciones')->first();

            $mensaje = $request->get('mensaje');
            $asunto = $request->get('asunto');

            $data = [];

            if($mensaje != ''){
                Mail::send('mensajeria.mail',compact('mensaje'), function($msj) use($asunto,$emails,$config){
                    $msj->from($config->{'email'},$config->{'titulo'});
                    $msj->subject($asunto);
                    $msj->to($emails);
                });
                Session::flash('success', 'Se envió el correo al correo a los clientes con exito');
                return redirect()->back();
            }else{
                Session::flash('danger', 'Ocurrió un error al enviar el correo');
                return redirect()->back();
            }

        } catch (\Exception $e) {
            dd($e);
        }
       
    }
}
