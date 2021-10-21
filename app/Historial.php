<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Historial extends Model
{
    protected $table = 'historial';
    public $timestamps = false;
    protected $fillable = [
        'usuario_id',
        'accion',
        'detalle'
    ];
}
