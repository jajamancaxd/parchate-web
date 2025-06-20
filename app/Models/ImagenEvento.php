<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImagenEvento extends Model
{
    use HasFactory;

    protected $table = 'imagenes_evento';

    // Falta indicar la clave primaria, que según tu tabla es 'id_imagen'
    protected $primaryKey = 'id_imagen';

    // Si no usas timestamps en la tabla de imágenes, desactívalos (asumiendo que no hay created_at/updated_at)
    public $timestamps = false;

    protected $fillable = [
        'ruta_imagen_evento',
        'id_evento',
        'imagen_evento_orden',
    ];

    public function evento()
    {
        return $this->belongsTo(Evento::class, 'id_evento', 'id_evento');
    }
}
