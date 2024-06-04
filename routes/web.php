<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LapanganController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\ArenaController;
use App\Http\Controllers\Frontend\LapanganController as FrontendLapanganController;
use App\Http\Controllers\Frontend\BookingController as FrontendBookingController;

// Route for welcome page
Route::get('/', function () {
    return view('welcome');
})->name('home');


Route::get('/menu', function () {
    return view('menu');
});

Route::get('/lapangan', [FrontendLapanganController::class, 'index'])->name('lapangan.index');
Route::get('/booking', [FrontendBookingController::class, 'index'])->name('booking.index');
// Route::get('/Booking/step-one', [FrontendBookingController::class, 'stepOne'])->name('Booking.step.one');
// Route::get('/Booking/step-two', [FrontendBookingController::class, 'stepTwo'])->name('Booking.step.two');

Route::middleware(['guest'])->group(function () {
    Route::get('/register', [LoginController::class, 'register'])->name('register');
    Route::post('/register-proses', [LoginController::class, 'register_proses'])->name('register-proses');
    Route::get('/login', [LoginController::class, 'index'])->name('login');
    Route::post('/login-proses', [LoginController::class, 'login_proses'])->name('login-proses');
});

Route::middleware(['auth'])->group(function () {
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('/', [AdminController::class, 'index'])->name('index');
        Route::get('/admin', [AdminController::class, 'admin'])->middleware('userAkses:admin')->name('admin');
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

        Route::resource('user', HomeController::class)->except(['show']);
        Route::resource('lapangan', LapanganController::class)->except(['show']);
        Route::delete('/admin/lapangan/{lapangan}', [LapanganController::class, 'destroy'])->name('lapangan.delete');
        Route::resource('booking', BookingController::class)->except(['show']);
        Route::delete('/admin/booking/{booking}', [BookingController::class, 'destroy'])->name('booking.delete');
        Route::resource('arena', ArenaController::class)->except(['show']);
        Route::delete('/admin/arena/{arena}', [ArenaController::class, 'destroy'])->name('arena.delete');
            
        Route::post('/admin/logout', [LoginController::class, 'logout'])->name('logout');
    });
});

Route::get('/home', function () {
    return redirect('/');
});
