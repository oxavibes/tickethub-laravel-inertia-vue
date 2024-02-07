<?php

use Inertia\Inertia;

use App\Http\Controllers\UserController;
use App\Http\Controllers\LabelController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
	return Inertia::render('Welcome', [
		'canLogin' => Route::has('login'),
		'canRegister' => Route::has('register'),
		'laravelVersion' => Application::VERSION,
		'phpVersion' => PHP_VERSION,
	]);
})->name('welcome');

Route::get('/dashboard', function () {
	return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth'])->group(function () {
	// Profile
	Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
	Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
	Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

	// Users
	Route::middleware(['permission:view-users'])->get('/users', [UserController::class, 'index'])->name('users.index');
	Route::middleware(['permission:create-users'])->post('/users', [UserController::class, 'store'])->name('users.store');
	Route::middleware(['permission:view-users'])->get('/users/{user}', [UserController::class, 'show'])->name('users.show');
	Route::middleware(['permission:edit-users'])->patch('/users/{user}', [UserController::class, 'update'])->name('users.update');
	Route::middleware(['permission:delete-users'])->delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');

	// Tickets
	Route::middleware(['permission:view-tickets'])->get('/tickets', [TicketController::class, 'index'])->name('tickets.index');
	Route::middleware(['permission:create-tickets'])->post('/tickets', [TicketController::class, 'store'])->name('tickets.store');
	Route::middleware(['permission:view-tickets'])->get('/tickets/{ticket}', [TicketController::class, 'show'])->name('tickets.show');
	Route::middleware(['permission:edit-tickets'])->patch('/tickets/{ticket}', [TicketController::class, 'update'])->name('tickets.update');
	Route::middleware(['permission:delete-tickets'])->delete('/tickets/{ticket}', [TicketController::class, 'destroy'])->name('tickets.destroy');

	// Labels
	Route::middleware(['permission:view-labels'])->get('/labels', [LabelController::class, 'index'])->name('labels.index');
	Route::middleware(['permission:create-labels'])->post('/labels', [LabelController::class, 'store'])->name('labels.store');
	Route::middleware(['permission:view-labels'])->get('/labels/{label}', [LabelController::class, 'show'])->name('labels.show');
	Route::middleware(['permission:edit-labels'])->patch('/labels/{label}', [LabelController::class, 'update'])->name('labels.update');
	Route::middleware(['permission:delete-labels'])->delete('/labels/{label}', [LabelController::class, 'destroy'])->name('labels.destroy');

	// Categories
	Route::middleware(['permission:view-categories'])->get('/categories', [CategoryController::class, 'index'])->name('categories.index');
	Route::middleware(['permission:create-categories'])->post('/categories', [CategoryController::class, 'store'])->name('categories.store');
	Route::middleware(['permission:view-categories'])->get('/categories/{category}', [CategoryController::class, 'show'])->name('categories.show');
	Route::middleware(['permission:edit-categories'])->patch('/categories/{category}', [CategoryController::class, 'update'])->name('categories.update');
	Route::middleware(['permission:delete-categories'])->delete('/categories/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');
});

require __DIR__ . '/auth.php';
