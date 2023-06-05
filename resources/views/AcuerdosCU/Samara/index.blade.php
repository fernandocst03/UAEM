<x-datatables.styles />

<x-app-layout>
  <x-slot name="header">
    <div class="flex items-center gap-1 pt-1">
      <x-nav-link href="{{ route('acuerdos-cu') }}">
        Acuerdos C.U
      </x-nav-link>
      <x-arrow />
      <x-nav-link href="{{ route('samaras.index') }}" :active="true">
        Samarás
      </x-nav-link>
    </div>
  </x-slot>

  <section class="flex flex-col px-20 pt-10 pb-32">
    @if (Auth::check() && Auth::user()->role->role == 'Administrador')
      <section class="flex justify-end">
        <x-primary-button x-data="" x-on:click.prevent="$dispatch('open-modal', 'create')">
          Crear Samará
        </x-primary-button>
        <x-modal name="create">
          <div class="p-5">
            <form action="{{ route('samaras.store') }}" method="post" class="flex flex-col gap-2">
              @csrf
              <h2 class="font-bold">Crea un nuevo samará</h2>

              <div class="mt-5">
                <x-input-label for="numero" :value="__('Número del samara')" />
                <x-text-input id="numero" name="numero" type="text" class="block mt-1 w-fit" placeholder="000" />
                <x-input-error class="mt-2" :messages="$errors->get('numero')" />
              </div>

              <div class="mt-4 ">
                <x-input-label for="anio" :value="__('Año')" />
                <x-text-input id="anio" name="anio" type="text" class="block mt-1 w-fit" value=""
                  placeholder="XXVII" />
                <x-input-error class="mt-2" :messages="$errors->get('anio')" />
              </div>

              <div class="mt-4">
                <x-input-label for="rectorado" :value="__('Rectorado')" />
                <select name="rectorado" id="rectorado" class="mt-2 border border-gray-300 rounded-md">
                  <option value="">Elige un rectorado</option>
                  @foreach ($rectorados as $rectorado)
                    <option value="{{ $rectorado->id }}">{{ $rectorado->ciclo }}</option>
                  @endforeach
                </select>
                <x-input-error class="mt-2" :messages="$errors->get('rectorado')" />
              </div>

              <div class="mt-4">
                <x-input-label for="fecha" :value="__('Fecha')" />
                <input type="date" name="fecha" id="fecha" class="mt-2 border border-gray-300 rounded-md">
                <x-input-error class="mt-2" :messages="$errors->get('fecha')" />
              </div>

              <div class="w-full mt-4">
                <x-input-label for="sesiones" class="mb-3" :value="__('Agregar sesiones')" />
                <div class="overflow-auto h-44">
                  <table class="table" style="width: 100%" id="tabla-sesiones">
                    <thead>
                      <tr class="text-sm text-gray-100 bg-gray-900">
                        <th>
                          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                              d="M9 12.75L11.25 15 15 9.75M21 12c0 1.268-.63 2.39-1.593 3.068a3.745 3.745 0 01-1.043 3.296 3.745 3.745 0 01-3.296 1.043A3.745 3.745 0 0112 21c-1.268 0-2.39-.63-3.068-1.593a3.746 3.746 0 01-3.296-1.043 3.745 3.745 0 01-1.043-3.296A3.745 3.745 0 013 12c0-1.268.63-2.39 1.593-3.068a3.745 3.745 0 011.043-3.296 3.746 3.746 0 013.296-1.043A3.746 3.746 0 0112 3c1.268 0 2.39.63 3.068 1.593a3.746 3.746 0 013.296 1.043 3.746 3.746 0 011.043 3.296A3.745 3.745 0 0121 12z" />
                          </svg>
                        </th>
                        <th>Tipo sesión</th>
                        <th>Fecha</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($sesiones as $sesion)
                        @if ($sesion->samarasesion == null)
                          <tr>
                            <td>
                              <input type="checkbox" value="{{ $sesion->id }}" class="ml-3" name="sesion[]"
                                id="{{ $sesion->id }}">
                            </td>
                            <td>{{ $sesion->sesionTipo->tipo }}</td>
                            <td>{{ date('d-m-Y', strtotime($sesion->fecha)) }}</td>
                          </tr>
                        @endif
                      @endforeach
                    </tbody>
                  </table>
                </div>
                <x-input-error class="mt-2" :messages="$errors->get('sesiones')" />
              </div>

              <div class="mt-4">
                <x-input-label for="url_archivo" :value="__('URL documento PDF')" />
                <x-text-input id="url_archivo" name="url_archivo" type="text" class="block w-full mt-1"
                  placeholder="URL" />
              </div>

              <div class="flex justify-end gap-1 mt-16">
                <x-danger-button type="button" x-on:click="$dispatch('close')">Cancelar
                </x-danger-button>
                <x-primary-button class="gap-2" x-data="{ loading: false }" x-on:click="loading = true">
                  <span>Crear Samará</span>
                  <span x-show="loading">
                    <x-loaders.spinner />
                  </span>
                </x-primary-button>
              </div>

            </form>
          </div>
        </x-modal>
      </section>
    @endif

    <section class="w-full h-10 mt-2 text-green-900">
      @if ($message = Session::get('success'))
        <x-alerts.success :text="$message" />
      @elseif ($message = Session::get('warning'))
        <x-alerts.warning :text="$message" />
      @endif
    </section>

    <section class="flex flex-col mt-2">
      <article class="card-container">
        <h2 class="title">Samaras del ultimo rectorado</h2>
        <p class="mb-3 text">Ciclo: {{ $last_rectorado->ciclo }}</p>
        <table id="ultimo_rectorado" class="table stripe" style="width: 100%">
          <thead class="bg-gray-900 text-md text-gray-50">
            <tr>
              <th>Número Samará</th>
              <th>Año</th>
              <th>Ciclo</th>
              <th>Fecha</th>
              <th>Numero de sesiones</th>
              <th>Opciones</th>
              <th>PDF</th>
            </tr>
          </thead>
          <tbody class="text">
            @foreach ($last_rectorado->samaras as $samara)
              <tr class="{{ $samara->status ? '' : 'opacity-40' }}">
                <td>{{ $samara->numero }}</td>
                <td>{{ $samara->anio }}</td>
                <td>{{ $samara->rectorado->ciclo }}</td>
                <td>{{ date('d-m-y', strtotime($samara->fecha)) }}</td>
                <td>{{ sizeOf($samara->samarasesion) }}</td>
                <td>
                  <div class="flex gap-2">
                    <a href="{{ route('samaras.show', ['samara' => $samara->id]) }}" class="btn-primary">
                      Ver
                    </a>
                    @if (Auth::check() && Auth::user()->role->role == 'Administrador')
                      <a href="{{ route('samaras.edit', ['samara' => $samara->id]) }}" class="btn-secondary">
                        Editar
                      </a>
                    @endif
                  </div>
                </td>
                <td>
                  @if ($samara->url_archivo)
                    <a href="{{ $samara->url_archivo }}" target="__blank" class=""><svg
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                          d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m.75 12l3 3m0 0l3-3m-3 3v-6m-1.5-9H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                      </svg>
                    </a>
                  @else
                    <p class="italic text-secondary">Sin PDF asignado</p>
                  @endif
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </article>
      <a href="{{ route('samaras.showAll') }}" class="text-sm text-blue-500 underline mt-7">Ver mas</a>
    </section>

  </section>
</x-app-layout>

<x-datatables.scripts />

<script src="{{ asset('js/datatables.js') }}"></script>
<script>
  document.addEventListener("DOMContentLoaded",
    datatable('#ultimo_rectorado'));
</script>
