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
    Schema::create('evento', function (Blueprint $table) {
        $table->bigIncrements('id_evento');
        $table->string('nombre_evento');
        $table->text('descripcion_evento');
        $table->date('fecha_inicio_evento');
        $table->date('fecha_fin_evento')->nullable();
        $table->time('hora_inicio_evento');
        $table->string('ubicacion_dada_evento');
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('eventos');
    }
};
