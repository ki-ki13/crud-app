<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;

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
//     return view("tabel");
// });

// Route::get('/new', function () {
//     return view("formnew");
// });

// Route::get('/edit', function () {
//     return "halaman edit";
// });

Route::resource('/home', ItemController::class);
Route::post('/home/restore-all', [ItemController::class,'restoreAll'])->name('home.restore-all');
Route::post('/home/{home}/restore', [ItemController::class,'restore'])->name('home.restore');
Route::delete('/home/{home}/force-del', [ItemController::class,'forceDelete'])->name('home.fdel');