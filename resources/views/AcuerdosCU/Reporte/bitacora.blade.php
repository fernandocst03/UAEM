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
        Bitacoras
      </x-nav-link>
    </div>
  </x-slot>

  <section class="flex flex-col gap-3 px-20 pt-10 pb-32">

    <article class="card-container">
      <form action="{{ route('reporte.bitacoras') }}" method="get">
        @csrf
        <div class="flex justify-center w-full gap-5">
          <div class="flex flex-col items-center justify-center gap-1">
            <label for="fechaInicio">Fecha inicio</label>
            <input type="date" name="fechaInicio" id="fechaInicio" class="border-[1px] border-gray-300 rounded"
              value="<?php echo date('Y-m-d'); ?>" required>
          </div>
          <div class="flex flex-col items-center justify-center gap-1">
            <label for="fechaFin">Fecha fin</label>
            <input type="date" name="fechaFin" id="fechaFin" class="border-[1px] border-gray-300 rounded"
              value="<?php echo date('Y-m-d'); ?>" required>
          </div>
          <div class="flex flex-col items-center justify-center gap-1">
            <label for="tipoAccion">Tipo acuerdo</label>
            <select name="tipoAccion" id="tipoAccion" class="border-[1px] border-gray-300 rounded">
              <option value="">Todos</option>
              <option value="1">Login</option>
              <option value="2">Cosulta</option>
              <option value="3">Alta</option>
              <option value="4">Modificacion</option>
              <option value="5">Baja</option>
            </select>
          </div>
        </div>
        <div class="flex justify-center gap-2 mt-4">
          <a href="{{ route('reporte.bitacoras') }}" class="flex items-center uppercase btn-secondary">Borrar
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
      <h4 class="mb-2 text-lg font-bold">Resultados</h4>
      <table class="table stripe" id="bitacoras">
        <thead class="bg-gray-900 text-gray-50">
          <tr class="text-md ">
            <th>Acción</th>
            <th>Usuario</th>
            <th>Fecha</th>
            <th>Sección</th>
            <th>Registro</th>
          </tr>
        </thead>
        <tbody class="text">
          @foreach ($bitacoras as $item)
            <tr>
              <td>{{ $item->tipoBitacora->accion }} </td>
              <td>{{ $item->user->name }}</td>
              <td>{{ $item->fecha }}</td>
              <td>{{ $item->seccion }}</td>
              <td>{{ $item->registro_id }}</td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </article>

  </section>

</x-app-layout>

<x-datatables.scripts />
<script src="{{ asset('js/datatables.js') }}"></script>
<script>
  document.addEventListener('DOMContentLoaded', datatable('#bitacoras'))
</script>
