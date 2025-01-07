<?php

namespace App\Http\Controllers;

use DB;

class DynamicDependent extends Controller
{
    public function index()
    {
        // $country_list = DB::table('site_data')
        //     ->groupBy('city_name')
        //     ->get();

        $country_list = DB::select('select distinct city_name from site_data');
        return view('frontend.test')->with('country_list', $country_list);
    }

    public function fetch(Request $request)
    {
        $select = $request->get('select');
        $value = $request->get('value');
        $dependent = $request->get('dependent');
        // $data = DB::table('site_data')
        //     ->where($select, $value)
        //     ->groupBy($dependent)
        //     ->get();
        // $results = DB::select('select * from users where id = :id', ['id' => 1]);

        $data = DB::select('select name from site_data where city_name= ?', $value);
        $output = '<option value="">Select ' . ucfirst($dependent) . '</option>';
        foreach ($data as $row) {
            // $output .= '<option value="' . $row->$dependent . '">' . $row->$dependent . '</option>';
            //可用來debug
            $output = "dependent ='$dependent' and  value ='$value' and  select='$select'";

        }
        echo $output;
    }

}
