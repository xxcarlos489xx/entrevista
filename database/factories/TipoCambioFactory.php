<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\TipoCambio;

$factory->define(TipoCambio::class, function () {
    return [
        'valor_compra' => number_format((rand ((3.70)*10, (3.80)*10)/10),2),
        'valor_venta' => number_format((rand ((3.80)*10, 4*05)/10),2),
        'pais' => 'PE',
        'tipo_moneda' => 'PEN',
        'activo' => 0,
    ];
});
