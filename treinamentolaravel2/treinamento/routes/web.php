<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ExerciseController;
use App\Http\Controllers\LivroController;
use App\Http\Controllers\BookController;

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

//crud da reunião

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
Route::delete('/delete/{livro}', [LivroController::class,'destroy'])->name('livros.destroy');


//crudo do exercicio2
Route::get('/books/oi',[BookController::class,'oi']);
Route::get('/books/create', [BookController::class,'create']);
Route::post('/books/store', [BookController::class,'store']);
Route::get('/books/index', [BookController::class,'index']);
Route::get('/books/show/{livro}', [BookController::class,'show']);
Route::get('/books/edit/{livro}', [BookController::class,'edit']);
Route::patch('/books/update/{livro}', [BookController::class,'update']);
Route::delete('/books/{livro}', [BookController::class,'destroy'])->name('livros.destroy')
