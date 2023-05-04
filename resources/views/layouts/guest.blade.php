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

<body class="font-sans text-gray-900 antialiased">
  @include('layouts.navigation')
  <div class="flex flex-col items-center bg-gray-100 py-36 sm:justify-center">
    <div>
      <a href="/">
        <x-application-logo class="h-20 w-20 fill-current text-gray-500" />
      </a>
    </div>

    <div class="mt-6 w-full overflow-hidden bg-white px-6 py-4 shadow-md sm:max-w-md sm:rounded-lg">
      {{ $slot }}
    </div>
  </div>
</body>

<footer class="h-auto w-full bg-blue-600 py-10 px-32">
  <div class="w-72">
    <p class="text-2xl text-gray-900">Contacto</p>
    <div class="flex flex-col gap-3 pt-5">
      <p class="text-gray9800 text-md font-normal">Direccion: <span class="font-normal">Av. Universidad No.
          1001, Col Chamilpa, Cuernavaca, Morelos, México. C.P. 62209</span></p>
      <p class="text-md font-normal text-gray-900">Telefono: <span class="font-normal">(777) 329-79-00</span></p>
    </div>
  </div>
</footer>

</html>
