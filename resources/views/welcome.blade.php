@extends('layouts.master')

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cartelera de Cine</title>

    <!-- Add Bootstrap CSS link -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

    <!-- No es necesario el bloque de estilos personalizados ya que Bootstrap se encargará del diseño -->

</head>

<body class="bg-light">

    <div class="container mt-4">
        @section('contenido')
        <h1 class="mb-4">Cartelera de Cine</h1>
        <ul class="nav">
            <li class="nav-item"><a class="nav-link" href="/filmout/oldFilms">Pelis antiguas</a></li>
            <li class="nav-item"><a class="nav-link" href="/filmout/newFilms">Pelis nuevas</a></li>
            <li class="nav-item"><a class="nav-link" href="/filmout/films">Pelis</a></li>
            <li class="nav-item"><a class="nav-link" href="/filmout/sortFilms">Pelis Por Fecha Lanzamiento</a></li>
            <li class="nav-item"><a class="nav-link" href="/filmout/countFilms">Contador De Pelis</a></li>
        </ul>

        <div class="card mt-4 p-4">
            <h2 class="mb-4">Añadir Película</h2>
            <form action="{{ route('createFilm') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="Nombre">Nombre:</label>
                    <input type="text" class="form-control" id="Nombre" name="Nombre" required>
                </div>
                <div class="form-group">
                    <label for="Ano">Año:</label>
                    <input type="number" class="form-control" id="Ano" name="Ano" min="0" required>
                </div>
                <div class="form-group">
                    <label for="Genero">Género:</label>
                    <input type="text" class="form-control" id="Genero" name="Genero" required>
                </div>
                <div class="form-group">
                    <label for="Pais">País:</label>
                    <input type="text" class="form-control" id="Pais" name="Pais" required>
                </div>
                <div class="form-group">
                    <label for="Duracion">Duración:</label>
                    <input type="number" class="form-control" id="Duracion" name="Duracion" min="0" required>
                </div>
                <div class="form-group">
                    <label for="Imagen">Imagen URL:</label>
                    <input type="text" class="form-control" id="Imagen" name="Imagen" required>
                </div>
                <button type="submit" class="btn btn-primary">Crear</button>
            </form>

            @if(isset($error))
            <div class="alert alert-danger mt-4" role="alert">
                <h2>{{$error}}</h2>
            </div>
            @endif
        </div>
        @endsection
    </div>

    <!-- Add Bootstrap JS and Popper.js (required for Bootstrap) -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>

</html>