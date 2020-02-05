{{-- <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body> --}}
{{-- @section('title', 'services') --}}
@extends('frontend_sna.layouts.master')

@section('db_2')
<?php
    
    
    try {
        $dbh = new PDO(
            'mysql:host=localhost;dbname=homestead',
            'root',
            'newpasswordd'
        );
        $dbh->exec("set names utf8");
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $dbh->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
    } catch (PDOException $exception) {
        die("Something wrong: {$exception->getMessage()}");
    }
?>
@endsection



@section('decision_input')
@if (isset($A))
{{-- {{$A}}<br /> --}}
@endif

@if (isset($B))
{{-- {!! $B."<br />" !!} --}}
@endif

@if (isset($C))
{{-- {!! $C."<br />" !!} --}}
@endif

@if (isset($D))
{{-- @dump($C) --}}
@foreach ($D as $e)
{{-- {!! $e."<br />" !!} --}}
@endforeach
@endif
@endsection

@section('toR')
@php
//台北
$N = $A;

//"台北"
$n = '"'.$N.'"';

// 以外部指令的方式呼叫 R 進行繪圖->between.html
exec("Rscript R/site_Betweeness.R $n", $results);
// print_r($results);
// // 產生亂數
$nocache = rand();

@endphp

@php

//台北
$city = $A;
$N2 = $B;
$N3 = $C;
//"台北"
$temp = "$city $N2 $N3";
$cc = '"'.$temp.'"';

// 以外部指令的方式呼叫 R 進行繪圖->between2.html
exec("Rscript R/new_Betweeness_2.R $cc");

$nocache_2 = rand();

@endphp
@endsection

@section('rand')
@php
//$name = public_path("between.html");
if(isset($nocache)){
// 功能一
$name = "R/between.html?$nocache";
}
if(isset($nocache_2)){
// 功能二
$name2 = "R/between2.html?$nocache_2";
}

@endphp
@endsection

@section('content')
{{-- 模板 --}}
<section class="flexslider">
    <ul class="slides">

        <li style="background-image: url(images/slider_2.jpg)" class="overlay">
            <div class="container h-10">
                <div class="row">
                    <div class="col-md-8 col-md-offset-2">
                        <div class="probootstrap-slider-text text-center">
                            <h1 class="probootstrap-heading">{{$A}}的景點</h1>
                            <p class="probootstrap-subheading">景點與類型關聯分析
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </li>
    </ul>
</section>

