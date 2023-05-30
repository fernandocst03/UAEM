<x-datatables.styles />
<x-app-layout>
  <x-slot name='header'>
    <div class="flex items-center gap-1">
      <x-nav-link>
        {{ __('Acuerdos del Consejo Universitario') }}
      </x-nav-link>
      <x-arrow />
      <x-nav-link :href="route('acuerdos-cu')" :active="true">
        {{ __('Presentacion') }}
      </x-nav-link>
    </div>
  </x-slot>

  <section class="flex flex-col gap-10 px-24 pb-32">

    <article class="mt-20">
      <div class="flex flex-col items-center">
        <h1 class="text-3xl font-light">Órgano Informativo Universitario</h1>
        <h3 class="mt-3 text-xl font-bold">“Adolfo Menéndez Samará”</h3>
      </div>

      <p class="mt-3 text">
        El Órgano Informativo Universitario “Adolfo Menéndez Samará” fue creado por acuerdo del Consejo
        Universitario en su sesión de fecha 9 de febrero de 1995. El Secretario General de la UAEM, es el
        Director
        de este Órgano Informativo, el cual contiene las actas y acuerdos de las sesiones del Consejo
        Universitario,
        las normatividades que regulan la gestión universitaria y los acuerdos del Rector.

        Para cualquier asunto relacionado a este Órgano se pone a disposición de la Comunidad Universitaria el
        teléfono 01 (777) 329-70-00 extensiones 2125, 3176 y 3124 con la Dirección de Normatividad Institucional
        y
        en el correo electrónico normatividad@uaem.mx
      </p>
    </article>

    <article class="card-container">
      @if (empty($last_sesion))
        <p class="italic text-center text-secondary">Información no disponible</p>
      @else
        <a href="{{ route('sesiones.show', ['sesione' => $last_sesion->id]) }}" class="text-lg font-bold">Ultima
          sesión</a>

        <div>
          <p class="title">Fecha de la sesión: {{ date('d-m-y', strtotime($last_sesion->fecha)) }} </p>
          <p class="text">Tipo de la sesion: {{ $last_sesion->sesionTipo->tipo }} </p>
          <p class="text">Acuerdos</p>
          <div>
            <table id="ultima_sesion" class="table stripe" style="width: 100%">
              <thead class="bg-gray-900 text-gray-50 text-md">
                <tr>
                  <th>Punto</th>
                  <th>Tipo acuerdo</th>
                  <th>Acuerdo corto</th>
                  <th>Acuerdo</th>
                  <th>Observaciones</th>
                  <th>Pagina Samara</th>
                  @if (Auth::check() && Auth::user()->role->id == 1)
                    <th>Opciones</th>
                  @endif
                </tr>
              </thead>
              <tbody class="text">
                @foreach ($last_sesion->acuerdos as $acuerdos)
                  <tr>
                    <td>{{ $acuerdos->punto }}</td>
                    <td>{{ $acuerdos->tipoAcuerdo->tipo_acuerdo }}</td>
                    <td>{{ $acuerdos->acuerdo_corto }}</td>
                    <td>{{ $acuerdos->acuerdo }}</td>
                    <td>
                      @if ($acuerdos->observaciones == null)
                        Sin observaciones
                      @else
                        {{ $acuerdos->observaciones }}
                      @endif
                    </td>
                    <th>{{ $acuerdos->pagina_samara }}</th>
                    @if (Auth::check() && Auth::user()->role->id == 1)
                      <td>
                        <a class="btn-primary w-fit" href="{{ route('acuerdos.edit', ['acuerdo' => $acuerdos->id]) }}">
                          Editar
                        </a>
                      </td>
                    @endif
                  </tr>
                @endforeach
            </table>
          </div>
        </div>
      @endif
    </article>

    <article class="card-container">
      <h4 class="title">Ultimos 5 Samaras</h4>
      <div class="flex flex-col gap-4 mt-2">
        <table id="ultimos_5_samaras" class="table stripe" style="width: 100%">
          <thead class="bg-gray-900 text-gray-50 text-md">
            <tr>
              <th>Menendez Samará</th>
              <th>Ciclo</th>
              <th>Fecha</th>
              <th>Opciones</th>
              <th>PDF</th>
            </tr>
          </thead>
          <tbody class="text">
            @foreach ($last_five_samaras as $samara)
              <tr>
                <td>{{ $samara->numero }}</td>
                <td>{{ $samara->rectorado->ciclo }}</td>
                <td>{{ date('d-m-y', strtotime($samara->fecha)) }}</td>
                <td>
                  <div class="flex items-center gap-2">
                    <a href="{{ route('samaras.show', ['samara' => $samara->id]) }}" class="btn-primary">
                      Ver
                    </a>
                    @if (Auth::check() && Auth::user()->role->role == 'Administrador')
                      <a href="{{ route('samaras.edit', ['samara' => $samara->id]) }}" class="btn-secondary">
                        Editar
                      </a>
                    @endif
                  </div>
                <td>
                  @if ($samara->url_archivo)
                    <a href="{{ $samara->url_archivo }}" target="_blank">
                      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                          d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m.75 12l3 3m0 0l3-3m-3 3v-6m-1.5-9H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                      </svg>
                    </a>
                  @else
                    <p class="italic text-secondary">Sin PDF asignado</p>
                  @endif
                </td>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>

    </article>

  </section>

</x-app-layout>

<x-datatables.scripts />

<script src="{{ asset('js/datatables.js') }}"></script>
<script>
  document.addEventListener("DOMContentLoaded", [
    datatable('#ultima_sesion'),
    datatable('#ultimos_5_samaras')
  ]);
</script>
