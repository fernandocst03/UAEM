<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FormatoImportacionController extends Controller
{
  public function __invoke($name)
  {
    try {
      if (Storage::disk('public')->exists($name . '.xlsx')) {
        $fileName = storage_path('app/public/' . $name . '.xlsx');
        return response()->download($fileName);
      }
    } catch (Exception $e) {
      return redirect()->back()->with('warning', 'Error al descargar el archivo ' . $e->getMessage());
    }
  }
}
