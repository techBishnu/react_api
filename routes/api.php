<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\CategoryController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::post('/login',[LoginController::class,'Login'])->name('login');
Route::post('/register',[RegisterController::class,'Register'])->name('register');

Route::prefix('category')->group(function () {
    Route::get('/',[CategoryController::class,'index']);
    Route::post('/store',[CategoryController::class,'store']);
    Route::get('/edit/{id}',[CategoryController::class,'edit']);
    Route::post('/update',[CategoryController::class,'update']);
    Route::get('/delete/{id}',[CategoryController::class,'delete']);
});
