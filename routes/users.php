<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::middleware(['auth'])->group(function () {
	Route::middleware(['permission:view-users'])->get('/users', [UserController::class, 'index'])->name('users.index');
	Route::middleware(['permission:create-users'])->post('/users', [UserController::class, 'store'])->name('users.store');
	Route::middleware(['permission:view-users'])->get('/users/{user}', [UserController::class, 'show'])->name('users.show');
	Route::middleware(['permission:edit-users'])->patch('/users/{user}', [UserController::class, 'update'])->name('users.update');
	Route::middleware(['permission:delete-users'])->delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
});
