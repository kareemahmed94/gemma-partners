<?php

use Illuminate\Support\Facades\DB;
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

Route::get('/partners', [\App\Http\Controllers\PartnerController::class , 'index']);
Route::get('/partners/{id}', [\App\Http\Controllers\PartnerController::class , 'show']);

Route::get('/', function () {
    return view('home');
});
