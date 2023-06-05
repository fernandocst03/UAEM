<x-app-layout>
  <x-slot name="header">
    <div class="flex items-center gap-1 pt-1">
      <x-nav-link href="{{ route('formato-911') }}">
        Formato 911
      </x-nav-link>
      <x-arrow />
      <x-nav-link href="{{ route('personal-docente-edad.index') }}">
        Personal Docente por Edad
      </x-nav-link>
      <x-arrow />
      <x-nav-link :active="true">
        {{ $personalDocente->unidadAcademica->unidadDependencia->unidad_dependencia }}
      </x-nav-link>
      <x-arrow />
      <x-nav-link>
        Editar
      </x-nav-link>
    </div>
  </x-slot>

  <section class="flex flex-col w-full px-20 pt-10 pb-32 gap-7">

    <section class="card-container ">
      <article>
        <h2 class="text-lg font-semibold text-gray-900">Personal Docente</h2>
        <p class="text-sm font-normal text-gray-500">Actualice la informacion del personal docente de la unidad
          academica de {{ $personalDocente->unidadAcademica->unidadDependencia->unidad_dependencia }} </p>
        <form action="{{ route('personal-docente-edad.update', ['personal_docente_edad' => $personalDocente->id]) }}"
          method="post" class="flex flex-col gap-8 mt-6">
          @csrf
          @method('patch')

          <div class="flex flex-col gap-1">
            <x-input-label for="" :value="__('Grupo de Edad')" />
            <select name="grupo_edad" id="grupo_edad" class="border border-gray-300 rounded w-fit">
              <option value="">Selecciona una opcion</option>
              @foreach ($grupoEdad as $item)
                <option value="{{ $item->id }}" @if (old('state', $personalDocente->grupo_id) == $item->id) {{ 'selected' }} @endif>
                  {{ $item->grupo }}</option>
              @endforeach
            </select>
            <x-input-error class="mt-1" :messages="$errors->get('grupo_edad')" />
          </div>

          <div class="flex flex-col gap-1">
            <x-input-label for="anio" :value="__('Año')" />
            <x-text-input id="anio" name="anio" value="{{ $personalDocente->anio }}" type="text"
              class="w-fit" />
            <x-input-error class="mt-1" :messages="$errors->get('anio')" />
          </div>

          <div class="flex flex-col gap-1">
            <x-input-label for="hombres" :value="__('Hombres')" />
            <x-text-input id="hombres" name="hombres" value="{{ $personalDocente->hombres }}" type="text"
              class="w-fit" />
            <x-input-error class="mt-1" :messages="$errors->get('hombres')" />
          </div>

          <div class="flex flex-col gap-1">
            <x-input-label for="mujeres" :value="__('Mujeres')" />
            <x-text-input id="mujeres" name="mujeres" value="{{ $personalDocente->mujeres }}" type="text"
              class="w-fit" />
            <x-input-error class="mt-1" :messages="$errors->get('mujeres')" />
          </div>

          <div class="flex items-center w-full gap-2">
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
    </section>

    <section class="card-container">
      <article class="">
        <div class="flex flex-col w-3/5 border-[1px] border-red-500 rounded">
          <div class="flex items-center justify-between py-5 border-b-2 border-gray-300 px-7">
            <div class="flex flex-col justify-center w-2/3">
              <h4 class="title">Eliminar Personal Docente por Antiguedad</h4>
              <p class="text-secondary">Al eliminar este personal docente, no se podra recuperar mas adelante de
                este
                registro, por favor, este seguro.</p>
            </div>
            <x-danger-button x-data="" x-on:click.prevent="$dispatch('open-modal', 'confirm-delete')">
              Eliminar
            </x-danger-button>
            <x-modal name="confirm-delete">
              <div>
                <form method="post"
                  action="{{ route('personal-docente-antiguedad.destroy', ['personal_docente_antiguedad' => $personalDocente->id]) }}"
                  class="p-6">
                  @csrf
                  @method('delete')
                  <h2 class="title">
                    {{ __('¿Esta seguro que quiere eliminar este Personal Docente?') }}
                  </h2>
                  <p class="text-secondary">
                    {{ __('Ingrese su contraseña para confirmar que desea eliminar el personal docente de forma permanente.') }}
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
                      {{ __('Eliminar Personal') }}
                    </x-danger-button>
                  </div>
                </form>
              </div>
            </x-modal>
          </div>

          @if ($personalDocente->status)
            <div class="flex items-center justify-between py-5 px-7 ">
              <div class="flex flex-col justify-center w-2/3">
                <h4 class="title">Archivar Personal Docente por Antiguedad</h4>
                <p class="text-secondary">Archiva este Personal docente, lo podras recuperar en un futuro si asi
                  lo
                  deseas.</p>
              </div>
              <x-danger-button x-data="" x-on:click.prevent="$dispatch('open-modal', 'confirm-file')">
                Archivar
              </x-danger-button>
              <x-modal name="confirm-file">
                <div>
                  <form method="post"
                    action="{{ route('personal-docente-edad.file', ['id' => $personalDocente->id]) }}" class="p-6">
                    @csrf
                    @method('patch')
                    <h2 class="title">
                      {{ __('¿Esta seguro que quiere archivar este Personal Docente?') }}
                    </h2>
                    <p class="text-secondary">
                      {{ __('Ingrese su contraseña para confirmar que desea archivar el personal docente') }}
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
                        {{ __('Archivar Personal') }}
                      </x-danger-button>
                    </div>
                  </form>
                </div>
              </x-modal>
            </div>
          @elseif (!$personalDocente->status)
            <div class="flex items-center justify-between py-5 px-7 ">
              <div class="flex flex-col justify-center w-2/3">
                <h4 class="title">Recuperar Personal Docente por Antiguedad</h4>
                <p class="text-secondary">Puede recuperar el Personal docente, de esta forma la información sera
                  visible a los usuarios nuevamente</p>
              </div>
              <x-primary-button x-data=""
                x-on:click.prevent="$dispatch('open-modal', 'confirm-unarchive')">
                {{ __('Recuperar') }}
              </x-primary-button>
              <x-modal name="confirm-unarchive">
                <div>
                  <form method="post"
                    action="{{ route('personal-docente-antiguedad.unarchive', ['id' => $personalDocente->id]) }}"
                    class="p-6">
                    @csrf
                    @method('patch')
                    <h2 class="font-bold text-primary">
                      {{ __('¿Esta seguro que quiere recuperar este Personal Docente?') }}
                    </h2>
                    <p class="text-secondary">
                      {{ __('Ingrese su contraseña para confirmar que desea recuperar el Personal Docente') }}
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
                        {{ __('Recuperar Personal') }}
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

  </section>
</x-app-layout>
