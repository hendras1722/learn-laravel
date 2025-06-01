<?php

use App\Http\Controllers\BlogController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\BookController;
use App\Http\Middleware\AdminMiddleware;
use Illuminate\Foundation\Application;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
})->middleware('auth')->name('home');


Route::get('dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth','admin-middleware'])->group(function () {
    Route::resource('blogs', BlogController::class);
    Route::resource('books', BookController::class);
});


require __DIR__ . '/settings.php';
require __DIR__ . '/auth.php';
