<?php

namespace App\Imports;

use App\Models\Formato911\PersonalAdministrativo;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class PersonalAdministrativoImport implements ToModel, WithHeadingRow, WithMultipleSheets
{
  private $rows = 0;

  public function model(array $row)
  {
    ++$this->rows;

    return new PersonalAdministrativo([
      'unidad_academica_id' => $row['unidad_academica_id'],
      'anio' => $row['anio'],
      'directivo_h' => $row['directivo_h'],
      'directivo_m' => $row['directivo_m'],
      'directivo_t' => $row['directivo_t'],
      'docente_h' => $row['docente_m'],
      'docente_m' => $row['docente_m'],
      'docente_t' => $row['docente_t'],
      'docente_investigador_h' => $row['docente_investigador_h'],
      'docente_investigador_m' => $row['docente_investigador_m'],
      'docente_investigador_t' => $row['docente_investigador_t'],
      'investigador_h' => $row['investigador_h'],
      'investigador_m' => $row['investigador_m'],
      'investigador_t' => $row['investigador_t'],
      'auxiliar_investigador_h' => $row['auxiliar_investigador_h'],
      'auxiliar_investigador_m' => $row['auxiliar_investigador_m'],
      'auxiliar_investigador_t' => $row['auxiliar_investigador_t'],
      'administrativo_h' => $row['administrativo_h'],
      'administrativo_m' => $row['administrativo_m'],
      'administrativo_t' => $row['administrativo_t'],
      'otros_h' => $row['otros_h'],
      'otros_m' => $row['otros_m'],
      'otros_t' => $row['otros_t']
    ]);
  }

  public function sheets(): array
  {
    return [
      'Importar' => new PersonalAdministrativoImport(),
    ];
  }

  public function getRowCount(): int
  {
    return $this->rows;
  }
}
