<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\TipoCambio;

$factory->define(TipoCambio::class, function () {
    return [
        'valor_compra' => number_format((rand ((3.70)*100, (3.80)*100)/100),2),
        'valor_venta' => number_format((rand ((3.80)*100, (4.05)*100)/100),2),
        'pais' => 'PE',
        'tipo_moneda' => 'PEN',
        'activo' => 0,
    ];
});
