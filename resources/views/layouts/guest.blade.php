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
  <div class="flex flex-col items-center bg-gray-50 py-36 sm:justify-center">
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

<footer class="w-full h-auto px-32 py-10 bg-blue-600">
  <div class="w-72">
    <p class="text-2xl text-gray-900">Contacto</p>
    <div class="flex flex-col gap-3 pt-5">
      <p class="font-normal text-gray9800 text-md">Direccion: <span class="font-normal">Av. Universidad No.
          1001, Col Chamilpa, Cuernavaca, Morelos, México. C.P. 62209</span></p>
      <p class="font-normal text-gray-900 text-md">Telefono: <span class="font-normal">(777) 329-79-00</span></p>
    </div>
  </div>
</footer>

</html>
