<?php

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
    return view('welcome');
});

Auth::routes(['register' => false]);

Route::middleware(['auth'])->group(function () {
    Route::get('/home', [\App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::resource('/tours', App\Http\Controllers\TourController::class);
    Route::get('/tours/export/{id}', [App\Http\Controllers\TourController::class, 'export'])->name('tours.export');

    Route::resource('/booking', App\Http\Controllers\BookingController::class);
    Route::post('booking/documents/{booking}', [App\Http\Controllers\BookingController::class, 'viewDocument'])->name('booking.documents');
});

Route::get('/new-booking/{season}/{slug}', [App\Http\Controllers\BookingController::class, 'book']);
Route::post('/booking/part2', [App\Http\Controllers\BookingController::class, 'part2'])->name('booking.part2');
Route::post('/booking/part3', [App\Http\Controllers\BookingController::class, 'part3'])->name('booking.part3');
Route::post('/booking/part4', [App\Http\Controllers\BookingController::class, 'part4'])->name('booking.part4');