<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $table = "producto";
    protected $primaryKey = "id";

    public $timestamps = false;

    protected $fillable=[	
        'titulo',	
        'marca',
        'descripcion',
        'categoria',
        'cantidad',
        'precio_venta',
        'presentacion',
        'poster',
        'codigo',
        'createAt',
        'updateAt',
        'estado',	
    ];

    protected $guarded=[

    ];
}
