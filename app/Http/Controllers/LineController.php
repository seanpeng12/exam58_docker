<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LineController extends Controller
{
    //
    function secondVerify(Request $request){
        $code_1 = $request->input("code");
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://maps.googleapis.com/maps/api/place/findplacefromtext/json?input=" . $site_name . "&inputtype=textquery&fields=place_id,formatted_address,name,rating,opening_hours,geometry&key=AIzaSyD1ACOGJqcyDr14vUOWeZCz-GAwdaz32Vs",
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
    }
}
