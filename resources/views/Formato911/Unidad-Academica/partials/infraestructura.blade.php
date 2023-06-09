@if (!empty($infraestructura))
  <div class="border-[2px] border-gray-200 rounded p-2 relative">
    <header class="flex items-center justify-between w-full px-5 py-4 bg-gray-900">
      <div class="flex flex-col">
        <h2 class="text-lg font-bold text-gray-100">Plantel</h2>
        <p class="text-base italic font-light text-gray-300">Informacion del año </p>
      </div>
      <p class="text-base font-light text-gray-300">Infraestructuras</p>
      <p class="text-xl font-bold text-gray-100">911</p>
    </header>
    <div class="flex flex-col gap-6 mt-10 md:items-center md:flex-row">
      <div class="md:w-1/3">
        <table class="table table-striped">
          <thead>
            <tr class="text-sm bg-gray-900 text-gray-50">
              <th>Estado</th>
              <th>Aulas</th>
              <th>Talleres</th>
              <th>Laboratorios</th>
            </tr>
          </thead>
          <tbody class="text">
            <tr>
              <td>Existentes</td>
              <td>{{ $infraestructura->aulas_existentes }}</td>
              <td>{{ $infraestructura->talleres_existentes }}</td>
              <td>{{ $infraestructura->laboratorios_existentes }}</td>
            </tr>
            <tr>
              <td>En uso</td>
              <td>{{ $infraestructura->aulas_en_uso }}</td>
              <td>{{ $infraestructura->talleres_en_uso }}</td>
              <td>{{ $infraestructura->laboratorios_en_uso }}</td>
            </tr>
            <tr>
              <td>Adaptados</td>
              <td>{{ $infraestructura->aulas_adaptadas }}</td>
              <td>{{ $infraestructura->talleres_adaptados }}</td>
              <td>{{ $infraestructura->laboratorios_adaptados }}</td>
            </tr>
          </tbody>
        </table>
      </div>
      <x-highcharts.grafica-infraestructuras :data="$infraestructura" />
    </div>

    <div class="flex flex-col gap-10 mt-20 md:flex-row">
      <div class="md:w-1/3 ">
        <table class="table table-striped">
          <thead>
            <tr class="text-sm bg-gray-900 text-gray-50">
              <th>Inmueble</th>
              <th></th>
            </tr>
          </thead>
          <tbody class="text">
            <tr>
              <td>Propiedad</td>
              <td>{{ $infraestructura->tipoPropiedad->tipo }}</td>
            </tr>
            <tr>
              <td>Adecuacion</td>
              <td>{{ $infraestructura->tipoConstruccion->tipo }}</td>
            </tr>
          </tbody>
        </table>
      </div>

      <div class="md:w-1/3 ">
        <table class="table table-striped">
          <thead>
            <tr class="text-sm bg-gray-900 text-gray-50">
              <th>Laboratorios de computo</th>
              <th>Número</th>
            </tr>
          </thead>
          <tbody class="text-[13px]">
            <tr>
              <td>{{ $infraestructura->laboratorios_computo > 0 ? 'Si' : 'No' }}</td>
              <td>{{ $infraestructura->laboratorios_computo }}</td>
            </tr>
          </tbody>
        </table>
      </div>

      <div class="md:w-1/3 ">
        <table class="table table-striped">
          <thead>
            <tr class="text-sm bg-gray-900 text-gray-50">
              <th>Biblioteca</th>
            </tr>
          </thead>
          <tbody class="text">
            <tr>
              <td>{{ $infraestructura->biblioteca ? 'Si' : 'No' }}</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
@else
  <div class="flex items-center justify-center w-full h-36">
    <p class="w-1/3 italic text-center text-secondary">Información de las infraestructuras no esta disponible.</p>
  </div>
@endif
