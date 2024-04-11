<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RecordatoriosController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/recordatorios', [RecordatoriosController::class, 'index'])->name('recordatorios.list');
Route::put('/recordatorios/{id}', [RecordatoriosController::class, 'update'])->name('recordatorios.update');
Route::post('/recordatorios', [RecordatoriosController::class, 'store'])->name('recordatorios.store');



