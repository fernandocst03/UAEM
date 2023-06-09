@props(['data'])

<div id="graficaPersonalAdministrativo" class="md:w-2/3">
</div>

<x-highcharts.scripts />

@if ($data)
  <script src="{{ asset('js/charts/generateBarGraphic.js') }}"></script>
  <script>
    generateChart({
      id: 'graficaPersonalAdministrativo',
      title: 'Personal Adminstrativo',
      props: {
        anio: {{ $data->anio }},
        categories: [
          'Directivo',
          'Docente',
          'Docente investigador',
          'Investigador',
          'Auxiliar investigador',
          'Administrativos',
          'Otros'
        ],
        dataHombres: [
          {{ $data->directivo_h }},
          {{ $data->docente_h }},
          {{ $data->docente_investigador_h }},
          {{ $data->investigador_h }},
          {{ $data->auxiliar_investigador_h }},
          {{ $data->administrativo_h }},
          {{ $data->otros_h }}
        ],
        dataMujeres: [
          {{ $data->directivo_m }},
          {{ $data->docente_m }},
          {{ $data->docente_investigador_m }},
          {{ $data->investigador_m }},
          {{ $data->auxiliar_investigador_m }},
          {{ $data->administrativo_m }},
          {{ $data->otros_m }}
        ],
      }
    })
  </script>
@endif
