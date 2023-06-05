<?php

namespace App\Imports;

use App\Models\Formato911\PersonalDocenteAntiguedad;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class PersonalDocenteAntiguedadImport implements ToModel, WithHeadingRow, WithMultipleSheets
{
  private $rows = 0;

  /**
   * @param array $row
   *
   * @return \Illuminate\Database\Eloquent\Model|null
   */
  public function model(array $row)
  {
    ++$this->rows;

    return new PersonalDocenteAntiguedad([
      'unidad_academica_id' => $row['unidad_academica_id'],
      'anio' => $row['anio'],
      'grupo_id' => $row['grupo_id'],
      'hombres' => $row['hombres'],
      'mujeres' => $row['mujeres'],
      'total' => $row['total'],
    ]);
  }

  public function sheets(): array
  {
    return [
      'Importar' => new PersonalDocenteAntiguedadImport(),
    ];
  }

  public function getRowCount(): int
  {
    return $this->rows;
  }
}
