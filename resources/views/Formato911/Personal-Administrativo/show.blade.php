<x-datatables.styles />

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
    </div>
  </x-slot>

  <section class="flex flex-col w-full px-20 pt-10 pb-32">

    <section class="card-container ">
      <div class="flex flex-col gap-3">
        <div class="flex flex-col gap-1">
          <div class="flex items-center gap-1">
            <h3 class="title">
              {{ $personalAdministrativo->unidadAcademica->unidadDependencia->unidad_dependencia }}
            </h3>
            @if (Auth::check() && Auth::user()->role->role == 'Administrador')
              <a href="{{ route('personal-administrativo.edit', ['personal_administrativo' => $personalAdministrativo->id]) }}"
                class="px-2 py-1 text-xs transition bg-gray-300 rounded hover:bg-gray-200 hover:text-gray-800">
                Editar Personal
              </a>
            @endif
          </div>
          <p class="mt-4 text-secondary">Tipo de plantel:
            {{ $personalAdministrativo->unidadAcademica->tipoUnidadAcademica->tipo }}</p>
          <p class="text-secondary">{{ $personalAdministrativo->unidadAcademica->municipio->municipio }}</p>
          <p class="text-secondary">Campus: {{ $personalAdministrativo->unidadAcademica->municipio->campus->campus }}
          </p>
        </div>
      </div>

      <div class="mt-12">
        <p class="mb-3 text">Informacion del Personal administrativo</p>
        <table class="table" id="personalAdministrativo">
          <thead class="text-sm bg-gray-900 text-gray-50">
            <tr>
              <th>Año</th>
              <th>Directivos Hombres</th>
              <th>Directivos Mujeres</th>
              <th>Directivos Total</th>
              <th>Docentes Hombres</th>
              <th>Docentes Mujeres</th>
              <th>Docentes Total</th>
              <th>Docentes Investigadores H</th>
              <th>Docentes Investigadores M</th>
              <th>Docentes Investigadores Total</th>
              <th>Investigador Hombres</th>
              <th>Investigador M</th>
              <th>Investigador Total</th>
              <th>Auxiliar investigador H</th>
              <th>Auxiliar investigador M</th>
              <th>Auxiliar Total</th>
              <th>Administrativos Hombres</th>
              <th>Administrativos Mujeres</th>
              <th>Administrativos Total</th>
              <th>Otros Hombres</th>
              <th>Otros Mujeres</th>
              <th>Otros Total</th>
            </tr>
          </thead>
          <tbody class="text">
            <tr>
              <td>{{ $personalAdministrativo->anio }}</td>
              <td>{{ $personalAdministrativo->directivo_h }}</td>
              <td>{{ $personalAdministrativo->directivo_m }}</td>
              <td>{{ $personalAdministrativo->directivo_t }}</td>
              <td>{{ $personalAdministrativo->docente_h }}</td>
              <td>{{ $personalAdministrativo->docente_m }}</td>
              <td>{{ $personalAdministrativo->docente_t }}</td>
              <td>{{ $personalAdministrativo->docente_investigador_h }}</td>
              <td>{{ $personalAdministrativo->docente_investigador_m }}</td>
              <td>{{ $personalAdministrativo->docente_investigador_t }}</td>
              <td>{{ $personalAdministrativo->investigador_h }}</td>
              <td>{{ $personalAdministrativo->investigador_m }}</td>
              <td>{{ $personalAdministrativo->investigador_t }}</td>
              <td>{{ $personalAdministrativo->auxiliar_investigador_h }}</td>
              <td>{{ $personalAdministrativo->auxiliar_investigador_m }}</td>
              <td>{{ $personalAdministrativo->auxiliar_investigador_t }}</td>
              <td>{{ $personalAdministrativo->administrativo_h }}</td>
              <td>{{ $personalAdministrativo->administrativo_m }}</td>
              <td>{{ $personalAdministrativo->administrativo_t }}</td>
              <td>{{ $personalAdministrativo->otros_h }}</td>
              <td>{{ $personalAdministrativo->otros_m }}</td>
              <td>{{ $personalAdministrativo->otros_t }}</td>
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
    id: '#personalAdministrativo',
    props: {
      orderBy: [0, 'desc'],
      scroll: 'true',
      fileName: '{{ $personalAdministrativo->unidadAcademica->unidadDependencia->unidad_dependencia }} - Personal Administrativo - {{ $personalAdministrativo->anio }} ',
      columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21]
    }
  }))
</script>
