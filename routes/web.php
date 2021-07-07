<?php

use App\Http\Controllers\CustomarController;
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

Route::get('/', function () {
    return view('welcome');
});
Route::get('/customer',[CustomarController::class,'index']);
Route::get('/customer/all',[CustomarController::class,'customer_all']);
Route::post('/customer/store',[CustomarController::class,'store']);
Route::get('/customer/edit/{id}',[CustomarController::class,'edit']);
Route::post('/customer/update/{id}',[CustomarController::class,'update']);
Route::get('/customer/delete/{id}',[CustomarController::class,'delete']);
