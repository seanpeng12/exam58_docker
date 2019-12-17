<?php

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
    return view('frontend.index');
})->name('home');

Route::get('portfolio', function () {
    return view('frontend.portfolio');
})->name('portfolio');

Route::get('services', function () {
    return view('frontend.services');
})->name('services');
Route::get('contact', function () {
    return view('frontend.contact');
})->name('contact');

Route::get('about', function () {
    return view('frontend.about');
})->name('about');

//登凱的範例
Route::get('/testaction', 'TestController@testSite_attr');
Route::get('about', 'TestController@testSite_attr')->name('about');
// OAuth驗證
Route::get('/redirect', 'SocialAuthGoogleController@redirect');
Route::get('/callback', 'SocialAuthGoogleController@callback')->name('callback');

Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
