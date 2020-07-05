<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gastos extends Model
{
    protected $table = "gastos";
    protected $primaryKey = "id";

    public $timestamps = false;

    protected $fillable=[	
        'idcaja',	
        'detalle',
        'precio_gasto',
        'nota',
        
    ];

    protected $guarded=[

    ];
}
