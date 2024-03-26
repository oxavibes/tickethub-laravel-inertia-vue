<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TicketController;

Route::middleware(['auth'])->group(function () {
	Route::middleware(['permission:view-tickets'])->get('/tickets', [TicketController::class, 'index'])->name('tickets.index');
	Route::middleware(['permission:create-tickets'])->post('/tickets', [TicketController::class, 'store'])->name('tickets.store');
	Route::middleware(['permission:view-tickets'])->get('/tickets/{ticket}', [TicketController::class, 'show'])->name('tickets.show');
	Route::middleware(['permission:edit-tickets'])->patch('/tickets/{ticket}', [TicketController::class, 'update'])->name('tickets.update');
	Route::middleware(['permission:delete-tickets'])->delete('/tickets/{ticket}', [TicketController::class, 'destroy'])->name('tickets.destroy');
});
