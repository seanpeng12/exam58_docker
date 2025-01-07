<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Site_data;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB as FacadesDB;

//登凱的範例，登凱萬歲><
class TestController extends Controller
{
    public function testAction(Request $request)
    {
        $datas = Site_data::all();
        foreach ($datas as $data) {
            echo $data->name . "<br/>" . "huhuhuu";
        }
    }

    // 測試表單傳值
    // public function loginForm()
    // {
    //     return view("frontend.create_schedule");
    // }

    public function formpass(Request $request) //這行你會覺得它很奇怪

    {

        //$input = $request->all();
        // echo $request->input("country") . "<br/>";
        // echo "<pre>";
        // var_dump($request->input("name.*"));
        // print_r($request->input("name.*"));
        // echo "</pre>";
        $country = $request->input("country");
        $arr = $request->input("name.*");

        // foreach ($arr as $e) {
        //     echo "$e <br/>";
        // }

        // 傳入getvalue.blade.php(return)
        return view('frontend_sna.getvalue')->with('arr', $arr)->with('country', $country);
    }

    // 自己測試
    public function testSite_attr(Request $request)
    {
        // #Site_attr::all();
        $datas = DB::select('select distinct city_name from site_data');

        // $datas = Site_data::all()->distinct();
        return view('frontend_sna.create_schedule')->with('datas', $datas);

        // foreach ($datas as $data) {
        //     echo $data->tag . "</br>";
        // }
    }
    // form1 取site_data.city_name
    public function index(Request $request)
    {
        // $country_list = FacadesDB::table('site_data')->groupBy('city_name')->get();

        $country_list = FacadesDB::table('site_data')
            ->select(FacadesDB::raw('city_name'))
            ->groupBy('city_name')
            ->get();

        return view('frontend_sna.create_schedule')->with('country_list', $country_list);
    }
    // form2 取site_data.name
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
        // $data = FacadesDB::select("SELECT DISTINCT site_attr.tag FROM ((site_data INNER JOIN site_relationship on site_data.id=site_relationship.from_id) INNER JOIN site_attr on site_relationship.to_id=site_attr.id ) WHERE site_data.city_name = '$value'");
        $data = FacadesDB::select("SELECT * FROM site_data WHERE site_data.city_name = '$value'");
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
        $output = '<option data-tokens="">Select ' . ucfirst($dependent) . '</option>';
        foreach ($data as $row) {
            //debug
            //$output =  "答案為='.$data_c->tag.'";

            //this one
            // $output = "<option value= '$data_c->tag'>$data_c->tag</option>\n";

            // 原始正確碼

            $output .= '<option id="' . $row->address . '">' . $row->name . '</option>';

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
        return view("deal");
    }

    public function out(Request $request)
    {
        $city = $request->cityname;

        return "OK已經收到" . $city;
    }

    //my_itinerary傳UID給create_itinerary
    public function itinerary_eve(Request $request){
        $eve_id = $request->get('eve_id');
        
        
       
        return view('frontend_sna.create_itinerary')->with('eve_id', $eve_id);

    }
}
