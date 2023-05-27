<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FormatoImportacionController extends Controller
{
  public function __invoke($name)
  {
    if (Storage::exists($name . '.xlsx')) {
      $fileName = storage_path('app/' . $name . '.xlsx');
      return response()->download($fileName);
    } else return response('', 404);
  }
}
