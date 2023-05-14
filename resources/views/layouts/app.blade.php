<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{ config('app.name', 'Laravel') }}</title>

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.bunny.net">
  <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

  <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.3/css/dataTables.bootstrap5.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.6/css/buttons.dataTables.min.css">


  <!-- Scripts -->
  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased">
  <div class="bg-gray-100 ">
    @include('layouts.navigation')

    <!-- Page Heading -->
    @if (isset($header))
      <header class="bg-white border-b-2 border-gray-200">
        <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
          {{ $header }}
        </div>
      </header>
    @endif

    <!-- Page Content -->
    <main>
      {{ $slot }}
    </main>
  </div>
</body>

<footer class="flex flex-col items-center justify-center w-full h-auto gap-2 py-10 bg-blue-600">
  <div class="flex flex-col items-center">
    <h2 class="text-lg font-bold text-gray-100">Direccion</h2>
    <p class="font-light text-gray-200 text-md">Av. Universidad No. 1001, Col Chamilpa, Cuernavaca, Morelos, México.
      C.P. 62209</p>
  </div>
  <div class="flex flex-col items-center">
    <h2 class="text-lg font-bold text-gray-100">Telefono</h2>
    <p class="font-light text-gray-200 text-md">(777) 329-79-00</p>
  </div>
  <div class="flex flex-col items-center">
    <h2 class="text-lg font-bold text-gray-100"> Contacto UAEM</h2>
    <a href="" class="font-light text-gray-200 text-md">Directorio</a>
  </div>
  <div class="flex flex-col items-center">
    <h2 class="text-lg font-bold text-gray-100">Cuenta de correo exclusiva para cuestiones relacionadas con el sitio web
    </h2>
    <a href="" class="font-light text-gray-200 text-md">web@uaem.mx</a>
  </div>
</footer>

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.6/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.html5.min.js"></script>


</html>
