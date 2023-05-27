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
        Todos los samarás
      </x-nav-link>
    </div>
  </x-slot>

  <section class="flex flex-col px-20 pt-10 pb-32">
    <div class="flex flex-col gap-14 " id="tablas">

      @foreach ($rectorados as $rectorado)
        <div class="p-4 bg-white rounded-md shadow">
          <p class="mb-2 title">Ciclo: {{ $rectorado->ciclo }}</p>
          <table id="tabla_samaras" class="table stripe" style="width: 100%">
            <thead class="bg-gray-900 text-gray-50">
              <tr>
                <th>Número Samará</th>
                <th>Año</th>
                <th>Ciclo</th>
                <th>Fecha</th>
                <th>Numero de sesiones</th>
                <th>Opciones</th>
                <th>PDF</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($rectorado->samaras as $samara)
                @if ($samara->status)
                  <tr class="text-sm">
                    <td>{{ $samara->numero }}</td>
                    <td>{{ $samara->anio }}</td>
                    <td>{{ $samara->rectorado->ciclo }}</td>
                    <td>{{ date('d-m-y', strtotime($samara->fecha)) }}</td>
                    <td>{{ sizeof($samara->samarasesion) }}</td>
                    <td class="flex items-center gap-3">
                      <a href="{{ route('samaras.show', ['samara' => $samara->id]) }}" class="btn-primary">
                        Ver
                      </a>
                      @if (Auth::check() && Auth::user()->role->role == 'Administrador')
                        <a href="{{ route('samaras.edit', ['samara' => $samara->id]) }}" class="btn-secondary">
                          Editar
                        </a>
                      @endif
                    </td>
                    <td>
                      @if ($samara->url_archivo)
                        <a href="{{ $samara->url_archivo }}" target="_blank" class=""><svg
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                              d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m.75 12l3 3m0 0l3-3m-3 3v-6m-1.5-9H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                          </svg>
                        </a>
                      @else
                        <p>Sin PDF asignado</p>
                      @endif
                    </td>
                  </tr>
                @endif
              @endforeach
            </tbody>
          </table>
        </div>
      @endforeach
    </div>
  </section>

</x-app-layout>
