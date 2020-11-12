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
// for line redirect
Route::group(['middleware' => ['CORS']], function () {

    // 
    Route::get('/lineLogin', 'PostController@line');
    Route::get('/line_2','PostController@line_2');

    Route::post('/line_3','PostController@line_3');
    // Route::post('/line_4','PostController@line_4');
});

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
    // 景點
    // 取得所有城市名稱-第一層選單
    Route::get('/site_dataCity', 'PostController@site_dataCityAll');
    // 取城市所有類別-第二層選單
    Route::post('/site_dataCat', 'PostController@Catagory');
    //執行R API(需求分析兩類別R圖)
    Route::post('/runR_twoC', 'PostController@runR_twoC');
    // 景點需求分析---取得c1/c2(交集)景點
    Route::post('/cat', 'PostController@bothCatagory');
    // 景點需求分析---取(聯集-交集)景點
    Route::post('/cat_diff', 'PostController@diffCatagory');
    // 新取(聯集-交集)景點(分開取)
    Route::post('/new_cat_diff', 'PostController@new_diff');

    // 飯店
    // 取得所有城市名稱-第一層選單
    Route::get('/h_site_dataCity', 'DemandController@site_dataCityAll');
    // 取城市所有類別-第二層選單
    Route::post('/h_site_dataCat', 'DemandController@Catagory');
    //執行R API(需求分析兩類別R圖)
    Route::post('/h_runR_twoC', 'DemandController@runR_twoC');
    // 景點需求分析---取得c1/c2(交集)景點
    Route::post('/h_cat', 'DemandController@bothCatagory');
    // 景點需求分析---取(聯集-交集)景點
    Route::post('/h_cat_diff', 'DemandController@diffCatagory');
    // 新取(聯集-交集)景點(分開取)
    Route::post('/new_h_cat_diff', 'DemandController@new_diff');


    // api
    // google照片
    // Route::post('/demand_Img', 'DemandController@getGoogleImg');

    Route::post('/getGoogleImg', 'PathController@getGoogleImg');
    // google資料
    Route::post('/demand_info', 'DemandController@GooglePlaceInfo');


    // 測試區域
    //執行R API(單一城市所有景點R圖)
    Route::post('/runR_city', 'PostController@runR_city');
    // 取得所有景點資料site_data
    Route::get('/site_data', 'PostController@site_dataAll');
    // 取單一景點site_data(整包object)
    Route::get('/site_data/{id}', 'PostController@site_dataById');
    // 下拉式選單---屬於該城市的所有景點name
    Route::get('/site_name/{city}', 'PostController@site_nameById');
});

// 優缺點分析
Route::group(['middleware' => ['CORS']], function () {
    // 景點
    // 第一層選單(取得所有城市名稱-第一層選單)
    Route::get('/proscons_site_data_City', 'ProsCosController@site_dataCityAll');
    // 第二層選單：輸入城市 ->城市所有景點
    Route::post('/sitesByCity', 'ProsCosController@sitesByCity');

    // 優缺點R分析 name->sid(S0102)->跑優點與缺點R圖(只能使用象山自然步道)
    Route::post('/proscons', 'ProsCosController@runR_proscons');
    // 優點懶人包
    Route::post('/prosData', 'ProsCosController@prosData');
    // 缺點懶人包
    Route::post('/consData', 'ProsCosController@consData');
    // 景點加入最愛
    Route::post('/proconsAddToCollection', 'ProsCosController@proconsAddToCollection');

    // 飯店
    // 第一層選單(取得所有城市名稱-第一層選單)
    Route::get('/proscons_hotel_data_City', 'ProsCosController@hotel_dataCityAll');
    // 第二層選單：輸入城市 ->城市所有景點
    Route::post('/h_sitesByCity', 'ProsCosController@h_sitesByCity');
    // 優缺點R分析 name->sid(S0102)->跑優點與缺點R圖(只能使用象山自然步道)
    Route::post('/h_proscons', 'ProsCosController@h_runR_proscons');
    // 優點懶人包
    Route::post('/h_prosData', 'ProsCosController@h_prosData');
    // 缺點懶人包
    Route::post('/h_consData', 'ProsCosController@h_consData');
    // 飯店加入最愛
    Route::post('/h_proconsAddToCollection', 'ProsCosController@h_proconsAddToCollection');
});

// 路徑分析
Route::group(['middleware' => ['CORS']], function () {
    // 景點第一層 => <get> api/site_dataCity

    // 旅館第一層 => <get> api/h_site_dataCity

    // 第二層選單：輸入城市 ->城市所有景點
    Route::post('/path_sitesByCity', 'PathController@path_sitesByCity');

    // 第二層選單：輸入城市 ->城市所有景點
    Route::post('/h_path_sitesByCity', 'PathController@h_path_sitesByCity');

    // 路徑分析(PHP + R)
    Route::post('/runPath', 'PathController@runPath');
    // 執行搭配php的R(跑路徑分析用path.php)
    Route::post('/runRafterPHP', 'PathController@runRafterPHP');

    Route::post('/PathData', 'PathController@PathData');
    // 取得商家資訊

    // 景點/飯店查城市(旅程表用)
    Route::post('/getCity', 'PathController@getCity');
});


// 偏好分析用
Route::group(['middleware' => ['CORS']], function () {

    Route::post('/preferTag', 'PostController@preferTag');

    Route::post('/pathSiteGooglePlaceId', 'PathController@pathSiteGooglePlaceId');
});
