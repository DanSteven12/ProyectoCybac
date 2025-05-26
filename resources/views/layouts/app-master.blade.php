 <!DOCTYPE html>
 <html lang="es">
 
 <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
    
 </head>
 
 <body>
     <!-- Navbar -->
     @include('layouts.partials.navbar')
     
 
     <!-- Contenido principal -->
     <div class="main-wrapper">
         @yield('content')
     </div>
 
     <!-- Footer -->
     @include('layouts.partials.footer')
 
 </body>
 
 </html>
