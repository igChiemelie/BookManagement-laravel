<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BooksController;


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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [BooksController::class, 'index'])->name('main');
Route::resource('/books', BooksController::class);

            //Dynamic Routing
// Route::get('/books/{id}', [BooksController::class , 'singleBookPage']);


Auth::routes();

// Route::get('/home', [App\Http\Controllers\DashboardController::class, 'index'])->name('home')->middleware('CheckUser');
Route::get('/home', [App\Http\Controllers\DashboardController::class, 'index'])->name('home');
