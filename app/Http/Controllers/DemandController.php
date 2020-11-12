<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Site_data;
use App\Hotel_data;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;
use Illuminate\Support\Facades\DB as FacadesDB;
use Symfony\Component\HttpKernel\Event\ResponseEvent;

class DemandController extends Controller
{
    //飯店需求分析
    // /h_site_dataCity 第一層選單：取得所有城市(完成)
    function site_dataCityAll()
    {
        $sql = Hotel_data::select('city_name')->distinct()->get();
        return response()->json($sql, 200);
    }

    // /h_site_dataCat 第二層選單：輸入城市 ->類別名稱給下拉式選單(未完成)
    function Catagory(Request $request)
    {
        $city = $request->input('name');
        $sql = FacadesDB::select("SELECT DISTINCT hotel_attr.tag FROM
        ((hotel_data INNER JOIN hotel_relationship on hotel_data.id=hotel_relationship.from_id)
        INNER JOIN hotel_attr on hotel_relationship.to_id=hotel_attr.id )
        WHERE hotel_data.city_name = '$city'");

        return response()->json($sql, 200);
    }

    // /h_runR_twoC 旅館需求分析R圖(未完成)
    function runR_twoC(Request $request)
    {

        $name = $request->input('name');
        $c1 = $request->input('c1');
        $c20 = $request->input('c20');

        // $temp_d = "台北 游泳池 免費停車";
        $temp_d = "$name $c1 $c20";

        $cc = "'" . $temp_d . "'";

        // 以外部指令的方式呼叫 R 進行繪圖->h_between_relationship.html

        // window10
        // $your_command = "/usr/local/bin/Rscript R/h_betweenss_attr_2020.R $cc";
        // $process = new Process($your_command);
        // $process->run(); // to run Sync

        // // executes after the command finishes
        // if (!$process->isSuccessful()) {
        //     throw new ProcessFailedException($process);
        // }
        // $result = $process->getOutput();

        //mac
        $set_charset = 'export LANG=en_US.UTF-8;';
        exec($set_charset . "/usr/local/bin/Rscript R/h_betweenss_attr_2020.R $cc");

        return response()->json(array(
            'name' => $name,
            'c1' => $c1,
            'c20' => $c20,
            'output' => '$result',
            'RhtmlCheck' => 'h_between_relationship.html。'
        ), 200);
    }
    // /h_cat 需求分析懶人包1(依照comment由大到小)
    function bothCatagory(Request $request)
    {
        $city = $request->input('name');
        $c1 = $request->input('c1');
        $c2 = $request->input('c20');

        $sql = FacadesDB::select("SELECT DISTINCT hotel_data.id,hotel_data.name,hotel_data.city_name,hotel_data.address,hotel_data.type,hotel_data.comment,hotel_data.rate,hotel_data.href
            FROM hotel_relationship, hotel_data, hotel_attr
            WHERE (hotel_relationship.from_id = hotel_data.id AND hotel_relationship.to_id = hotel_attr.id)
            AND hotel_data.city_name = '$city'
            AND (hotel_attr.tag = '$c1' OR hotel_attr.tag = '$c2') GROUP BY hotel_data.id HAVING COUNT(*) > 1 ORDER BY hotel_data.comment DESC");

        return response()->json($sql, 200);
    }
    // /h_cat_diff 懶人包2 3(照著hotel_data.comment由大到小)
    function diffCatagory(Request $request)
    {
        $city = $request->input('name');
        $c1 = $request->input('c1');
        $c2 = $request->input('c20');

        // 取(聯集-交集)，傳回含單一tag
        $sql_diff = FacadesDB::select("SELECT DISTINCT hotel_data.id,hotel_data.name,hotel_data.city_name,hotel_data.address,hotel_data.type,hotel_data.comment
        ,hotel_data.rate,hotel_data.href,hotel_attr.tag
        FROM hotel_relationship, hotel_data, hotel_attr
        WHERE (hotel_relationship.from_id = hotel_data.id AND hotel_relationship.to_id = hotel_attr.id)
        AND hotel_data.city_name ='$city'
        AND (hotel_attr.tag = '$c1' OR hotel_attr.tag = '$c2')
        GROUP BY hotel_data.id
        HAVING COUNT(*) = 1
        ORDER BY hotel_data.comment DESC");

        return response()->json($sql_diff, 200);
    }

    // 新api區分懶人包2 3(照著hotel_data.comment 由大排到小)
    function new_diff(Request $request)
    {
        $city = $request->input('name');
        $c1 = $request->input('c1');
        $c2 = $request->input('c20');

        // 取(聯集-交集)，傳回含單一tag
        $sql_diff = FacadesDB::select("SELECT DISTINCT hotel_data.id,hotel_data.name,hotel_data.city_name,hotel_data.address,hotel_data.type,hotel_data.comment
        ,hotel_data.rate,hotel_data.href,hotel_attr.tag
        FROM hotel_relationship, hotel_data, hotel_attr
        WHERE (hotel_relationship.from_id = hotel_data.id AND hotel_relationship.to_id = hotel_attr.id)
        AND hotel_data.city_name ='$city'
        AND (hotel_attr.tag = '$c1' OR hotel_attr.tag = '$c2')
        GROUP BY hotel_data.id
        HAVING COUNT(*) = 1
        ORDER BY hotel_data.comment DESC");


        // array取id值

        $data = $sql_diff;


        // 資料格式修改
        $result_1 = array();
        $result_2 = array();

        $temp = array();
        for ($i = 0; $i < count($data); $i++) {
            $temp = $data[$i]->tag;

            if ($temp == $c1) {
                array_push($result_1, $data[$i]);
            } else {
                array_push($result_2, $data[$i]);
            }
        };
        return response()->json(array(
            $c1 => $result_1,
            $c2 => $result_2
        ), 200);
    }

    // google 取照片
    // function getGoogleImg(Request $request)
    // {
    //     $city = $request->input("name");
    //     $curl = curl_init();

    //     curl_setopt_array($curl, array(
    //         CURLOPT_URL => "https://maps.googleapis.com/maps/api/place/findplacefromtext/json?input=" . $city . "&inputtype=textquery&fields=photos,formatted_address,name,rating,opening_hours,geometry&key=AIzaSyD1ACOGJqcyDr14vUOWeZCz-GAwdaz32Vs",
    //         CURLOPT_RETURNTRANSFER => true,
    //         CURLOPT_ENCODING => "",
    //         CURLOPT_MAXREDIRS => 10,
    //         CURLOPT_TIMEOUT => 0,
    //         CURLOPT_FOLLOWLOCATION => true,
    //         CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    //         CURLOPT_CUSTOMREQUEST => "GET",
    //     ));

    //     $response = curl_exec($curl);
    //     curl_close($curl);

    //     $result = json_decode($response);

    //     // 取得photo_reference
    //     $result_1 = $result->candidates[0]->photos[0]->photo_reference;

    //     $img = "https://maps.googleapis.com/maps/api/place/photo?maxwidth=900&maxheight=600&photoreference=" . $result_1 . "&key=AIzaSyD1ACOGJqcyDr14vUOWeZCz-GAwdaz32Vs";
    //     return response()->json($img, 200);
    // }

    
    // google 取data
    function GooglePlaceInfo(Request $request)
    {
        $site_name = $request->input("name");
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

        if ($result->status == "OK") {
            // 取得id
            $place_id = $result->candidates[0]->place_id;
            //
            $curl_2 = curl_init();

            curl_setopt_array($curl_2, array(
                CURLOPT_URL => "https://maps.googleapis.com/maps/api/place/details/json?place_id=" . $place_id . "&fields=reviews,opening_hours,price_level,name,rating,user_ratings_total,website,formatted_phone_number,address_component,adr_address,business_status,formatted_address,geometry,icon,name,permanently_closed,photo,place_id,plus_code,type,url,utc_offset,vicinity&language=zh-TW&key=AIzaSyD1ACOGJqcyDr14vUOWeZCz-GAwdaz32Vs",
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

            // 取得所有資料
            $detail_info = $result_2->result;
            $name = $detail_info->name;
            $address = $detail_info->formatted_address;
            $icon_url = $detail_info->icon;
            $photos_temp = $detail_info->photos;

            // 照片
            $photos = array();
            for ($i = 0; $i < count($photos_temp); $i++) {
                $temp = $photos_temp[$i]->photo_reference;

                $dataA = [
                    'url' => "https://maps.googleapis.com/maps/api/place/photo?maxwidth=900&maxheight=600&photoreference=" . $temp . "&key=AIzaSyD1ACOGJqcyDr14vUOWeZCz-GAwdaz32Vs"
                ];
                array_push($photos, $dataA);
            };
            // 電話
            if (!empty($detail_info->formatted_phone_number)) {
                $number = $detail_info->formatted_phone_number;
            } else {
                $number = "無資料";
            }
            // 營業資訊
            if (!empty($detail_info->business_status)) {
                $business_status = $detail_info->business_status;
            } else {
                $business_status = "無資料";
            }
            // 星等
            if (!empty($detail_info->rating)) {
                $rating = $detail_info->rating;
            } else {
                $rating = "無資料";
            }
            // user_ratings_total
            if (!empty($detail_info->user_ratings_total)) {
                $user_ratings_total = $detail_info->user_ratings_total;
            } else {
                $user_ratings_total = "無資料";
            }
            // 分類
            if (!empty($detail_info->types)) {
                $types = $detail_info->types;
            } else {
                $types = "無資料";
            }
            // 價格區間
            if (!empty($detail_info->price_level)) {
                $price_level = $detail_info->price_level;
            } else {
                $price_level = "無資料";
            }
            // 評論
            // if (!empty($detail_info->reviews)) {
            //     $reviews = $detail_info->reviews;
            // } else {
            //     $reviews = "無資料";
            // }
            // opening_hours
            if (!empty($detail_info->opening_hours)) {
                $opening_hours = $detail_info->opening_hours;
            } else {
                $opening_hours = "無資料";
            }
            // website
            if (!empty($detail_info->website)) {
                $website = $detail_info->website;
            } else {
                $website = "無資料";
            }
            return response()->json(array(
                'name' => $name,
                'address' => $address,
                'icon_url' => $icon_url,
                'phone_number' => $number,
                'status' => $business_status,
                'rating' => $rating,
                'rating_total' => $user_ratings_total,
                'types' =>  $types,
                'price_level' => $price_level,
                'opening_hours' => $opening_hours,
                'website' => $website,
                'photos' => $photos,

            ), 200);
        } else {
            return response()->json(array(
                'ok' => false,
                'name' => "無資料",
                'address' => "無資料",
                'icon_url' => "無資料",
                'phone_number' => "無資料",
                'status' => "無資料",
                'rating' => "無資料",
                'rating_total' => "無資料",
                'types' =>  "無資料",
                'price_level' => "無資料",
                'opening_hours' => "無資料",
                'website' => "無資料",
                'photos' => "無資料",
            ), 200);
        }
    }
}
