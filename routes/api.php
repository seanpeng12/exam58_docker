<?php

use App\Http\Controllers\PostController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Post;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
//此為post測試(成功回傳hello)
Route::post('/aaa', function (Request $request) {
    return "hello!";
});
// 允許跨域請求(測試)
Route::group(['middleware' => ['CORS']], function () {
    // 取得post api
    // 所有資料
    Route::get('/posts', 'PostController@apiAll');
    // 取得單一文章(use id)
    Route::get('/posts/{id}', 'PostController@apiFindPostById');
    // 建立一篇文章(成功回傳ok:true)
    Route::post('/posts', 'PostController@apiCreatePost');
    // 更新一篇文章(成功回傳ok use json format)
    Route::put('/posts/{id}', 'PostController@apiUpdatePostById');
    //刪除一篇文章
    Route::delete('/posts/{id}', 'PostController@apiDeletePostById');
});


// 需求分析
Route::group(['middleware' => ['CORS']], function () {

    // R
    //執行R API(單一城市所有景點R圖)
    Route::post('/runR_city', 'PostController@runR_city');

    //執行R API(需求分析兩類別R圖)
    Route::post('/runR_twoC', 'PostController@runR_twoC');


    // mysql
    // 景點需求分析---取得交集資料
    Route::post('/cat', 'PostController@bothCatagory');

    // 取得所有景點資料site_data
    Route::get('/site_data', 'PostController@site_dataAll');
    // 取單一景點site_data(整包object)
    Route::get('/site_data/{id}', 'PostController@site_dataById');
    // 下拉式選單---屬於該城市的所有景點name
    Route::get('/site_name/{city}', 'PostController@site_nameById');


    // 取得所有城市名稱-第一層選單
    Route::get('/site_dataCity', 'PostController@site_dataCityAll');
    // 取城市所有類別-第二層選單
    Route::post('/site_dataCat', 'PostController@Catagory');
    // 輸入城市 ->城市所有景點
    Route::post('/sitesByCity', 'PostController@sitesByCity');
});

// 優缺點分析
Route::group(['middleware' => ['CORS']], function () {

    // 景點優缺點分析 name->sid(S0102)->跑優點與缺點R圖(只能使用象山自然步道)
    Route::post('/proscons', 'ProsCosController@runR_proscons');
    // 優點懶人包
    Route::post('/prosData', 'PostController@prosData');
    // 缺點懶人包
    Route::post('/consData', 'PostController@consData');
});

// 路徑分析
Route::group(['middleware' => ['CORS']], function () {

    // 路徑分析(PHP + R)
    Route::post('/runPath', 'PathController@runPath');
    // 執行搭配php的R(跑路徑分析用path.php)
    Route::post('/runRafterPHP', 'PathController@runRafterPHP');
});
