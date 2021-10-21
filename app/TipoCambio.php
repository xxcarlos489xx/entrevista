<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\Uuids;

class TipoCambio extends Model
{
    use SoftDeletes,Uuids;

    protected $primaryKey = 'id';

    public $incrementing = false;

    protected $table = 'tipo_cambio';

    protected $fillable = [
        'valor_compra',
        'valor_venta',
        'pais',
        'tipo_moneda',
        'activo'        
    ];
}
