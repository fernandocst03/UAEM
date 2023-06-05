<x-app-layout>

  <x-slot name='header'>

    <x-nav-link :href="route('welcome')" :active="true">
      {{ __('Inicio') }}
    </x-nav-link>

  </x-slot>

  <section class="flex flex-col items-center pt-8 pb-32">

    <section class="flex items-center">
      <img src="https://www.semmexico.mx/wp-content/uploads/2019/10/universidad-autonoma-morelos.jpg"
        alt="Edificio principal de la UAEM" class="rounded-md" width="1000" height="auto">
    </section>

    <section class="flex flex-col items-center w-full gap-16 mt-20">

      <article class='flex flex-col items-center w-2/4'>
        <h2 class="pb-4 text-xl font-bold text-blue-600">Misión</h2>
        <p class='text-center text-secondary'>La UAEM es una institución educativa que forma profesionales
          en los
          niveles Medio
          Superior y Superior, que sean competentes para la vida y líderes académicos en investigación,
          desarrollo y
          creación. Con ello contribuye a la transformación de la sociedad.
          La docencia, la investigación y la extensión se realizan con amplias perspectivas críticas,
          articuladas con
          las políticas internas y externas dentro del marco de la excelencia académica. De esta forma, la
          universidad
          se constituye en un punto de encuentro de la pluralidad de pensamientos y se asume como protagonista
          de una
          sociedad democrática en constante movimiento.</p>
      </article>

      <article class='flex flex-col items-center w-2/4'>
        <h2 class="pb-4 text-xl font-bold text-blue-600">Visión</h2>
        <p class='text-center text-secondary'>Para 2023, la UAEM se consolida como una institución de
          excelencia
          académica,
          sustentable, incluyente y segura, reconocida por la calidad de sus egresados, el impacto de su
          investigación,
          la vinculación, la difusión de la cultura y la extensión de los servicios, posicionada en los
          niveles estatal,
          regional, nacional e internacional, en un mundo interconectado a través de la innovación educativa y
          la
          economía del conocimiento.
          La universidad se distingue como impulsora del cambio, por la transparencia y calidad de sus
          procesos
          sustantivos y adjetivos, la consolidación de sus redes del conocimiento como el recurso de mayor
          valor para el
          logro de sus objetivos y por su respuesta a la sociedad, que equilibra el pensamiento global con el
          actuar
          localmente.</p>
      </article>

    </section>

  </section>

</x-app-layout>
