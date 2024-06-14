<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ExerciseController;

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
