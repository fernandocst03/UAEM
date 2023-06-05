<?php

namespace App\Imports;

use App\Models\Formato911\PersonalDocenteEdad;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class PersonalDocenteEdadImport implements ToModel, WithHeadingRow, WithMultipleSheets
{
  /**
   * @param array $row
   *
   * @return \Illuminate\Database\Eloquent\Model|null
   */
  private $rows = 0;

  public function model(array $row)
  {
    ++$this->rows;

    return new PersonalDocenteEdad([
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
      'Importar' => new PersonalDocenteEdadImport(),
    ];
  }

  public function getRowCount(): int
  {
    return $this->rows;
  }
}
