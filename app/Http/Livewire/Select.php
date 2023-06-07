<?php

namespace App\Http\Livewire;

use App\Models\Formato911\UnidadAcademica;
use Livewire\Component;

class Select extends Component
{
  public function render()
  {
    $unidadesAcademicas = UnidadAcademica::orderBy('id')
      ->where('tipo_id', '!=', 10)
      ->get();
    return view('livewire.select', compact('unidadesAcademicas'));
  }
}
