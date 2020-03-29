<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;

class PostController extends Controller
{
    //APi

    // 取得全部資料
    function apiAll()
    {
        return response()->json(Post::all(), 200);
    }


    // 取得單一文章(use id)
    function apiFindPostById($id)
    {
        return response()->json(Post::find($id), 200);
    }


    // 建立一篇文章(成功回傳ok use json format)
    function apiCreatePost(Request $request)
    {
        $post = new Post;
        $post->id = $request->input('id', 1);
        $post->title = $request->input('title', '標題');
        $post->body = $request->input('body', '沒有內文。');
        $ok = $post->save();

        return response()->json(['ok' => $ok], 200);
    }


    // 更新一篇文章(成功回傳ok use json format)
    function apiUpdatePostById(Request $request, $id)
    {
        $ok = false;
        $msg = '沒有錯誤碼';

        $post = Post::find($id);
        // 如果找到該id
        if ($post) {
            $post->title = $request->input('title', '我更新了標題');
            $post->body = $request->input('body', '我更新了內文。');
            $ok = $post->save();
            if (!$ok) $msg = '更新失敗，請檢查網路。';
        } else {
            $msg = '找不到該文章!';
        }
        return response()->json(['ok' => $ok, 'msg' => $msg], 200);
    }


    //刪除一篇文章
    function apiDeletePostById($id)
    {
        $rows = Post::destroy($id);
        $ok = ($rows > 0);
        return response()->json(['ok' => $ok], 200);
    }
}
