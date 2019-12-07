<?php

namespace App\Http\Controllers;

use App\Site_attr;
use App\Site_data;
use Illuminate\Http\Request;

//登凱的範例，登凱萬歲><
class TestController extends Controller
{
    public function testAction(Request $request)
    {
        $datas = Site_data::all();
        foreach ($datas as $data) {
            echo $data->name . "<br/>";
        }
    }
// 自己測試
    public function testSite_attr(Request $request)
    {
        // #Site_attr::all();

        $datas = Site_attr::all();
        return view('frontend.about')->with('datas',$datas);

// foreach ($datas as $data) {
        //             echo $data->tag . "</br>";
        //         }
    }
}
