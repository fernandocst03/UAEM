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
      <x-arrow />
      <x-nav-link>
        Editar
      </x-nav-link>
    </div>
  </x-slot>

  <section class="flex flex-col pt-10 pb-20 sm:px-20">
    <article class="card-container">
      <p class="title">Actualice la informacion de la sesion.</p>
      <form method="post" action="{{ route('sesiones.update', ['sesione' => $sesion->id]) }}" class="space-y-6 sm:mt-6"
        id="form" onKeyPress="return disableEnterKey(event)">
        @csrf
        @method('patch')
        <div class="w-1/3 mt-6">
          <x-input-label for="tipoSesion" :value="__('Tipo de sesion')" />
          <select name="tipoSesion" id="tipoSesion" class="mt-2 border-gray-300 rounded-md border-1">
            <option value="">Elige un tipo de sesión</option>
            <option value="1" @if (old('state', $sesion->sesionTipo->id) == '1') {{ 'selected' }} @endif>Ordinaria</option>
            <option value="2" @if (old('state', $sesion->sesionTipo->id) == '2') {{ 'selected' }} @endif>Extraordinaria</option>
            <option value="3" @if (old('state', $sesion->sesionTipo->id) == '3') {{ 'selected' }} @endif>Solemne</option>
          </select>
        </div>

        <div class="w-1/3 mt-6">
          <x-input-label for="fecha" :value="__('Fecha')" />
          <input type="date" name="fecha" id="fecha" class="mt-2 border-gray-300 rounded-md border-1"
            value="{{ Carbon\Carbon::parse($sesion->fecha)->format('Y-m-d') }}">
        </div>

        <div class="flex items-center gap-2">
          <x-primary-button class="gap-2" x-data="{ loading: false }" x-on:click="loading = true">
            <span>Actualizar</span>
            <span x-show="loading">
              <x-loaders.spinner />
            </span>
          </x-primary-button>
          @if ($message = Session::get('success'))
            <x-alerts.success :text="$message" />
          @elseif ($message = Session::get('warning'))
            <x-alerts.warning :text="$message" />
          @endif
        </div>
      </form>

    </article>

    <article class="mt-9 card-container">
      <div class="flex flex-col sm:w-2/3 border-[1px] border-red-500 rounded">
        <div class="flex items-center justify-between px-3 py-5 border-b-2 border-gray-300">
          <div class="flex flex-col justify-center w-1/2">
            <h4 class="title">Eliminar Sesión</h4>
            <p class="text-secondary">Al eliminar esta sesión, no se podra recuperar mas adelante de este
              registro, por favor,este seguro.</p>
          </div>
          <x-danger-button x-data="" x-on:click.prevent="$dispatch('open-modal', 'confirm-delete')">
            Eliminar
          </x-danger-button>
          <x-modal name="confirm-delete">
            <div>
              <form method="post" action="{{ route('sesiones.destroy', ['sesione' => $sesion->id]) }}" class="p-6">
                @csrf
                @method('delete')
                <h2 class="title">
                  {{ __('¿Esta seguro que quiere eliminar este Rectorado?') }}
                </h2>
                <p class="text-secondary">
                  {{ __('Ingrese su contraseña para confirmar que desea eliminar el rectorado de forma permanente.') }}
                </p>
                <div class="mt-6">
                  <x-input-label for="password" value="{{ __('Password') }}" class="sr-only" />
                  <x-text-input id="password" name="password" type="password" class="block w-3/4 mt-1"
                    placeholder="{{ __('Password') }}" />
                  <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
                </div>
                <div class="flex justify-end mt-6">
                  <x-primary-button type="button" x-on:click="$dispatch('close')" class="btn-cancel-delete">
                    {{ __('Cancelar') }}
                  </x-primary-button>
                  <x-danger-button class="ml-3">
                    {{ __('Eliminar rectorado') }}
                  </x-danger-button>
                </div>
              </form>
            </div>
          </x-modal>
        </div>

        @if ($sesion->status)
          <div class="flex items-center justify-between px-3 py-5 ">
            <div class="flex flex-col justify-center sm:w-2/3">
              <h4 class="title">Archivar Sesión</h4>
              <p class="text-secondary">Archiva esta sesión, la inrofmación ya no sera visible a los usuarios la podras
                recuperar en un futuro si asi lo
                deseas.</p>
            </div>
            <x-danger-button x-data="" x-on:click.prevent="$dispatch('open-modal', 'confirm-archivaded')">
              Archivar
            </x-danger-button>
            <x-modal name="confirm-archivaded">
              <div>
                <form method="post" action="{{ route('sesiones.file', ['sesion' => $sesion->id]) }}" class="p-6">
                  @csrf
                  @method('patch')
                  <h2 class="title">
                    {{ __('¿Esta seguro que quiere archivar esta Sesión?') }}
                  </h2>
                  <p class="text-secondary">
                    {{ __('Ingrese su contraseña para confirmar que desea archivar la sesion') }}
                  </p>
                  <div class="mt-6">
                    <x-input-label for="password" value="{{ __('Password') }}" class="sr-only" />
                    <x-text-input id="password" name="password" type="password" class="block w-3/4 mt-1"
                      placeholder="{{ __('Password') }}" />
                    <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
                  </div>
                  <div class="flex justify-end mt-6">
                    <x-primary-button type="button" x-on:click="$dispatch('close')" class="btn-cancel-delete">
                      {{ __('Cancelar') }}
                    </x-primary-button>
                    <x-danger-button class="ml-3">
                      {{ __('Archivar rectorado') }}
                    </x-danger-button>
                  </div>
                </form>
              </div>
            </x-modal>
          </div>
        @elseif (!$sesion->status)
          <div class="flex items-center justify-between px-3 py-5 ">
            <div class="flex flex-col justify-center w-1/2">
              <h4 class="title">Recuperar Sesión</h4>
              <p class="text-secondary">Puede recuperar la sesión, de esta forma la información sera
                visible a los usuarios nuevamente</p>
            </div>
            <x-primary-button x-data=""
              x-on:click.prevent="$dispatch('open-modal', 'confirm-rectorado-archivaded')">
              {{ __('Recuperar') }}
            </x-primary-button>
            <x-modal name="confirm-rectorado-archivaded">
              <div>
                <form method="post" action="{{ route('sesiones.unarchive', ['sesion' => $sesion->id]) }}"
                  class="p-6">
                  @csrf
                  @method('patch')
                  <h2 class="font-bold text-primary">
                    {{ __('¿Esta seguro que quiere recuperar este Rectorado?') }}
                  </h2>
                  <p class="text-secondary">
                    {{ __('Ingrese su contraseña para confirmar que desea recuperar el rectorado') }}
                  </p>
                  <div class="mt-6">
                    <x-input-label for="password" value="{{ __('Password') }}" class="sr-only" />
                    <x-text-input id="password" name="password" type="password" class="block w-3/4 mt-1"
                      placeholder="{{ __('Password') }}" />
                    <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
                  </div>
                  <div class="flex justify-end mt-6">
                    <x-danger-button type="button" x-on:click="$dispatch('close')" class="btn-cancel-create">
                      {{ __('Cancelar') }}
                    </x-danger-button>
                    <x-primary-button class="ml-3">
                      {{ __('Recuperar rectorado') }}
                    </x-primary-button>
                  </div>
                </form>
              </div>
            </x-modal>
          </div>
        @endif
      </div>
    </article>
  </section>

</x-app-layout>
