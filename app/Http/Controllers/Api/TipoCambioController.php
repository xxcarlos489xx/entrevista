<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\TipoCambio;

class TipoCambioController extends Controller
{
    public function getTypeChange(){
        
        $tipo_cambio = TipoCambio::whereActivo(1)->first();

        $tc = (Object) array();

        if ($tipo_cambio) {
            $tc->tc_venta = $tipo_cambio->valor_venta;
            $tc->tc_compra = $tipo_cambio->valor_compra;
            return response()->json($tc, 200);
        }else{
            $tc->message = 'Estamos actualizando el tipo de cambio';
            return response()->json($tc, 503);
        }
    }
}
