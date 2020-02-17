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

// 以外部指令的方式呼叫 R 進行繪圖->between_city.html
// exec("Rscript R/site_Betweeness_2020.R $n", $results);
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
$temp_d = "$city $N2 $N3";
$cc = '"'.$temp_d.'"';

// 以外部指令的方式呼叫 R 進行繪圖->between_relationship.html
// exec("Rscript R/betweenss_attr_2020.R $cc");

$nocache_2 = rand();

@endphp
@endsection

@section('rand')
@php
//$name = public_path("between_city.html");
if(isset($nocache)){
// 功能一
$name = "R/between_city.html?$nocache";
}
if(isset($nocache_2)){
// 功能二
$name2 = "R/between_relationship.html?$nocache_2";
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
        {{-- row1 --}}
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
                                                <h1 style="font-family: Microsoft JhengHei;">{{$B}}/{{$C}}</h1>
                                            </p>
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapseOne" class="panel-collapse collapse in">
                                    <div class="panel-body">
                                        <iframe id="frame2" width="100%" height="600px" frameBorder="0" scrolling="no"
                                            src="{{url($name2)}}"></iframe>
                                    </div>
                                </div>
                            </div>

                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
                                            <p>
                                                <h1 style="font-family: Microsoft JhengHei;">{{$A}} 景點</h1>
                                            </p>
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapseTwo" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        <iframe width="100%" height="600px" frameBorder="0" scrolling="no"
                                            style="align:center" src="{{url($name)}}"></iframe>
                                    </div>
                                </div>
                            </div>

                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
                                            <p>
                                                <h1>串API</h1>
                                            </p>
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapseOne" class="panel-collapse collapse in">
                                    <div class="panel-body">
                                        <p>
                                            <?php
                                            //初始化
                                            $curl = curl_init();
                                            //設定屬性值
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
                                            // 執行
                                            $response = curl_exec($curl);
                                            $data_json = json_decode(file_get_contents('php://input'), true);
                                            echo "<script>console.log('Debug Objects: " . $data_json . "' );</script>";
                                            // 退出關閉
                                            curl_close($curl);


                                            echo '<pre>';
                                            print_r($response);
                                            echo '</pre>';

                                            ?>

                                            <script>
                                                var settings = {
                                                    "url": "https://maps.googleapis.com/maps/api/place/findplacefromtext/json?input=輔仁大學&inputtype=textquery&fields=photos,formatted_address,name,rating,opening_hours,geometry&key=AIzaSyDkS6nBwtRIUe55-p_oHZh6QocvIyUAG2A",
                                                    "method": "GET",
                                                    "timeout": 0,
                                                };

                                                $.ajax(settings).done(function (response) {
                                                    console.log("回答是："+response);
                                                });



                                                // function insert() {
                                                //     var title = $("#title_1").val();
                                                //     var url = $("#url_1").val();
                                                //     $('#success').html('傳送中..');

                                                //     $.ajax({
                                                //         headers: {
                                                //                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                                //         },
                                                //         type: "POST",//方法
                                                //         url: "/ajax2/new" ,//表單接收url
                                                //         data: {
                                                //             title:title, url:url, '_token': $('meta[name="csrf-token"]').attr('content'),
                                                //         },
                                                //         success: function (result) {
                                                //             //提交成功的提示詞或者其他反饋程式碼
                                                //             console.log(result);
                                                //             $('#success').html(result.msg);
                                                //             $('#success').html(result.title);
                                                //             $('#success').html(result.url);
                                                //             var result=document.getElementById("success");
                                                //             result.innerHTML="<h2>新增資料成功!</h2>";
                                                //             // to firebase
                                                //             create();
                                                //         },
                                                //         error : function() {
                                                //             //提交失敗的提示詞或者其他反饋程式碼
                                                //             var result=document.getElementById("success");
                                                //             result.innerHTML="傳輸失敗!";
                                                //         }
                                                //     });
                                                // }
                                            </script>
                                        </p>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- 結束摺疊 --}}


                    {{-- 讀取產生的網頁 --}}


                </div>
                <div class="form-group">


                    <script type="text/javascript"
                        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDkS6nBwtRIUe55-p_oHZh6QocvIyUAG2A&libraries=places">
                    </script>

                    <script type="text/javascript">
                        $(document).ready(function () {

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
                            $('#frame2').contents().find('[id^="graphhtmlwidget"]').trigger("click");
                            // window.οnlοad=xieyi;

                            //iframe非同步偵測click
                            var existCondition = setInterval(function () {

                                if ($('#frame2').contents().find('div.vis-tooltip').length) {

                                    console.log("已經出現tooltip!");
                                    clearInterval(existCondition);

                                    var f2 = document.getElementById("frame2");
                                    var iwindow = f2.contentWindow;//取得物件(使用contentwindow)
                                    var idoc = iwindow.document;//取得程式碼(使用contentwindow)



                                    $('#frame2').contents().find('[id^="graphhtmlwidget"]').on('click', function () {
                                        // html純文字解析
                                        var $test = $('#frame2').contents().find('[id^="graphhtmlwidget"]').find('p').html();

                                        //加到console上
                                        console.log("點按tooltip區域");
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
                    </ul>
                </div>

                <h4>儲存該景點</h4>

                <div>您點選的景點
                    <h2 id="frame_site"><b>請先點選景點</b></h2>
                    <form id="form1" onsubmit="return false" action="##" method="post">
                        <ul class="probootstrap-contact-info">
                            <li><i class="icon-pin"></i>請輸入title <input name="title_1" id="title_1" type="text" /></li>
                            <li><i class="icon-email"></i>請輸入url <input name="url_1" id="url_1" type="text" /></li>
                            <p><input type="button" value="建立喜好項目" onclick="insert()"></p>
                            <p>
                                <div id="success"></div>
                            </p>
                        </ul>
                    </form>
                </div>


            </div>

            <div>

                {{-- <div id="form-div">
                    <form id="form1" onsubmit="return false" action="##" method="post">
                        <p><input name="title_1" id="title_1" type="text" />請輸入title</p>
                        <p><input name="url_1" id="url_1" type="text" />請輸入url</p>
                        <p><input type="button" value="插入" onclick="insert()"></p>
                        <p>
                            <div id="success"></div>
                        </p>
                    </form>
                </div> --}}

                <div>
                    {{-- ajax部分 --}}
                    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

                    {{-- firestore引入 --}}
                    <!-- Insert these scripts at the bottom of the HTML, but before you use any Firebase services -->

                    <!-- Firebase App (the core Firebase SDK) is always required and must be listed first -->
                    <script src="https://www.gstatic.com/firebasejs/6.2.0/firebase-app.js"></script>

                    <!-- Add Firebase products that you want to use -->
                    <script src="https://www.gstatic.com/firebasejs/6.2.0/firebase-auth.js"></script>
                    <script src="https://www.gstatic.com/firebasejs/6.2.0/firebase-firestore.js"></script>





                    <script type="text/javascript">
                        // Your web app's Firebase configuration
                        var firebaseConfig = {
                                apiKey: "AIzaSyB2XfJ2AwM1FiciKO23zexRNIqTj284Dtw",
                                authDomain: "laravel-crud-seanpeng12.firebaseapp.com",
                                databaseURL: "https://laravel-crud-seanpeng12.firebaseio.com",
                                projectId: "laravel-crud-seanpeng12",
                                storageBucket: "laravel-crud-seanpeng12.appspot.com",
                                messagingSenderId: "44144922525",
                                appId: "1:44144922525:web:cb45a36fe77e7509ca6974",
                                measurementId: "G-HES2RGKZYZ"
                        };
                        // Initialize Firebase
                        firebase.initializeApp(firebaseConfig);
                        // firebase.analytics();
                        var db = firebase.firestore();

                        function create() {
                            // 產生現在時間
                            var Today = new Date();
                            var time = Today.toLocaleString();
                            // 找到文字

                            var name_place = $('#frame2').contents().find('[id^="graphhtmlwidget"]').find('p').html();
                            console.log(name_place);
                            //新增資料庫
                            db.collection("喜歡的地點").add({
                                name: name_place,
                                date: time,
                                desctiption: name_place,
                            });
                            // console.log("傳資料");
                        }

                        //ajax input data(success)
                        function insert() {
                            var title = $("#title_1").val();
                            var url = $("#url_1").val();
                            $('#success').html('傳送中..');

                            $.ajax({
                                headers: {
                                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                },
                                type: "POST",//方法
                                url: "/ajax2/new" ,//表單接收url
                                data: {
                                    title:title, url:url, '_token': $('meta[name="csrf-token"]').attr('content'),

                                },
                                success: function (result) {
                                    //提交成功的提示詞或者其他反饋程式碼
                                    console.log(result);
                                    $('#success').html(result.msg);
                                    $('#success').html(result.title);
                                    $('#success').html(result.url);
                                    var result=document.getElementById("success");
                                    result.innerHTML="<h2>新增資料成功!</h2>";
                                    // to firebase
                                    create();
                                },
                                error : function() {
                                    //提交失敗的提示詞或者其他反饋程式碼
                                    var result=document.getElementById("success");
                                    result.innerHTML="傳輸失敗!";
                                }
                            });
                        }



                    </script>
                </div>

            </div>

        </div>
        {{-- row2 --}}
        <div class="row">
            <div class="col-sm-4 panel-item">
                <div class="box">
                    <div class="box-heading">
                        <img src="images/food_bread.jpg">
                    </div>
                    <div class="box-body">
                        <h3>Bread</h3>
                        <p>Li Europan lingues es membres del sam familie. Lor separat existentie es un myth. Por
                            scientie, musica, sport etc, litot Europa usa li sam vocabular. Li lingues differe solmen in
                            li grammatica, li pro</p>
                    </div>
                </div>
            </div>
            <div class="col-sm-4 panel-item">
                <div class="box">
                    <div class="box-heading">
                        <img src="images/food_coffee_beans.jpg">
                    </div>
                    <div class="box-body">
                        <h3>Coffee Beans</h3>
                        <p>The European languages are members of the same family. Their separate existence is a myth.
                            For science, music, sport, etc, Europe uses the same vocabulary. The languages only differ
                            in their grammar.</p>
                    </div>
                </div>
            </div>
            <div class="col-sm-4 panel-item">
                <div class="box">
                    <div class="box-heading">
                        <img src="images/food_strawberry.jpg">
                    </div>
                    <div class="box-body">
                        <h3>Strawberry</h3>
                        <p>A wonderful serenity has taken possession of my entire soul, like these sweet mornings of
                            spring which I enjoy with my whole heart. I am alone, and feel the charm of existence in
                            this spot, which was.</p>
                    </div>
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
