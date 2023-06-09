@if (!empty($personalDocente))
  <div class="border-[2px] border-gray-200 rounded p-2">
    <header class="flex items-center justify-between w-full px-3 py-4 bg-gray-900 md:px-5">
      <div class="flex flex-col w-3/4">
        <h2 class="text-sm font-bold text-gray-100 md:text-lg">
          {{ $personalDocente->unidadAcademica->unidadDependencia->unidad_dependencia }}</h2>
        <p class="text-sm italic font-light text-gray-300 md:text-base">Personal Docente - Informacion del año
          {{ $personalDocente->anio }}</p>
      </div>
      <p class="text-xl font-bold text-gray-100">911</p>
    </header>
    <div class="mt-3 md:mt-10">
      {{-- Personal docente --}}
      <div class="flex flex-col gap-2 md:gap-5 md:mb-10 md:flex-row md:justify-center">
        <div class="flex flex-col md:w-1/3">
          <h2 class="mb-2 title">Personal docente</h2>
          <table class="table stripe">
            <thead>
              <tr class="text-sm text-gray-100 bg-gray-900">
                <th>Tipo</th>
                <th>Mujeres</th>
                <th>Hombres</th>
                <th>Total</th>
              </tr>
            </thead>
            <tbody class="text">
              <tr>
                <td>PITC</td>
                <td>{{ $personalDocente->pitc_h }}</td>
                <td>{{ $personalDocente->pitc_m }}</td>
                <td>{{ $personalDocente->pitc_t }}</td>
              </tr>
              <tr>
                <td>P34T</td>
                <td>{{ $personalDocente->p34t_h }}</td>
                <td>{{ $personalDocente->p34t_m }}</td>
                <td>{{ $personalDocente->p34t_t }}</td>
              </tr>
              <tr>
                <td>PMT</td>
                <td>{{ $personalDocente->pmt_h }}</td>
                <td>{{ $personalDocente->pmt_m }}</td>
                <td>{{ $personalDocente->pmt_t }}</td>
              </tr>
              <tr>
                <td>PPH</td>
                <td>{{ $personalDocente->pph_h }}</td>
                <td>{{ $personalDocente->pph_m }}</td>
                <td>{{ $personalDocente->pph_t }}</td>
              </tr>
            </tbody>
          </table>
        </div>
        <x-highcharts.grafica-personal-docente :data="$personalDocente" />
      </div>

      <div class="flex flex-col items-center gap-2 mt-10 mb-10 md:gap-10 md:flex-row md:mt-0">
        {{-- Personal docente edad --}}
        <div class="flex flex-col md:w-1/3 ">
          <h2 class="mb-2 title">Personal docente por grupos de edad</h2>
          <table class="table stripe">
            <thead>
              <tr class="text-sm bg-gray-900 text-gray-50">
                <th>Grupo de edad</th>
                <th>Hombres</th>
                <th>Mujeres</th>
                <th>Total</th>
              </tr>
            </thead>
            <tbody class="text">
              @foreach ($personalDocenteEdad as $item)
                <tr>
                  <td>{{ $item->edadGrupo->grupo }}</td>
                  <td>{{ $item->hombres }}</td>
                  <td>{{ $item->mujeres }}</td>
                  <td>{{ $item->total }}</td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
        <x-highcharts.grafica-personal-docente-edad :data="$personalDocenteEdad" />
      </div>

      <div class="flex flex-col items-center gap-2 mt-10 mb-10 md:gap-10 md:flex-row md:mt-0">
        {{-- Personal docente por antiguedad --}}
        <div class="flex flex-col md:w-1/3 ">
          <h2 class="mb-2 title">Personal docente por grupos de antiguedad</h2>
          <table class="table striped">
            <thead>
              <tr class="text-sm bg-gray-900 text-gray-50">
                <th>Antiguedad</th>
                <th>Hombres</th>
                <th>Mujeres</th>
                <th>Total</th>
              </tr>
            </thead>
            <tbody class="text">
              @foreach ($personalDocenteAntiguedad as $item)
                <tr>
                  <td>{{ $item->antiguedadGrupo->grupo }}</td>
                  <td>{{ $item->hombres }}</td>
                  <td>{{ $item->mujeres }}</td>
                  <td>{{ $item->total }}</td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
        <x-highcharts.grafica-personal-docente-antiguedad :data="$personalDocenteAntiguedad" />
      </div>

    </div>
  </div>
@else
  <div class="flex items-center justify-center w-full h-36">
    <p class="w-1/3 italic text-center text-secondary">Información del personal docente no esta disponible.</p>
  </div>
@endif
