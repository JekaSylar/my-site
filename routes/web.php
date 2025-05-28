<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});
//Admin
Route::prefix('dashboard')->middleware(['auth', 'is_admin'])->group(function () {

    Route::get('/', function () {
        return Inertia::render('Admin/Dashboard');
    })->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    //Users
    Route::resource('users', UserController::class)->except(['show']);
    Route::post('users/{user}/change-email-verified', [UserController::class, 'change_email_verified'])->name('users.change.email.verified');
    Route::post('users/{user}/change-block', [UserController::class, 'change_block'])->name('users.change.block');
    Route::get('users/search/{search}', [UserController::class, 'search'])->name('users.search');
    //Categories
    Route::resource('category', CategoryController::class)->except(['show']);
    Route::get('category/search/{search}', [CategoryController::class, 'search'])->name('category.search');

})->middleware(['auth', 'is_admin']);
//Admin



require __DIR__.'/auth.php';
