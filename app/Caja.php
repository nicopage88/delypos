<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Caja extends Model
{
    protected $table = "caja";
    protected $primaryKey = "id";

    public $timestamps = false;

    protected $fillable=[	
        'fecha',	
        'idusers',
        'hora',
        'monto',
        'monto_cierre',
        'estado',
        'caja',
        'monto_cierre',
        'codigo'
    ];

    protected $guarded=[

    ];
}
