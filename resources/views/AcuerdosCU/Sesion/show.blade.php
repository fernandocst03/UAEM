<x-datatables.styles />

<x-app-layout>

  <x-slot name="header">
    <div class="flex items-center gap-1 pt-1">
      <x-nav-link href="{{ route('acuerdos-cu') }}">
        Acuerdos C.U
      </x-nav-link>
      <x-arrow />
      <x-nav-link href="{{ route('sesiones.index') }}">
        Sesiones
      </x-nav-link>
      <x-arrow />
      <x-nav-link href="{{ route('sesiones.show', ['sesione' => $sesion->id]) }}" :active="true">
        Sesion del {{ $sesion->fecha }}
      </x-nav-link>
    </div>
  </x-slot>

  <section class="flex flex-col px-20 pt-10 pb-32">
    <section class="card-container">

      <article>
        <div class="flex items-center gap-2">
          <h2 class="title">
            {{ __('Informacion de la sesion') }}
          </h2>
          @if (Auth::check() && Auth::user()->role->role == 'Administrador')
            <a href="{{ route('sesiones.edit', ['sesione' => $sesion->id]) }}"
              class="px-2 py-1 text-xs transition bg-gray-300 rounded hover:bg-gray-200 hover:text-gray-800">
              Editar
            </a>
          @endif
        </div>
        <div class="flex flex-col gap-1 mt-3">
          <p class="text">Fecha de la sesión: {{ date('d-m-Y', strtotime($sesion->fecha)) }}</p>
          <p class="text">Tipo de la sesión: {{ $sesion->sesionTipo->tipo }}</p>
        </div>
      </article>
      <article class="flex justify-end">
        @if (Auth::check() && Auth::user()->role->role == 'Administrador')
          <x-primary-button x-data="" x-on:click.prevent="$dispatch('open-modal', 'create-acuerdo')">
            Agregar acuerdo
          </x-primary-button>
          <x-modal name="create-acuerdo">
            <div class="p-5">
              <p class="font-bold text-md">Crear nuevo acuerdo</p>
              <form method="post" action="{{ route('sesion.acuerdo.store', ['sesion' => $sesion->id]) }}">
                @method('post')
                @csrf
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
                  <textarea name="observaciones" id="observaciones" cols="40" rows="10" placeholder="Escriba las observaciones."
                    class="p-2 mt-2 border-gray-300 rounded-md resize-none border-1"></textarea>
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

                <div class="flex justify-end gap-1 mt-4">
                  <x-danger-button type="button" x-on:click="$dispatch('close')">Cancelar</x-danger-button>
                  <x-primary-button class="gap-2" x-data="{ loading: false }" x-on:click="loading = true">
                    <span>Crear Sesión</span>
                    <span x-show="loading">
                      <x-loaders.spinner />
                    </span>
                  </x-primary-button>
                </div>
              </form>
            </div>
          </x-modal>
        @endif
      </article>

      <article class="w-full h-10 my-3">
        @if ($message = Session::get('success'))
          <x-alerts.success :text="$message" />
        @elseif ($message = Session::get('warning'))
          <x-alerts.warning :text="$message" />
        @endif
      </article>

      <article class="">
        <h2 class="mb-3 text">Acuerdos de la sesión</h2>
        <table id="acuerdos" class="table" style="width: 100%">
          <thead class="w-full bg-gray-900 text-gray-50">
            <tr>
              <th>Punto</th>
              <th>Tipo acuerdo</th>
              <th>Acuerdo corto</th>
              <th>Observaciones</th>
              <th>Pagina Samara</th>
              <th>Opciones</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($sesion->acuerdos as $acuerdo)
              <tr>
                <td>{{ $acuerdo->punto }}</td>
                <td>{{ $acuerdo->tipoAcuerdo->tipo_acuerdo }}</td>
                <td>{{ $acuerdo->acuerdo_corto }}</td>
                <td>
                  @if ($acuerdo->observaciones)
                    {{ $acuerdo->observaciones }}
                  @else
                    <p class="italic text-secondary">Sin observaciones</p>
                  @endif
                </td>
                <td>
                  @if ($acuerdo->pagina_samara)
                    <p>{{ $acuerdo->pagina_samara }}</p>
                  @else
                    <P class="italic text-secondary">Sin pagina</P>
                  @endif
                </td>
                <td>
                  <div class="flex items-center gap-1 ">
                    <a href="{{ route('acuerdos.show', ['acuerdo' => $acuerdo->id]) }}" class="btn-primary">Ver</a>
                    @if (Auth::check() && Auth::user()->role->role == 'Administrador')
                      <a href="{{ route('acuerdos.edit', ['acuerdo' => $acuerdo->id]) }}"
                        class="btn-secondary">Editar</a>
                    @endif
                  </div>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </article>
    </section>
  </section>

</x-app-layout>

<x-datatables.scripts />

<script src="{{ asset('js/dataTableConfig.js') }}"></script>
<script>
  document.addEventListener('DOMContentLoaded', datatable({
    id: '#acuerdos',
    props: {
      orderBy: [0, 'asc'],
      scroll: 'false',
      fileName: 'Acuerdos de la sesión del: {{ $sesion->fecha }}',
      columns: [0, 1, 2, 3, 4]
    }
  }))
</script>
