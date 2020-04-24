<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Site_data;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;
use Illuminate\Support\Facades\DB as FacadesDB;

class ProsCosController extends Controller
{

    // 優缺點 景點名name -> 景點id -> 執行R
    function runR_proscons(Request $request)
    {
        $name = $request->input("name");
        $sql = Site_data::select('id')->where('name', '=', $name)->get();

        // json轉array取值
        $obj = json_decode($sql);
        $id = $obj[0]->id;

        // $n = '"' . $name . '"';
        $your_command_good = "Rscript R/degree.R $id";
        $your_command_bad = "Rscript R/bad_degree.R $id";
        $process = new Process($your_command_good);
        $process2 = new Process($your_command_bad);

        $process->start();
        $process2->start();

        $process->wait();
        $process2->wait();


        if (!$process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }
        if (!$process2->isSuccessful()) {
            throw new ProcessFailedException($process2);
        }
        return response()->json(array(
            'id' => $id,
            'debug優點' => "完成",
            'debug缺點' => "完成",

        ), 200);
    }
}
