<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetalleProductosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalle_productos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('descripcion');
            $table->string('valor_unitario');
            $table->string('entrada_cantidad')->nullable();
            $table->string('entrada_valor')->nullable();
            $table->string('salida_cantidad')->nullable();
            $table->string('salida_valor')->nullable();
            $table->string('saldo_cantidad');
            $table->string('saldo_valor');
            $table->boolean('devuelto')->default(false);
            $table->bigInteger('id_producto');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detalle_productos');
    }
}
