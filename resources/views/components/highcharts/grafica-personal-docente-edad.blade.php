@props(['data'])

<div id="graficaPersonalDocenteEdad" class="w-full md:w-2/3">
</div>

<x-highcharts.scripts />

@if ($data)
  <script src="{{ asset('js/charts/generateBarGraphic.js') }}"></script>
  <script>
    generateChart({
      id: 'graficaPersonalDocenteEdad',
      title: 'Personal Docente por grupos de Edad',
      props: {
        anio: {{ $data[0]->anio }},
        categories: [
          'Menos de 20 años',
          'De 20 a 24 años',
          'De 25 a 29 años',
          'De 30 a 34 años',
          'De 25 a 39 años',
          'De 40 a 44 años',
          'De 45 a 49 años',
          'De 50 a 54 años',
          'De 55 a 59 años',
          'De 60 a 64 años',
          'De 65 años o mas'
        ],
        dataHombres: [
          {{ $data[0]->hombres }},
          {{ $data[1]->hombres }},
          {{ $data[2]->hombres }},
          {{ $data[3]->hombres }},
          {{ $data[5]->hombres }},
          {{ $data[5]->hombres }},
          {{ $data[6]->hombres }},
          {{ $data[7]->hombres }},
          {{ $data[8]->hombres }},
          {{ $data[9]->hombres }},
          {{ $data[10]->hombres }},
        ],
        dataMujeres: [
          {{ $data[0]->mujeres }},
          {{ $data[1]->mujeres }},
          {{ $data[2]->mujeres }},
          {{ $data[3]->mujeres }},
          {{ $data[5]->mujeres }},
          {{ $data[5]->mujeres }},
          {{ $data[6]->mujeres }},
          {{ $data[7]->mujeres }},
          {{ $data[8]->mujeres }},
          {{ $data[9]->mujeres }},
          {{ $data[10]->mujeres }},
        ],
      }
    })
  </script>
@endif
