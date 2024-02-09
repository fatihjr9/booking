<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\SeatController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [CustomerController::class,'create'])->name('client-create');
Route::post('/', [CustomerController::class,'store'])->name('client-store');


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    // Menu
    Route::get('/admin/menu', [MenuController::class, 'index'])->name('admin-menu');
    Route::get('/admin/menu/add', [MenuController::class, 'create'])->name('admin-menu-create');
    Route::post('/admin/menu/add', [MenuController::class, 'store'])->name('admin-menu-store');
    // Customer
    Route::get('/admin/customer', function () {
        return view('admin.views.customer');
    })->name('admin-customer');
    // Seat
    Route::get('/admin/seat', [SeatController::class, 'index'])->name('admin-seat');
    Route::get('/admin/seat/add', [SeatController::class, 'create'])->name('admin-seat-create');
    Route::post('/admin/seat/add', [SeatController::class, 'store'])->name('admin-seat-store');
    // Affiliate
    Route::get('/admin/affiliate', function () {
        return view('admin.views.affiliate');
    })->name('admin-affiliate');
    // customer
    Route::get('/admin/customer', [CustomerController::class, 'index'])->name('admin-customer');
    Route::delete('/admin/customer/{id}', [CustomerController::class, 'destroy'])->name('admin-customer-destroy');
});
