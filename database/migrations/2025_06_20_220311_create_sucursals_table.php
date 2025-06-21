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
    Schema::create('sucursals', function (Blueprint $table) {
        $table->id();
        $table->string('nombre');
        $table->text('descripcion');
        $table->json('imagenes')->nullable();
        $table->json('etiquetas')->nullable();
        $table->json('dias_funcionamiento')->nullable();
        $table->json('horarios')->nullable();
        $table->json('productos')->nullable();
        $table->json('precios')->nullable();
        $table->string('ubicacion')->nullable();
        $table->decimal('precio_promedio', 10, 2)->nullable();
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sucursals');
    }
};
