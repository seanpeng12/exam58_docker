<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Site_data;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;
use Illuminate\Support\Facades\DB as FacadesDB;
use Symfony\Component\HttpKernel\Event\ResponseEvent;

class PathController extends Controller
{
    function getGoogleImg(Request $request)
    {
        $city = $request->input("name");
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://maps.googleapis.com/maps/api/place/findplacefromtext/json?input=" . $city . "&inputtype=textquery&fields=photos,formatted_address,name,rating,opening_hours,geometry&key=AIzaSyDkS6nBwtRIUe55-p_oHZh6QocvIyUAG2A",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
        ));

        $response = curl_exec($curl);
        curl_close($curl);

        $result = json_decode($response);

        // 取得photo_reference
        $result_1 = $result->candidates[0]->photos[0]->photo_reference;

        $img = "https://maps.googleapis.com/maps/api/place/photo?maxwidth=400&photoreference=" . $result_1 . "&key=AIzaSyDkS6nBwtRIUe55-p_oHZh6QocvIyUAG2A";
        return response()->json($img, 200);
    }
    //路徑分析前置csv檔案，run path.php
    function runPath(Request $request)
    {
        // 產生兩個csv檔案到public->path_edge path_node.csv
        $your_command_php = "php C:\\xampp\\htdocs\\SNA_sean\\exam58\\public\\php\\path.php";
        $process = new Process($your_command_php);
        $process->setTimeout(180);

        // 讀取csv，以外部指令的方式呼叫 R 進行繪圖->between_relationship.html
        $your_command_R = "Rscript R/new_path.R";
        $process2 = new Process($your_command_R);

        $process->start();
        $process->wait();

        $process2->start();
        $process2->wait();

        if (!$process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }
        if (!$process2->isSuccessful()) {
            throw new ProcessFailedException($process2);
        }



        return response()->json(array(
            'response' => '成功，產生csv在public，R/path.R讀取csv'
        ), 200);
    }
    // 路徑分析R圖
    function runRafterPHP(Request $request)
    {

        // 以外部指令的方式呼叫 R 進行繪圖->between_relationship.html

        $your_command = "Rscript R/new_path.R";
        $process = new Process($your_command);
        $process->run(); // to run Sync
        // executes after the command finishes
        if (!$process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }
        // $process->start(); // to run Async

        return response()->json(array(
            'response' => '路徑分析成功!'
        ), 200);
    }
    // 懶人包
    function PathData(Request $request)
    {
        // 起始點名字
        $sitename = $request->input("name");
        $sql = FacadesDB::select("SELECT DISTINCT sid FROM comment_relationship WHERE near_site = '$sitename'");

        // array取id值
        $obj = $sql;
        $id = $obj[0]->sid;


        // 起始點
        $sql_1 = FacadesDB::select("SELECT * FROM path_relationship WHERE from_id = '$id' ORDER BY d_edge DESC");

        // 資料格式修改
        $result = array();
        $to_id_name = array();



        for ($i = 0; $i < count($sql_1); $i++) {
            $temp = $sql_1[$i]->to_id;

            if (substr($temp, 0, 1) == "S") {
                $to_id_name = FacadesDB::select("SELECT `name` FROM `site_data`  WHERE `id` = '$temp'");
            } elseif (substr($temp, 0, 1) == "R") {
                $to_id_name = FacadesDB::select("SELECT `name` FROM `resta_data` WHERE `id` = '$temp'");
            } elseif (substr($temp, 0, 1) == "H") {
                $to_id_name = FacadesDB::select("SELECT `name` FROM `hotel_data` WHERE `id` = '$temp'");
            }

            $dataA = [
                'to_id' => $sql_1[$i]->to_id,
                'name' => $to_id_name[0]->name,
                'type' => substr($temp, 0, 1),
                'weight' => $sql_1[$i]->d_edge,

            ];
            array_push($result, $dataA);
        };


        // foreach ($sql_1 as $value) {

        //     $to_id_name = FacadesDB::select("SELECT `name` FROM `site_data` WHERE `id` = '$value->to_id'");
        //     // $name = $to_id_name[0]->name;
        //     $dataA = [
        //         'to_id' => $value->to_id,
        //         'name' => $to_id_name->name
        //     ];
        //     array_push($result, $dataA);
        // };



        return response()->json(
            $result,
            200
        );
    }
}
