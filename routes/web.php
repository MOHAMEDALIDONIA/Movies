<?php

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

Route::get('/',[App\Http\Controllers\MoviesController::class,'index'])->name('movies.index');
Route::get('/movies/{movie_id}',[App\Http\Controllers\MoviesController::class,'show'])->name('movies.show');

Route::get('/actors',[App\Http\Controllers\ActorsController::class,'index'])->name('actors.index');
Route::get('/actors/page/{page?}',[App\Http\Controllers\ActorsController::class,'index']);
Route::get('/actors/{actor}',[App\Http\Controllers\ActorsController::class,'show'])->name('actors.show');
Route::get('/tv',[App\Http\Controllers\TvController::class,'index'] )->name('tv.index');
Route::get('/tv/{id}',[App\Http\Controllers\TvController::class,'show'])->name('tv.show');
