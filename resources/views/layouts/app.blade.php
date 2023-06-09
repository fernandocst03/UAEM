<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="description"
    content="La máxima casa de estudios morelense fue fundada en abril de 1953 y obtuvo su autonomía en 1967. Es una universidad pública incluyente, laica y democrática, legitimada y prestigiada socialmente en los ámbitos estatal, regional, nacional e internacional.">

  <title>{{ config('app.name', 'Laravel') }}</title>

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.bunny.net">
  <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
  <link rel="icon"
    href="https://upload.wikimedia.org/wikipedia/commons/thumb/1/1a/Logo_de_la_UAEMex.svg/800px-Logo_de_la_UAEMex.svg.png">
  <!-- Scripts -->
  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased">
  <div class="bg-gray-100 ">
    @include('layouts.navigation')

    <!-- Page Heading -->
    @if (isset($header))
      <header class="hidden bg-white border-b-2 border-gray-200 sm:block">
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

<script src="{{ asset('js/getRouteName.js') }}"></script>
<script type="text/javascript">
  // Cuando el usuario pierde el foco o sale de tu pestaña (sitio web)
  window.addEventListener("blur", () => {
    document.title = "UAEM";
  });
  // Cuando el enfoque del usuario vuelve a tu pestaña (sitio web) nuevamente
  window.addEventListener("focus", getRouteName);
  // Cuando carga la pagina
  window.addEventListener('load', getRouteName);
</script>
