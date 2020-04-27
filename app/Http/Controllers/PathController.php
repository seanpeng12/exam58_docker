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
}
