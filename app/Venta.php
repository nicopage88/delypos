<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    protected $table = "venta";
    protected $primaryKey = "id";

    public $timestamps = false;

    protected $fillable=[	
        'iduser',	
        'fecha',
        'mes',
        'year',
        'serie',
        'correlativo',
        'razon_social',
        'tipo_factura',
        'hora'
    ];

    protected $guarded=[

    ];
}
