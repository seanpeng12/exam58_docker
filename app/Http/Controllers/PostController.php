<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Site_data;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;
use Illuminate\Support\Facades\DB as FacadesDB;
use Symfony\Component\HttpKernel\Event\ResponseEvent;

use Exception;
use Illuminate\Support\Facades\Log;
use App\Services\LineService;
use Kreait\Firebase\Factory;

class PostController extends Controller
{
    
    //line login
    protected $lineService;

    public function __construct(LineService $lineService)
    {
        $this->lineService = $lineService;
    }

    function line(Request $request)
    {
        // $ok = $request->all();
        $code = $request->input("code");
        $state = $request->input("state");
        // $uri = $request->path();
        // $ok = "good!!!";
        // insert
        if(isset($code)){
            FacadesDB::table('line')->insert(
                ['code' => $code,'state' => $state]
            );
        }else{
            FacadesDB::table('line')->insert(
                ['code' => "no data",'state' => "no state"]
            );
        }
        

        // return response()->json(['ok' => 'ok','uri' => $uri], 200);
        // return view('frontend_sna/test');
        
        // return redirect()->route('PostController@line_2');
        return redirect()->action('PostController@line_2', ['code' => $code,'state' => $state]);
        // return view('api.line2');
    }

    function line_2()
    {
        // $curl = curl_init();

        // curl_setopt_array($curl, array(
        //     CURLOPT_URL => "https://api.line.me/oauth2/v2.1/token",
        //     CURLOPT_RETURNTRANSFER => true,
        //     CURLOPT_ENCODING => "",
        //     CURLOPT_MAXREDIRS => 10,
        //     CURLOPT_TIMEOUT => 0,
        //     CURLOPT_FOLLOWLOCATION => true,
        //     CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        //     CURLOPT_CUSTOMREQUEST => "POST",
        //     CURLOPT_POSTFIELDS => "grant_type=authorization_code&code=ecoItkOgL0E4WOuuUJib&redirect_uri=http%3A//sightseeing.nctu.me/api/lineLogin&client_id=1654565142&client_secret=1a9b442ff9b319032d6c31fe490ca67f",
        //     CURLOPT_HTTPHEADER => array(
        //         "Content-Type: application/x-www-form-urlencoded"
        //     ),
        // ));
        // $response = curl_exec($curl);
        // curl_close($curl);
        

        return redirect()->away('http://sightseeing.nctu.me:8080/#/index');
    }

    public function line_3(Request $request)
      { //callback的內容
          try {
              $error = $request->input('error', false);
              if ($error) {
                  throw new Exception($request->all());
              }
              $code = $request->input('code');
            
              $response = $this->lineService->getLineToken($code); 

              // 用id_token取得email內容
              $user_content = $this->lineService->getUserContent($response['id_token']);
              //   echo "<pre>"; print_r($user_content); echo "</pre>";              

              if(isset($code)){
                $factory = (new Factory)->withServiceAccount(__DIR__.'/sna-master-firebase.json');
                $auth = $factory->createAuth();
                
                $email = $user_content['email'];
                $password = $user_content['sub'];
                $name = $user_content['name'];
                $picture = $user_content['picture'];
                // return response()->json(['name' => $name,'picture' => $picture,'email' => $email, 'password' => $password], 200);
                
                // 用createCustomToken登入
                $response = $this->lineService->linefirebasecreate($auth, $password);
                // return $response;
                return response()->json(['name' => $name, 'email' => $email, 'response' => $response, 'password' => $password], 200);

              }else{
                $email = "email not found";
                $password = "password not found";
                $name = "name not found";
                $picture = "picture not found";
                return response()->json(['name' => $name,'picture' => $picture,'email' => $email, 'password' => $password], 200);
              }

          } catch (Exception $ex) {
            Log::error($ex);
          }
      }
    

    function index()
    {
        return view('frontend_sna/test');
    }

    //APi (post資料庫)

    // 取得全部資料
    function apiAll()
    {
        return response()->json(Post::all(), 200);
    }

    // 取得單一文章(use id)
    function apiFindPostById($id)
    {
        return response()->json(Post::find($id), 200);
    }

