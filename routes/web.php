<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('users', [UserController::class, 'index']);
Route::get('category', [CategoryController::class, 'index']);
Route::get('category/form', [CategoryController::class, 'create']);
Route::get('category/form/{id}', [CategoryController::class, 'create']);
Route::post('category/save', [CategoryController::class, 'store']);
Route::post('category/save/{id}', [CategoryController::class, 'update']);
