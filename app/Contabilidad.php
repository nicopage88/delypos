<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contabilidad extends Model
{
    protected $table = "contabilidad";
    protected $primaryKey = "id";

    public $timestamps = false;

    protected $fillable=[	
        'denominacion',	
        'valor',
        'cantidad',
        'cantidad',
        'modo'
    ];

    protected $guarded=[

    ];
}
