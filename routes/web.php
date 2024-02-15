<?php

use App\Http\Controllers\AffiliateController;
use App\Http\Controllers\ClassesController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\SeatController;
use App\Models\affiliate;
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

Route::get('/', [CustomerController::class,'create'],)->name('client-create');
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
    Route::get('/admin/menu/edit/{id}', [MenuController::class, 'edit'])->name('admin-menu-edit');
    Route::put('/admin/menu/edit/{id}', [MenuController::class, 'update'])->name('admin-menu-update');
    Route::delete('/admin/menu/{id}', [MenuController::class, 'destroy'])->name('admin-menu-destroy');
    
    // class
    Route::get('/admin/class/add', [ClassesController::class, 'create'])->name('admin-class-create');
    Route::post('/admin/class/add', [ClassesController::class, 'store'])->name('admin-class-store');
    Route::get('/admin/class/edit/{id}', [ClassesController::class, 'edit'])->name('admin-class-edit');
    Route::put('/admin/class/edit/{id}', [ClassesController::class, 'update'])->name('admin-class-update');
    Route::delete('/admin/class/{id}', [ClassesController::class, 'destroy'])->name('admin-class-destroy');
    // Seat
    Route::get('/admin/seat', [SeatController::class, 'index'])->name('admin-seat');
    Route::get('/admin/seat/add', [SeatController::class, 'create'])->name('admin-seat-create');
    Route::post('/admin/seat/add', [SeatController::class, 'store'])->name('admin-seat-store');
    // Affiliate
    Route::get('/admin/affiliate', [AffiliateController::class, 'index'])->name('admin-affiliate');
    Route::get('/admin/affiliate/add', [AffiliateController::class, 'create'])->name('admin-affiliate-create');
    Route::post('/admin/affiliate/add', [AffiliateController::class, 'store'])->name('admin-affiliate-store');
    Route::delete('/admin/affiliate/{id}', [AffiliateController::class, 'destroy'])->name('admin-affiliate-destroy');
    // customer
    Route::get('/admin/customer', [CustomerController::class, 'index'])->name('admin-customer');
    // Route::get('/admin/customer/edit/{id}', [CustomerController::class, 'edit'])->name('admin-customer-edit');
    // Route::put('/admin/customer/edit/{id}', [CustomerController::class, 'update'])->name('admin-customer-update');
    Route::delete('/admin/customer/{id}', [CustomerController::class, 'destroy'])->name('admin-customer-destroy');
});
