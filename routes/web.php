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
  Route::resource('/tours', 'App\Http\Controllers\TourController');
  // Route::get('/tours/edit/{slug}', 'App\Http\Controllers\TourController@edit');
  // Route::get('/home-client', function () { return view('home-client'); });

});

Route::resource('/booking', 'App\Http\Controllers\BookingController');
Route::get('/booking/new/{season}/{slug}', 'App\Http\Controllers\BookingController@book');
// Route::post('/booking/send-documents/{id}', 'App\Http\Controllers\BookingController@documents');

Route::get('/register-tour', function () {
    return view('auth.register-tour');
});
