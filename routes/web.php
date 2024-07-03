<?php

use App\Http\Controllers\AuthorController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
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




Route::get('/', [BookController::class, 'index']);
Route::get('/edit/{id}', [BookController::class, 'edit']);
Route::post('/', [BookController::class, 'store']);
Route::get('/author', [AuthorController::class, 'index']);
Route::post('/author', [AuthorController::class, 'store']);
Route::get('/author/edit/{id}', [AuthorController::class, 'edit']);
Route::put('/author/{id}', [AuthorController::class, 'update']);
Route::put('/author/update/{id}', [AuthorController::class, 'update']);
Route::put('/update/{id}', [BookController::class, 'update']);
Route::delete('/delete/{id}', [BookController::class, 'destroy']);
Route::delete('/delete/{id}', [AuthorController::class, 'destroy']);
