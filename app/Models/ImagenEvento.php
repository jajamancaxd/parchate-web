<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImagenEvento extends Model
{
    use HasFactory;

    protected $table = 'imagenes_evento'; // 👉 Así lo solucionas

    protected $fillable = [
        'ruta_imagen_evento',
        'id_evento',
        'imagen_evento_orden',
    ];

    public function evento()
    {
        return $this->belongsTo(Evento::class, 'id_evento');
    }
}
