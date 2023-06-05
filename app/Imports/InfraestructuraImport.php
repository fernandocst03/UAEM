<?php

namespace App\Imports;

use App\Models\Formato911\Infraestructura;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class InfraestructuraImport implements ToModel,  WithHeadingRow, WithMultipleSheets
{
  private $filas = 0;

  /**
   * @param array $row
   *
   * @return \Illuminate\Database\Eloquent\Model|null
   */
  public function model(array $row)
  {
    ++$this->filas;

    return new Infraestructura([
      'unidad_academica_id' => $row['unidad_academica_id'],
      'anio' => $row['anio'],
      'inmueble_tipo_id' => $row['inmueble_tipo_id'],
      'aula_tipo_id' => $row['aula_tipo_id'],
      'aulas_existentes' => $row['aulas_existentes'],
      'aulas_en_uso' => $row['aulas_en_uso'],
      'aulas_adaptadas' => $row['aulas_adaptadas'],
      'talleres_existentes' => $row['talleres_existentes'],
      'talleres_en_uso' => $row['talleres_en_uso'],
      'talleres_adaptados' => $row['talleres_adaptados'],
      'laboratorios_existentes' => $row['laboratorios_existentes'],
      'laboratorios_en_uso' => $row['laboratorios_en_uso'],
      'laboratorios_adaptados' => $row['laboratorios_adaptados'],
      'laboratorios_computo' => $row['laboratorios_computo'],
      'biblioteca' => $row['biblioteca'],
    ]);
  }

  public function sheets(): array
  {
    return [
      'Importar' => new InfraestructuraImport(),
    ];
  }

  public function getRowCount(): int
  {
    return $this->filas;
  }
}
