<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Configuraciones extends Model
{
    protected $table = "configuraciones";
    protected $primaryKey = "id";

    public $timestamps = false;

    protected $fillable=[	
        'titulo',	
        'logo',
        'marcas',
        'categorias',
        'presentaciones',
        'denomicaciones',	
        'currency',
        'tipo_moneda',	
        'prefijo_moneda',
        'cajas',	
        'serie',
        'correlativo',	
        'igv',
    ];

    protected $guarded=[

    ];
}
