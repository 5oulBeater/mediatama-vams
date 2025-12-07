<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\VideoController as AdminVideoController;
use App\Http\Controllers\Admin\VideoAccessController as AdminRequestController;
use App\Http\Controllers\Admin\CustomerController as AdminCustomerController;

use App\Http\Controllers\Customer\CustomerVideoController;
use App\Http\Controllers\Customer\CustomerHistoryController;

// Redirect halaman utama ke login
Route::get('/', function () {
    return redirect()->route('login');
});

// Auth routes (Laravel Breeze/Fortify default)
require __DIR__.'/auth.php';

/*
|--------------------------------------------------------------------------
| ADMIN ROUTES
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {

    Route::get('/dashboard', [\App\Http\Controllers\Admin\AdminDashboardController::class, 'index'])
        ->name('dashboard');
        
    Route::resource('videos', AdminVideoController::class);
    
    Route::delete('/customers/delete/{id}', [AdminCustomerController::class, 'destroy'])
    ->name('customers.destroy');

    Route::get('/requests', [AdminRequestController::class, 'index'])->name('requests.index');

    Route::post('/requests/approve/{id}', [AdminRequestController::class, 'approve'])
        ->name('requests.approve');

    Route::post('/requests/reject/{id}', [AdminRequestController::class, 'reject'])
        ->name('requests.reject');


    Route::get('/customers', [AdminCustomerController::class, 'index'])->name('customers.index');
});

/*
|--------------------------------------------------------------------------
| CUSTOMER ROUTES
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:customer'])->prefix('customer')->name('customer.')->group(function () {

    Route::get('/dashboard', function () {
        return view('customer.dashboard');
    })->name('dashboard');

    Route::get('/videos', [CustomerVideoController::class, 'index'])->name('videos.index');
    Route::post('/videos/request/{id}', [CustomerVideoController::class, 'requestAccess'])->name('videos.request');
    Route::get('/videos/watch/{id}', [CustomerVideoController::class, 'watch'])->name('videos.watch');

    // History Request Video
    Route::get('/history', [CustomerHistoryController::class, 'index'])->name('history.index');
});
