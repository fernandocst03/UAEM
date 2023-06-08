@props(['data'])

<div id="graficaPersonalDocenteAntiguedad" class="w-full md:w-2/3">
</div>

<x-highcharts.scripts />

@if ($data)
  <script src="{{ asset('js/charts/generateBarGraphic.js') }}"></script>
  <script>
    generateChart({
      id: 'graficaPersonalDocenteAntiguedad',
      props: {
        anio: {{ $data[0]->anio }},
        title: 'Personal Docente por grupos de Antiguedad',
        categories: [
          'De 0 a 4 años',
          'De 4 a 9 años',
          'De 10 a 14 años',
          'De 15 a 19 años',
          'De 20 a 24 años',
          'De 25 a 29 años',
          'De 30 años o mas'
        ],
        dataHombres: [
          {{ $data[0]->hombres }},
          {{ $data[1]->hombres }},
          {{ $data[2]->hombres }},
          {{ $data[3]->hombres }},
          {{ $data[5]->hombres }},
          {{ $data[5]->hombres }},
          {{ $data[6]->hombres }},
        ],
        dataMujeres: [
          {{ $data[0]->mujeres }},
          {{ $data[1]->mujeres }},
          {{ $data[2]->mujeres }},
          {{ $data[3]->mujeres }},
          {{ $data[5]->mujeres }},
          {{ $data[5]->mujeres }},
          {{ $data[6]->mujeres }},
        ],
      }
    })
  </script>
@endif
