<?php
use App\Http\Controllers\SentimentController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::post('/analyze', [SentimentController::class, 'analyze']);