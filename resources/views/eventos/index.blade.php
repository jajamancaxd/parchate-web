<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Eventos Guardados</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8f8f8;
            margin: 0;
            padding: 20px;
        }
        header {
            background-color: #ff6600;
            color: white;
            padding: 15px;
            text-align: center;
            font-size: 20px;
            font-weight: bold;
            margin-bottom: 20px;
        }
        .event-container {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 20px;
        }
        .event-card {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.2);
            overflow: hidden;
            transition: transform 0.2s;
        }
        .event-card:hover {
            transform: scale(1.02);
        }
        .event-card img {
            width: 100%;
            height: 150px;
            object-fit: cover;
        }
        .event-info {
            padding: 10px;
        }
        .event-info h3 {
            margin: 0;
            font-size: 16px;
            color: #ff6600;
        }
        .event-info p {
            font-size: 13px;
            margin: 5px 0;
        }
        .edit-button {
            display: inline-block;
            margin-top: 10px;
            padding: 5px 10px;
            background-color: #ff6600;
            color: white;
            border-radius: 4px;
            text-decoration: none;
        }
    </style>
</head>
<body>

<header>Eventos Guardados</header>

<div class="event-container">
    @foreach($eventos as $evento)
        <div class="event-card">
            @if($evento->imagenes->first())
                <img src="{{ asset('storage/' . $evento->imagenes->first()->ruta_imagen_evento) }}" alt="Imagen del evento">
            @else
                <img src="{{ asset('img/sin-imagen.png') }}" alt="Sin imagen">
            @endif
            <div class="event-info">
                <h3>{{ $evento->nombre_evento }}</h3>
                <p>{{ Str::limit($evento->descripcion_evento, 50) }}</p>
                <a href="{{ route('eventos.edit', $evento->id_evento) }}" class="edit-button">Modificar</a>
            </div>
        </div>
    @endforeach
</div>

</body>
</html>
