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
        return view('eventos.create');
    }

    public function store(Request $request)
{
        $request->validate([
            'nombre_evento' => 'required|string|max:255',
            'descripcion_evento' => 'required|string',
            'fecha_inicio_evento' => 'required|date',
            'fecha_fin_evento' => 'nullable|date|after_or_equal:fecha_inicio_evento',
            'hora_inicio_evento' => 'required',
            'ubicacion_dada_evento' => 'required|string|max:255',
            'imagenes.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
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

        // Guardar imágenes si hay
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

        return redirect()->route('eventos.index')->with('success', 'Evento actualizado correctamente.');
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
        // Cargar todas las imágenes del evento
        $evento->load('imagenes');

        // Cargar todos los eventos (por si los quieres mostrar, opcional)
        $eventos = Evento::with('imagenes')->get();

        return view('eventos.edit', compact('evento', 'eventos'));
    }

    public function update(Request $request, Evento $evento)
{
        $request->validate([
            'nombre_evento' => 'required|string|max:255',
            'descripcion_evento' => 'required|string',
            'fecha_inicio_evento' => 'required|date',
            'fecha_fin_evento' => 'nullable|date|after_or_equal:fecha_inicio_evento',
            'hora_inicio_evento' => 'required',
            'ubicacion_dada_evento' => 'required|string|max:255',
            'imagenes.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',  // <-- aquí agregamos webp
        ]);

        // Actualizar evento
        $evento->update([
            'nombre_evento' => $request->nombre_evento,
            'descripcion_evento' => $request->descripcion_evento,
            'fecha_inicio_evento' => $request->fecha_inicio_evento,
            'fecha_fin_evento' => $request->fecha_fin_evento,
            'hora_inicio_evento' => $request->hora_inicio_evento,
            'ubicacion_dada_evento' => $request->ubicacion_dada_evento,
        ]);

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

        return redirect()->route('eventos.index')->with('success', 'Evento actualizado correctamente.');
    }
}
