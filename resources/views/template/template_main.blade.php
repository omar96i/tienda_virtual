<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ mix('/css/app.css') }}">
    <title></title>
</head>

<body>
    <div class="container-fluid bg-info">
        <nav class="navbar navbar-expand-lg navbar-light bg-info">
            <a class="navbar-brand text-white" href="{{ route('home') }}">Tienda virtual</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav">
                    @if(\Auth::check())
                        @role('admin')
                            <li class="nav-item active">
                                <a class="nav-link text-white" href="{{ route('category') }}">Categories<span class="sr-only">(current)</span></a>
                            </li>
                            <li class="nav-item active">
                                <a class="nav-link text-white" href="{{ route('product', ['tipo' => 'admin']) }}">Products<span class="sr-only">(current)</span></a>
                            </li>
                            <li class="nav-item active">
                                <a class="nav-link text-white" href="{{ route('user') }}">Users<span class="sr-only">(current)</span></a>
                            </li>
                        @else
                            <li class="nav-item active">
                                <a class="nav-link text-white" href="{{ route('categories.products', ['tipo' => 'categories']) }}">Categorias<span class="sr-only">(current)</span></a>
                            </li>
                        @endrole
                        @role('client')
                            <li class="nav-item active">
                                <a class="nav-link text-white" href="{{route('carrito')}}">Carrito<span class="sr-only">(current)</span></a>
                            </li>
                        @endrole
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                {{ auth()->user()->name }}
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                <a class="dropdown-item" href="{{ route('logout') }}">Cerrar sesion</a>
                            </div>
                        </li>

                    @else
                        <li class="nav-item active">
                            <a class="nav-link text-white" href="{{ route('categories.products', ['tipo' => 'categories']) }}">Categorias<span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item active">
                            <a class="nav-link text-white" href="{{ route('login') }}">Iniciar sesion<span class="sr-only">(current)</span></a>
                        </li>
                    @endif
                </ul>
            </div>
        </nav>
    </div>
    <hr>
    @yield('content')
    <script src="{{ mix('/js/app.js') }}"></script>
</body>
</html>
