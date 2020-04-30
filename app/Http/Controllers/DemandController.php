<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Site_data;
use App\Hotel_data;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;
use Illuminate\Support\Facades\DB as FacadesDB;
use Symfony\Component\HttpKernel\Event\ResponseEvent;

class DemandController extends Controller
{
    //飯店需求分析
    // /site_dataCity 第一層選單：取得所有城市(完成)
    function site_dataCityAll()
    {
        $sql = Hotel_data::select('city_name')->distinct()->get();
        return response()->json($sql, 200);
    }

    // /site_dataCat 第二層選單：輸入城市 ->類別名稱給下拉式選單(未完成)
    function Catagory(Request $request)
    {
        $city = $request->input('name');
        $sql = FacadesDB::select("SELECT DISTINCT site_attr.tag FROM
        ((site_data INNER JOIN site_relationship on site_data.id=site_relationship.from_id)
        INNER JOIN site_attr on site_relationship.to_id=site_attr.id )
        WHERE site_data.city_name = '$city'");

        return response()->json($sql, 200);
    }

    // /runR_twoC 需求分析R圖(未完成)
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
    // /cat 需求分析懶人包(未完成)
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
    // /cat_diff 懶人包2(未完成)
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
}
