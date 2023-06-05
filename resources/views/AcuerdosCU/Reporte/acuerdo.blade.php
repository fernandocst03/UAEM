<x-datatables.styles />

<x-app-layout>

  <x-slot name="header">
    <div class="flex items-center gap-1 pt-1">
      <x-nav-link href="{{ route('acuerdos-cu') }}">
        Acuerdos C.U
      </x-nav-link>
      <x-arrow />
      <x-nav-link>
        Reportes
      </x-nav-link>
      <x-arrow />
      <x-nav-link :active="true">
        Acuerdos
      </x-nav-link>
    </div>
  </x-slot>

  <section class="flex flex-col gap-3 px-20 pt-10 pb-32">
    <article class="card-container">
      <form action="{{ route('reporte.acuerdos') }}" method="get">
        @csrf
        <div class="flex justify-center w-full gap-5">
          <div class="flex flex-col items-center justify-center gap-1">
            <label for="fechaInicio">Fecha inicio</label>
            <input type="date" name="fechaInicio" id="fechaInicio" class="border-[1px] border-gray-300 rounded"
              value="2023-01-01" required>
          </div>
          <div class="flex flex-col items-center justify-center gap-1">
            <label for="fechaFin">Fecha fin</label>
            <input type="date" name="fechaFin" id="fechaFin" class="border-[1px] border-gray-300 rounded"
              value="<?php echo date('Y-m-d'); ?>" required>
          </div>
          <div class="flex flex-col items-center justify-center gap-1">
            <label for="tipoAcuerdo">Tipo acuerdo</label>
            <select name="tipoAcuerdo" id="tipoAcuerdo" class="border-[1px] border-gray-300 rounded">
              <option value="">Todos</option>
              @foreach ($tipoAcuerdos as $tipo)
                <option value="{{ $tipo->id }}">{{ $tipo->tipo_acuerdo }}</option>
              @endforeach
            </select>
          </div>
        </div>
        <div class="flex justify-center gap-2 mt-4">
          <a href="{{ route('reporte.acuerdos') }}" class="flex items-center uppercase btn-secondary">Borrar
            filtros</a>
          <x-primary-button class="gap-2" x-data="{ loading: false }" x-on:click="loading = true">
            <span>Buscar</span>
            <span x-show="loading">
              <x-loaders.spinner />
            </span>
          </x-primary-button>
        </div>
      </form>
    </article>

    <article class="relative card-container">
      {{-- <x-loaders.skeleton /> --}}
      <h4 class="text-lg font-bold">Resultados</h4>
      <table class="table stripe" id="acuerdos" style="width: 100%">
        <thead class="bg-gray-900 text-gray-50">
          <tr class="text-md">
            <th>Samara</th>
            <th>Fecha</th>
            <th>Punto</th>
            <th>Tipo de acuerdo</th>
            <th>Acuerdo Corto</th>
            <th>Observaciones</th>
          </tr>
        </thead>
        <tbody class="text">
          @foreach ($acuerdos as $item)
            <tr>
              <td>
                @if ($item->sesion->samarasesion)
                  <a href="{{ route('samaras.show', ['samara' => $item->sesion->samarasesion->samara->id]) }} ">
                    {{ $item->sesion->samarasesion->samara->numero }}
                  </a>
                @else
                  <p class="italic text-secondary">No asignado</p>
                @endif
              </td>
              <td>
                <a
                  href="{{ route('sesiones.show', ['sesione' => $item->sesion->id]) }}">{{ date('d-M-Y', strtotime($item->sesion->fecha)) }}</a>
              </td>
              <td>
                {{-- <a href="{{ route('acuerdos.show', ['acuerdo' => $item->id]) }}"> --}}{{ $item->punto }}{{-- </a> --}}
              </td>
              <td>{{ $item->tipoAcuerdo->tipo_acuerdo }}</td>
              <td>{{ $item->acuerdo_corto }}</td>
              <td>
                @if ($item->observaciones)
                  <p>{{ $item->observaciones }}</p>
                @else
                  <p class="italic text-secondary">Sin observaciones</p>
                @endif
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>

    </article>
  </section>

</x-app-layout>

<x-datatables.scripts />
<script src="{{ asset('js/dataTableConfig.js') }}"></script>
<script>
  document.addEventListener('DOMContentLoaded', datatable({
    id: '#acuerdos',
    props: {
      orderBy: [0, 'desc'],
      scroll: 'false',
      fileName: 'Reporte de acuerdos',
      columns: [0, 1, 2, 3, 4, 5]
    }
  }))
</script>
