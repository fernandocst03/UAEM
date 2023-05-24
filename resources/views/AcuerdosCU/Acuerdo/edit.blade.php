<x-app-layout>

  <x-slot name="header">
    <div class="flex items-center gap-1 pt-1">

      <x-nav-link href="{{ route('acuerdos-cu') }}">Acuerdos C.U </x-nav-link>
      <x-arrow />
      <x-nav-link href="{{ route('sesiones.index') }}">Sesiones</x-nav-link>
      <x-arrow />
      <x-nav-link href="{{ route('sesiones.show', ['sesione' => $acuerdo->sesion->id]) }}">Sesión:
        {{ $acuerdo->sesion->fecha }}
      </x-nav-link>
      <x-arrow />
      <x-nav-link :active="true">Acuerdo - Punto {{ $acuerdo->punto }}</x-nav-link>
      <x-arrow />
      <x-nav-link>Edit</x-nav-link>
    </div>
  </x-slot>

  <section class="flex flex-col gap-5 px-20 pt-10 pb-32">
    <article class="card-container">
      <p class="title">Actualice la informacion del acuerdo.</p>
      <form method="post" action="{{ route('acuerdos.update', ['acuerdo' => $acuerdo->id]) }}"" class="mt-6 space-y-6">
        @csrf
        @method('patch')
        <div class="w-1/3 mt-6">
          <x-input-label for="tipoAcuerdo" :value="__('Tipo de acuerdo')" />
          <select name="tipoAcuerdo" id="tipoAcuerdo" class="mt-2 border-gray-300 rounded-md border-1">
            @foreach ($tipoAcuerdos as $item)
              <option value="{{ $item->id }}" @if (old('state', $acuerdo->acuerdo_tipo_id) == $item->id) {{ 'selected' }} @endif>
                {{ $item->tipo_acuerdo }}</option>
            @endforeach
          </select>
        </div>
        <div class="w-1/3 mt-6">
          <x-input-label for="punto" :value="__('Punto')" />
          <x-text-input id="punto" name="punto" type="text" class="block w-full mt-1" :value="$acuerdo->punto"
            required autofocus autocomplete="name" />
        </div>
        <div class="w-1/3 mt-6">
          <x-input-label for="acuerdo" :value="__('Acuerdo')" />
          <textarea class='w-full pt-4 mt-2 border-gray-300 rounded-md resize-none border-1' name="acuerdo" id="acuerdo"
            cols="30" rows="15">{{ $acuerdo->acuerdo }}</textarea>
        </div>
        <div class="w-1/3 mt-6">
          <x-input-label for="acuerdoCorto" :value="__('Acuerdo Corto')" />
          <textarea class='w-full pt-4 mt-2 border-gray-300 rounded-md resize-none border-1' name="acuerdoCorto" id="acuerdo"
            cols="30" rows="15">{{ $acuerdo->acuerdo_corto }}</textarea>
        </div>
        <div class="w-1/3 mt-6">
          <x-input-label for="observaciones" :value="__('Observaciones')" />
          <textarea class='w-full pt-4 mt-2 border-gray-300 rounded-md resize-none border-1' name="observaciones"
            id="observaciones" cols="30" rows="10">{{ $acuerdo->observaciones }}</textarea>
        </div>
        <div class="w-1/3 mt-6">
          <x-input-label for="paginaSamara" :value="__('Pagina Samara')" />
          <x-text-input id="paginaSamara" name="paginaSamara" type="text" class="block w-full mt-1" :value="$acuerdo->pagina_samara"
            autofocus autocomplete="name" />
        </div>
        <div class="flex gap-2 mt-7">
          <x-primary-button class="w-min">{{ __('Guardar') }}</x-primary-button>
          @if ($message = Session::get('success'))
            <x-alerts.success :text="$message" />
          @endif
        </div>
        <div class="pb-10">
          <p class="text-secondary">Editado por ultima vez: {{ $acuerdo->updated_at }} </p>
        </div>
      </form>
    </article>

    <article class="card-container">
      <div class="flex flex-col w-3/5 border-[1px] border-red-500 rounded">
        <div class="flex items-center justify-between py-5 border-b-2 border-gray-300 px-7">
          <div class="flex flex-col justify-center w-2/3">
            <h4 class="title">Eliminar Acuerdo</h4>
            <p class="text-secondary">Al eliminar este acuerdo, no se podra recuperar mas adelante de este
              registro, por favor, este seguro.</p>
          </div>
          <x-danger-button x-data="" x-on:click.prevent="$dispatch('open-modal', 'confirm-delete')">
            Eliminar
          </x-danger-button>
          <x-modal name="confirm-delete">
            <div>
              <form method="post" action="{{ route('acuerdos.destroy', ['acuerdo' => $acuerdo->id]) }}"
                class="p-6">
                @csrf
                @method('delete')
                <h2 class="title">
                  {{ __('¿Esta seguro que quiere eliminar este Acuerdo?') }}
                </h2>
                <p class="text-secondary">
                  {{ __('Ingrese su contraseña para confirmar que desea eliminar el acuerdo de forma permanente.') }}
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

        @if ($acuerdo->status)
          <div class="flex items-center justify-between py-5 px-7 ">
            <div class="flex flex-col justify-center w-2/3">
              <h4 class="title">Archivar Acuerdo</h4>
              <p class="text-secondary">Archiva este acuerdo, lo podras recuperar en un futuro si asi lo
                deseas.</p>
            </div>
            <x-danger-button x-data="" x-on:click.prevent="$dispatch('open-modal', 'confirm-file')">
              Archivar
            </x-danger-button>
            <x-modal name="confirm-file">
              <div>
                <form method="post" action="{{ route('acuerdo.file', ['acuerdo' => $acuerdo->id]) }}" class="p-6">
                  @csrf
                  @method('patch')
                  <h2 class="title">
                    {{ __('¿Esta seguro que quiere archivar este Acuerdo?') }}
                  </h2>
                  <p class="text-secondary">
                    {{ __('Ingrese su contraseña para confirmar que desea archivar el acuerdo.') }}
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
                      {{ __('Archivar acuerdo') }}
                    </x-danger-button>
                  </div>
                </form>
              </div>
            </x-modal>
          </div>
        @elseif (!$rectorado->status)
          <div class="flex items-center justify-between py-5 px-7 ">
            <div class="flex flex-col justify-center w-2/3">
              <h4 class="title">Recuperar Acuerdo</h4>
              <p class="text-secondary">Puede recuperar el acuerdo, de esta forma la información sera
                visible a los usuarios nuevamente</p>
            </div>
            <x-primary-button x-data=""
              x-on:click.prevent="$dispatch('open-modal', 'confirm-unarchive')">
              {{ __('Recuperar') }}
            </x-primary-button>
            <x-modal name="confirm-unarchive">
              <div>
                <form method="post" action="{{ route('acuerdo.unarchive', ['acuerdo' => $acuerdo->id]) }}"
                  class="p-6">
                  @csrf
                  @method('patch')
                  <h2 class="font-bold text-primary">
                    {{ __('¿Esta seguro que quiere recuperar este Acuerdo?') }}
                  </h2>
                  <p class="text-secondary">
                    {{ __('Ingrese su contraseña para confirmar que desea recuperar el acuerdo') }}
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
                      {{ __('Recuperar acuerdo') }}
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
