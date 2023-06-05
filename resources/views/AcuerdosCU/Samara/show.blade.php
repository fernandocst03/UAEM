<x-datatables.styles />

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
    </div>
  </x-slot>

  <section class="flex flex-col px-24 mt-10">
    <article class="card-container">
      <div class="flex items-center gap-2">
        <h2 class="title">
          {{ __('Menendez Samara número ') . $samara->numero }}
        </h2>
        @if (Auth::check() && Auth::user()->role->role == 'Administrador')
          <a href="{{ route('samaras.edit', ['samara' => $samara->id]) }}"
            class="px-2 py-1 text-xs transition bg-gray-300 rounded hover:bg-gray-200 hover:text-gray-800">
            Editar
          </a>
        @endif
      </div>

      <div class="pt-3">

        <div>
          <p class="text">Rectorado: {{ $samara->rectorado->ciclo }}</p>
          <p class="text">Fecha: {{ date('d-m-Y', strtotime($samara->fecha)) }}</p>
          <p class="text">Año: {{ $samara->anio }}</p>
        </div>
        <p class="mt-4 mb-2 font-bold text">Sesiones:</p>
        <table id="sesiones" class="table stripe" style="width: 100%">
          <thead class="bg-gray-900 text-gray-50">
            <tr>
              <th>Tipo sesión</th>
              <th>Fecha</th>
              <th>Numero de acuerdos</th>
              <th>Opciones</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($samara->samarasesion as $sesion)
              <tr class="text-sm">
                <td>{{ $sesion->sesion->sesionTipo->tipo }}</td>
                <td>{{ date('d-m-y', strtotime($sesion->sesion->fecha)) }}</td>
                <td>{{ sizeof($sesion->sesion->acuerdos) }}</td>
                <td class="flex items-center gap-3">
                  <a href="{{ route('sesiones.show', ['sesione' => $sesion->sesion->id]) }}" class="btn-primary">
                    Ver
                  </a>
                  @if (Auth::check() && Auth::user()->role->role == 'Administrador')
                    <a href="{{ route('sesiones.edit', ['sesione' => $sesion->sesion->id]) }}" class="btn-secondary">
                      Editar
                    </a>
                  @endif
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>

      </div>
    </article>

    <article class="pb-20 mt-3">
      <a href="{{ $samara->url_archivo }}" target="_blank" class="flex gap-2 btn-primary w-fit">Descargar
        PDF
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
          stroke="currentColor" class="w-5 h-5">
          <path stroke-linecap="round" stroke-linejoin="round"
            d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m.75 12l3 3m0 0l3-3m-3 3v-6m-1.5-9H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
        </svg>
      </a>
    </article>
  </section>
</x-app-layout>

<x-datatables.scripts />

<script src="{{ asset('js/dataTableConfig.js') }}"></script>
<script>
  document.addEventListener("DOMContentLoaded",
    datatable({
      id: '#sesiones',
      props: {
        orderBy: [0, 'desc'],
        scroll: 'false',
        fileName: 'Sesiones del Samará: {{ $samara->numero }} ',
        columns: [0, 1, 2]
      }
    }));
</script>
