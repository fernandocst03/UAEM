<x-datatables.styles />

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
      <x-nav-link :active="true">Acuerdo - Punto: {{ $acuerdo->punto }}
      </x-nav-link>

    </div>
  </x-slot>

  <section class="flex flex-col px-20 pt-10 pb-32">

    <article class="card-container">
      <div>
        <h2 class="title">Informacion de la sesión</h2>
        <div class="flex flex-col gap-1">
          @if ($acuerdo->sesion->samarasesion)
            <p class="text-secondary">Menendez Samara: {{ $acuerdo->sesion->samarasesion->samara->numero }}</p>
            <p class="text-secondary">Rectorado: {{ $acuerdo->sesion->samarasesion->samara->rectorado->ciclo }}</p>
          @endif
          <p class="text-secondary">Tipo de la sesión: {{ $acuerdo->sesion->sesionTipo->tipo }}</p>
          <a class="text-secondary" href="{{ route('sesiones.show', ['sesione' => $acuerdo->sesion->id]) }}">Fecha de la
            sesion: {{ $acuerdo->sesion->fecha }}</a>
        </div>
      </div>

      <div class="mt-4">
        <table class="table stripe" id="acuerdo">
          <thead>
            <tr class="text-sm bg-gray-900 text-gray-50">
              <th>Tipo del acuerdo</th>
              <th>Acuerdo</th>
              <th>Acuerdo Corto</th>
              <th>Observaciones</th>
              <th>Pagina samara</th>
              @if (Auth::check() && (Auth::user()->role->role = 'Administrador'))
                <th>Opciones</th>
              @endif
            </tr>
          </thead>
          <tbody>
            <tr>
              @if ($acuerdo->tipoAcuerdo->id == 19)
                <td>Otro ({{ $acuerdo->tipo_otro }})</td>
              @else
                <td>{{ $acuerdo->tipoAcuerdo->tipo_acuerdo }}</td>
              @endif
              <td>{{ $acuerdo->acuerdo }}</td>
              <td>{{ $acuerdo->acuerdo_corto }}</td>
              <td>
                @if ($acuerdo->observaciones)
                  <p>{{ $acuerdo->observaciones }}</p>
                @else
                  <p class="italic text-secondary">Sin observaciones</p>
                @endif
              </td>
              <td>
                @if ($acuerdo->pagina_samara)
                  <p>{{ $acuerdo->pagina_samara }}</p>
                @else
                  <p class="italic text-secondary">Sin pagina</p>
                @endif
              </td>
              @if (Auth::check() && (Auth::user()->role->role = 'Administrador'))
                <td>
                  <a href="{{ route('acuerdos.edit', ['acuerdo' => $acuerdo->id]) }}" class="btn-primary">Editar</a>
                </td>
              @endif
            </tr>
          </tbody>
        </table>
      </div>
    </article>
  </section>

</x-app-layout>
