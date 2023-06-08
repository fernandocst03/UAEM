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

  <section class="flex flex-col gap-10 pb-32 md:px-24">

    <article class="px-3 mt-20">
      <div class="flex flex-col items-center">
        <h1 class="text-3xl font-light">Formato 911</h1>
      </div>

      <p class="mt-3 text">
        El Formato-911 consiste en bases de datos conformadas por medio de registros administrativos que contienen la
        información de todas las escuelas del estado (censo de escuelas).
        Todos los centros escolares están obligados a proporcionar la información solicitada por la SEP, tanto al inicio
        como al fin de cada ciclo escolar, siguiendo una logística de captura que involucra tanto a las autoridades
        escolares como a los directivos de la educación de los estados y la propia SEP. Así es como se generan las
        estadísticas educativas para dar cuenta de la educación en el país y proveer la información necesaria para
        diseñar políticas educativas. Las estadísticas generadas son básicas para llevar a cabo los procesos de
        planeación, programación, asignación, evaluación de recursos y rendición de cuentas del sector educativo, además
        de que son los insumos para la construcción de indicadores educativos que contribuyen a la evaluación del
        Sistema Educativo Nacional (SEN), actualmente a cargo del Instituto Nacional para la Evaluación de la Educación
        (INEE)
      </p>
    </article>

  </section>

</x-app-layout>
