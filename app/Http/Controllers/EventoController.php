<?php

namespace App\Http\Controllers;

use App\Models\Evento;
use App\Models\ImagenEvento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EventoController extends Controller
{
    public function index()
    {
        // Consultar todos los eventos con sus imágenes
        $eventos = Evento::with('imagenes')->get();
        return view('eventos.index', compact('eventos'));
    }

    public function create()
    {
        // Mostrar el formulario de creación
        return view('eventos.form');
    }

    public function store(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'nombre_evento' => 'required|string|max:255',
            'descripcion_evento' => 'required|string',
            'fecha_inicio_evento' => 'required|date',
            'fecha_fin_evento' => 'nullable|date|after_or_equal:fecha_inicio_evento',
            'hora_inicio_evento' => 'required',
            'ubicacion_dada_evento' => 'required|string|max:255',
            'imagenes.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Crear el evento
        $evento = Evento::create([
            'nombre_evento' => $request->nombre_evento,
            'descripcion_evento' => $request->descripcion_evento,
            'fecha_inicio_evento' => $request->fecha_inicio_evento,
            'fecha_fin_evento' => $request->fecha_fin_evento,
            'hora_inicio_evento' => $request->hora_inicio_evento,
            'ubicacion_dada_evento' => $request->ubicacion_dada_evento,
        ]);

        // Guardar las imágenes si existen
        if ($request->hasFile('imagenes')) {
            foreach ($request->file('imagenes') as $index => $imagen) {
                $path = $imagen->store('imagenes_evento', 'public');

                ImagenEvento::create([
                    'ruta_imagen_evento' => $path,
                    'id_evento' => $evento->id_evento,
                    'imagen_evento_orden' => $index + 1,
                ]);
            }
        }

        // Redirigir al detalle del evento recién creado
        return redirect()->route('eventos.show', $evento->id_evento)->with('success', 'Evento creado correctamente.');
    }

    public function show(Evento $evento)
    {
        // Cargar el evento con sus imágenes
        $evento->load('imagenes');

        // Mostrar el detalle del evento
        return view('eventos.show', compact('evento'));
    }

    public function edit(Evento $evento)
{
    $eventos = Evento::all(); // Esto carga todos los eventos
    return view('eventos.edit', compact('evento', 'eventos'));
}



    public function update(Request $request, Evento $evento)
    {
        // Validar los datos del formulario
        $request->validate([
            'nombre_evento' => 'required|string|max:255',
            'descripcion_evento' => 'required|string',
            'fecha_inicio_evento' => 'required|date',
            'fecha_fin_evento' => 'nullable|date|after_or_equal:fecha_inicio_evento',
            'hora_inicio_evento' => 'required',
            'ubicacion_dada_evento' => 'required|string|max:255',
            'imagenes.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Actualizar el evento
        $evento->update([
            'nombre_evento' => $request->nombre_evento,
            'descripcion_evento' => $request->descripcion_evento,
            'fecha_inicio_evento' => $request->fecha_inicio_evento,
            'fecha_fin_evento' => $request->fecha_fin_evento,
            'hora_inicio_evento' => $request->hora_inicio_evento,
            'ubicacion_dada_evento' => $request->ubicacion_dada_evento,
        ]);

        // Guardar nuevas imágenes si se subieron
        if ($request->hasFile('imagenes')) {
            foreach ($request->file('imagenes') as $index => $imagen) {
                $path = $imagen->store('imagenes_evento', 'public');

                ImagenEvento::create([
                    'ruta_imagen_evento' => $path,
                    'id_evento' => $evento->id_evento,
                    'imagen_evento_orden' => $index + 1,
                ]);
            }
        }

        // Redirigir al índice de eventos o puedes cambiar por el detalle
        return redirect()->route('eventos.index')->with('success', 'Evento actualizado correctamente.');
    }
}
