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

// Personal administrativo
Route::patch('/formato-911/personal-administrativo/{id}/file', [PersonalAdministrativoController::class, 'file'])
  ->name('personal-administrativo.file');
Route::patch('/formato-911/personal-administrativo/{id}/unarchive', [PersonalAdministrativoController::class, 'unarchive'])
  ->name('personal-administrativo.unarchive');

// Personal docente
Route::patch('/formato-911/personal-docente/{id}/file', [PersonalDocenteController::class, 'file'])
  ->name('personal-docente.file');
Route::patch('/formato-911/personal-docente/{id}/unarchive', [PersonalDocenteController::class, 'unarchive'])
  ->name('personal-docente.unarchive');

// Personal docente antiguedad
Route::patch('/formato-911/personal-docente-antiguedad/{id}/file', [PersonalDocenteAntiguedadController::class, 'file'])
  ->name('personal-docente-antiguedad.file');
Route::patch('/formato-911/personal-docente-antiguedad/{id}/unarchive', [PersonalDocenteAntiguedadController::class, 'unarchive'])
  ->name('personal-docente-antiguedad.unarchive');

// Personal docente edad
Route::patch('/formato-911/personal-docente-edad/{id}/file', [PersonalDocenteEdadController::class, 'file'])
  ->name('personal-docente-edad.file');
Route::patch('/formato-911/personal-docente-edad/{id}/unarchive', [PersonalDocenteEdadController::class, 'unarchive'])
  ->name('personal-docente-edad.unarchive');

// Infraestructura
Route::patch('/formato-911/infraestructura/{id}/file', [InfraestructuraController::class, 'file'])
  ->name('infraestructura.file');
Route::patch('/formato-911/personal-docente-edad/{id}/unarchive', [InfraestructuraController::class, 'unarchive'])
  ->name('infraestructura.unarchive');


/*
    Importaciones
  */

Route::post('/formato-911/personal-administrativo/import', [PersonalAdministrativoController::class, 'import'])->middleware('auth')
  ->name('personal-administrativo.import');
Route::post('/formato-911/personal-docente/import', [PersonalDocenteController::class, 'import'])->middleware('auth')
  ->name('personal-docente.import');
Route::post('/formato-911/personal-docente-antiguedad/import', [PersonalDocenteAntiguedadController::class, 'import'])->middleware('auth')
  ->name('personal-docente-antiguedad.import');
Route::post('/formato-911/personal-docente-edad/import', [PersonalDocenteEdadController::class, 'import'])->middleware('auth')
  ->name('personal-docente-edad.import');
Route::post('/formato-911/infraestructura/import', [InfraestructuraController::class, 'import'])->middleware('auth')
  ->name('infraestructuras.import');
