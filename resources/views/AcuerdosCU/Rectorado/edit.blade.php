<x-app-layout>

  <x-slot name="header">
    <div class="flex items-center gap-1 pt-1">
      <x-nav-link href="{{ route('acuerdos-cu') }}">
        {{ __('Acuerdos C.U') }}
      </x-nav-link>
      <x-arrow />
      <x-nav-link href="{{ route('rectorados.index') }}">{{ __('Rectorados') }}</x-nav-link>
      <x-arrow />
      <x-nav-link :active="true">{{ $rectorado->ciclo }}</x-nav-link>
      <x-arrow />
      <x-nav-link>{{ __('Editar') }}</x-nav-link>
    </div>
  </x-slot>

  <section class="flex flex-col px-24 mt-12 pb-28">
    <article class="card-container">
      <p class="mt-3 title">Actualice la informacion del ciclo.</p>
      <form method="post" action="{{ route('rectorados.update', ['rectorado' => $rectorado->id]) }}"
        class="mt-2 space-y-6">
        @csrf
        @method('patch')
        <div class="w-1/3 mt-6">
          <x-input-label for="ciclo" :value="__('Ciclo')" />
          <x-text-input id="ciclo" name="ciclo" type="text" class="block w-full mt-1" :value="$rectorado->ciclo"
            required autofocus />
          <x-input-error :messages="$errors->userDeletion->get('ciclo')" class="mt-2" />
        </div>
        <div class="flex gap-2">
          <x-primary-button class="gap-2" x-data="{ loading: false }" x-on:click="loading = true">
            <span>Actualizar</span>
            <span x-show="loading">
              <x-loaders.spinner />
            </span>
          </x-primary-button>
          @if ($message = Session::get('success'))
            <x-alerts.success :text="$message" />
          @endif
        </div>
        @if (Auth::check() && Auth::user()->role->role == 'Administrador')
          <p class="text-secondary">Actualizado ultima vez: {{ date('d/m/Y', strtotime($rectorado->updated_at)) }}</p>
        @endif
      </form>
    </article>

    <article class="card-container">
      <div class="flex flex-col w-3/5 border-[1px] border-red-500 rounded">
        <div class="flex items-center justify-between py-5 border-b-2 border-gray-300 px-7">
          <div class="flex flex-col justify-center w-2/3">
            <h4 class="title">Eliminar Rectorado</h4>
            <p class="text-secondary">Al eliminar este rectorado, no se podra recuperar mas adelante de este
              registro, por favor,
              este seguro.</p>
          </div>
          <x-danger-button x-data="" x-on:click.prevent="$dispatch('open-modal', 'confirm-delete')">
            Eliminar
          </x-danger-button>
          <x-modal name="confirm-delete">
            <div>
              <form method="post" action="{{ route('rectorados.destroy', ['rectorado' => $rectorado->id]) }}"
                class="p-6">
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

        @if ($rectorado->status)
          <div class="flex items-center justify-between py-5 px-7 ">
            <div class="flex flex-col justify-center w-2/3">
              <h4 class="title">Archivar Rectorado</h4>
              <p class="text-secondary">Archiva este rectorado, lo podras recuperar en un futuro si asi lo
                deseas.</p>
            </div>
            <x-danger-button x-data="" x-on:click.prevent="$dispatch('open-modal', 'confirm-archivaded')">
              Archivar
            </x-danger-button>
            <x-modal name="confirm-archivaded">
              <div>
                <form method="post" action="{{ route('rectorados.file', ['rectorado' => $rectorado->id]) }}"
                  class="p-6">
                  @csrf
                  @method('patch')
                  <h2 class="title">
                    {{ __('¿Esta seguro que quiere archivar este Rectorado?') }}
                  </h2>
                  <p class="text-secondary">
                    {{ __('Ingrese su contraseña para confirmar que desea archivar el rectorado') }}
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
        @elseif (!$rectorado->status)
          <div class="flex items-center justify-between py-5 px-7 ">
            <div class="flex flex-col justify-center w-2/3">
              <h4 class="title">Recuperar Rectorado</h4>
              <p class="text-secondary">Puede recuperar el rectorado, de esta forma la información sera
                visible a los usuarios nuevamente</p>
            </div>
            <x-primary-button x-data=""
              x-on:click.prevent="$dispatch('open-modal', 'confirm-rectorado-archivaded')">
              {{ __('Recuperar') }}
            </x-primary-button>
            <x-modal name="confirm-rectorado-archivaded">
              <div>
                <form method="post" action="{{ route('rectorados.unarchive', ['rectorado' => $rectorado->id]) }}"
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
