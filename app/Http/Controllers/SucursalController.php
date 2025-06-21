<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sucursal;
use App\Models\ImagenSucursal;

class SucursalController extends Controller
{
    // Mostrar formulario para crear una nueva sucursal
    public function create()
    {
        return view('sucursales.create');
    }

    // Guardar la nueva sucursal
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'imagenes.*' => 'image|mimes:jpg,jpeg,png|max:2048',
            'etiquetas' => 'nullable|string',
            'dias_funcionamiento' => 'nullable|string',
            'horarios' => 'nullable|string',
            'productos' => 'nullable|array',
            'precios' => 'nullable|array',
            'ubicacion' => 'nullable|string',
        ]);

        $productos = $request->productos ?? [];
        $precios = $request->precios ?? [];

        $preciosNumeros = array_filter(array_map('floatval', $precios));
        $promedio = count($preciosNumeros) ? array_sum($preciosNumeros) / count($preciosNumeros) : 0;

        // Crear sucursal con campos reales de la tabla
        $sucursal = Sucursal::create([
            'nombre_sucursal' => $request->nombre,
            'descripcion_sucursal' => $request->descripcion,
            'ubicacion_dada_sucursal' => $request->ubicacion,
            'promedio_productos' => $promedio,
            'id_dia_de_servicio' => 1, // Ajusta si tienes lógica para días
            'id_usuario_negocio' => auth()->id(), // Ajusta si no estás usando autenticación
            'estado_sucursal' => 'activa',
            'fecha_de_creacion' => now()
        ]);

        // Guardar imágenes en la tabla imagenes_sucursal
        if ($request->hasFile('imagenes')) {
            $orden = 1;
            foreach ($request->file('imagenes') as $imagen) {
                $path = $imagen->store('sucursales', 'public');

                ImagenSucursal::create([
                    'ruta_imagen_sucursal' => $path,
                    'id_sucursal' => $sucursal->id,
                    'imagen_sucursal_orden' => $orden++
                ]);
            }
        }

        return redirect()->route('sucursales.index')->with('success', 'Sucursal registrada correctamente.');
    }

    // Mostrar listado de sucursales
    public function index()
    {
        $sucursales = Sucursal::with('imagenesSucursal')->get();
        return view('sucursales.index', compact('sucursales'));
    }

    // Mostrar formulario para editar una sucursal
    public function edit(Sucursal $sucursal)
    {
        $sucursal->load('imagenesSucursal');
        return view('sucursales.edit', compact('sucursal'));
    }

    // Actualizar sucursal existente
    public function update(Request $request, Sucursal $sucursal)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'etiquetas' => 'nullable|string',
            'dias_funcionamiento' => 'nullable|string',
            'horarios' => 'nullable|string',
            'productos' => 'nullable|array',
            'precios' => 'nullable|array',
            'ubicacion' => 'nullable|string',
            'imagenes.*' => 'image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $productos = $request->productos ?? [];
        $precios = $request->precios ?? [];

        $preciosNumeros = array_filter(array_map('floatval', $precios));
        $promedio = count($preciosNumeros) ? array_sum($preciosNumeros) / count($preciosNumeros) : 0;

        // Actualizar campos reales de la tabla
        $sucursal->update([
            'nombre_sucursal' => $request->nombre,
            'descripcion_sucursal' => $request->descripcion,
            'ubicacion_dada_sucursal' => $request->ubicacion,
            'promedio_productos' => $promedio,
            'id_dia_de_servicio' => 1, // Ajusta si corresponde
            'estado_sucursal' => 'activa',
        ]);

        // Agregar nuevas imágenes si se suben
        if ($request->hasFile('imagenes')) {
            $orden = ImagenSucursal::where('id_sucursal', $sucursal->id)->max('imagen_sucursal_orden') + 1;

            foreach ($request->file('imagenes') as $imagen) {
                $path = $imagen->store('sucursales', 'public');

                ImagenSucursal::create([
                    'ruta_imagen_sucursal' => $path,
                    'id_sucursal' => $sucursal->id,
                    'imagen_sucursal_orden' => $orden++
                ]);
            }
        }

        return redirect()->route('sucursales.index')->with('success', 'Sucursal actualizada correctamente.');
    }
}
