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

Route::get('about', function () {
    return view('frontend.about');
})->name('about');
 
Route::get('products', function () {
    return view('frontend.products');
})->name('products');
Route::get('store', function () {
    return view('frontend.store');
})->name('store');

Route::get('/', function () {
    $config = array();
    $config['center'] = 'Taipei, Taiwan';
    $config['zoom']='14';
    $config['map_height']='500px';
    $config['scrollwheel']=false;

    GMaps::initialize($config);

    $map=GMaps::create_map();

    echo $map['js'];
    echo $map['html'];
    return view('frontend.index')->with('map',$map);
})->name('home');
// Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');
