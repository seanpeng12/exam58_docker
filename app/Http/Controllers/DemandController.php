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
    // /h_site_dataCity 第一層選單：取得所有城市(完成)
    function site_dataCityAll()
    {
        $sql = Hotel_data::select('city_name')->distinct()->get();
        return response()->json($sql, 200);
    }

    // /h_site_dataCat 第二層選單：輸入城市 ->類別名稱給下拉式選單(未完成)
    function Catagory(Request $request)
    {
        $city = $request->input('name');
        $sql = FacadesDB::select("SELECT DISTINCT hotel_attr.tag FROM
        ((hotel_data INNER JOIN hotel_relationship on hotel_data.id=hotel_relationship.from_id)
        INNER JOIN hotel_attr on hotel_relationship.to_id=hotel_attr.id )
        WHERE hotel_data.city_name = '$city'");

        return response()->json($sql, 200);
    }

    // /h_runR_twoC 旅館需求分析R圖(未完成)
    function runR_twoC(Request $request)
    {

        $name = $request->input('name');
        $c1 = $request->input('c1');
        $c20 = $request->input('c20');

        // $temp_d = "台北 游泳池 免費停車";
        $temp_d = "$name $c1 $c20";

        $cc = "'" . $temp_d . "'";

        // 以外部指令的方式呼叫 R 進行繪圖->h_between_relationship.html
        
        // window10
        // $your_command = "/usr/local/bin/Rscript R/h_betweenss_attr_2020.R $cc";
        // $process = new Process($your_command);
        // $process->run(); // to run Sync

        // // executes after the command finishes
        // if (!$process->isSuccessful()) {
        //     throw new ProcessFailedException($process);
        // }
        // $result = $process->getOutput();

        //mac
        $set_charset = 'export LANG=en_US.UTF-8;';
        exec($set_charset."/usr/local/bin/Rscript R/h_betweenss_attr_2020.R $cc");

        return response()->json(array(
            'name' => $name,
            'c1' => $c1,
            'c20' => $c20,
            'output' => '$result',
            'RhtmlCheck' => 'h_between_relationship.html。'
        ), 200);
    }
    // /h_cat 需求分析懶人包(未完成)
    function bothCatagory(Request $request)
    {
        $city = $request->input('name');
        $c1 = $request->input('c1');
        $c2 = $request->input('c20');

        $sql = FacadesDB::select("SELECT DISTINCT hotel_data.id,hotel_data.name,hotel_data.city_name,hotel_data.address,hotel_data.type,hotel_data.comment,hotel_data.rate,hotel_data.href
            FROM hotel_relationship, hotel_data, hotel_attr
            WHERE (hotel_relationship.from_id = hotel_data.id AND hotel_relationship.to_id = hotel_attr.id)
            AND hotel_data.city_name = '$city'
            AND (hotel_attr.tag = '$c1' OR hotel_attr.tag = '$c2') GROUP BY hotel_data.id HAVING COUNT(*) > 1");

        return response()->json($sql, 200);
    }
    // /h_cat_diff 懶人包2(未完成)
    function diffCatagory(Request $request)
    {
        $city = $request->input('name');
        $c1 = $request->input('c1');
        $c2 = $request->input('c20');

        // 取(聯集-交集)，傳回含單一tag
        $sql_diff = FacadesDB::select("SELECT DISTINCT hotel_data.id,hotel_data.name,hotel_data.city_name,hotel_data.address,hotel_data.type,hotel_data.comment
        ,hotel_data.rate,hotel_data.href,hotel_attr.tag
        FROM hotel_relationship, hotel_data, hotel_attr
        WHERE (hotel_relationship.from_id = hotel_data.id AND hotel_relationship.to_id = hotel_attr.id)
        AND hotel_data.city_name ='$city'
        AND (hotel_attr.tag = '$c1' OR hotel_attr.tag = '$c2')
        GROUP BY hotel_data.id
        HAVING COUNT(*) = 1
        ORDER BY hotel_data.rate DESC");

        return response()->json($sql_diff, 200);
    }
}
