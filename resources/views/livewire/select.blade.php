<div>
  <select name="unidadAcademica" id=""
    class="w-full border border-gray-500 rounded focus:outline-blue-500 focus:ring-offset-2" required>
    <option value="">Seleciona una Unidad Academica</option>
    @foreach ($unidadesAcademicas as $item)
      <option value="{{ $item->id }}">{{ $item->unidadDependencia->unidad_dependencia }}</option>
    @endforeach
  </select>
</div>
