<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NotesController;
use App\Http\Controllers\TodoController;


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


Route::get('/notes', [NotesController::class,'index']);
Route::post('/note/store', [NotesController::class,'store']);
Route::get('/note/edit/{id}', [NotesController::class,'edit']);
Route::patch('/note/update/{id}', [NotesController::class,'update']);
Route::delete('/note/delete/{id}', [NotesController::class,'delete']);

Route::get('/todos', [TodoController::class,'index']);
Route::post('/todo/store', [TodoController::class,'store']);
Route::get('/todo/edit/{id}', [TodoController::class,'edit']);
Route::patch('/todo/update/{id}', [TodoController::class,'update']);
Route::delete('/todo/delete/{id}', [TodoController::class,'delete']);
Route::patch('/todo/done/{id}', [TodoController::class,'done']);



