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

Auth::routes();

Route::get('/home', [\App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth'])->group(function () {
    Route::resource('/tours', App\Http\Controllers\TourController::class);
    Route::get('/tours/export/{id}', [App\Http\Controllers\TourController::class, 'export'])->name('tours.export');
});

Route::resource('/booking', 'App\Http\Controllers\BookingController');

Route::get('/new-booking/{season}/{slug}', 'App\Http\Controllers\BookingController@book');
Route::post('/booking/part2', 'App\Http\Controllers\BookingController@part2')->name('booking.part2');
Route::post('/booking/part3', 'App\Http\Controllers\BookingController@part3')->name('booking.part3');
Route::post('/booking/part4', 'App\Http\Controllers\BookingController@part4')->name('booking.part4');

// Route::post('/booking/send-documents/{id}', 'App\Http\Controllers\BookingController@documents');

//Route::get('/register-tour', function () {
//    return view('auth.register-tour');
//});
