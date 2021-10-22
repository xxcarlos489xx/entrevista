<?php
//RUTAS CON PREFIJO TIPO-CAMBIO
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'admin', 'middleware' => ['auth']], function () {
    //ADMIN
    Route::get('/tipo-cambio', 'TipoCambio\TipoCambioController@index')->name('TipoCambio');
    Route::get('/tipo-cambio/crear', 'TipoCambio\TipoCambioController@add');
    Route::get('/tipo-cambio/edit/{id}', 'TipoCambio\TipoCambioController@edit');

    //API FRONT
    Route::get('/api/tipo-cambio/all', 'TipoCambio\TipoCambioController@getRegistros');
    Route::post('/api/tipo-cambio/save', 'TipoCambio\TipoCambioController@save');
    Route::post('/api/tipo-cambio/edit', 'TipoCambio\TipoCambioController@editTc');
    Route::post('/api/tipo-cambio/eliminar/{id}', 'TipoCambio\TipoCambioController@deleteTc');
    Route::post('/api/tipo-cambio/eliminar-force/{id}', 'TipoCambio\TipoCambioController@deleteForceTc');
    Route::post('/api/tipo-cambio/changeEstado/{id}', 'TipoCambio\TipoCambioController@changeEstado');
   
});