<?php

use App\Http\Controllers\DatasetController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('components.page.dashboard');
});

Route::get('/dataset', [DatasetController::class, 'index'])->name('dataset.index');


Route::get('/clasification', function () {
    return view('components.page.clasification'); // tampilkan form kosong
});
Route::post('/clasification', [DatasetController::class, 'clasification'])
    ->name('clasification');
