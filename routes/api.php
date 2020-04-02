<?php

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



// 允許跨域請求
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




Route::get('/site_data/{id}', function ($id) {
    return response()->json(App\Site_data::find($id), 20);
});
