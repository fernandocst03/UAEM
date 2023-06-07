@if (!empty($personalAdministrativo))
  <div class="border-[2px] border-gray-200 rounded p-2">
    <header class="flex items-center justify-between w-full px-5 py-4 bg-gray-900">
      <div class="flex flex-col">
        <h2 class="text-lg font-bold text-gray-100">
          {{ $personalAdministrativo->unidadAcademica->unidadDependencia->unidad_dependencia }}</h2>
        <p class="text-base italic font-light text-gray-300">Personal Administrativo - Informacion del año
          {{ $personalAdministrativo->anio }}</p>
      </div>
      <p class="text-xl font-bold text-gray-100">911</p>
    </header>
    <div class="flex gap-5 mt-9">
      <table class="table w-1/3 table-striped">
        <thead>
          <tr class="text-base text-gray-100 bg-gray-900">
            <th>Tipo</th>
            <th>Mujeres</th>
            <th>Hombres</th>
            <th>Total</th>
          </tr>
        </thead>
        <tbody class="text">
          <tr>
            <td>Directivo</td>
            <td>{{ $personalAdministrativo->directivo_h }}</td>
            <td>{{ $personalAdministrativo->directivo_m }}</td>
            <td>{{ $personalAdministrativo->directivo_t }}</td>
          </tr>
          <tr>
            <td>Docente</td>
            <td>{{ $personalAdministrativo->docente_h }}</td>
            <td>{{ $personalAdministrativo->docente_m }}</td>
            <td>{{ $personalAdministrativo->docente_t }}</td>
          </tr>
          <tr>
            <td>Docente investigador</td>
            <td>{{ $personalAdministrativo->docente_investigador_h }}</td>
            <td>{{ $personalAdministrativo->docente_investigador_m }}</td>
            <td>{{ $personalAdministrativo->docente_investigador_t }}</td>
          </tr>
          <tr>
            <td>Investigador</td>
            <td>{{ $personalAdministrativo->investigador_h }}</td>
            <td>{{ $personalAdministrativo->investigador_m }}</td>
            <td>{{ $personalAdministrativo->investigador_t }}</td>
          </tr>
          <tr>
            <td>Auxiliar investigador</td>
            <td>{{ $personalAdministrativo->auxiliar_investigador_h }}</td>
            <td>{{ $personalAdministrativo->auxiliar_investigador_m }}</td>
            <td>{{ $personalAdministrativo->auxiliar_investigador_t }}</td>
          </tr>
          <tr>
            <td>Administrativos</td>
            <td>{{ $personalAdministrativo->administrativo_h }}</td>
            <td>{{ $personalAdministrativo->administrativo_m }}</td>
            <td>{{ $personalAdministrativo->administrativo_t }}</td>
          </tr>
          <tr>
            <td>Otros</td>
            <td>{{ $personalAdministrativo->otros_h }}</td>
            <td>{{ $personalAdministrativo->otros_m }}</td>
            <td>{{ $personalAdministrativo->otros_t }}</td>
          </tr>
        </tbody>
      </table>
      <x-highcharts.grafica-personal-administrativo :data="$personalAdministrativo" />
    </div>
  </div>
@else
  <div class="flex items-center justify-center w-full h-36">
    <p class="w-1/3 italic text-secondary">Información del personal administrativo no esta disponible.</p>
  </div>
@endif
