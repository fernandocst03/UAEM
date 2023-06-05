<?php

namespace App\Http\Controllers;

use App\Models\AcuerdosCU\Samara;
use App\Models\AcuerdosCU\Sesion;
use Illuminate\Routing\Controller as BaseController;

class HomeController extends BaseController
{
  public function __invoke()
  {
    return view('welcome');
  }

  public function index_acuerdosCU()
  {
    $last_sesion = Sesion::orderBy('fecha', 'desc')->first();
    $last_five_samaras = Samara::orderBy('fecha', 'desc')->take(5)->get();
    return view('AcuerdosCU.presentacion', compact('last_sesion', 'last_five_samaras'));
  }

  public function index_formato911()
  {
    return view('Formato911.presentacion');
  }
}
