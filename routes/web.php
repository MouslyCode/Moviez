<?php

use App\Http\Controllers\MovieController;
use Illuminate\Support\Facades\Route;

Route::get('/',[MovieController::class,'dashboard'])->name('dashboard');
// Route::get('/data', function () {
//     return view('index');
// });

Route::get('movie',[MovieController::class, 'index'])->name('movies.index');
Route::get('movie/create',[MovieController::class, 'create'])->name('movies.create');
Route::post('movie',[MovieController::class, 'store'])->name('movies.store');
Route::get('movie/{movie}',[MovieController::class, 'show'])->name('movies.show');
Route::get('movie/{movie}/edit',[MovieController::class, 'edit'])->name('movies.edit');
Route::put('movie/{movie}',[MovieController::class, 'update'])->name('movies.update');
Route::delete('movie/{movie}',[MovieController::class, 'destroy'])->name('movies.destroy');
