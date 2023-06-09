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

  <!-- Scripts -->
  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased text-gray-900">
  @include('layouts.navigation')
  <div class="flex flex-col items-center py-24 bg-gray-50 sm:justify-center">
    <div>
      <a href="/">
        <x-application-logo class="w-20 h-20 text-gray-500 fill-current" />
      </a>
    </div>

    <div class="w-full px-6 py-4 mt-6 overflow-hidden bg-white shadow-md sm:max-w-md sm:rounded-lg">
      {{ $slot }}
    </div>
  </div>
</body>

<footer class="flex flex-col items-center justify-center w-full h-auto gap-2 px-2 py-5 bg-blue-600">
  <div class="flex flex-col items-center">
    <h2 class="text-base font-bold text-gray-100 sm:text-lg">Direccion</h2>
    <p class="text-xs font-light text-center text-gray-200 sm:text-base">Av. Universidad No. 1001, Col Chamilpa,
      Cuernavaca, Morelos,
      México.
      C.P. 62209</p>
  </div>
  <div class="flex flex-col items-center">
    <h2 class="mt-2 text-base font-bold text-gray-100 sm:text-lg">Telefono</h2>
    <p class="text-xs font-light text-center text-gray-200 sm:text-base">(777) 329-79-00</p>
  </div>
  <div class="flex flex-col items-center mt-2">
    <h2 class="text-base font-bold text-gray-100 sm:text-lg"> Contacto UAEM</h2>
    <a href="https://www.uaem.mx/" class="text-xs font-light text-gray-200 sm:text-base">Directorio</a>
  </div>
  <div class="flex flex-col items-center mt-2">
    <h2 class="text-base font-bold text-center text-gray-100 sm:text-lg">Cuenta de correo exclusiva para cuestiones
      relacionadas con
      el sitio web
    </h2>
    <a href="https://www.uaem.mx/" class="text-xs font-light text-gray-200 sm:text-base">web@uaem.mx</a>
  </div>
</footer>

</html>
