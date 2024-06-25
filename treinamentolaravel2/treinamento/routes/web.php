<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ExerciseController;
use App\Http\Controllers\LivroController;

Route::get('/thiago', function () {
    echo "oi galera aqui é o thiago";
  //  return view('welcome');
});

Route::get('/fflch', function () {
    echo "sistema fflch";
  //  return view('welcome');
});

Route::get('/exercises',[ExerciseController::class,'index']);

Route::get('/stats',[ExerciseController::class,'stats']);

Route::get('/stats2',[ExerciseController::class,'stats2']);

//create and store
Route::get('/livros/create', [LivroController::class,'create']);
Route::post('/livros/store', [LivroController::class,'store']);

//Read
Route::get('/livros/index', [LivroController::class,'index']);
Route::get('/livros/show/{livro}', [LivroController::class,'show']);

//update
Route::get('/livros/edit/{livro}', [LivroController::class,'edit']);
Route::patch('/livros/update/{livro}', [LivroController::class,'update']);

//delete
Route::delete('/delete/{livro}', [LivroController::class,'update']);


