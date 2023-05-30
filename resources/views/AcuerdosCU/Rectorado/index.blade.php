<x-app-layout>

  <x-slot name="header">
    <div class="flex items-center gap-1 pt-1">
      <x-nav-link href="{{ route('acuerdos-cu') }}">{{ __('Acuerdos CU') }}</x-nav-link>
      <x-arrow />
      <x-nav-link :active="true">
        {{ __('Rectorados') }}
      </x-nav-link>
    </div>
  </x-slot>

  <section class="flex flex-col w-full px-24 pt-10 pb-20">

    <section class="flex items-center justify-end w-full gap-1">
      <article>
        <x-secondary-button x-data="" x-on:click.prevent="$dispatch('open-modal', 'import')">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
            stroke="currentColor" class="w-4 h-4">
            <path stroke-linecap="round" stroke-linejoin="round"
              d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m6.75 12l-3-3m0 0l-3 3m3-3v6m-1.5-15H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
          </svg>
          {{ __('Importar datos') }}
        </x-secondary-button>
        <x-modal name="import">
          <div class="flex flex-col gap-4 px-4 py-8">
            <div class="flex flex-col gap-2 mb-3">
              <h2 class="title">Importar nuevos Rectorados</h2>
              <p class="text-secondary">
                Seleccion el archivo con la informacion que desea importar,
                por favor asegurese que la estructura de
                los datos esta de manera correcta, en caso de no saber cual es la estructura correspondiente descargue
                este <a href="" class="underline">archivo.</a>.
              </p>
            </div>
            <form {{-- action="{{ route('acuerdos.import') }} " --}} method="post" enctype="multipart/form-data">
              @csrf
              <div class="flex flex-col justify-center w-full">
                <label class="block">
                  <span class="sr-only">Elige un archivo.</span>
                  <input type="file"
                    class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-500 file:text-white hover:file:bg-blue-600 "
                    name="file" />
                </label>
                <div class="flex items-center justify-end gap-2 mt-4">
                  <button type="reset" class="danger-button">Eliminar archivo</button>
                  <x-primary-button type="submit">Importar</x-primary-button>
                </div>
              </div>
            </form>
          </div>
        </x-modal>
      </article>

      <article>
        <x-primary-button x-data="" x-on:click.prevent="$dispatch('open-modal', 'create')">
          {{ __('Nuevo Rectorado') }}
        </x-primary-button>
        <x-modal name="create">
          <div class="px-4 py-8">
            <div class="flex flex-col gap-1 mb-4">
              <h2 class="title">Crear nuevo Rectorado</h2>
              <p class="text-secondary">Introdusca el periodo del nuevo rectorado</p>
            </div>
            <form method="post" action="{{ route('rectorados.store') }}">
              @method('post')
              @csrf
              <div class="pb-5">
                <x-input-label for="ciclo" value="{{ __('Ciclo') }}" />
                <x-text-input id="ciclo" name="ciclo" type="text" class="block w-3/4 mt-1"
                  placeholder="{{ __('0000-0000') }}" />
                <x-input-error :messages="$errors->get('ciclo')" class="mt-2" />
              </div>
              <div class="flex justify-end gap-2 pb-4 mt-6 text-gray-100">
                <x-danger-button x-on:click="$dispatch('close')" type="button">
                  {{ __('Cancelar') }}
                </x-danger-button>
                <x-primary-button class="gap-2" x-data="{ loading: false }" x-on:click="loading = true">
                  <span>Crear Rectorado</span>
                  <span x-show="loading">
                    <x-loaders.spinner />
                  </span>
                </x-primary-button>
              </div>
            </form>
          </div>
        </x-modal>
      </article>
    </section>

    <section class="w-full h-10 mt-2 text-green-900">
      @if ($message = Session::get('success'))
        <x-alerts.success :text="$message" />
      @elseif ($message = Session::get('warning'))
        <x-alerts.warning :text="$message" />
      @endif
    </section>

    <section class="flex flex-col gap-3">
      @if (empty($rectorados))
        <p class="text-center text-gray-600">No hay rectorados registrados</p>
      @else
        @foreach ($rectorados as $rectorado)
          <div class="card-container">
            <div class="flex items-center gap-3">
              <span class="p-2 {{ $rectorado->status ? 'bg-green-400' : 'bg-red-600' }} rounded-lg">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                  stroke="currentColor" class="w-6 h-6">
                  <path stroke-linecap="round" stroke-linejoin="round"
                    d="M4.26 10.147a60.436 60.436 0 00-.491 6.347A48.627 48.627 0 0112 20.904a48.627 48.627 0 018.232-4.41 60.46 60.46 0 00-.491-6.347m-15.482 0a50.57 50.57 0 00-2.658-.813A59.905 59.905 0 0112 3.493a59.902 59.902 0 0110.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.697 50.697 0 0112 13.489a50.702 50.702 0 017.74-3.342M6.75 15a.75.75 0 100-1.5.75.75 0 000 1.5zm0 0v-3.675A55.378 55.378 0 0112 8.443m-7.007 11.55A5.981 5.981 0 006.75 15.75v-1.5" />
                </svg>
              </span>
              <h2 class="title">Rectorado {{ $rectorado->ciclo }}</h2>
              @if (Auth::check() && Auth::user()->role->role == 'Administrador')
                <a href="{{ route('rectorados.edit', ['rectorado' => $rectorado->id]) }}" class="text-gray-400">
                  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-4 h-4">
                    <path stroke-linecap="round" stroke-linejoin="round"
                      d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                  </svg>
                </a>
              @endif
            </div>
            <div class="flex flex-col w-full gap-2 pl-14">
              @foreach ($rectorado->samaras as $samara)
                <div class="flex justify-between px-0 {{ $samara->status ? '' : 'line-through' }} text items-center">
                  <p>Menendez Samara {{ $samara->numero }}</p>
                  <p>{{ $samara->anio }}</p>
                  <p>{{ date('d-m-Y', strtotime($samara->fecha)) }}</p>
                  @if ($samara->url_archivo)
                    <a href="{{ $samara->url_archivo }}" target="blank">
                      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round"
                          d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m.75 12l3 3m0 0l3-3m-3 3v-6m-1.5-9H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                      </svg>
                    </a>
                  @else
                    <p class="italic text-secondary">PDF sin asignar</p>
                  @endif
                  <div class="flex gap-2">
                    <a href="{{ route('samaras.show', ['samara' => $samara->id]) }}" class="btn-primary">Ver</a>
                    <a href="{{ route('samaras.edit', ['samara' => $samara->id]) }}" class="btn-secondary">Editar</a>
                  </div>
                </div>
              @endforeach
            </div>
          </div>
        @endforeach
      @endif
    </section>

  </section>

</x-app-layout>
