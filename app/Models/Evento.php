<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evento extends Model
{
    use HasFactory;

    protected $table = 'evento';
    protected $primaryKey = 'id_evento';

    public $timestamps = true;

    protected $fillable = [
        'nombre_evento',
        'descripcion_evento',
        'fecha_inicio_evento',
        'fecha_fin_evento',
        'hora_inicio_evento',
        'ubicacion_dada_evento',
    ];

    public function imagenes()
    {
        return $this->hasMany(ImagenEvento::class, 'id_evento');
    }
}


