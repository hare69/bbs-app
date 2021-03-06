<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ThreadController;
use App\Http\Controllers\ReplyController;

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

Route::redirect('/', '/thread');
Route::resource('/thread', ThreadController::class)->middleware('auth');
Route::resource('/reply', ReplyController::class)->middleware('auth');
Route::post('/thread/search', [ThreadController::class, 'search'])->name('thread.search');
Auth::routes();



Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/create', [App\Http\Controllers\HomeController::class, 'create'])->name('create');



