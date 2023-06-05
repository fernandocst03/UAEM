<x-datatables.styles />

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
    </div>
  </x-slot>

  <section class="flex flex-col w-full px-20 pt-10 pb-32 gap-7">
    <section class="card-container">
      <div class="flex flex-col gap-3">
        <div class="flex flex-col gap-1">
          <div class="flex items-center gap-1">
            <h3 class="title">
              {{ $personalDocente->unidadAcademica->unidadDependencia->unidad_dependencia }}
            </h3>
            @if (Auth::check() && Auth::user()->role->role == 'Administrador')
              <a href="{{ route('personal-docente-edad.edit', ['personal_docente_edad' => $personalDocente->id]) }}"
                class="px-2 py-1 text-xs transition bg-gray-300 rounded hover:bg-gray-200 hover:text-gray-800">
                Editar Personal
              </a>
            @endif
          </div>
          <p class="mt-4 text-secondary">Tipo de plantel:
            {{ $personalDocente->unidadAcademica->tipoUnidadAcademica->tipo }}</p>
          <p class="text-secondary">{{ $personalDocente->unidadAcademica->municipio->municipio }}</p>
          <p class="text-secondary">Campus: {{ $personalDocente->unidadAcademica->municipio->campus->campus }}
          </p>
        </div>
        <div class="mt-12">
          <p class="mb-3 text">Informacion del Personal Docente por Edad</p>
          <table class="table" id="personalDocenteEdad" style="width: 100%">
            <thead class="text-sm bg-gray-900 text-gray-50">
              <tr>
                <th>Año</th>
                <th>Grupo de edad</th>
                <th>Mujeres</th>
                <th>Hombres</th>
                <th>Total</th>
              </tr>
            </thead>
            <tbody class="text">
              <tr>
                <td>{{ $personalDocente->anio }}</td>
                <td>{{ $personalDocente->edadGrupo->grupo }}</td>
                <td>{{ $personalDocente->mujeres }}</td>
                <td>{{ $personalDocente->hombres }}</td>
                <td>{{ $personalDocente->total }}</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </section>
  </section>
</x-app-layout>

<x-datatables.scripts />
<script src="{{ asset('js/dataTableConfig.js') }}"></script>
<script>
  $(document).ready(datatable({
    id: '#personalDocenteEdad',
    props: {
      orderBy: [0, 'desc'],
      scroll: 'true',
      fileName: '{{ $personalDocente->unidadAcademica->unidadDependencia->unidad_dependencia }} - Personal docente por grupo de edad - {{ $personalDocente->anio }}',
      columns: [0, 1, 2, 3, 4]
    }
  }))
</script>
