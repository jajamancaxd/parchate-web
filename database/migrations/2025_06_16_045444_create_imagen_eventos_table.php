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
    Schema::create('imagenes_evento', function (Blueprint $table) {
        $table->bigIncrements('id_imagen');
        $table->string('ruta_imagen_evento');
        $table->unsignedBigInteger('id_evento');
        $table->string('imagen_evento_orden')->nullable();
        $table->foreign('id_evento')->references('id_evento')->on('evento')->onDelete('cascade');
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
       Schema::dropIfExists('imagenes_evento'); // ✅ Correcto

    }
};
