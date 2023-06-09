<x-datatables.styles />

<x-app-layout>
  <x-slot name="header">
    <div class="flex items-center gap-1 pt-1">
      <x-nav-link href="{{ route('formato-911') }}">
        Formato 911
      </x-nav-link>
      <x-arrow />
      <x-nav-link href="{{ route('infraestructuras.index') }}">
        Infraestructura
      </x-nav-link>
      <x-arrow />
      <x-nav-link href="{{ route('infraestructuras.show', ['infraestructura' => $infraestructura->id]) }}"
        :active="true">
        {{ $infraestructura->unidadAcademica->unidadDependencia->unidad_dependencia }}
      </x-nav-link>
      <x-arrow />
      <x-nav-link>
        Editar
      </x-nav-link>
    </div>
  </x-slot>

  <section class="flex flex-col w-full pt-10 pb-20 md:px-20">

    <section class="card-container">
      <div>
        <h2 class="title">Infraestructura</h2>
        <p class="text-secondary">Actualice la informacion de la infraestructura de la unidad
          academica de </p>
      </div>

      <article class="mt-10">
        <form method="post" action="{{ route('infraestructuras.update', ['infraestructura' => $infraestructura->id]) }}"
          class="flex flex-col gap-4">
          @csrf
          @method('patch')

          <div class="flex flex-col gap-1 w-fit">
            <x-input-label for="" :value="__('Año')" />
            <x-text-input id="anio" name="anio" type="text" class="block mt-1 fit"
              value="{{ $infraestructura->anio }}" />
            <x-input-error class="mt-2" :messages="$errors->get('anio')" />
          </div>

          <div class="flex flex-col gap-1">
            <x-input-label for="" :value="__('Tipo de inmueble')" />
            <select name="tipoInmueble" id="" class="border border-gray-300 rounded w-fit">
              <option value="">Eliga una opcion</option>
              @foreach ($inmuebleTipos as $item)
                <option value="{{ $item->id }}" @if (old('state', $infraestructura->inmueble_tipo_id) == $item->id) {{ 'selected' }} @endif>
                  {{ $item->tipo }}</option>
              @endforeach
            </select>
            <x-input-error class="mt-2" :messages="$errors->get('tipoInmueble')" />
          </div>

          <div class="flex flex-col gap-1">
            <x-input-label for="" :value="__('Tipo de Aula')" />
            <select name="tipoAula" id="" class="border border-gray-300 rounded w-fit">
              <option value="">Eliga una opcion</option>
              @foreach ($aulaTipos as $item)
                <option value="{{ $item->id }}" @if (old('state', $infraestructura->aula_tipo_id) == $item->id) {{ 'selected' }} @endif>
                  {{ $item->tipo }}</option>
              @endforeach
            </select>
            <x-input-error class="mt-2" :messages="$errors->get('tipoAula')" />
          </div>

          <div class="flex flex-col gap-1">
            <x-input-label for="" :value="__('Aula')" />
            <div class="flex flex-wrap items-center gap-3">
              <div class="flex flex-col gap-1">
                <x-input-label for="aulas_existentes" value="{{ __('Existentes') }}" />
                <x-text-input id="aulas_existentes" name="aulas_existentes" type="text" class="1"
                  value="{{ $infraestructura->aulas_existentes }}" />
                <x-input-error class="mt-2" :messages="$errors->get('aulas_existentes')" />
              </div>
              <div class="flex flex-col gap-1">
                <x-input-label for="aulas_en_uso" value="{{ __('En uso') }}" />
                <x-text-input id="aulas_en_uso" name="aulas_en_uso" type="text" class=""
                  value="{{ $infraestructura->aulas_en_uso }}" />
                <x-input-error class="mt-2" :messages="$errors->get('aulas_en_uso')" />
              </div>
              <div class="flex flex-col gap-1">
                <x-input-label for="aulas_adaptadas" value="{{ __('Adaptadas') }}" />
                <x-text-input id="aulas_adaptadas" name="aulas_adaptadas" type="text" class="1"
                  value="{{ $infraestructura->aulas_adaptadas }}" />
                <x-input-error class="mt-2" :messages="$errors->get('aulas_adaptadas')" />
              </div>
            </div>
          </div>

          <div class="flex flex-col gap-1 mt-7 md:mt-0">
            <x-input-label for="" :value="__('Talleres')" />
            <div class="flex flex-wrap items-center gap-3">
              <div class="flex flex-col gap-1">
                <x-input-label for="talleres_existentes" value="{{ __('Existentes') }}" />
                <x-text-input id="talleres_existentes" name="talleres_existentes" type="text" class="1"
                  value="{{ $infraestructura->talleres_existentes }}" />
                <x-input-error class="mt-2" :messages="$errors->get('talleres_existentes')" />
              </div>
              <div class="flex flex-col gap-1">
                <x-input-label for="talleres_en_uso" value="{{ __('En uso') }}" />
                <x-text-input id="talleres_en_uso" name="talleres_en_uso" type="text" class=""
                  value="{{ $infraestructura->talleres_en_uso }}" />
                <x-input-error class="mt-2" :messages="$errors->get('talleres_en_uso')" />
              </div>
              <div class="flex flex-col gap-1">
                <x-input-label for="talleres_adaptados" value="{{ __('Adaptados') }}" />
                <x-text-input id="talleres_adaptados" name="talleres_adaptados" type="text" class="1"
                  value="{{ $infraestructura->talleres_adaptados }}" />
                <x-input-error class="mt-2" :messages="$errors->get('talleres_adaptados')" />
              </div>
            </div>
          </div>

          <div class="flex flex-col gap-1 mt-7 md:mt-0">
            <x-input-label for="" :value="__('Laboratorios')" />
            <div class="flex flex-wrap items-center gap-3">
              <div class="flex flex-col gap-1">
                <x-input-label for="laboratorios_existentes" value="{{ __('Existentes') }}" />
                <x-text-input id="laboratorios_existentes" name="laboratorios_existentes" type="text"
                  class="1" value="{{ $infraestructura->laboratorios_existentes }}" />
                <x-input-error class="mt-2" :messages="$errors->get('laboratorios_existentes')" />
              </div>
              <div class="flex flex-col gap-1">
                <x-input-label for="laboratorios_en_uso" value="{{ __('En uso') }}" />
                <x-text-input id="laboratorios_en_uso" name="laboratorios_en_uso" type="text" class=""
                  value="{{ $infraestructura->laboratorios_en_uso }}" />
                <x-input-error class="mt-2" :messages="$errors->get('laboratorios_en_uso')" />
              </div>
              <div class="flex flex-col gap-1">
                <x-input-label for="laboratorios_adaptados" value="{{ __('Adaptados') }}" />
                <x-text-input id="laboratorios_adaptados" name="laboratorios_adaptados" type="text"
                  class="1" value="{{ $infraestructura->laboratorios_adaptados }}" />
                <x-input-error class="mt-2" :messages="$errors->get('laboratorios_adaptados')" />
              </div>
            </div>
          </div>

          <div class="flex flex-col gap-1 w-fit mt-7 md:mt-0">
            <x-input-label for="laboratorio_computo" value="{{ __('Laboratorio de computo') }}" class="w-fit" />
            <x-text-input id="laboratorio_computo" name="laboratorio_computo" type="text" class="1"
              value="{{ $infraestructura->laboratorios_computo }}" />
            <x-input-error class="mt-2" :messages="$errors->get('laboratorio_computo')" />
          </div>

          <div class="flex flex-col gap-1">
            <div class="flex flex-col gap-1">
              <x-input-label for="" :value="__('Biblioteca')" />
              <select name="biblioteca" id="" class="border border-gray-300 rounded w-fit">
                <option value="">Eliga una opcion</option>
                <option value="1" @if ($infraestructura->biblioteca) selected @endif>Si</option>
                <option value="0" @if (!$infraestructura->biblioteca) selected @endif>No</option>
              </select>
              <x-input-error class="mt-2" :messages="$errors->get('biblioteca')" />
            </div>
          </div>

          <div class="flex items-center gap-2 mt-4">
            <x-primary-button class="gap-2" x-data="{ loading: false }" x-on:click="loading = true">
              <span>Actualizar</span>
              <span x-show="loading">
                <x-loaders.spinner />
              </span>
            </x-primary-button>
            @if ($messages = Session::get('success'))
              <x-alerts.success :text="$messages" />
            @elseif ($messages = Session::get('warning'))
              <x-alerts.warning :text="$messages" />
            @endif
          </div>
        </form>

        <div class="mt-1">
          <p class="text-sm text-gray-500">Editado por ultima vez: {{ $infraestructura->updated_at }}</p>
        </div>

      </article>
    </section>

    <section class="mt-9 card-container">
      <article class="">
        <div class="flex flex-col md:w-3/5 border-[1px] border-red-500 rounded">
          <div class="flex items-center justify-between px-3 py-3 border-b-2 border-gray-300">
            <div class="flex flex-col justify-center w-1/2 md:w-2/3">
              <h4 class="title">Eliminar Infraesstructura</h4>
              <p class="text-secondary">Al eliminar esta infraestructura, no se podra recuperar mas adelante de
                este
                registro, por favor, este seguro.</p>
            </div>
            <x-danger-button x-data="" x-on:click.prevent="$dispatch('open-modal', 'confirm-delete')">
              Eliminar
            </x-danger-button>
            <x-modal name="confirm-delete">
              <div>
                <form method="post"
                  action="{{ route('infraestructuras.destroy', ['infraestructura' => $infraestructura->id]) }}"
                  class="p-6">
                  @csrf
                  @method('delete')
                  <h2 class="title">
                    {{ __('¿Esta seguro que quiere eliminar este Infraestructura?') }}
                  </h2>
                  <p class="text-secondary">
                    {{ __('Ingrese su contraseña para confirmar que desea eliminar el infraestructura de forma permanente.') }}
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
                      {{ __('Eliminar Infraestructura') }}
                    </x-danger-button>
                  </div>
                </form>
              </div>
            </x-modal>
          </div>

          @if ($infraestructura->status)
            <div class="flex items-center justify-between px-3 py-3 ">
              <div class="flex flex-col justify-center w-1/2 md:w-2/3">
                <h4 class="title">Archivar Infraestructura</h4>
                <p class="text-secondary">Archiva esta infraestructura, lo podras recuperar en un futuro si asi
                  lo
                  deseas.</p>
              </div>
              <x-danger-button x-data="" x-on:click.prevent="$dispatch('open-modal', 'confirm-file')">
                Archivar
              </x-danger-button>
              <x-modal name="confirm-file">
                <div>
                  <form method="post" action="{{ route('infraestructura.file', ['id' => $infraestructura->id]) }}"
                    class="p-6">
                    @csrf
                    @method('patch')
                    <h2 class="title">
                      {{ __('¿Esta seguro que quiere archivar esta Infraestructura?') }}
                    </h2>
                    <p class="text-secondary">
                      {{ __('Ingrese su contraseña para confirmar que desea archivar la Infraestructura') }}
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
                        {{ __('Archivar Infraestructura') }}
                      </x-danger-button>
                    </div>
                  </form>
                </div>
              </x-modal>
            </div>
          @elseif (!$infraestructura->status)
            <div class="flex items-center justify-between px-3 py-3 ">
              <div class="flex flex-col justify-center w-1/2 md:w-2/3">
                <h4 class="title">Recuperar Infraestructura</h4>
                <p class="text-secondary">Puede recuperar la Infraestructura, de esta forma la información sera
                  visible a los usuarios nuevamente</p>
              </div>
              <x-primary-button x-data=""
                x-on:click.prevent="$dispatch('open-modal', 'confirm-unarchive')">
                {{ __('Recuperar') }}
              </x-primary-button>
              <x-modal name="confirm-unarchive">
                <div>
                  <form method="post"
                    action="{{ route('infraestructura.unarchive', ['id' => $infraestructura->id]) }}" class="p-6">
                    @csrf
                    @method('patch')
                    <h2 class="title">
                      {{ __('¿Esta seguro que quiere recuperar esta infraestructura?') }}
                    </h2>
                    <p class="text-secondary">
                      {{ __('Ingrese su contraseña para confirmar que desea recuperar la Infraestructura') }}
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
                        {{ __('Recuperar Infraestructura') }}
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

<x-datatables.scripts />
<script src="{{ asset('js/datatables.js') }}"></script>
<script>
  $(document).ready(datatable('#infraestructuras'))
</script>
