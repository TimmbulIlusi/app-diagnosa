<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DiagnosaController;

Route::get('/', [DiagnosaController::class, 'dashboard']);          
Route::get('/diagnosa', [DiagnosaController::class, 'index']);      
Route::post('/predict', [DiagnosaController::class, 'predict']);    

// 3 Rute Informasi Terpisah
Route::get('/informasi/penyakit', [DiagnosaController::class, 'infoPenyakit']);
Route::get('/informasi/dataset', [DiagnosaController::class, 'infoDataset']);
Route::get('/informasi/pengembang', [DiagnosaController::class, 'infoPengembang']);