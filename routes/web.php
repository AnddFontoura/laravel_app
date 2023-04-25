<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
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

Route::controller(CategoryController::class)
    ->prefix('category')
    ->name('category.')
    ->middleware(['auth'])
    ->group(function () {
        Route::match(['get', 'post'], '/', 'index')->name('index');
        Route::get('form', 'create')->name('form');
        Route::get('form/{id}', 'create')->name('form_update');
        Route::post('save', 'store')->name('save');
        Route::post('save/{id}', 'update')->name('update');    
    }
);


Route::controller(ProductController::class)
    ->prefix('product')
    ->name('product.')
    ->middleware(['auth'])
    ->group(function () {
        Route::match(['get', 'post'], '/', 'index')->name('index');
        Route::get('form', 'create')->name('form');
        Route::get('form/{id}', 'create')->name('form_update');
        Route::post('save', 'store')->name('save');
        Route::post('save/{id}', 'update')->name('update');    
    }
);

Route::controller(UserController::class)
    ->prefix('user')
    ->name('user.')
    ->middleware(['auth', 'is_admin:true'])
    ->group(function () {
        Route::match(['get', 'post'], '/', 'index')->name('index');
        Route::get('form', 'create')->name('form');
        Route::get('form/{id}', 'create')->name('form_update');
        Route::post('save', 'store')->name('save');
        Route::post('save/{id}', 'update')->name('update');    
    }
);
