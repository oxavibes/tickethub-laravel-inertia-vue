<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;

Route::middleware(['auth'])->group(function () {
	Route::middleware(['permission:view-categories'])->get('/categories', [CategoryController::class, 'index'])->name('categories.index');
	Route::middleware(['permission:create-categories'])->post('/categories', [CategoryController::class, 'store'])->name('categories.store');
	Route::middleware(['permission:view-categories'])->get('/categories/{category}', [CategoryController::class, 'show'])->name('categories.show');
	Route::middleware(['permission:edit-categories'])->patch('/categories/{category}', [CategoryController::class, 'update'])->name('categories.update');
	Route::middleware(['permission:delete-categories'])->delete('/categories/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');
});
