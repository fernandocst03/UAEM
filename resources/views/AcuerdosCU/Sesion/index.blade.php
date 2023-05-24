<x-datatables.styles />

<x-app-layout>

  <x-slot name="header">
    <div class="flex items-center gap-1 pt-1">
      <x-nav-link href="{{ route('acuerdos-cu') }}">
        Acuerdos C.U
      </x-nav-link>
      <x-arrow />
      <x-nav-link href="{{ route('sesiones.index') }}" :active="true">
        Sesiones
      </x-nav-link>
    </div>
  </x-slot>

  <section class="flex flex-col px-20 pt-10 pb-32">
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
                <h2 class="title">Importar nuevas sesiones</h2>
                <p class="text-secondary">
                  Seleccion el archivo con la informacion que desea importar,
                  por favor asegurese que la estructura de
                  los datos esta de manera correcta, en caso de no saber cual es la estructura correspondiente descargue
                  este <a href="" class="underline">archivo</a>.
                </p>
              </div>
              <form {{-- action="{{ route('acuerdos.import') }} " --}} method="post" enctype="multipart/form-data">
                @csrf
                <div class="flex flex-col justify-center w-full">
                  <label class="block">
                    <span class="sr-only">Choose profile photo</span>
                    <input type="file"
                      class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-500 file:text-white hover:file:bg-blue-600 "
                      name="file" />
                  </label>
                  <div class="flex items-center justify-end gap-2 mt-4">
                    <button x-on:click="$dispatch('close')" type="button"
                      class="danger-button">{{ __('Cancelar') }}</button>
                    <x-primary-button type="submit">{{ __('Importar') }}</x-primary-button>
                  </div>
                </div>
              </form>
            </div>
          </x-modal>
        </article>

        <article>
          <x-primary-button x-data="" x-on:click.prevent="$dispatch('open-modal', 'create')">
            {{ __('Nueva sesión') }}
          </x-primary-button>
          <x-modal name="create">
            <div class="px-4 py-8">
              <div class="flex flex-col gap-1 mb-4">
                <h2 class="title">Crear nueva sesión</h2>
                <p class="text-secondary">Ingrese la fecha y el tipo de la sesión.</p>
              </div>
              <form action="{{ route('sesiones.store') }}" class="flex flex-col gap-4" method="POST">
                @csrf
                @method('post')

                <div class="flex flex-col justify-center gap-2">
                  <x-input-label for="fecha" :value="__('Fecha')" />
                  <input type="date" name="fecha" id="fecha" required
                    class="mt-2 border-gray-300 rounded-md border-1 w-fit">
                  <x-input-error :messages="$errors->get('fecha')" class="mt-2" />
                </div>

                <div class="flex flex-col justify-center gap-2">
                  <x-input-label for="tipoSesion" :value="__('Tipo de la sesión')" />
                  <select name="tipoSesion" id="tipoSesion" class="mt-2 border-gray-300 rounded-md border-1">
                    <option value="">Elige una opcion</option>
                    <option value="1">Ordinaria</option>
                    <option value="2">Extraordinaria</option>
                    <option value="3">Solemne</option>
                  </select>
                  <x-input-error :messages="$errors->get('tipoSesion')" class="mt-2" />
                </div>

                <div class="flex items-center justify-end gap-2 mt-4">
                  <x-danger-button x-on:click="$dispatch('close')" type="button">
                    {{ __('Cancelar') }}
                  </x-danger-button>
                  <x-primary-button class="px-3 py-1 ml-3 bg-gray-800 rounded-md">
                    {{ __('Crear sesión') }}
                  </x-primary-button>
                </div>
              </form>
            </div>
          </x-modal>
        </article>
      </section>
    @endif

    <section class="w-full h-10 my-3">
      @if ($message = Session::get('success'))
        <x-alerts.success :text="$message" />
      @elseif ($message = Session::get('warning'))
        <x-alerts.warning :text="$message" />
      @endif
    </section>

    <section class="flex flex-col gap-5">
      <article class="card-container">
        <h2 class="mb-2 title">Sesiones sin samará asignado</h2>
        <table id="sesionesSinSamaras" class="table px-2 stripe">
          <thead class="bg-gray-900 text-gray-50">
            <tr>
              <th>Fecha</th>
              <th>Tipo de sesion</th>
              <th>Samara</th>
              <th>Número de a cuerdos</th>
              <th></th>
            </tr>
          </thead>
          <tbody class="font-normal">
            @foreach ($sesiones as $sesion)
              @if ($sesion->status && $sesion->samarasesion == null)
                <tr class="text-sm">
                  <td>{{ date('d-m-y', strtotime($sesion->fecha)) }}</td>
                  <td>{{ $sesion->sesionTipo->tipo }}</td>
                  <td class="italic text-secondary">{{ __('Sin samara asiganado') }}</td>
                  <td>{{ sizeof($sesion->acuerdos) }}</td>
                  <td class="flex gap-2">
                    <a href="{{ route('sesiones.show', ['sesione' => $sesion->id]) }}" class="btn-primary">
                      Ver
                    </a>
                    @if (Auth::check() && Auth::user()->role->role == 'Administrador')
                      <a href="{{ route('sesiones.edit', ['sesione' => $sesion->id]) }}" class="btn-secondary">
                        Editar
                      </a>
                    @endif
                  </td>
                </tr>
              @endif
            @endforeach
          </tbody>
        </table>
      </article>

      <article class="card-container">
        <h2 class="mb-2 title">Sesiones del ultimo samará</h2>
        <table id="sesionesUltimosamara" class="table px-2 stripe">
          <thead class="bg-gray-900 text-gray-50">
            <tr>
              <th>Fecha</th>
              <th>Tipo de sesion</th>
              <th>Número de acuerdos</th>
              <th>Opciones</th>
            </tr>
          </thead>
          <tbody class="font-normal">
            @foreach ($samara->samarasesion as $sesiones)
              @if ($sesiones->sesion->status)
                <tr class="text-sm">
                  <td>{{ date('d-m-Y', strtotime($sesiones->sesion->fecha)) }}</td>
                  <td>{{ $sesiones->sesion->sesionTipo->tipo }}</td>
                  <td>{{ sizeOf($sesiones->sesion->acuerdos) }}</td>
                  <td class="flex gap-2">
                    <a href="{{ route('sesiones.show', ['sesione' => $sesiones->sesion->id]) }}"
                      class="btn-primary">Ver</a>
                    @if (Auth::check() && Auth::user()->role->role == 'Administrador')
                      <a href="{{ route('sesiones.edit', ['sesione' => $sesiones->sesion->id]) }}"
                        class="btn-secondary">Editar</a>
                    @endif
                  </td>
                </tr>
              @endif
            @endforeach
          </tbody>
        </table>
      </article>

    </section>
  </section>

</x-app-layout>

<x-datatables.scripts />

<script src="{{ asset('js/datatables.js') }}"></script>
<script>
  document.addEventListener('DOMContentLoaded', [
    datatable('#sesionesSinSamaras'),
    datatable('#sesionesUltimosamara')
  ])
</script>