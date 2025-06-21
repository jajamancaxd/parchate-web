<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('imagenes_sucursal', function (Blueprint $table) {
        $table->id('id_imagen_sucursal');
        $table->string('ruta_imagen_sucursal');
        $table->unsignedBigInteger('id_sucursal');
        $table->integer('imagen_sucursal_orden')->default(1);

        $table->foreign('id_sucursal')->references('id')->on('sucursales')->onDelete('cascade');
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('imagen_sucursals');
    }
};
