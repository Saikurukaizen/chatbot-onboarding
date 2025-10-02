<?php

use App\Http\Controllers\ChatController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/api/chat', [ChatController::class, 'index']);
Route::post('/api/chat', [ChatController::class, 'store']);