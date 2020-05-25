<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Site_data;
use App\Hotel_data;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;
use Illuminate\Support\Facades\DB as FacadesDB;
use Symfony\Component\HttpKernel\Event\ResponseEvent;

class PathController extends Controller
{
    // 第二層：輸入城市 ->城市所有景點 > 30評論
    function path_sitesByCity(Request $request)
    {
        $city = $request->input('city_name');
        $sql = FacadesDB::select("SELECT name FROM site_data WHERE city_name='$city' AND comment >=30 ORDER BY site_data.comment DESC");
        return response()->json($sql, 200);
    }

    // 第二層：輸入城市 ->城市所有飯店 > 50評論
    function h_path_sitesByCity(Request $request)
    {
        $city = $request->input('city_name');
        $sql = Hotel_data::select('name')->where('city_name', "=", "$city")->where('comment', ">", 50)->get();

        return response()->json($sql, 200);
    }

    // google 取照片
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

        $img = "https://maps.googleapis.com/maps/api/place/photo?maxwidth=900&maxheight=600&photoreference=" . $result_1 . "&key=AIzaSyDkS6nBwtRIUe55-p_oHZh6QocvIyUAG2A";
        return response()->json($img, 200);
    }
    //路徑分析前置csv檔案，run path.php
    function runPath(Request $request)
    {
        // Windows
        // // 產生兩個csv檔案到public->path_edge path_node.csv
        // $your_command_php = "php php/path.php";
        // $process = new Process($your_command_php);
        // $process->setTimeout(180);

        // // 讀取csv，以外部指令的方式呼叫 R 進行繪圖->between_relationship.html
        // $your_command_R = "/usr/local/bin/Rscript R/new_path.R";
        // $process2 = new Process($your_command_R);

        // $process->start();
        // $process->wait();

        // $process2->start();
        // $process2->wait();

        // if (!$process->isSuccessful()) {
        //     throw new ProcessFailedException($process);
        // }
        // if (!$process2->isSuccessful()) {
        //     throw new ProcessFailedException($process2);
        // }


        // MAC
        $city = $request->input("city");
        $site = $request->input("site");

        $set_charset = 'export LANG=en_US.UTF-8;';
        // "php php/path.php city=嘉義縣 site=故宮南院"
        $output = shell_exec($set_charset . "php php/path.php city=$city site=$site");
        $output2 = shell_exec($set_charset . "/usr/local/bin/Rscript R/new_path.R");



        return response()->json(array(
            'php' => $output,
            'R' => $output2,
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
    function pathSiteGooglePlaceId(Request $request)
    {
        $site_name = $request->input("name");
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://maps.googleapis.com/maps/api/place/findplacefromtext/json?input=" . $site_name . "&inputtype=textquery&fields=place_id,formatted_address,name,rating,opening_hours,geometry&key=AIzaSyDkS6nBwtRIUe55-p_oHZh6QocvIyUAG2A",
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
        // 取得id
        $place_id = $result->candidates[0]->place_id;


        //
        $curl_2 = curl_init();

        curl_setopt_array($curl_2, array(
            CURLOPT_URL => "https://maps.googleapis.com/maps/api/place/details/json?place_id=" . $place_id . "&fields=name,rating,formatted_phone_number,address_component,adr_address,business_status,formatted_address,geometry,icon,name,permanently_closed,photo,place_id,plus_code,type,url,utc_offset,vicinity&language=zh-TW&key=AIzaSyDkS6nBwtRIUe55-p_oHZh6QocvIyUAG2A",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
        ));

        $response_2 = curl_exec($curl_2);
        curl_close($curl_2);

        $result_2 = json_decode($response_2);
        // 取得id
        $detail_info = $result_2->result;



        return response()->json($detail_info, 200);
    }
}
