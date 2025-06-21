<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Sucursal extends Model
{
    use HasFactory;

    // Nombre real de la tabla
    protected $table = 'sucursal';

    // 👇 Clave primaria personalizada
    protected $primaryKey = 'id_sucursal';

    // 👇 Laravel debe saber si es incremental y de tipo entero
    public $incrementing = true;
    protected $keyType = 'int';

    // Habilitar timestamps si usas created_at y updated_at
    public $timestamps = true;

    protected $fillable = [
        'nombre_sucursal',
        'descripcion_sucursal',
        'ubicacion_dada_sucursal',
        'longitud',
        'latitud',
        'promedio_productos',
        'id_dia_de_servicio',
        'id_usuario_negocio',
        'estado_sucursal',
        'fecha_de_creacion'
    ];

    public function imagenesSucursal()
    {
        return $this->hasMany(ImagenSucursal::class, 'id_sucursal', 'id_sucursal');
    }
}
