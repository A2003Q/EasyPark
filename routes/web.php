<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;

// Admin controllers
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\CityController;
use App\Http\Controllers\Admin\ParkingController as AdminParkingController;
use App\Http\Controllers\Admin\ReservationController as AdminReservationController;
use App\Http\Controllers\Admin\SubscriptionController as AdminSubscriptionController;
use App\Http\Controllers\Admin\RevenueController;

// User controllers
use App\Http\Controllers\User\ParkingBrowseController;
use App\Http\Controllers\User\ReservationFrontController;
use App\Http\Controllers\User\SubscriptionFrontController;
use App\Http\Controllers\User\UserProfileController;

//Owner controllers
use App\Http\Controllers\Owner\DashboardController as OwnerDashboardController;
use App\Http\Controllers\Owner\ParkingController as OwnerParkingController;
use App\Http\Controllers\Owner\ReservationController as OwnerReservationController;

/*
|--------------------------------------------------------------------------
| Public
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return view('landing.index');
})->name('home');



/*
|--------------------------------------------------------------------------
| Parkings (Public for guest/user, blocked for admin)
|--------------------------------------------------------------------------
*/
Route::middleware('not_admin')
    ->prefix('parkings')
    ->name('user.parkings.')
    ->group(function () {
        Route::get('/', [ParkingBrowseController::class, 'index'])->name('index');
        Route::get('/{parking}', [ParkingBrowseController::class, 'show'])->name('show');
    });

/*
|--------------------------------------------------------------------------
| Auth (Breeze profile only)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    // Breeze profile (keep)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/*
|--------------------------------------------------------------------------
| User app pages (ONLY user)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'user'])->group(function () {
    Route::get('/subscriptions', [SubscriptionFrontController::class, 'index'])->name('user.subscriptions.index');
    Route::post('/subscriptions', [SubscriptionFrontController::class, 'store'])->name('user.subscriptions.store');

    Route::post('/reservations', [ReservationFrontController::class, 'store'])->name('user.reservations.store');

    Route::get('/my-profile', [UserProfileController::class, 'index'])->name('user.profile');
});

/*
|--------------------------------------------------------------------------
| Dashboard shortcut
|--------------------------------------------------------------------------
*/
Route::get('/dashboard', function () {
    return redirect()->route('admin.dashboard');
})->middleware('auth')->name('dashboard');

/*
|--------------------------------------------------------------------------
| Admin (ONLY admin)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        Route::resource('users', UserController::class);
        Route::resource('cities', CityController::class);
        Route::resource('parkings', AdminParkingController::class);

        Route::get('/reservations', [AdminReservationController::class, 'index'])->name('reservations.index');

        // ✅ FIX: admin subscriptions must NOT use user middleware
        Route::get('/subscriptions', [AdminSubscriptionController::class, 'index'])->name('subscriptions.index');

        Route::get('/revenue', [RevenueController::class, 'index'])->name('revenue.index');

        Route::post('/spots', [\App\Http\Controllers\Admin\SpotController::class, 'store'])->name('spots.store');
        Route::patch('/spots/{spot}', [\App\Http\Controllers\Admin\SpotController::class, 'update'])->name('spots.update');
        Route::delete('/spots/{spot}', [\App\Http\Controllers\Admin\SpotController::class, 'destroy'])->name('spots.destroy');
       Route::get('/parkings/{parking}/spots', [\App\Http\Controllers\Admin\SpotController::class, 'index'])
    ->name('spots.index');


    });
/*
|--------------------------------------------------------------------------
| Owner (ONLY owner)
|--------------------------------------------------------------------------
*/

    Route::middleware(['auth','owner'])
    ->prefix('owner')
    ->name('owner.')
    ->group(function () {
        Route::get('/dashboard', [OwnerDashboardController::class, 'index'])->name('dashboard');

        Route::resource('parkings', OwnerParkingController::class);
        Route::get('/reservations', [OwnerReservationController::class, 'index'])->name('reservations.index');
        Route::get('/revenue', [\App\Http\Controllers\Owner\RevenueController::class, 'index'])->name('revenue.index');
       
        Route::post('/spots', [\App\Http\Controllers\Owner\SpotController::class,'store'])->name('spots.store');
        Route::patch('/spots/{spot}', [\App\Http\Controllers\Owner\SpotController::class,'update'])->name('spots.update');
        Route::delete('/spots/{spot}', [\App\Http\Controllers\Owner\SpotController::class,'destroy'])->name('spots.destroy');
       Route::get('/parkings/{parking}/spots', [\App\Http\Controllers\Owner\SpotController::class,'list'])
    ->name('parkings.spots.list');

        
    });

require __DIR__.'/auth.php';
