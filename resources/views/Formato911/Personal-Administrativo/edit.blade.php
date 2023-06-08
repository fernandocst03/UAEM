<x-app-layout>
  <x-slot name="header">
    <div class="flex items-center gap-1 pt-1">
      <x-nav-link href="{{ route('formato-911') }}">
        Formato 911
      </x-nav-link>
      <x-arrow />
      <x-nav-link href="{{ route('personal-administrativo.index') }}">
        Personal Administrativo
      </x-nav-link>
      <x-arrow />
      <x-nav-link :active="true">
        {{ $personalAdministrativo->unidadAcademica->unidadDependencia->unidad_dependencia }}
      </x-nav-link>
      <x-arrow />
      <x-nav-link>
        Editar
      </x-nav-link>
    </div>
  </x-slot>

  <section class="flex flex-col w-full pt-10 pb-32 lg:px-20 gap-7">

    <section class="card-container ">
      <article>
        <h2 class="text-lg font-semibold text-gray-900">Personal administrativo</h2>
        <p class="text-sm font-normal text-gray-500">Actualice la informacion del personal administratio de la unidad
          academica de {{ $personalAdministrativo->unidadAcademica->unidadDependencia->unidad_dependencia }} </p>
        <form
          action="{{ route('personal-administrativo.update', ['personal_administrativo' => $personalAdministrativo->id]) }}"
          method="post" class="flex flex-col gap-8 mt-6">
          @csrf
          @method('patch')

          <div class="flex flex-col gap-1">
            <x-input-label for="anio" :value="__('Año')" />
            <x-text-input id="anio" name="anio" value="{{ $personalAdministrativo->anio }}" type="text"
              class="w-fit" />
            <x-input-error class="mt-1" :messages="$errors->get('anio')" />
          </div>

          <div class="flex flex-col gap-1">
            <x-input-label for="directivos" :value="__('Directivos')" />
            <div class="flex gap-4">
              <div class="flex flex-col justify-center gap-1">
                <x-input-label for="directivo_h" :value="__('Hombres')" class="text-secondary" />
                <x-text-input id="directivo_h" name="directivo_h" value="{{ $personalAdministrativo->directivo_h }}"
                  type="text" class="w-3/4 md:w-full" />
                <x-input-error class="mt-1" :messages="$errors->get('directivo_h')" />
              </div>
              <div class="flex flex-col justify-center gap-1">
                <x-input-label for="directivo_m" :value="__('Mujeres')" class="text-secondary" />
                <x-text-input id="directivo_m" name="directivo_m" value="{{ $personalAdministrativo->directivo_m }}"
                  type="text" class="w-3/4 md:w-full" />
                <x-input-error class="mt-1" :messages="$errors->get('directivo_m')" />
              </div>
            </div>
          </div>

          <div class="flex flex-col gap-1">
            <x-input-label for="docentes" :value="__('Docentes')" />
            <div class="flex gap-4">
              <div class="flex flex-col justify-center gap-1">
                <x-input-label for="docente_h" :value="__('Hombres')" class="text-secondary" />
                <x-text-input id="docente_h" name="docente_h" value="{{ $personalAdministrativo->docente_h }}"
                  type="text" class="w-3/4 md:w-full" />
                <x-input-error class="mt-1" :messages="$errors->get('docente_h')" />
              </div>
              <div class="flex flex-col justify-center gap-1">
                <x-input-label for="docente_m" :value="__('Mujeres')" class="text-secondary" />
                <x-text-input id="docente_m" name="docente_m" value="{{ $personalAdministrativo->docente_m }}"
                  type="text" class="w-3/4 md:w-full" />
                <x-input-error class="mt-1" :messages="$errors->get('docente_m')" />
              </div>
            </div>
          </div>

          <div class="flex flex-col gap-1">
            <x-input-label for="" :value="__('Docentes investigadores')" />
            <div class="flex gap-4">
              <div class="flex flex-col justify-center gap-1">
                <x-input-label for="docente_investigador_h" :value="__('Mujeres')" class="text-secondary" />
                <x-text-input id="docente_investigador_h" name="docente_investigador_h"
                  value="{{ $personalAdministrativo->docente_investigador_h }}" type="text"
                  class="w-3/4 md:w-full" />
                <x-input-error class="mt-1" :messages="$errors->get('docente_investigador_h')" />

              </div>
              <div class="flex flex-col justify-center gap-1">
                <x-input-label for="docente_investigador_m" :value="__('Mujeres')" class="text-secondary" />
                <x-text-input id="docente_investigador_m" name="docente_investigador_m"
                  value="{{ $personalAdministrativo->docente_investigador_m }}" type="text"
                  class="w-3/4 md:w-full" />
                <x-input-error class="mt-1" :messages="$errors->get('docente_investigador_m')" />

              </div>
            </div>
          </div>

          <div class="flex flex-col gap-1">
            <x-input-label for="" :value="__('Investigadores')" />
            <div class="flex gap-4">
              <div class="flex flex-col justify-center gap-1">
                <x-input-label for="investigador_h" :value="__('Mujeres')" class="text-secondary" />
                <x-text-input id="investigador_h" name="investigador_h"
                  value="{{ $personalAdministrativo->investigador_h }}" type="text" class="w-3/4 md:w-full" />
                <x-input-error class="mt-1" :messages="$errors->get('investigador_h')" />
              </div>
              <div class="flex flex-col justify-center gap-1">
                <x-input-label for="investigador_m" :value="__('Mujeres')" class="text-secondary" />
                <x-text-input id="investigador_m" name="investigador_m"
                  value="{{ $personalAdministrativo->investigador_m }}" type="text" class="w-3/4 md:w-full" />
                <x-input-error class="mt-1" :messages="$errors->get('investigador_m')" />
              </div>
            </div>
          </div>

          <div class="flex flex-col gap-1">
            <x-input-label for="" :value="__('Auxiliares investigadores')" />
            <div class="flex gap-4">
              <div class="flex flex-col justify-center gap-1">
                <x-input-label for="auxiliar_investigador_h" :value="__('Mujeres')" class="text-secondary" />
                <x-text-input id="auxiliar_investigador_h" name="auxiliar_investigador_h"
                  value="{{ $personalAdministrativo->auxiliar_investigador_h }}" type="text"
                  class="w-3/4 md:w-full" />
                <x-input-error class="mt-1" :messages="$errors->get('auxiliar_investigador_h')" />
              </div>
              <div class="flex flex-col justify-center gap-1">
                <x-input-label for="auxiliar_investigador_m" :value="__('Mujeres')" class="text-secondary" />
                <x-text-input id="auxiliar_investigador_m" name="auxiliar_investigador_m"
                  value="{{ $personalAdministrativo->auxiliar_investigador_m }}" type="text"
                  class="w-3/4 md:w-full" />
                <x-input-error class="mt-1" :messages="$errors->get('auxiliar_investigador_m')" />
              </div>
            </div>
          </div>

          <div class="flex flex-col gap-1">
            <x-input-label for="" :value="__('Administrativos')" />
            <div class="flex gap-4">
              <div class="flex flex-col justify-center gap-1">
                <x-input-label for="administrativo_h" :value="__('Mujeres')" class="text-secondary" />
                <x-text-input id="administrativo_h" name="administrativo_h"
                  value="{{ $personalAdministrativo->administrativo_h }}" type="text" class="w-3/4 md:w-full" />
                <x-input-error class="mt-1" :messages="$errors->get('administrativo_h')" />
              </div>
              <div class="flex flex-col justify-center gap-1">
                <x-input-label for="administrativo_m" :value="__('Mujeres')" class="text-secondary" />
                <x-text-input id="administrativo_m" name="administrativo_m"
                  value="{{ $personalAdministrativo->administrativo_m }}" type="text" class="w-3/4 md:w-full" />
                <x-input-error class="mt-1" :messages="$errors->get('administrativo_m')" />
              </div>
            </div>
          </div>

          <div class="flex flex-col gap-1">
            <x-input-label for="" :value="__('Otros')" />
            <div class="flex gap-4">
              <div class="flex flex-col justify-center gap-1">
                <x-input-label for="otros_h" :value="__('Mujeres')" class="text-secondary" />
                <x-text-input id="otros_h" name="otros_h" value="{{ $personalAdministrativo->otros_h }}"
                  type="text" class="w-3/4 md:w-full" />
                <x-input-error class="mt-1" :messages="$errors->get('otros_h')" />
              </div>
              <div class="flex flex-col justify-center gap-1">
                <x-input-label for="otros_m" :value="__('Mujeres')" class="text-secondary" />
                <x-text-input id="otros_m" name="otros_m" value="{{ $personalAdministrativo->otros_m }}"
                  type="text" class="w-3/4 md:w-full" />
                <x-input-error class="mt-1" :messages="$errors->get('otros_m')" />
              </div>
            </div>
          </div>

          <div class="flex items-center gap-2">
            <x-primary-button class="gap-2" x-data="{ loading: false }" x-on:click="loading = true">
              <span>Actualizar</span>
              <span x-show="loading">
                <x-loaders.spinner />
              </span>
            </x-primary-button>
            @if ($messages = Session::get('success'))
              <x-alerts.success :text="$messages" />
            @elseif($messages = Session::get('warning'))
              <x-alerts.warning :text="$messages" />
            @endif
          </div>
        </form>
      </article>
    </section>

    <section class="card-container">
      <article class="">
        <div class="flex flex-col lg:w-3/5 border-[1px] border-red-500 rounded">
          <div class="flex items-center justify-between px-3 py-5 border-b-2 border-gray-300">
            <div class="flex flex-col justify-center w-1/2 md:w-2/3">
              <h4 class="title">Eliminar Personal Administrativo</h4>
              <p class="text-secondary">Al eliminar este personal administrativo, no se podra recuperar mas adelante de
                este
                registro, por favor, este seguro.</p>
            </div>
            <x-danger-button x-data="" x-on:click.prevent="$dispatch('open-modal', 'confirm-delete')">
              Eliminar
            </x-danger-button>
            <x-modal name="confirm-delete">
              <div>
                <form method="post"
                  action="{{ route('personal-administrativo.destroy', ['personal_administrativo' => $personalAdministrativo->id]) }}"
                  class="p-6">
                  @csrf
                  @method('delete')
                  <h2 class="title">
                    {{ __('¿Esta seguro que quiere eliminar este Personal Administrativo?') }}
                  </h2>
                  <p class="text-secondary">
                    {{ __('Ingrese su contraseña para confirmar que desea eliminar el personal administrativo de forma permanente.') }}
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

          @if ($personalAdministrativo->status)
            <div class="flex items-center justify-between px-3 py-5 ">
              <div class="flex flex-col justify-center w-1/2 md:w-2/3">
                <h4 class="title">Archivar Personal administrativo</h4>
                <p class="text-secondary">Archiva este Personal administrativo, lo podras recuperar en un futuro si asi
                  lo
                  deseas.</p>
              </div>
              <x-danger-button x-data="" x-on:click.prevent="$dispatch('open-modal', 'confirm-file')">
                Archivar
              </x-danger-button>
              <x-modal name="confirm-file">
                <div>
                  <form method="post"
                    action="{{ route('personal-administrativo.file', ['id' => $personalAdministrativo->id]) }}"
                    class="p-6">
                    @csrf
                    @method('patch')
                    <h2 class="title">
                      {{ __('¿Esta seguro que quiere archivar este Personal administrativo?') }}
                    </h2>
                    <p class="text-secondary">
                      {{ __('Ingrese su contraseña para confirmar que desea archivar el personal administrativo') }}
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
          @elseif (!$personalAdministrativo->status)
            <div class="flex items-center justify-between px-3 py-5 ">
              <div class="flex flex-col justify-center w-1/2 md:w-2/3">
                <h4 class="title">Recuperar Personal administrativo</h4>
                <p class="text-secondary">Puede recuperar el Personal administrativo, de esta forma la información sera
                  visible a los usuarios nuevamente</p>
              </div>
              <x-primary-button x-data=""
                x-on:click.prevent="$dispatch('open-modal', 'confirm-unarchive')">
                {{ __('Recuperar') }}
              </x-primary-button>
              <x-modal name="confirm-unarchive">
                <div>
                  <form method="post"
                    action="{{ route('personal-administrativo.unarchive', ['id' => $personalAdministrativo->id]) }}"
                    class="p-6">
                    @csrf
                    @method('patch')
                    <h2 class="font-bold text-primary">
                      {{ __('¿Esta seguro que quiere recuperar este Personal Administrativo?') }}
                    </h2>
                    <p class="text-secondary">
                      {{ __('Ingrese su contraseña para confirmar que desea recuperar el Personal Administrativo') }}
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
