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

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/old', function () {
    return view('frontend.index');
})->name('home_o');

Route::get('/my_travel', function () {
    return view('frontend.my_travel');
})->name('my_travel');

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

// Route::get('/test', function () {
//     return view('frontend_sna.test');
// })->name('test');
//登凱的範例
Route::get('/testaction', 'TestController@testSite_attr');

Route::get('/create_schedule', 'TestController@index')->name('create_schedule');
Route::post('/schedule/fetch', 'TestController@fetch')->name('schedule.fetch');

Route::get('/', function () {
    return view('frontend_sna.index');
})->name('index');

// OAuth驗證
Route::get('/redirect', 'SocialAuthGoogleController@redirect');
Route::get('/callback', 'SocialAuthGoogleController@callback')->name('callback');

// 測試post get 表單
// Route::get("/create_schedule", "testController@loginForm")->name("member.loginForm");
Route::post("/testform", "testController@formpass")->name("formpass");
// test 測試動態選單
// Route::get('/test', 'DynamicDependent@index');

// Route::post('test/fetch', 'DynamicDependent@fetch')->name('dynamicdependent.fetch');

Route::get('/ajax2', 'AjaxController@index')->name('myform');
Route::post('/ajax2/fetch', 'AjaxController@fetch')->name('myform.fetch');
Route::post('/ajax2/new', 'AjaxController@fetch_firebase')->name('myform.fetch_data');


Route::get('/deal', 'AjaxController@loginForm')->name('dealGET');
Route::post('/deal', "AjaxController@loginProcess")->name('dealPOST');



// Route::get('/home', 'HomeController@index')->name('home');

// Firebase 連結資料庫
Route::get('firebase', 'FirebaseController@index');
// 讀取Firebase
Route::get('firebase-get-data', 'FirebaseController@getData');

Route::get('firebaseRoll', function () {
    return view('frontend_sna.testFirebaseRoll');
})->name('testFirebaseRoll');
// 第一次登入使用者進入填寫會員資料頁面
Route::get('fill_member_data', function () {
    return view('frontend_sna.fill_member_data');
})->name('fill_member_data');

Route::get('create_itinerary', function () {
    return view('frontend_sna.create_itinerary');
})->name('create_itinerary');

Route::get('/ccc', function () {
    return view('frontend_sna.test');
})->name('ccc');

Route::get('/ccc2', function () {
    return view('crudlaravel');
})->name('ccc2');

Auth::routes();

//Quasar(基於vue.js)
Route::get('/c213', function () {
    return view('quasar');
})->name('quasar');
// Route::get('/home', 'HomeController@index')->name('home');

// 全部都通吃
// Route::get('{path?}', function () {
//     return view('frontend_sna.test');
// })->where('path', '(.*)');


Route::get('/posts', 'PostController@index');


Route::get('{path?}', 'AjaxController@onepageVue')->where('path', '(.*)')->name('newpageVue');
