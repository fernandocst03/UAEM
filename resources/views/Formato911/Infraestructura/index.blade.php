<x-datatables.styles />

<x-app-layout>
  <x-slot name="header">
    <div class="flex items-center gap-1 pt-1">
      <x-nav-link href="{{ route('formato-911') }}">
        Formato 911
      </x-nav-link>
      <x-arrow />
      <x-nav-link href="{{ route('infraestructuras.index') }}" :active="true">
        Infraestructura
      </x-nav-link>
    </div>
  </x-slot>

  <section class="flex flex-col w-full px-20 pt-10 pb-32">
    @if (Auth::check() && Auth::user()->role->role == 'Administrador')
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
                <h2 class="title">Importar nuevas infraestructuras</h2>
                <p class="text-secondary">
                  Seleccion el archivo con la informacion que desea importar,
                  por favor asegurese que la estructura de
                  los datos esta de manera correcta, en caso de no saber cual es la estructura correspondiente descargue
                  este <a href="" class="underline">archivo.</a>.
                </p>
              </div>
              <form action="{{ route('infraestructuras.import') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="flex flex-col justify-center w-full">
                  <label class="block">
                    <span class="sr-only">Elige un archivo.</span>
                    <input type="file"
                      class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-500 file:text-white hover:file:bg-blue-600 "
                      name="file" />
                  </label>
                  <div class="flex items-center justify-end gap-2 mt-4">
                    <x-danger-button>Cancelar</x-danger-button>
                    <x-primary-button class="gap-2" x-data="{ loading: false }" x-on:click="loading = true">
                      <span>Importar</span>
                      <span x-show="loading">
                        <x-loaders.spinner />
                      </span>
                    </x-primary-button>
                  </div>
                </div>
              </form>
            </div>
          </x-modal>
        </article>

        <article>
          <x-primary-button x-data="" x-on:click.prevent="$dispatch('open-modal', 'create')">
            {{ __('Nueva Infraestructura') }}
          </x-primary-button>
          <x-modal name="create">
            <div class="px-4 py-8">
              <h2 class="title">Crear nueva infraestructura</h2>
              <form method="post" action="{{ route('infraestructuras.store') }}">
                @csrf
                @method('post')

                <div class="flex flex-col gap-1 mt-5">
                  <x-input-label for="unidad_academica" :value="__('Unidad Academica')" />
                  <select name="unidad_academica" id="unidad_academica" class="border border-gray-300 rounded">
                    <option value="">Selecciona una unidad academica</option>
                    @foreach ($unidadesAcademicas as $unidadAcademica)
                      <option value="{{ $unidadAcademica->id }}">
                        {{ $unidadAcademica->unidadDependencia->unidad_dependencia }}</option>
                    @endforeach
                  </select>
                  <x-input-error class="mt-2" :messages="$errors->get('unidad_academica')" />
                </div>

                <div class="flex flex-col gap-1 mt-3">
                  <x-input-label for="anio" :value="__('Año')" />
                  <x-text-input id="anio" name="anio" type="text" class="block w-1/4 mt-1"
                    placeholder="{{ __('0000') }}" />
                  <x-input-error class="mt-1" :messages="$errors->get('anio')" />
                </div>

                <div class="flex flex-col gap-1 mt-3">
                  <x-input-label for="tipoInmueble" :value="__('Tipo de inmueble')" />
                  <select name="tipoInmueble" id="tipoInmueble" class="border border-gray-300 rounded w-fit">
                    <option value="">Eliga una opcion</option>
                    <option value="4">Adaptado</option>
                    <option value="5">Construido para uso educativo</option>
                  </select>
                  <x-input-error class="mt-2" :messages="$errors->get('tipoInmueble')" />
                </div>

                <div class="flex flex-col gap-1 mt-3">
                  <x-input-label for="tipoAula" :value="__('Tipo de aula')" />
                  <select name="tipoAula" id="tipoAula" class="border border-gray-300 rounded w-fit">
                    <option value="">Eliga una opcion</option>
                    <option value="1">Propio</option>
                    <option value="2">Rentado</option>
                    <option value="3">Prestado</option>
                  </select>
                  <x-input-error class="mt-2" :messages="$errors->get('tipoAula')" />
                </div>

                <div class="flex flex-col gap-1 mt-3">
                  <x-input-label for="" :value="__('Aulas')" />
                  <div class="flex items-center gap-3">
                    <div class="flex flex-col gap-1">
                      <x-input-label for="aulas_existentes" value="{{ __('Existentes') }}" />
                      <x-text-input id="aulas_existentes" name="aulas_existentes" type="text"
                        placeholder="{{ __('0') }}" />
                      <x-input-error class="mt-2" :messages="$errors->get('aulas_existentes')" />
                    </div>
                    <div class="flex flex-col gap-1">
                      <x-input-label for="aulas_en_uso" value="{{ __('En uso') }}" />
                      <x-text-input id="aulas_en_uso" name="aulas_en_uso" type="text"
                        placeholder="{{ __('0') }}" />
                      <x-input-error class="mt-2" :messages="$errors->get('aulas_en_uso')" />
                    </div>
                    <div class="flex flex-col gap-1">
                      <x-input-label for="aulas_adaptadas" value="{{ __('Adaptadas') }}" />
                      <x-text-input id="aulas_adaptadas" name="aulas_adaptadas" type="text"
                        placeholder="{{ __('0') }}" />
                      <x-input-error class="mt-2" :messages="$errors->get('aulas_adaptadas')" />
                    </div>
                  </div>
                </div>

                <div class="flex flex-col gap-1 mt-3">
                  <x-input-label for="" :value="__('Talleres')" />
                  <div class="flex items-center gap-3">
                    <div class="flex flex-col gap-1">
                      <x-input-label for="talleres_existentes" value="{{ __('Existentes') }}" />
                      <x-text-input id="talleres_existentes" name="talleres_existentes" type="text"
                        class="1" placeholder="{{ __('0') }}" />
                      <x-input-error class="mt-2" :messages="$errors->get('talleres_existentes')" />
                    </div>
                    <div class="flex flex-col gap-1">
                      <x-input-label for="talleres_en_uso" value="{{ __('En uso') }}" />
                      <x-text-input id="talleres_en_uso" name="talleres_en_uso" type="text" class=""
                        placeholder="{{ __('0') }}" />
                      <x-input-error class="mt-2" :messages="$errors->get('talleres_en_uso')" />
                    </div>
                    <div class="flex flex-col gap-1">
                      <x-input-label for="talleres_adaptados" value="{{ __('Adaptados') }}" />
                      <x-text-input id="talleres_adaptados" name="talleres_adaptados" type="text" class="1"
                        placeholder="{{ __('0') }}" />
                      <x-input-error class="mt-2" :messages="$errors->get('talleres_adaptados')" />
                    </div>
                  </div>
                </div>

                <div class="flex flex-col gap-1 mt-3">
                  <x-input-label for="" :value="__('Laboratorios')" />
                  <div class="flex items-center gap-3">
                    <div class="flex flex-col gap-1">
                      <x-input-label for="laboratorios_existentes" value="{{ __('Existentes') }}" />
                      <x-text-input id="laboratorios_existentes" name="laboratorios_existentes" type="text"
                        class="1" placeholder="{{ __('0') }}" />
                      <x-input-error class="mt-2" :messages="$errors->get('laboratorios_existentes')" />
                    </div>
                    <div class="flex flex-col gap-1">
                      <x-input-label for="laboratorios_en_uso" value="{{ __('En uso') }}" />
                      <x-text-input id="laboratorios_en_uso" name="laboratorios_en_uso" type="text"
                        class="" placeholder="{{ __('0') }}" />
                      <x-input-error class="mt-2" :messages="$errors->get('laboratorios_en_uso')" />
                    </div>
                    <div class="flex flex-col gap-1">
                      <x-input-label for="laboratorios_adaptados" value="{{ __('Adaptados') }}" />
                      <x-text-input id="laboratorios_adaptados" name="laboratorios_adaptados" type="text"
                        class="1" placeholder="{{ __('0') }}" />
                      <x-input-error class="mt-2" :messages="$errors->get('laboratorios_adaptados')" />
                    </div>
                  </div>
                </div>

                <div class="flex flex-col gap-1 mt-3">
                  <div class="flex flex-col gap-1">
                    <x-input-label for="laboratorio_computo" value="{{ __('Laboratorio de computo') }}"
                      class="w-fit" />
                    <x-text-input id="laboratorio_computo" name="laboratorio_computo" type="text" class="1"
                      placeholder="{{ __('0') }}" />
                    <x-input-error class="mt-2" :messages="$errors->get('laboratorio_computo')" />

                  </div>
                </div>

                <div class="flex flex-col gap-1 mt-3">
                  <div class="flex flex-col gap-1">
                    <x-input-label for="biblioteca" value="{{ __('Biblioteca') }}" />
                    <select name="biblioteca" id="" class="border border-gray-300 rounded w-fit">
                      <option value="">Eliga una opcion</option>
                      <option value="1">Si</option>
                      <option value="0">No</option>
                    </select>
                    <x-input-error class="mt-2" :messages="$errors->get('biblioteca')" />
                  </div>
                </div>

                <div class="flex justify-end gap-2 pb-2 mt-10 text-gray-100">
                  <x-danger-button x-on:click="$dispatch('close')" type="button">
                    {{ __('Cancelar') }}
                  </x-danger-button>
                  <x-primary-button class="gap-2" x-data="{ loading: false }" x-on:click="loading = true">
                    <span>Crear</span>
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
    @endif

    <section class="w-full h-10 mt-1 mb-1 text-green-900">
      @if ($message = Session::get('success'))
        <x-alerts.success :text="$message" />
      @elseif ($message = Session::get('warning'))
        <x-alerts.warning :text="$message" />
      @endif
    </section>

    <section class="card-container ">
      <table class="table stripe" id="infraestructuras">
        <thead class="text-sm bg-gray-900 text-gray-50">
          <tr>
            <th>Unidad academica</th>
            <th>Tipo unidad academica</th>
            <th>Municipio</th>
            <th>Campus</th>
            <th>Año</th>
            <th>Tipo inmueble</th>
            <th>Tipo aula</th>
            <th>Aulas existentes</th>
            <th>Talleres existentes</th>
            <th>Laboratorios existentes</th>
            <th>Laboratorios de computo</th>
            <th>Biblioteca</th>
            <th>Opciones</th>
          </tr>
        </thead>
        <tbody class="text">
          @foreach ($infraestructuras as $infraestructura)
            <tr class="{{ $infraestructura->status ? '' : 'opacity-40' }}">
              <td>{{ $infraestructura->unidadAcademica->unidadDependencia->unidad_dependencia }}</td>
              <td>{{ $infraestructura->unidadAcademica->tipoUnidadAcademica->tipo }}</td>
              <td>{{ $infraestructura->unidadAcademica->municipio->municipio }}</td>
              <td>{{ $infraestructura->unidadAcademica->municipio->campus->campus }}</td>
              <td>{{ $infraestructura->anio }}</td>
              <td>{{ $infraestructura->tipoConstruccion->tipo }}</td>
              <td>{{ $infraestructura->tipoPropiedad->tipo }}</td>
              <td>{{ $infraestructura->aulas_existentes }}</td>
              <td>{{ $infraestructura->talleres_existentes }}</td>
              <td>{{ $infraestructura->laboratorios_existentes }}</td>
              <td>{{ $infraestructura->laboratorios_computo }}</td>
              <td>
                @if ($infraestructura->biblioteca)
                  <p>Si</p>
                @else
                  <p>No</p>
                @endif
              </td>
              <td>
                <div class="flex gap-2">
                  <a href="{{ route('infraestructuras.show', ['infraestructura' => $infraestructura->id]) }}"
                    class="btn-secondary">Ver</a>
                  @if (Auth::check() && Auth::user()->role->role == 'Administrador')
                    <a href="{{ route('infraestructuras.edit', ['infraestructura' => $infraestructura->id]) }} "
                      class="btn-primary">Editar</a>
                  @endif
                </div>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </section>

  </section>
</x-app-layout>

<x-datatables.scripts />
<script src="{{ asset('js/datatables.js') }}"></script>
<script>
  $(document).ready(datatable('#infraestructuras'))
</script>
