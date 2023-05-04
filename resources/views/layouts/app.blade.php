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

<body class="font-sans antialiased">
  <div class="min-h-screen bg-gray-100">
    @include('layouts.navigation')

    <!-- Page Heading -->
    @if (isset($header))
      <header class="bg-white shadow">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
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
