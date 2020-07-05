<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use DB;

class FacturaMail extends Mailable
{
    use Queueable, SerializesModels;
    public $venta;
    public $detalles;
    public $config;
    public $factura;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($id)
    {
        $venta = DB::table('venta')
        ->where('id','=',$id)
        ->first();

        $detalles = DB::table('detalleventa as dv')
        ->join('producto as p','dv.idproducto','=','p.id')
        ->select('p.titulo','dv.precio_venta','dv.cantidad','p.presentacion')
        ->where('idventa','=',$id)
        ->get();

        $config = DB::table('configuraciones')->first();
        $factura = DB::table('factura')->first();

        $this->venta = $venta;
        $this->venta = $detalles;
        $this->venta = $config;
        $this->venta = $factura;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('ventas.mail');
    }
}
