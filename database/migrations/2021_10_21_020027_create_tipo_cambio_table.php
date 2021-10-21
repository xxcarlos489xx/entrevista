<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateTipoCambioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tipo_cambio', function (Blueprint $table) {
            $table->uuid('id')->primary('id');
            $table->double('valor_compra');
            $table->double('valor_venta');
            $table->string('pais',5);
            $table->string('tipo_moneda',5);
            $table->tinyInteger('activo')->comment('1 = activado ; 0 = desactivado');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
            $table->softDeletes('deleted_at', 0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tipo_cambio');
    }
}
