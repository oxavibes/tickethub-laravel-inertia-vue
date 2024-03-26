<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LabelController;

Route::middleware(['auth'])->group(function () {
	Route::middleware(['permission:view-labels'])->get('/labels', [LabelController::class, 'index'])->name('labels.index');
	Route::middleware(['permission:create-labels'])->post('/labels', [LabelController::class, 'store'])->name('labels.store');
	Route::middleware(['permission:view-labels'])->get('/labels/{label}', [LabelController::class, 'show'])->name('labels.show');
	Route::middleware(['permission:edit-labels'])->patch('/labels/{label}', [LabelController::class, 'update'])->name('labels.update');
	Route::middleware(['permission:delete-labels'])->delete('/labels/{label}', [LabelController::class, 'destroy'])->name('labels.destroy');
});
