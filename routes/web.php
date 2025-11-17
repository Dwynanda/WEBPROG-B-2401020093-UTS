<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ForumController;

Route::get('/', [ForumController::class, 'index'])->name('forum.index');
Route::post('/store', [ForumController::class, 'store'])->name('forum.store');
Route::post('/reply/{index}', [ForumController::class, 'reply'])->name('forum.reply');