    // 建立一篇文章(成功回傳ok use json format)
    function apiCreatePost(Request $request)
    {
        $post = new Post;
        $post->title = $request->input('title', '標題');
        $post->body = $request->input('body', '沒有內文。');
        $ok = $post->save();

        return response()->json(['ok' => $ok], 200);
    }

    // 更新一篇文章(成功回傳ok use json format)
    function apiUpdatePostById(Request $request, $id)
    {
        $ok = false;
        $msg = '沒有錯誤碼';

        $post = Post::find($id);
        // 如果找到該id
        if ($post) {
            $post->title = $request->input('title', '我更新了標題');
            $post->body = $request->input('body', '我更新了內文。');
            $ok = $post->save();
            if (!$ok) $msg = '更新失敗，請檢查網路。';
        } else {
            $msg = '找不到該文章!';
        }
        return response()->json(['ok' => $ok, 'msg' => $msg], 200);
    }

    //刪除一篇文章
    function apiDeletePostById($id)
    {
        $rows = Post::destroy($id);
        $ok = ($rows > 0);
        return response()->json(['ok' => $ok], 200);
    }



    // 測試R

    function runR_city(Request $request)
    {

        $id = "台北";
        $n = '"' . $id . '"';

        // 以外部指令的方式呼叫 R 進行繪圖->between_city.html

        $your_command = "Rscript R/site_Betweeness_2020.R $n";
        $process = new Process($your_command);
        $process->run(); // to run Sync

        // executes after the command finishes
        if (!$process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }
        return response()->json(array('output' => $process->getOutput(), 'RhtmlCheck' => 'R/site_Betweeness_2020.R "城市"-> between_city.html。'), 200);
    }
    // 需求分析R圖-成功
    function runR_twoC(Request $request)
    {

        $name = $request->input('name');
        $c1 = $request->input('c1');
        $c20 = $request->input('c20');

        // $temp_d = "台北 博物館 特色博物館";
        $temp_d = "$name $c1 $c20";

        $cc = '"' . $temp_d . '"';

        // 以外部指令的方式呼叫 R 進行繪圖->between_relationship.html
        // window10
        // $your_command = "Rscript R/betweenss_attr_2020.R $cc";
        // $process = new Process($your_command);
        // $process->run(); // to run Sync

        // // executes after the command finishes
        // if (!$process->isSuccessful()) {
        //     throw new ProcessFailedException($process);
        // }
        // $result = $process->getOutput();

        //mac
        $set_charset = 'export LANG=en_US.UTF-8;';
        exec($set_charset . "/usr/local/bin/Rscript R/betweenss_attr_2020.R $cc");

        return response()->json(array(
            'name' => $name,
            'c1' => $c1,
            'c20' => $c20,
            'RhtmlCheck' => 'between_relationship.html。'
        ), 200);
    }
    // 需求分析懶人包(照著site_data.comment 由大排到小)
    function bothCatagory(Request $request)
    {
        $city = $request->input('name');
        $c1 = $request->input('c1');
        $c2 = $request->input('c20');

        $sql = FacadesDB::select("SELECT DISTINCT site_data.id,site_data.name,site_data.city_name,site_data.address,site_data.type,site_data.comment,site_data.rate,site_data.href
            FROM site_relationship, site_data, site_attr
            WHERE (site_relationship.from_id = site_data.id AND site_relationship.to_id = site_attr.id)
            AND site_data.city_name = '$city'
            AND (site_attr.tag = '$c1' OR site_attr.tag = '$c2') GROUP BY site_data.id HAVING COUNT(*) > 1 ORDER BY site_data.comment DESC");

        // $sql =  FacadesDB::table('site_data')
        //     ->selectRaw("DISTINCT site_data.id, site_data.name, site_data.city_name, site_data.type,site_data.completed
        //     FROM site_relationship, site_data, site_attr
        //     WHERE (site_relationship.from_id = site_data.id AND site_relationship.to_id = site_attr.id)
        //     AND site_data.city_name = '$city'
        //     AND (site_attr.tag = '$c1' OR site_attr.tag = '$c2') GROUP BY site_data.id HAVING COUNT(*) > 1")->get();


        return response()->json($sql, 200);

        // 改寫eloquent failed
        // $A = FacadesDB::table('site_relationship')
        //     ->join('site_data', 'site_relationship.from_id', '=', 'site_data.id')
        //     ->join('site_attr', 'site_relationship.to_id', '=', 'site_attr.id')
        //     ->select("site_data.id, site_data.name, site_data.city_name, site_data.type")
        //     ->where(function ($query) {
        //         $query->where(['site_relationship.from_id' => 'site_data.id', 'site_relationship.to_id' => 'site_attr.id']);
        //     })->andWhere(function ($query) {
        //         $query->where(['site_data' => "台北"]);
        //     })->andWhere(function ($query) {
        //         $query->orWhere(['site_attr.tag' => "博物館", 'site_attr.tag' => "古蹟"]);
        //     })->groupBy('site_data.id')->havingRaw('COUNT(*) > ?', [1])->get();
    }
    // 需求分析懶人包2 3(照著site_data.comment 由大排到小)
    function diffCatagory(Request $request)
    {
        $city = $request->input('name');
        $c1 = $request->input('c1');
        $c2 = $request->input('c20');

        // 取(聯集-交集)，傳回含單一tag
        $sql_diff = FacadesDB::select("SELECT DISTINCT site_data.id,site_data.name,site_data.city_name,site_data.address,site_data.type,site_data.comment
        ,site_data.rate,site_data.href,site_attr.tag
        FROM site_relationship, site_data, site_attr
        WHERE (site_relationship.from_id = site_data.id AND site_relationship.to_id = site_attr.id)
        AND site_data.city_name ='$city'
        AND (site_attr.tag = '$c1' OR site_attr.tag = '$c2')
        GROUP BY site_data.id
        HAVING COUNT(*) = 1
        ORDER BY site_data.comment DESC");







        return response()->json($sql_diff, 200);
    }
    // 新api區分懶人包2 3(照著site_data.comment 由大排到小)
    function new_diff(Request $request)
    {
        $city = $request->input('name');
        $c1 = $request->input('c1');
        $c2 = $request->input('c20');

        // 取(聯集-交集)，傳回含單一tag
        $sql_diff = FacadesDB::select("SELECT DISTINCT site_data.id,site_data.name,site_data.city_name,site_data.address,site_data.type,site_data.comment
        ,site_data.rate,site_data.href,site_attr.tag
        FROM site_relationship, site_data, site_attr
        WHERE (site_relationship.from_id = site_data.id AND site_relationship.to_id = site_attr.id)
        AND site_data.city_name ='$city'
        AND (site_attr.tag = '$c1' OR site_attr.tag = '$c2')
        GROUP BY site_data.id
        HAVING COUNT(*) = 1
        ORDER BY site_data.comment DESC");


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





    // site_data API
    // 取所有景點(測試用，有設定量以供測試)
    function site_dataAll()
    {
        $sql = Site_data::where('id', '<', "S0008")->get();
        return response()->json($sql, 200);
    }

    // 輸入景點id->單一景點詳細資訊
    function site_dataById($id)
    {
        $sql = Site_data::find($id);
        return response()->json($sql, 200);
    }
    // 輸入城市->所有景點名稱
    function site_nameById($city)
    {
        $sql = Site_data::select('name')->where('city_name', '=', $city)->get();
        return response()->json($sql, 200);
        // return response()->json(Site_data::find($city_name), 200);
    }


    // 取得所有城市
    function site_dataCityAll()
    {
        $sql = Site_data::select('city_name')->distinct()->get();
        return response()->json($sql, 200);
    }

    // 輸入城市 ->類別名稱給下拉式選單
    function Catagory(Request $request)
    {
        $city = $request->input('name');
        $sql = FacadesDB::select("SELECT DISTINCT site_attr.tag FROM
        ((site_data INNER JOIN site_relationship on site_data.id=site_relationship.from_id)
        INNER JOIN site_attr on site_relationship.to_id=site_attr.id)
        WHERE site_data.city_name = '$city'");

        return response()->json($sql, 200);
    }



    // 偏好分析存取至tag
    function preferTag(Request $request)
    {
        $id = $request->input('site_id');
        $sql = FacadesDB::select("SELECT site_data.id, site_attr.tag FROM site_data, site_relationship, site_attr
        WHERE (site_data.id = site_relationship.from_id and site_relationship.to_id = site_attr.id)
        AND site_data.id = '$id'");

        return response()->json($sql, 200);
    }
}
