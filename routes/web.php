<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;







Route::get('/', [HomeController::class, 'home']);
Route::get('lga', [HomeController::class, 'lga']);

Route::get('add-result', [HomeController::class, 'addResult'])->name('add-result');

Route::post('store-result', [HomeController::class, 'storeResult'])->name('store-result');
Route::post('lga/results', [HomeController::class, 'lgaResults'])->name('lga.results');


Route::post('/polling-unit/results', [HomeController::class, 'showResults'])->name('polling-unit.results');







// Route::get('/', function () {
//     return view('home');
// });
