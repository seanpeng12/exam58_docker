<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB as FacadesDB;

class AjaxController extends Controller
{
    //get myform
    public function index()
    {
        // $country_list = FacadesDB::table('site_data')->groupBy('city_name')->get();

        $country_list = FacadesDB::table('site_data')
            ->select(FacadesDB::raw('city_name'))
            ->groupBy('city_name')
            ->get();
        return view('frontend_sna.myform')->with('country_list', $country_list);
    }

    //firebase insert
    public function fetch_firebase(Request $request)
    {
        // 取得ajax的selectbox
        // $input = request()->all();
        $city = $request->input('city');
        $cat1 = $request->input('cat1');
        $cat2 = $request->input('cat2');
        $title = $request->input('title');
        $url = $request->input('url');
        // $output = 'title=' . $title . 'url=' . $url . '。';
        $msg = "這是一條簡單的測試消息.";
        return response()->json(array('city' => $city, 'cat1' => $cat1, 'cat2' => $cat2, 'msg' => $msg, 'title' => $title, 'url' => $url), 200);
    }

    //post myform(Ajax)
    public function fetch(Request $request)
    {
        // 取得ajax的selectbox
        $select = $request->get('select');
        $value = $request->get('value');
        $dependent = $request->get('dependent');

        // 方法三(失敗)
        // $data = FacadesDB::table('site_data')
        //     ->join('site_relationship', 'ssite_data.id', '=', 'site_relationship.from_id')
        //     ->join('site_attr', 'site_relationship.to_id', '=', 'site_attr.id')
        //     ->select(FacadesDB::raw('DISTINCT site_attr.tag'))
        //     ->where('site_data.city_name', '=', $value)
        //     ->get();

        // 方法一(直接raw sql可用)
        $data = FacadesDB::select("SELECT DISTINCT site_attr.tag FROM ((site_data INNER JOIN site_relationship on site_data.id=site_relationship.from_id) INNER JOIN site_attr on site_relationship.to_id=site_attr.id ) WHERE site_data.city_name = '$value'");

        //湘涵sql
        // $data = FacadesDB::select("SELECT site_data.name FROM site_data WHERE site_data.city_name = '$value'");

        //方法四之二(閉包含數讀取$value(失敗))
        // $data = FacadesDB::table('site_data')
        //     ->join('site_relationship', function ($join1) {
        //         $join1->on('site_data.id', '=', 'site_relationship.from_id');
        //     })->join('site_attr', function ($join) use ($value) {
        //         $join->on('site_relationship.to_id', '=', 'site_attr . id')
        //             ->where('site_data.city_name', '=', FacadesDB::raw("$value"));
        //     })->select(FacadesDB::raw('DISTINCT site_attr.tag'))->get();

        // "SELECT R.from_id, D.city_name, R.to_id, A.tag FROM site_relationship R, site_data D, site_attr A WHERE R.from_id = D.id AND R.to_id = A.id AND D.city_name ='基隆'";

        // 自我嘗試(可行)
        $output = '<option value="">選擇' . $value . '的景點(' . ucfirst($dependent) . ')</option>';

        foreach ($data as $row) {
            //debug
            //$output =  "答案為='.$data_c->tag.'";

            //this one
            // $output = "<option value= '$data_c->tag'>$data_c->tag</option>\n";

            // 原始正確碼

            $output .= '<option value="' . $row->$dependent . '">' . $row->$dependent . '</option>';

            //可用來debug
            // $output = "dependent ='$dependent' and  value ='$value' and  select='$select'";
        }

        echo $output;

        //可行作法(可作動)
        // foreach ($data as $data_c) {
        //     $output = "答案為=$data_c->tag";
        //     $output = '<option value="' . $data_c->tag . '">' . $data_c->tag . '</option>';
        // }

        // 找問題(可作動)
        // $output = "dependent = $dependent and  value =  $value and  select=$select";

        // 正確句子如下
        // "SELECT R.from_id, D.city_name, R.to_id, A.tag FROM site_relationship R, site_data D, site_attr A WHERE R.from_id = D.id AND R.to_id = A.id AND D.city_name ='基隆'";

    }

    public function deal()
    {
        return view("frontend_sna.deal");
    }

    public function out(Request $request)
    {
        $city = $request->cityname;

        return "OK已經收到" . $city;
    }




    //僅使用get到deal網站
    public function loginForm()
    {
        return view("frontend_sna.deal");
    }
    //前一網站post到deal網站
    public function loginProcess(Request $request)
    {

        //$input = $request->all();
        //echo $request->input("country") . "<br/>";
        // echo "<pre>";///無格式化的輸出
        //echo $request->input("tag2") . "<br/>";
        // echo "<pre>";
        // var_dump($request->input("tag3.*"));
        // print_r($request->input("tag3.*"));
        // echo "</pre>";

        $arr = $request->input("tag3.*", ["無資料!"]);
        // foreach ($arr as $e) {
        //     echo "$e <br/>";
        // }

        return view('frontend_sna.deal')->with('A', $request->input("country"))->with('B', $request->input("tag"))->with('C', $request->input("tag2"))->with('D', $arr);
    }
}
