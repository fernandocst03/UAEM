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
    </div>
  </x-slot>

  <section class="flex flex-col w-full pt-10 pb-32 md:px-20">

    <section class="card-container">
      <div class="flex flex-col gap-3">
        <div class="flex flex-col gap-1">
          <div class="flex items-center gap-2">
            <h3 class="title">
              {{ $infraestructura->unidadAcademica->unidadDependencia->unidad_dependencia }}
            </h3>
            @if (Auth::check() && Auth::user()->role->role == 'Administrador')
              <a href="{{ route('infraestructuras.edit', ['infraestructura' => $infraestructura->id]) }}"
                class="px-2 py-1 text-xs transition bg-gray-300 rounded hover:bg-gray-200 hover:text-gray-800">
                Editar infraestructura
              </a>
            @endif
          </div>
          <p class="text">{{ $infraestructura->unidadAcademica->tipoUnidadAcademica->tipo }}</p>
          <p class="text">{{ $infraestructura->unidadAcademica->municipio->municipio }}</p>
          <p class="text">Campus: {{ $infraestructura->unidadAcademica->municipio->campus->campus }}</p>
        </div>
      </div>

      <div class="mt-7">
        <table class="table stripe" id="infraestructuras">
          <thead class="text-sm bg-gray-900 text-gray-50">
            <tr>
              <th>Año</th>
              <th>Aulas existentes</th>
              <th>Aulas en uso</th>
              <th>Aulas adaptadas</th>
              <th>Talleres existentes</th>
              <th>Talleres en uso</th>
              <th>Talleres adaptados</th>
              <th>Laboratorios existentes</th>
              <th>Laboratorios en uso</th>
              <th>Laboratorios adaptados</th>
              <th>Laboratorios de computo</th>
              <th>Biblioteca</th>
              @if (Auth::check() && Auth::user()->role->role == 'Administrador')
                <th>Opciones</th>
              @endif
            </tr>
          </thead>
          <tbody class="text">
            <tr>
              <td>{{ $infraestructura->anio }}</td>
              <td>{{ $infraestructura->aulas_existentes }}</td>
              <td>{{ $infraestructura->aulas_en_uso }}</td>
              <td>{{ $infraestructura->aulas_adaptadas }}</td>
              <td>{{ $infraestructura->talleres_existentes }}</td>
              <td>{{ $infraestructura->talleres_en_uso }}</td>
              <td>{{ $infraestructura->talleres_adaptados }}</td>
              <td>{{ $infraestructura->laboratorios_existentes }}</td>
              <td>{{ $infraestructura->laboratorios_en_uso }}</td>
              <td>{{ $infraestructura->laboratorios_adaptados }}</td>
              <td>{{ $infraestructura->laboratorios_computo }}</td>
              <td>{{ $infraestructura->biblioteca ? 'Si' : 'No' }}</td>
              <td>
                @if (Auth::check() && Auth::user()->role->role == 'Administrador')
                  <a href="{{ route('infraestructuras.edit', ['infraestructura' => $infraestructura->id]) }}"
                    class="btn-primary">Editar</a>
                @endif
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </section>

  </section>
</x-app-layout>

<x-datatables.scripts />
<script src="{{ asset('js/dataTableConfig.js') }}"></script>
<script>
  $(document).ready(datatable({
    id: '#infraestructuras',
    props: {
      orderBy: [0, 'desc'],
      scroll: 'true',
      fileName: '{{ $infraestructura->unidadAcademica->unidadDependencia->unidad_dependencia }} - Infraestructura - {{ $infraestructura->anio }}',
      columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11]
    }
  }))
</script>