<section class="probootstrap-section probootstrap-bg-gray">
    <div class="container">
        <div class="row">
            <div class="col-md-6 probootstrap-animate" data-animate-effect="fadeIn">
                <div class="container box"></div>
                <div class="form-group">

                    @yield('decision_input')
                    {{-- ajax後台 --}}
                    {{-- @yield('ajax_back') --}}

                    @yield('toR')
                    {{-- 執行R語言讀取資料庫 (功能一\二)--}}
                    {{-- @yield('Rtest')
                                @yield('R_between') --}}

                    @yield('rand')
                    {{-- 產生亂數(避免重複檔名無法覆蓋問題)--}}

                    {{-- 摺疊 --}}
                    <div>
                        <div class="panel-group" id="accordion">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                                            <p>
                                                <h1 style="font-family: Microsoft JhengHei;">{{$A}}的景點關聯圖</h1>
                                            </p>
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapseOne" class="panel-collapse collapse in">
                                    <div class="panel-body">
                                        <iframe width="100%" height="600px" frameBorder="0" scrolling="no"
                                            style="align:center" src="{{url($name)}}"></iframe>
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
                                            <p>
                                                <h1 style="font-family: Microsoft JhengHei;">{{$B}}/{{$C}}</h1>
                                            </p>
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapseTwo" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        <iframe id="frame2" width="100%" height="600px" frameBorder="0" scrolling="no"
                                            src="{{url($name2)}}"></iframe>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- 結束摺疊 --}}


                    {{-- 讀取產生的網頁 --}}


                </div>
                <div class="form-group">
                    <?php
                    $curl = curl_init();
                    
                    curl_setopt_array($curl, array(
                      CURLOPT_URL => "https://maps.googleapis.com/maps/api/place/findplacefromtext/json?input=%E5%8F%B0%E5%A4%A7%E9%AB%94%E8%82%B2%E9%A4%A8&inputtype=textquery&fields=photos,formatted_address,name,rating,opening_hours,geometry&key=AIzaSyDkS6nBwtRIUe55-p_oHZh6QocvIyUAG2A",
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
                    echo '<pre>';
                    
                    print_r($response);
                    echo '</pre>';

                    
                    function debug_to_console($response) {
                    $output = $response;
                    if (is_array($output))
                    $output = implode(',', $output);
                    
                    echo "<script>
                        console.log('Debug Objects: " . $output . "' );
                    </script>";
                    }
                    
                    ?>

                    <script type="text/javascript"
                        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDkS6nBwtRIUe55-p_oHZh6QocvIyUAG2A&libraries=places">
                    </script>

                    <script type="text/javascript">
                        $(document).ready(function () {

                            
                            var settings = {
                            "url":
                            "https://maps.googleapis.com/maps/api/place/findplacefromtext/json?input=輔大露易莎&inputtype=textquery&fields=photos,formatted_address,name,rating,opening_hours,geometry&key=AIzaSyDkS6nBwtRIUe55-p_oHZh6QocvIyUAG2A",
                            "method": "GET",
                            "timeout": 0,
                            };
                            
                            $.ajax(settings).done(function (response) {
                            console.log(response);
                            });
                            
                            // if($('#collapseOne').find('.aria-expanded').length){
                            //     $('#collapseOne').on('click' function() {
                            //         var $ee = $('#collapseOne').find('.aria-expanded').html();
                            //         console.log($ee);
                            //     // $( ".aria-expanded" ).change(function() {
                            //     // alert( "alter." );
                            //     // });
                            //     });
                                
                            //     $('#collapseTwo').on('click' function() {
                            //         var $ee2 = $('#collapseTwo').find('.aria-expanded').html();
                            //         console.log($ee2);
                            //     });
                            // }else{
                            //     console.log("not found!");
                            // }

                            //無法自動觸發click! 
                            $('#frame2').contents().find('#graphhtmlwidget-b414b4c4d83797c3e0b3').trigger("click");
                            // window.οnlοad=xieyi;
                            
                            //iframe非同步偵測click
                            var existCondition = setInterval(function () {

                                if ($('#frame2').contents().find('div.vis-tooltip').length) {
                                
                                    console.log("已經出現tooltip!");
                                    clearInterval(existCondition);

                                    var f2 = document.getElementById("frame2");
                                    var iwindow = f2.contentWindow;//取得物件(使用contentwindow) 
                                    var idoc = iwindow.document;//取得程式碼(使用contentwindow)


                                    
                                    $('#frame2').contents().find('#graphhtmlwidget-b414b4c4d83797c3e0b3').on('click', function () {
                                        // html純文字解析
                                        var $test = $('#frame2').contents().find('#graphhtmlwidget-b414b4c4d83797c3e0b3').find('p').html();

                                        //加到console上
                                        console.log($test);
                                        


                                        // var my_var = "php echo $herf_get; ";

                                        // $("#herf_1").html(my_var);


                                        // $('#frame_site').prepend($test);
                                        // $("#frame_site").text($test);
                                        $("#frame_site").html("<b>"+$test+"</b>");
                                        
                                        // console.log("test",idoc);
                                        // console.log($('#frame2').contents().find('test').html());

                                    });
                            
                                } else {
                                    console.log("尚未出現tooltip!");
                                }


                            }, 500); // check every 500ms
                        });
                    </script>

                </div>
                <div class="form-group">

                </div>
                <div class="form-group">


                </div>


                @yield('db_2')
                <?php
                    $result = $dbh->prepare("SELECT href FROM `site_data` WHERE name='萬春宮 Wanchungong';");
                    $result->execute();
                    $lst = $result->fetchAll();
                ?>



            </div>
            <div class="col-md-6 col-md-push-1 probootstrap-animate" data-animate-effect="fadeIn"
                style="font-family: Microsoft JhengHei;">
                <h2>左側為
                    <b>{{$A}}</b>的景點關聯圖，您可以點選類別景點查看相關資訊
                </h2>
                {{-- jquery catch value!!! --}}


                <h2 id="frame_site"><b>請先點選景點</b></h2>
                <h4>景點所屬類別</h4>
                <ul class="probootstrap-contact-info">
                    <li><i class="icon-pin"></i> <span>{{$B}}類別</span></li>
                    <li><i class="icon-email"></i><span>{{$C}}類別</span></li>
                </ul>

                <h4>景點內容</h4>

                <div>在台灣區域，景點有其所屬的類別提供使用者分析
                    使用者可以分析他們對旅遊的需求。
                    <h4>網址：</h4>
                    <ul class="probootstrap-contact-info">
                        <li><i class="icon-pin"></i> <span>網址一</span></li>
                        <li><i class="icon-email"></i> <span id="herf_1"></span></li>
                    </ul>
                </div>


            </div>
        </div>
    </div>
</section>

{{-- end 模板 --}}





{{-- 

</body>

</html> --}}




@endsection