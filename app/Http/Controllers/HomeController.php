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
    $last_sesion = Sesion::orderBy('id', 'desc')->first();
    $last_five_samaras = Samara::orderBy('id', 'desc')->take(5)->get();
    return view('AcuerdosCU.presentacion', compact('last_sesion', 'last_five_samaras'));
  }
}
