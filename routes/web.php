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

Route::get('Waypoints', function () {
    return view('frontend.waypoints');
})->name('waypoints');

Route::get('/southern', function () {
    return view('frontend.betweeness');
})->name('southern');

Route::get('/', function () {
//     $config = array();
    //     $config['center'] = 'New York, USA';
    //     $config['zoom']='14';
    //     // $config['map_height']='400px';
    //     // $config['scrollwheel']=false;

//     GMaps::initialize($config);
    //     $map = GMaps::create_map();

//     echo $map['js'];
    //     echo $map['html'];
    return view('frontend.index');
})->name('home');
// Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');
