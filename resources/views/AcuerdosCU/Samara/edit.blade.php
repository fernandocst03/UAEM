<x-app-layout>
  <x-slot name="header">
    <div class="flex items-center gap-1 pt-1">
      <x-nav-link href="{{ route('acuerdos-cu') }}">
        Acuerdos C.U
      </x-nav-link>
      <x-arrow />
      <x-nav-link href="{{ route('samaras.index') }}">
        Samarás
      </x-nav-link>
      <x-arrow />
      <x-nav-link :active="true">
        Menendez Samara {{ $samara->numero }}
      </x-nav-link>
      <x-arrow />
      <x-nav-link>
        Editar
      </x-nav-link>
    </div>
  </x-slot>

  <section class="flex flex-col px-20 mt-10 mb-20">
    <article class="card-container">
      <div>
        <h3 class="title">Menendez Samara {{ $samara->numero }}</h3>
        <p class="text-secondary">Actualice la informacion del samara.</p>
      </div>

      <form method="post" action="{{ route('samaras.update', ['samara' => $samara->id]) }}" class="mt-3">
        @csrf
        @method('patch')
        <div class="w-1/3 mt-6">
          <x-input-label for="anio" :value="__('Año')" />
          <x-text-input id="anio" name="anio" type="text" class="block mt-1 w-fit" :value="$samara->anio"
            autofocus />
          <x-input-error class="mt-2" :messages="$errors->get('anio')" />
        </div>

        <div class="w-1/3 mt-6">
          <x-input-label for="numero" :value="__('Numero')" />
          <x-text-input id="numero" name="numero" type="text" class="block mt-1 w-fit" :value="$samara->numero" />
          <x-input-error class="mt-2" :messages="$errors->get('numero')" />
        </div>

        <div class="w-1/3 mt-6">
          <x-input-label for="rectorado" :value="__('Rectorado')" />
          <select name="rectorado" id="rectorado" class="mt-2 border-gray-300 rounded-md border-1">
            @foreach ($rectorados as $rectorado)
              <option value="{{ $rectorado->id }}" @if (old('state', $samara->rectorado_id) == $rectorado->id) {{ 'selected' }} @endif>
                {{ $rectorado->ciclo }}</option>
            @endforeach
          </select>
          <x-input-error class="mt-2" :messages="$errors->get('rectorado')" />
        </div>

        <div class="w-1/3 mt-6">
          <x-input-label for="fecha" :value="__('Fecha')" />
          <input type="date" name="fecha" id="fecha" class="mt-2 border-gray-300 rounded-md border-1"
            value="{{ Carbon\Carbon::parse($samara->fecha)->format('Y-m-d') }}">
          <x-input-error class="mt-2" :messages="$errors->get('fecha')" />
        </div>

        <div class="w-2/3 mt-6">
          @if ($samara->url_archivo == null)
            <x-input-label for="url_archivo" :value="__('URL documento PDF')" />
            <x-text-input id="url_archivo" name="url_archivo" type="text" class="block w-full mt-1"
              :value="$samara->url_archivo" autofocus />
            <x-input-error class="mt-2" :messages="$errors->get('url_archivo')" />
          @else
            <div>
              <x-input-label for="url_archivo" :value="__('URL documento PDF')" />
              <x-text-input id="url_archivo" name="url_archivo" type="text" class="block w-full mt-1 text-gray-500"
                :value="$samara->url_archivo" autofocus />
              <x-input-error class="mt-2" :messages="$errors->get('url_archivo')" />
            </div>
          @endif
        </div>

        <div class="flex items-center gap-2 mt-10">
          <x-primary-button>{{ __('Guardar') }}</x-primary-button>
          @if ($message = Session::get('success'))
            <x-alerts.success :text="$message" />
          @endif
        </div>

        <div class="mt-3">
          <p class="text-secondary">Actializado ultima vez: {{ $samara->updated_at }} </p>
        </div>
      </form>
    </article>

    <article class="mt-6 card-container">
      <section class="flex flex-col w-1/2 border-[1px] rounded border-red-500">

        <div class="flex items-center justify-between py-5 border-b-[1px] border-gray-300 px-7">
          <div class="flex flex-col justify-center w-2/3">
            <h4 class="title">Eliminar Samará</h4>
            <p class="text-secondary">Elimina este samará, no se podra recuperar este registro, por favor,
              este
              seguro.</p>
          </div>
          <x-danger-button x-data=""
            x-on:click.prevent="$dispatch('open-modal', 'confirm-rectorado-delete')" class="">
            Eliminar
          </x-danger-button>

          <x-modal name="confirm-rectorado-delete">
            <div class="p-5">
              <form method="post" action="{{ route('samaras.destroy', ['samara' => $samara->id]) }}">
                @csrf
                @method('delete')
                <h2 class="title">
                  {{ __('¿Esta seguro que quiere eliminar este Rectorado?') }}
                </h2>
                <p class="text-secondary">
                  {{ __('Ingrese su contraseña para confirmar que desea eliminar el samara de forma permanente.') }}
                </p>
                <div class="mt-6">
                  <x-input-label for="password" value="{{ __('Password') }}" class="sr-only" />
                  <x-text-input id="password" name="password" type="password" class="block w-3/4 mt-1"
                    placeholder="{{ __('Password') }}" />
                  <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
                </div>

                <div class="flex justify-end mt-10">
                  <x-primary-button type="button" x-on:click="$dispatch('close')" class="btn-cancel-delete">
                    {{ __('Cancelar') }}
                  </x-primary-button>

                  <x-danger-button class="ml-3">
                    {{ __('Eliminar samará') }}
                  </x-danger-button>
                </div>
              </form>
            </div>
          </x-modal>
        </div>

        @if ($samara->status)
          <div class="flex items-center justify-between py-5 px-7 ">
            <div class="flex flex-col justify-center w-2/3">
              <h4 class="title">Archivar Samará</h4>
              <p class="text-secondary">Archiva este samará, lo podras recuperar en un futuro si asi lo
                deseas.
              </p>
            </div>
            <x-danger-button x-data=""
              x-on:click.prevent="$dispatch('open-modal', 'confirm-file-rectorado')">
              Archivar
            </x-danger-button>
            <x-modal name="confirm-file-rectorado">
              <div>
                <form method="post" class="p-6">
                  @csrf
                  @method('patch')
                  <h2 class="title">
                    {{ __('¿Esta seguro que quiere archivar este Samará?') }}
                  </h2>
                  <p class="text-secondary">
                    {{ __('Ingrese su contraseña para confirmar que desea archivar el samara') }}
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
        @elseif (!$samara->status)
          <div class="flex items-center justify-between py-5 px-7 ">
            <div class="flex flex-col justify-center w-2/3">
              <h4 class="font-bold text-md">Recuperar Samará</h4>
              <p class="font-normal text-gray-600">Recuperar este samará </p>
            </div>
            <x-primary-button x-data=""
              x-on:click.prevent="$dispatch('open-modal', 'confirm-rectorado-recover')"
              class="flex items-center gap-4 px-3 py-2 font-bold text-gray-200 bg-gray-600 rounded-md opacity-2 hover:bg-red-700">
              Recuperar
            </x-primary-button>
            <x-modal name="confirm-rectorado-recover">
              <div>
                <form method="post" class="p-6">
                  @csrf
                  @method('patch')
                  <h2 class="title">
                    {{ __('¿Esta seguro que quiere recuperar este Samará?') }}
                  </h2>
                  <p class="text-secondary">
                    {{ __('Ingrese su contraseña para confirmar que desea recuperar el samara') }}
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
                    <x-primary-button>
                      {{ __('Archivar rectorado') }}
                    </x-primary-button>
                  </div>
                </form>
              </div>
            </x-modal>
          </div>
        @endif
      </section>
    </article>
  </section>

</x-app-layout>
