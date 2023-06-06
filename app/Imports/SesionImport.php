<?php

namespace App\Imports;

use App\Models\AcuerdosCU\Sesion;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class SesionImport implements ToModel, WithHeadingRow, WithMultipleSheets
{
  private $rows = 0;

  public function model(array $row)
  {
    ++$this->rows;

    return new Sesion([
      'tipo_id' => $row['sesion_tipo_id'],
      'fecha' => $row['fecha']
    ]);
  }

  public function sheets(): array
  {
    return [
      'Importar' => new SesionImport(),
    ];
  }

  public function getRowCount(): int
  {
    return $this->rows;
  }
}
