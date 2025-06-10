<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">


    @yield('styles')
</head>

<body>
    <!-- Navbar -->
    @include('layouts.partials.instructor-navbar')

    <!-- Contenido principal -->
    <div class="main-wrapper">
        @yield('content')
    </div>

    <!-- Footer -->
    @include('layouts.partials.footer')


    @yield('scripts')
</body>
</html> 
