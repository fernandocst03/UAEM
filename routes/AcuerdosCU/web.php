<?php

use App\Http\Controllers\AcuerdosCU\AcuerdoController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AcuerdosCU\RectoradoController;
use App\Http\Controllers\AcuerdosCU\ReporteAcuerdoController;
use App\Http\Controllers\ReporteBitacoraController;
use App\Http\Controllers\AcuerdosCU\SamaraController;
use App\Http\Controllers\AcuerdosCU\SesionController;
use App\Http\Controllers\FormatoImportacionController;
use Illuminate\Support\Facades\Route;

Route::get('/acuerdos-cu', [HomeController::class, 'index_acuerdosCU'])->name('acuerdos-cu');

Route::resource('/acuerdos-cu/rectorados', RectoradoController::class);
Route::patch('/acuerdos-cu/rectorados/{rectorado}/file', [RectoradoController::class, 'file'])->name('rectorados.file');
Route::patch('/acuerdos-cu/rectorados/{rectorado}/unarchive', [RectoradoController::class, 'unarchive'])->name('rectorados.unarchive');

Route::get('/acuerdos-cu/samaras/ver-todos', [SamaraController::class, 'showAll'])->name('samaras.showAll');
Route::resource('/acuerdos-cu/samaras', SamaraController::class);

Route::resource('/acuerdos-cu/sesiones', SesionController::class);
Route::post('/acuerdos-cu/sesiones/import', [SesionController::class, 'import'])->name('sesiones.import')->middleware('auth');

Route::resource('/acuerdos-cu/acuerdos', AcuerdoController::class);
Route::post('/acuerdos-cu/sesiones/{sesion}/acuerdos', [AcuerdoController::class, 'store'])->middleware('auth')->name('sesion.acuerdo.store');
Route::patch('/acuerdos-cu/acuerdos/{acuerdo}/file', [AcuerdoController::class, 'file'])->name('acuerdo.file');
Route::patch('/acuerdos-cu/acuerdos/{acuerdo}/unarchive', [AcuerdoController::class, 'unarchive'])->name('acuerdo.unarchive');
Route::post('/acuerdos-cu/acuerdos/import', [AcuerdoController::class, 'import'])->name('acuerdo.import')->middleware('auth');

Route::get('/reportes/bitacoras', ReporteBitacoraController::class)->name('reporte.bitacoras')->middleware('auth');
Route::get('/acuerdos-cu/reportes/acuerdos', ReporteAcuerdoController::class)->name('reporte.acuerdos')->middleware('auth');

Route::get('/formato-importacion/{name}', FormatoImportacionController::class)->name('formato.importacion');
