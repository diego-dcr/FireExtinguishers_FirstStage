<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FireExtController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\FloorplanController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/{section}', [PagesController::class, 'index'])->name('landscape');

Route::post('/fire-ext/store', [FireExtController::class, 'store'])->name('fire-ext.store');
Route::post('/fire-ext/update', [FireExtController::class, 'update'])->name('fire-ext.update');
Route::get('/fire-ext/delete', [FireExtController::class, 'destroy'])->name('fire-ext.delete');

Route::post('/floorplan/store', [FloorplanController::class, 'store'])->name('floorplan.store');
Route::get('/floorplan/edit/{id}/{section}', [FloorplanController::class, 'edit'])->name('floorplan.edit');
Route::post('/floorplan/update/{id}', [FloorplanController::class, 'update'])->name('floorplan.update');
Route::get('/floorplan/delete', [FloorplanController::class, 'destroy'])->name('floorplan.delete');

Route::get('/floorplan/getImage/{filename}', [FloorplanController::class, 'getImage'])->name('image.show');
