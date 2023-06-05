<x-datatables.styles />
<x-app-layout>

  <x-slot name="header">
    <div class="flex items-center gap-1 pt-1">
      <x-nav-link href="{{ route('acuerdos-cu') }}">
        Acuerdos C.U
      </x-nav-link>
      <x-arrow />
      <x-nav-link href="{{ route('samaras.index') }}" :active="true">
        Acuerdos
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
                <h2 class="title">Importar nuevos acuerdos</h2>
                <p class="text-secondary">
                  Seleccion el archivo con la informacion que desea importar,
                  por favor asegurese que la estructura de
                  los datos esta de manera correcta, en caso de no saber cual es la estructura correspondiente descargue
                  este <a href="{{ route('formato.importacion', ['name' => 'acuerdos']) }}"
                    class="underline">archivo</a>.
                </p>
              </div>
              <form action="{{ route('aceurdos.import') }} " method="post" enctype="multipart/form-data">
                @csrf
                <div class="flex flex-col justify-center w-full">
                  <label class="block">
                    <span class="sr-only">Elija un archivo</span>
                    <input type="file"
                      class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-500 file:text-white hover:file:bg-blue-600 "
                      name="file" />
                  </label>
                  <div class="flex items-center justify-end gap-2 mt-4">
                    <button x-on:click="$dispatch('close')" type="button"
                      class="danger-button">{{ __('Cancelar') }}</button>
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
            {{ __('Nuevo acuerdo') }}
          </x-primary-button>
          <x-modal name="create">
            <div class="px-4 py-8">
              <div class="flex flex-col gap-1 mb-4">
                <h2 class="title">Crear nuevo acuerdo</h2>
                <p class="text-secondary">Ingrese la información del acuerdo</p>
              </div>
              <form method="post" action="{{ route('acuerdos.store') }}">
                @method('post')
                @csrf
                <div>
                  <select name="sesionId" id="sesionId" class="mt-2 border-gray-300 rounded-md border-1">
                    <option value="">Eliga una sesión</option>
                    @foreach ($lastFiveSesions as $item)
                      <option value="{{ $item->id }}">Sesión del día: {{ $item->fecha }}</option>
                    @endforeach
                  </select>
                  <x-input-error :messages="$errors->get('sesionId')" class="mt-1" />
                </div>
                <div class="w-full mt-6">
                  <x-input-label for="tipoAcuerdo" :value="__('Tipo de acuerdo')" />
                  <select name="tipoAcuerdo" id="tipoAcuerdo" class="mt-2 border-gray-300 rounded-md border-1">
                    <option value="">Eliga una opcion</option>
                    <option value="10">Elección de persona titular de unidad académica</option>
                    <option value="11">Alta de PE de licenciatura</option>
                    <option value="12">Alta de PE de postgrado</option>
                    <option value="13">Modificación curricular de PE de Licenciatura</option>
                    <option value="14">Modificación curricular de PE de Posgrado</option>
                    <option value="15">Reestructuración curricular de PE de Licenciatura
                    </option>
                    <option value="16">Reestructuración curricular de PE de Posgrado</option>
                    <option value="17">Cancelación de PE de Licenciatura</option>
                    <option value="18">Cancelación de PE de Posgrado</option>
                    <option value="19">Otro</option>
                  </select>
                  <x-input-error :messages="$errors->get('tipoAcuerdo')" class="mt-1" />
                </div>

                <div class="w-full mt-6">
                  <x-input-label for="punto" :value="__('Punto')" />
                  <x-text-input id="punto" name="punto" type="number" class="block mt-1 w-fit" placeholder="1"
                    min="1" />
                  <x-input-error :messages="$errors->get('punto')" class="mt-1" />
                </div>

                <div class="w-full mt-6">
                  <x-input-label for="acuerdoCorto" :value="__('Acuerdo Corto')" />
                  <textarea name="acuerdoCorto" id="acuerdoCorto" cols="40" rows="5" placeholder="Escriba el acuerdo corto."
                    class="p-2 mt-2 border-gray-300 rounded-md resize-none border-1"></textarea>
                  <x-input-error :messages="$errors->get('acuerdoCorto')" class="mt-1" />
                </div>

                <div class="w-full mt-6">
                  <x-input-label for="acuerdo" :value="__('Acuerdo')" />
                  <textarea name="acuerdo" id="acuerdo" cols="40" rows="10" placeholder="Escriba el acuerdo."
                    class="p-2 mt-2 border-gray-300 rounded-md resize-none border-1"></textarea>
                  <x-input-error :messages="$errors->get('acuerdo')" class="mt-1" />
                </div>

                <div class="w-full mt-6">
                  <x-input-label for="observaciones" :value="__('Observaciones')" />
                  <textarea name="observaciones" id="observaciones" cols="40" rows="10"
                    placeholder="Escriba las observaciones." class="p-2 mt-2 border-gray-300 rounded-md resize-none border-1"></textarea>
                  <x-input-error :messages="$errors->get('observaciones')" class="mt-1" />
                </div>

                <div class="w-full mt-6">
                  <x-input-label for="tipoOtro" :value="__('Otro tipo')" />
                  <x-text-input id="tipoOtro" name="tipoOtro" class="block w-2/3 mt-1" placeholder="..."
                    type="text" />
                  <x-input-error :messages="$errors->get('tipoOtro')" class="mt-1" />
                </div>

                <div class="w-full mt-6">
                  <x-input-label for="paginaSamara" :value="__('Pagina Samara')" />
                  <x-text-input id="paginaSamara" name="paginaSamara" class="block mt-1 w-fit" placeholder="0"
                    type="text" />
                  <x-input-error :messages="$errors->get('paginaSamara')" class="mt-1" />
                </div>

                <div class="flex justify-end gap-2 mt-4">
                  <x-danger-button type="button" x-on:click="$dispatch('close')">Cancelar</x-danger-button>
                  <x-primary-button class="gap-2" x-data="{ loading: false }" x-on:click="loading = true">
                    <span>Crear Acuerdo</span>
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

    <section class="w-full h-10 my-1">
      @if ($message = Session::get('success'))
        <x-alerts.success :text="$message" />
      @elseif ($message = Session::get('warning'))
        <x-alerts.warning :text="$message" />
      @endif
    </section>

    <section class="flex flex-col gap-5">
      <article class="card-container">
        @if (!empty($lastSesion->acuerdos))
          <div class="flex flex-col gap-1 mb-4">
            <h2 class="title">Acuerdos de la ultima sesion</h2>
            <a class="text-secondary w-fit" href="{{ route('sesiones.show', ['sesione' => $lastSesion->id]) }}">Fecha
              de
              la sesion:
              {{ $lastSesion->fecha }}</a>
          </div>
          <table id="ultima_sesion" class="table px-2 stripe">
            <thead class="bg-gray-900 text-gray-50">
              <tr>
                <th>Tipo del acuerdo</th>
                <th>Otro tipo</th>
                <th>Punto</th>
                <th>Acuerdo corto</th>
                <th>Acuerdo</th>
                <th>Observaciones</th>
                <th>Pagina samara</th>
                <th>Opciones</th>
              </tr>
            </thead>
            <tbody class="font-normal">
              @foreach ($lastSesion->acuerdos as $item)
                <tr class="{{ $item->status ? '' : 'opacity-40' }}">
                  <td>{{ $item->tipoAcuerdo->tipo_acuerdo }}</td>
                  <td>
                    @if ($item->tipo_otro)
                      <p>{{ $item->tipo_otrp }}</p>
                    @else
                      <p class="italic text-secondary">Ninguno</p>
                    @endif
                  </td>
                  <td>{{ $item->punto }}</td>
                  <td>{{ $item->acuerdo_corto }}</td>
                  <td>{{ $item->acuerdo }}</td>
                  <td>
                    @if ($item->observaciones)
                      <p>{{ $item->observaciones }}</p>
                    @else
                      <p class="italic text-secondary">Sin observaciones</p>
                    @endif
                  </td>
                  <td>
                    @if ($item->pagina_samara)
                      <p>{{ $item->pagina_samara }}</p>
                    @else
                      <p class="italic text-secondary">Ninguno</p>
                    @endif
                  </td>
                  <td>
                    <div class="flex gap-2">
                      <a href="{{ route('acuerdos.show', ['acuerdo' => $item->id]) }}" class="btn-primary">Ver</a>
                      @if (Auth::check() && (Auth::user()->role->role = 'Administrador'))
                        <a href="{{ route('acuerdos.edit', ['acuerdo' => $item->id]) }}"
                          class="btn-secondary">Editar</a>
                      @endif
                    </div>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        @else
          <p class="italic text-center text-secondary">Sin información disponible</p>
        @endif
      </article>
    </section>
  </section>

</x-app-layout>

<x-datatables.scripts />
<script src="{{ asset('js/datatables.js') }}"></script>
<script>
  document.addEventListener('DOMContentLoaded', datatable('ultima_sesion'))
</script>
