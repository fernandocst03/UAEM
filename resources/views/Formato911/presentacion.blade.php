<x-datatables.styles />
<x-app-layout>
  <x-slot name='header'>
    <div class="flex items-center gap-1">
      <x-nav-link>
        {{ __('Formato 911') }}
      </x-nav-link>
      <x-arrow />
      <x-nav-link :href="route('formato-911')" :active="true">
        {{ __('Presentacion') }}
      </x-nav-link>
    </div>
  </x-slot>

  <section class="flex flex-col gap-10 px-24 pb-32">

    <article class="mt-20">
      <div class="flex flex-col items-center">
        <h1 class="text-3xl font-light">Órgano Informativo Universitario</h1>
        <h3 class="mt-3 text-xl font-bold">“Adolfo Menéndez Samará”</h3>
      </div>

      <p class="mt-3 text">
        El Órgano Informativo Universitario “Adolfo Menéndez Samará” fue creado por acuerdo del Consejo
        Universitario en su sesión de fecha 9 de febrero de 1995. El Secretario General de la UAEM, es el
        Director
        de este Órgano Informativo, el cual contiene las actas y acuerdos de las sesiones del Consejo
        Universitario,
        las normatividades que regulan la gestión universitaria y los acuerdos del Rector.

        Para cualquier asunto relacionado a este Órgano se pone a disposición de la Comunidad Universitaria el
        teléfono 01 (777) 329-70-00 extensiones 2125, 3176 y 3124 con la Dirección de Normatividad Institucional
        y
        en el correo electrónico normatividad@uaem.mx
      </p>
    </article>

  </section>

</x-app-layout>
