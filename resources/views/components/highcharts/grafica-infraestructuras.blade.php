@props(['data'])

<div id="graficaInfraestructuras" class="w-full md:w-2/3">
</div>

<x-highcharts.scripts />

<script src="{{ asset('js/charts/generateBarGraphicInfraestructuras.js') }}"></script>
@if ($data)
  <script>
    generateChartInfraestructuras({
      id: 'graficaInfraestructuras',
      props: {
        anio: {{ $data->anio }},
        title: 'Infraestructuras',
        categories: [
          'Existentes',
          'En uso',
          'Adaptadas'
        ],
        aulas: [
          {{ $data->aulas_existentes }},
          {{ $data->aulas_en_uso }},
          {{ $data->aulas_adaptadas }},
        ],
        talleres: [
          {{ $data->talleres_existentes }},
          {{ $data->talleres_en_uso }},
          {{ $data->talleres_adaptados }},
        ],
        laboratorios: [
          {{ $data->laboratorios_existentes }},
          {{ $data->laboratorios_en_uso }},
          {{ $data->laboratorios_adaptados }},
        ]
      }
    })
  </script>
@endif
