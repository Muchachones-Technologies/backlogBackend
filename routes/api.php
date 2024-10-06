<?php

use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\studentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum'])->group(function(){
  //  Route::get('/students', [studentController::class, 'index']);

    Route::apiResource('students',studentController::class);  //No se necesita especificar el crud siempre y cunado en el controller coincida el nombre
});

require __DIR__.'/guest.php';
