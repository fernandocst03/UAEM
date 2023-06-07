@props(['data'])

<div id="graficaPersonalDocente" class="w-2/3 h-80"></div>
<script src="{{ asset('js/charts/generateCakeGraphic.js') }}"></script>
@if ($data)
  <script>
    generateChart({
      id: 'graficaPersonalDocente',
      title: 'Personal Docente',
      props: {
        pitc: {{ $data->pitc_t }},
        p34t: {{ $data->p34t_t }},
        pmt: {{ $data->pmt_t }},
        pph: {{ $data->pph_t }},
      }
    })
  </script>
@endif
