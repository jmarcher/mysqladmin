<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', \App\Http\Controllers\IndexController::class);
Route::get('/schemas/{selectedSchema?}', [\App\Http\Controllers\SchemasController::class, 'index']);
Route::get('/schemas/{selectedSchema?}/data', [\App\Http\Controllers\SchemasController::class, 'viewData']);

// Tables
Route::get('/schemas/{selectedSchema?}/create_table', [\App\Http\Controllers\TablesController::class, 'create']);
Route::post('/schemas/{selectedSchema?}/create_table', [\App\Http\Controllers\TablesController::class, 'store']);
