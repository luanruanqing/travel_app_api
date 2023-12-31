<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HotelController;
use App\Http\Controllers\TravelController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\LocationController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::controller(UserController::class)->prefix('user')->group(function () {
    Route::post('register', 'register')->name('register');
    Route::get('info', 'info')->middleware('auth:api')->name('info');
    Route::get('get/{id}', 'get')->name('get');
    Route::post('login', 'login')->name('login');
    Route::post('sendOtp', 'sendOtp')->name('otp.send');
    Route::post('verify-otp', 'verifyOtp')->name('verified.otp');
    Route::put('update/{id}', 'update')->name('user.update');
});
Route::controller(TravelController::class)->prefix('travel')->group(function () {
    Route::get('all', 'all')->name('travel.all');
    Route::get('get-popular', 'getPopular')->name('travel.getPopular');
    Route::get('search', 'search')->name('travel.search');
    Route::get('detail/{travel}', 'detail')->name('travel.detail');
    Route::get('popular', 'popular')->name('travel.popular');
    Route::get('recommended', 'recommended')->name('travel.recommended');
});

Route::controller(HotelController::class)->prefix('hotel')->group(function () {
    Route::get('get-all', 'getAll')->name('hotel.getAll');
    Route::get('detail/{hotel}', 'detail')->name('hotel.detail');
    Route::get('search', 'search')->name('hotel.search');
    Route::get('filter', 'filter')->name('hotel.filter');
    Route::get('hotel-by-country/{country}', 'getHotelByCountry')->name('hotel.getHotelByCountry');
});

Route::controller(LocationController::class)->prefix('location')->group(function () {
    Route::get('get-all', 'getAll')->name('location.getAll');
});

Route::controller(BookingController::class)->prefix('booking')->group(function () {
    Route::get('all/{user}', 'all')->name('booking.all');
    Route::post('order', 'order')->name('booking.order');
});

Route::controller(ReviewController::class)->prefix('review')->group(function () {
    Route::get('all/{user}', 'all')->name('review.all');
    // Route::post('order', 'order')->name('booking.order');
});
