<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Site_data;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;
use Illuminate\Support\Facades\DB as FacadesDB;
use Symfony\Component\HttpKernel\Event\ResponseEvent;

class PostController extends Controller
{
    function index()
    {
        return view('frontend_sna/test');
    }

    //APi (post資料庫)

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



    // 測試R

    function runR_city(Request $request)
    {

        $id = "台北";
        $n = '"' . $id . '"';

        // 以外部指令的方式呼叫 R 進行繪圖->between_city.html

        $your_command = "Rscript R/site_Betweeness_2020.R $n";
        $process = new Process($your_command);
        $process->run(); // to run Sync

        // executes after the command finishes
        if (!$process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }
        return response()->json(array('output' => $process->getOutput(), 'RhtmlCheck' => 'R/site_Betweeness_2020.R "城市"-> between_city.html。'), 200);
    }
    // 需求分析R圖-成功
    function runR_twoC(Request $request)
    {

        $name = $request->input('name');
        $c1 = $request->input('c1');
        $c20 = $request->input('c20');

        // $temp_d = "台北 博物館 特色博物館";
        $temp_d = "$name $c1 $c20";

        $cc = '"' . $temp_d . '"';

        // 以外部指令的方式呼叫 R 進行繪圖->between_relationship.html

        $your_command = "Rscript R/betweenss_attr_2020.R $cc";
        $process = new Process($your_command);
        $process->run(); // to run Sync

        // executes after the command finishes
        if (!$process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }

        return response()->json(array(
            'name' => $name,
            'c1' => $c1,
            'c20' => $c20,
            'output' => $process->getOutput(),
            'RhtmlCheck' => 'R/betweenss_attr_2020.R "a b c"-> between_relationship.html。'
        ), 200);
    }
    // 需求分析懶人包
    function bothCatagory(Request $request)
    {
        $city = $request->input('name');
        $c1 = $request->input('c1');
        $c2 = $request->input('c20');

        $sql = FacadesDB::select("SELECT DISTINCT site_data.id,site_data.name,site_data.city_name,site_data.address,site_data.type,site_data.comment,site_data.rate,site_data.href
            FROM site_relationship, site_data, site_attr
            WHERE (site_relationship.from_id = site_data.id AND site_relationship.to_id = site_attr.id)
            AND site_data.city_name = '$city'
            AND (site_attr.tag = '$c1' OR site_attr.tag = '$c2') GROUP BY site_data.id HAVING COUNT(*) > 1");

        // $sql =  FacadesDB::table('site_data')
        //     ->selectRaw("DISTINCT site_data.id, site_data.name, site_data.city_name, site_data.type,site_data.completed
        //     FROM site_relationship, site_data, site_attr
        //     WHERE (site_relationship.from_id = site_data.id AND site_relationship.to_id = site_attr.id)
        //     AND site_data.city_name = '$city'
        //     AND (site_attr.tag = '$c1' OR site_attr.tag = '$c2') GROUP BY site_data.id HAVING COUNT(*) > 1")->get();


        return response()->json($sql, 200);

        // 改寫eloquent failed
        // $A = FacadesDB::table('site_relationship')
        //     ->join('site_data', 'site_relationship.from_id', '=', 'site_data.id')
        //     ->join('site_attr', 'site_relationship.to_id', '=', 'site_attr.id')
        //     ->select("site_data.id, site_data.name, site_data.city_name, site_data.type")
        //     ->where(function ($query) {
        //         $query->where(['site_relationship.from_id' => 'site_data.id', 'site_relationship.to_id' => 'site_attr.id']);
        //     })->andWhere(function ($query) {
        //         $query->where(['site_data' => "台北"]);
        //     })->andWhere(function ($query) {
        //         $query->orWhere(['site_attr.tag' => "博物館", 'site_attr.tag' => "古蹟"]);
        //     })->groupBy('site_data.id')->havingRaw('COUNT(*) > ?', [1])->get();
    }




    function diffCatagory(Request $request)
    {
        $city = $request->input('name');
        $c1 = $request->input('c1');
        $c2 = $request->input('c20');

        // 取(聯集-交集)，傳回含單一tag
        $sql_diff = FacadesDB::select("SELECT DISTINCT site_data.id,site_data.name,site_data.city_name,site_data.address,site_data.type,site_data.comment
        ,site_data.rate,site_data.href,site_attr.tag
        FROM site_relationship, site_data, site_attr
        WHERE (site_relationship.from_id = site_data.id AND site_relationship.to_id = site_attr.id)
        AND site_data.city_name ='$city'
        AND (site_attr.tag = '$c1' OR site_attr.tag = '$c2')
        GROUP BY site_data.id
        HAVING COUNT(*) = 1
        ORDER BY site_data.rate DESC");

        return response()->json($sql_diff, 200);
    }





    // site_data API
    // 取所有景點(測試用，有設定量以供測試)
    function site_dataAll()
    {
        $sql = Site_data::where('id', '<', "S0008")->get();
        return response()->json($sql, 200);
    }

    // 輸入景點id->單一景點詳細資訊
    function site_dataById($id)
    {
        $sql = Site_data::find($id);
        return response()->json($sql, 200);
    }
    // 輸入城市->所有景點名稱
    function site_nameById($city)
    {
        $sql = Site_data::select('name')->where('city_name', '=', $city)->get();
        return response()->json($sql, 200);
        // return response()->json(Site_data::find($city_name), 200);
    }


    // 取得所有城市
    function site_dataCityAll()
    {
        $sql = Site_data::select('city_name')->distinct()->get();
        return response()->json($sql, 200);
    }

    // 輸入城市 ->類別名稱給下拉式選單
    function Catagory(Request $request)
    {
        $city = $request->input('name');
        $sql = FacadesDB::select("SELECT DISTINCT site_attr.tag FROM
        ((site_data INNER JOIN site_relationship on site_data.id=site_relationship.from_id)
        INNER JOIN site_attr on site_relationship.to_id=site_attr.id )
        WHERE site_data.city_name = '$city'");

        return response()->json($sql, 200);
    }
    // 輸入城市 ->城市所有景點
    function sitesByCity(Request $request)
    {
        $city = $request->input('city_name');
        $sql = Site_data::select('name')->where('city_name', "=", "$city")->get();

        return response()->json($sql, 200);
    }

    function prosData(Request $request)
    {
        $city = $request->input('name');
        $sql_positive = FacadesDB::select("SELECT `segment`,`id`,`weight` FROM segment_data WHERE weight >= 2 AND evaluation = 'P' ORDER BY weight DESC LIMIT 20");



        return response()->json($sql_positive, 200);
    }

    function consData(Request $request)
    {
        $city = $request->input('name');
        $sql_negative = FacadesDB::select("SELECT `segment`,`id`,`weight` FROM segment_data WHERE weight >= 2 AND evaluation = 'N' ORDER BY weight DESC LIMIT 20");


        return response()->json($sql_negative, 200);
    }

    function preferTag(Request $request)
    {
        $id = $request->input('site_id');
        $sql = FacadesDB::select("SELECT site_data.id, site_attr.tag FROM site_data, site_relationship, site_attr
        WHERE (site_data.id = site_relationship.from_id and site_relationship.to_id = site_attr.id) 
        AND site_data.id = '$id'");

        return response()->json($sql,200);
    }
}
