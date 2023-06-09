<x-datatables.styles />

<x-app-layout>
  <x-slot name="header">
    <div class="flex items-center gap-1 pt-1">
      <x-nav-link href="{{ route('formato-911') }}">
        Formato 911
      </x-nav-link>
      <x-arrow />
      <x-nav-link href="{{ route('unidades-academicas.index') }}" :active="true">
        Unidades Academicas
      </x-nav-link>
    </div>
  </x-slot>

  <section class="flex flex-col w-full pt-10 pb-32 lg:px-20">

    <article class="items-center card-container">
      <form action="">
        <div class="flex flex-col items-center gap-4 md:flex-row">
          <livewire:select />
          <div>
            <select name="anio" id="anio"
              class="border border-gray-500 rounded focus:outline-blue-500 focus:ring-offset-2">
              <option value="">Elige un año</option>
              @for ($i = 2023; $i >= 2000; $i--)
                <option value="{{ $i }}">{{ $i }}</option>
              @endfor
            </select>
          </div>
        </div>
        <div class="flex items-center justify-center gap-2 mt-4">
          <a href="{{ route('unidades-academicas.index') }}"
            class="py-2 uppercase btn-secondary">{{ __('Restablecer') }}</a>
          <x-primary-button class="gap-2" x-data="{ loading: false }" x-on:click="loading = true">
            <span>{{ __('Buscar') }}</span>
            <span x-show="loading">
              <x-loaders.spinner />
            </span>
          </x-primary-button>
        </div>
      </form>
    </article>

    <article class="mt-10 card-container">
      <header class="w-full tabs">
        <h3
          class="px-3 py-2 text-sm font-bold text-center transition bg-gray-900 rounded-tl-lg md:text-base text-gray-50 active hover:cursor-pointer hover:bg-gray-800">
          Personal Administrativo
        </h3>
        <h3
          class="px-3 py-2 text-sm font-bold text-center transition bg-gray-900 md:text-base text-gray-50 hover:cursor-pointer hover:bg-gray-800">
          Personal Docente
        </h3>
        <h3
          class="px-3 py-2 text-sm font-bold text-center transition bg-gray-900 rounded-tr-lg md:text-base text-gray-50 hover:cursor-pointer hover:bg-gray-800">
          Infraestructura
        </h3>
      </header>
      <div class="mt-2">
        @if ($unidadAcademica)
          <section class="relative tab-content">
            <x-loaders.skeleton />
            <article class="active">
              @include('Formato911.Unidad-Academica.partials.personal-administrativo')
            </article>
            <article>
              @include('Formato911.Unidad-Academica.partials.personal-docente')
            </article>
            <article>
              @include('Formato911.Unidad-Academica.partials.infraestructura')
            </article>
          </section>
        @else
          <div class="flex items-center justify-center h-40">
            <span class="italic text-secondary">Realiza una busqueda</span>
          </div>
        @endif
      </div>
    </article>

  </section>
</x-app-layout>

<link rel="stylesheet" href="{{ asset('styles/navigationTabs.css') }}">
<script src="{{ asset('js/tabsNavigation.js') }}"></script>
