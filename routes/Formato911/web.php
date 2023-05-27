<?php

use App\Http\Controllers\formato911\InfraestructuraController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Formato911\PersonalAdministrativoController;
use App\Http\Controllers\Formato911\PersonalDocenteAntiguedadController;
use App\Http\Controllers\Formato911\PersonalDocenteController;
use App\Http\Controllers\Formato911\PersonalDocenteEdadController;
use App\Http\Controllers\Formato911\UnidadAcademicaController;

Route::get('/formato-911', [HomeController::class, 'index_formato911'])->name('formato-911');

Route::resource('/formato-911/personal-administrativo', PersonalAdministrativoController::class);
Route::resource('/formato-911/personal-docente', PersonalDocenteController::class);
Route::resource('/formato-911/personal-docente-antiguedad', PersonalDocenteAntiguedadController::class);
Route::resource('/formato-911/personal-docente-edad', PersonalDocenteEdadController::class);
Route::resource('/formato-911/infraestructuras', InfraestructuraController::class);
Route::get('/formato-911/unidades-academicas', UnidadAcademicaController::class)->name('unidades-academicas.index');

Route::patch('/formato-911/personal-administrativo/{id}/file', [PersonalAdministrativoController::class, 'file'])
  ->name('personal-administrativo.file');
Route::patch('/formato-911/personal-administrativo/{id}/unarchive', [PersonalAdministrativoController::class, 'unarchive'])
  ->name('personal-administrativo.unarchive');

Route::patch('/formato-911/personal-docente/{id}/file', [PersonalDocenteController::class, 'file'])
  ->name('personal-docente.file');
Route::patch('/formato-911/personal-docente/{id}/unarchive', [PersonalDocenteController::class, 'unarchive'])
  ->name('personal-docente.unarchive');
