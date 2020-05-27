<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Site_data;
use App\Hotel_data;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;
use Illuminate\Support\Facades\DB as FacadesDB;

class ProsCosController extends Controller
{
    // 景點
    // 取得所有城市
    function site_dataCityAll()
    {
        $sql = Site_data::select('city_name')->distinct()->get();
        return response()->json($sql, 200);
    }

    // 第二層：輸入城市 ->城市所有景點 > 30評論
    function sitesByCity(Request $request)
    {
        $city = $request->input('city_name');
        $sql = Site_data::select('name')->where('city_name', "=", "$city")->where('comment', ">", 30)->get();

        return response()->json($sql, 200);
    }


    // 優缺點 景點名name -> 景點id -> 執行R
    function runR_proscons(Request $request)
    {
        $name = $request->input("name");
        $sql = Site_data::select('id')->where('name', '=', $name)->get();

        // json轉array取值
        $obj = json_decode($sql);
        $id_pre = $obj[0]->id;

        $id = "'" . $id_pre . "'";

        // window10
        // $your_command_good = "Rscript R/h_degree.R $id";
        // $your_command_bad = "Rscript R/h_bad_degree.R $id";

        // macOS
        // setlocale (LC_ALL, 'zh_TW.UTF-8');
        // header("Content-type:text/html; charset=utf-8");
        $set_charset = 'export LANG=en_US.UTF-8;';
        $output = shell_exec($set_charset . "/usr/local/bin/Rscript R/degree.R $id");
        $output2 = shell_exec($set_charset . "/usr/local/bin/Rscript R/bad_degree.R $id");

        // $your_command_good = "/usr/local/bin/Rscript R/h_degree.R $id";
        // $your_command_bad = "/usr/local/bin/Rscript R/h_bad_degree.R $id";

        // $process = new Process($your_command_good);
        // $process2 = new Process($your_command_bad);

        // $process->start();
        // $process2->start();

        // $process->wait();
        // $process2->wait();


        // if (!$process->isSuccessful()) {
        //     throw new ProcessFailedException($process);
        // }
        // if (!$process2->isSuccessful()) {
        //     throw new ProcessFailedException($process2);
        // }
        return response()->json(array(
            'id' => $id,
            '1?' => $output,
            '2?' => $output2,
            'debug優點' => "完成！",
            'debug缺點' => "完成",

        ), 200);
    }
    // 景點優點
    function prosData(Request $request)
    {
        $site_name = $request->input('name');

        $sql = Site_data::select('id')->where('name', '=', $site_name)->get();

        // json轉array取值
        $obj = json_decode($sql);
        $id = $obj[0]->id;


        $sql_positive = FacadesDB::select("SELECT id,segment,degree FROM segment_data WHERE site_id = '$id' AND degree >= 1 AND evaluation = 'P' ORDER BY degree DESC LIMIT 9");



        return response()->json($sql_positive, 200);
    }
    // 景點缺點
    function consData(Request $request)
    {
        $site_name = $request->input('name');

        $sql = Site_data::select('id')->where('name', '=', $site_name)->get();

        // json轉array取值
        $obj = json_decode($sql);
        $id = $obj[0]->id;


        $sql_negative = FacadesDB::select("SELECT id,segment,degree FROM segment_data WHERE site_id = '$id' AND degree >= 1 AND evaluation = 'N' ORDER BY degree DESC LIMIT 9");


        return response()->json($sql_negative, 200);
    }

    // 景點加入最愛
    function proconsAddToCollection(Request $request)
    {
        $name = $request->input('name');

        $sql = Site_data::select('id')->where('name', '=', $name)->get();

        // json轉array取值
        $obj = json_decode($sql);
        $id = $obj[0]->id;

        $data = FacadesDB::select("SELECT DISTINCT site_data.id,site_data.name,site_data.city_name,site_data.address,site_data.type,site_data.comment,site_data.rate,site_data.href FROM site_data WHERE site_data.id = '$id'");

        return response()->json($data, 200);
    }


    // 飯店

    // 取得所有城市
    function hotel_dataCityAll()
    {
        $sql = Hotel_data::select('city_name')->distinct()->get();
        return response()->json($sql, 200);
    }
    // 第二層：輸入城市 ->城市所有飯店 > 50評論
    function h_sitesByCity(Request $request)
    {
        $city = $request->input('city_name');
        $sql = Hotel_data::select('name')->where('city_name', "=", "$city")->where('comment', ">", 50)->get();

        return response()->json($sql, 200);
    }
    // 優缺點 景點名name -> 飯店id -> 執行R
    function h_runR_proscons(Request $request)
    {
        $name = $request->input("name");
        $sql = Hotel_data::select('id')->where('name', '=', $name)->get();

        // json轉array取值
        $obj = json_decode($sql);
        $id_pre = $obj[0]->id;

        $id = "'" . $id_pre . "'";

        // window10
        // $your_command_good = "Rscript R/h_degree.R $id";
        // $your_command_bad = "Rscript R/h_bad_degree.R $id";

        // $process = new Process($your_command_good);
        // $process2 = new Process($your_command_bad);

        // $process->start();
        // $process2->start();

        // $process->wait();
        // $process2->wait();


        // if (!$process->isSuccessful()) {
        //     throw new ProcessFailedException($process);
        // }
        // if (!$process2->isSuccessful()) {
        //     throw new ProcessFailedException($process2);
        // }

        // macOS
        $set_charset = 'export LANG=en_US.UTF-8;';
        $output = shell_exec($set_charset . "/usr/local/bin/Rscript R/h_degree.R $id");
        $output2 = shell_exec($set_charset . "/usr/local/bin/Rscript R/h_bad_degree.R $id");


        return response()->json(array(
            'id' => $id,
            'debug優點' => $output,
            'debug缺點' => $output2,

        ), 200);
    }
    // 飯店優點
    function h_prosData(Request $request)
    {
        $site_name = $request->input('name');

        $sql = Hotel_data::select('id')->where('name', '=', $site_name)->get();

        // json轉array取值
        $obj = json_decode($sql);
        $id = $obj[0]->id;


        $sql_positive = FacadesDB::select("SELECT id,segment,degree FROM h_segment_data WHERE hotel_id = '$id' AND degree >= 1 AND evaluation = 'P' ORDER BY degree DESC LIMIT 9");



        return response()->json($sql_positive, 200);
    }
    // 飯店缺點
    function h_consData(Request $request)
    {
        $site_name = $request->input('name');

        $sql = Hotel_data::select('id')->where('name', '=', $site_name)->get();

        // json轉array取值
        $obj = json_decode($sql);
        $id = $obj[0]->id;


        $sql_negative = FacadesDB::select("SELECT id,segment,degree FROM h_segment_data WHERE hotel_id = '$id' AND degree >= 1 AND evaluation = 'N' ORDER BY degree DESC LIMIT 9");


        return response()->json($sql_negative, 200);
    }

    // 景點加入最愛
    function h_proconsAddToCollection(Request $request)
    {
        $name = $request->input('name');

        $sql = Hotel_data::select('id')->where('name', '=', $name)->get();

        // json轉array取值
        $obj = json_decode($sql);
        $id = $obj[0]->id;

        $data = FacadesDB::select("SELECT DISTINCT hotel_data.id,hotel_data.name,hotel_data.city_name,hotel_data.address,hotel_data.type,hotel_data.comment,hotel_data.rate,hotel_data.href FROM hotel_data WHERE hotel_data.id = '$id'");

        return response()->json($data, 200);
    }
}
