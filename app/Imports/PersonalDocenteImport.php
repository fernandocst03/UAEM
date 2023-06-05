<?php

namespace App\Imports;

use App\Models\Formato911\PersonalDocente;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class PersonalDocenteImport implements ToModel, WithHeadingRow, WithMultipleSheets
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

    return new PersonalDocente([
      'unidad_academica_id' => $row['unidad_academica_id'],
      'anio' => $row['anio'],
      'pitc_h' => $row['pitc_h'],
      'pitc_m' => $row['pitc_m'],
      'pitc_t' => $row['pitc_t'],
      'p34t_h' => $row['p34t_h'],
      'p34t_m' => $row['p34t_m'],
      'p34t_t' => $row['p34t_t'],
      'pmt_h' => $row['pmt_h'],
      'pmt_m' => $row['pmt_m'],
      'pmt_t' => $row['pmt_t'],
      'pph_h' => $row['pph_h'],
      'pph_m' => $row['pph_m'],
      'pph_t' => $row['pph_t'],
    ]);
  }

  public function sheets(): array
  {
    return [
      'Importar' => new PersonalDocenteImport(),
    ];
  }

  public function getRowCount(): int
  {
    return $this->rows;
  }
}
