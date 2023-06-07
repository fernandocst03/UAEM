<?php

namespace App\Imports;

use App\Models\AcuerdosCU\Rectorado;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class RectoradoImport implements ToModel, WithHeadingRow, WithMultipleSheets
{
  private $rows = 0;

  public function model(array $row)
  {
    ++$this->rows;

    return new Rectorado([
      'ciclo' => $row['ciclo'],
    ]);
  }

  public function sheets(): array
  {
    return [
      'Importar' => new RectoradoImport(),
    ];
  }

  public function getRowCount(): int
  {
    return $this->rows;
  }
}
