<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    //
    public $fillable = [
        'nombre',
        'descripcion',
        'precio',
        'cantidad'
    ];
}
