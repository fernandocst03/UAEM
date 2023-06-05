<?php

namespace App\Imports;

use App\Models\AcuerdosCU\Acuerdo;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class AcuerdoImport implements ToModel,  WithHeadingRow, WithMultipleSheets
{
  /**
   * @param array $row
   *
   * @return \Illuminate\Database\Eloquent\Model|null
   */
  public function model(array $row)
  {
    return new Acuerdo([
      'sesion_id' => $row['sesion_id'],
      'acuerdo_tipo_id' => $row['acuerdo_tipo_id'],
      'punto' => $row['punto'],
      'acuerdo' => $row['acuerdo'],
      'acuerdo_corto' => $row['acuerdo_corto'],
      'pagina_samara' => $row['pagina_samara'],
      'tipo_otro' => $row['tipo_otro'],
      'observaciones' => $row['observaciones']
    ]);
  }

  public function sheets(): array
  {
    return [
      'Importar' => new AcuerdoImport(),
    ];
  }
}
