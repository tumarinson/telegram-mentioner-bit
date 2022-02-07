<?php

use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

/** @see \App\Http\Controllers\TelegramBotController::index() */
Route::get('index', [\App\Http\Controllers\TelegramBotController::class, 'index']);

Route::get('healthCheck', [\App\Http\Controllers\TelegramBotController::class, 'getMe']);
