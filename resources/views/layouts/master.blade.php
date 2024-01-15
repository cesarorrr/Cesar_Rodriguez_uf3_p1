<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <header>

        <img src="{{asset('img/header.png')}}" alt="Header-Pixar">
    </header>
    <main>
        @yield('contenido')
    </main>
    <footer>
        <img src="{{asset('img/footer.jpg')}}" alt="Footer-Pixar">
        <p>Cine By Cesar</p>
    </footer>
</body>

</html>