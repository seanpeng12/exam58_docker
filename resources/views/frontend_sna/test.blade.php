<!DOCTYPE html>
<html lang="zh-TW">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- datatable會用到 --}}
    <script src=" https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"> </script> {{-- firebase --}}
    <script src="https://www.gstatic.com/firebasejs/6.5.0/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/5.9.1/firebase-auth.js"></script>
    <script src="https://www.gstatic.com/firebasejs/5.5.5/firebase-firestore.js"></script>
    {{-- <script src="//unpkg.com/jquery@3.3.1/dist/jquery.min.js"></script>
  <script src="//raw.githack.com/hnzzmsf/layui-formSelects/master/dist/formSelects-v4.min.js"></script> --}}

    {{-- bootstrap --}}
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css"
        integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">



    {{-- google place style配置 --}}
    <style>
        /* Always set the map height explicitly to define the size of the div
         * element that contains the map. */
        #map {
            height: 100%;
        }

        /* Optional: Makes the sample page fill the window. */
        html,
        body {
            height: 100%;
            margin: 0;
            padding: 0;

            /* 避免navbar擋住 */
            margin-top: 50px;
            font-family: Microsoft JhengHei;

        }
    </style>
    <link type="text/css" rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500">

    <script>
        // Your web app's Firebase configuration
        var firebaseConfig = {
            apiKey: "AIzaSyBC62oZBm9ftF_O0-eO7BPWx52vprEz38Y",
            authDomain: "sna-master.firebaseapp.com",
            databaseURL: "https://sna-master.firebaseio.com",
            projectId: "sna-master",
            storageBucket: "sna-master.appspot.com",
            messagingSenderId: "640892044634",
            appId: "1:640892044634:web:3c3c94c360528786d31f63",
            measurementId: "G-D1PL8FR9EF"
        };

    </script>
</head>

<body>
    {{-- navbar --}}
    <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
        <a class="navbar-brand" href="#">
            <img src="/docs/4.2/assets/brand/bootstrap-solid.svg" width="30" height="30"
                class="d-inline-block align-top" alt="">
            SIGHTSEEING
        </a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Link</a>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        功能選單
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{route('myform')}}">官方首頁</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{route('myform')}}">景點需求分析</a>
                        <a class="dropdown-item" href=" portfolio.html">鄰近景點路徑規劃</a>
                        <a class="dropdown-item" href="portfolio-single.html">景點優缺點分析</a>

                        <a class="dropdown-item" href="#">Something else here</a>
                    </div>

                </li>

                {{-- <li class="nav-item">
                    <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
                </li> --}}

                <li class="nav-item">
                    <button class="btn btn-outline-success" type="button" onclick="test123()">測試</button>
                    <button class="btn btn-outline-success" type="button" onclick="getdata_onlog()">取得資料(log)</button>
                    <button class="btn btn-outline-success" type="button" onclick="updatedata()">更新資料</button>
                    <button class="btn btn-outline-success" type="button" onclick="getdata()">取得資料</button>
                </li>
            </ul>
            <form class="form-inline my-2 my-lg-0">
                <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
            </form>
        </div>
    </nav>

    <div class="container">
        <div class="row">
            <div class="col" style="margin-top:10px">
                <strong>
                    <p class="h1" style="text-align:center;">我的收藏景點</p>
                </strong>
            </div>
        </div>
    </div>

    {{-- card區域 --}}
    <div class="container" style="margin-top:15px">
        <div id="loading" class="text-center">
            <div class="spinner-border" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
            <p class="h3" style="text-align:center;margin-top:10x">載入資料中</p>
        </div>

        <div id="card_append" class="card-columns">
            {{-- 此區填充 --}}


        </div>
    </div>

    {{-- model區域 --}}
    <!-- Button trigger modal on each card 詳細資訊 -->

    <!-- Modal -->
    <div class="modal fade  bd-example-modal-lg" id="model_card" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 id="model_title" class="modal-title" id="exampleModalCenterTitle">放置景點名稱</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div id="model_info" class="modal-body">
                    ....相關城市明子
                </div>
                <div>
                    {{-- <script type="text/javascript" src="{{ URL::asset('js-call-r/index.js') }}"></script> --}}

                    @php
                    //台北
                    $N = "台北";

                    //"台北"
                    $n = '"'.$N.'"';

                    // 以外部指令的方式呼叫 R 進行繪圖->between_city.html
                    // exec("Rscript R/site_Betweeness_2020.R $n", $results);
                    // print_r($results);
                    // // 產生亂數
                    $nocache = rand();

                    if(isset($nocache)){
                    // 功能一
                    $name = "R/between_city.html?$nocache";
                    }


                    @endphp
                    <iframe id="#" width="100%" height="600px" frameBorder="0" scrolling="no"
                        src="{{url($name)}}"></iframe>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">關閉</button>
                    <button type="button" class="btn btn-primary">前往Tripadvisor</button>
                </div>
            </div>
        </div>
    </div>



    {{-- 原始設定 card desk --}}
    {{-- <div class="container">
        <div class="row">
            <div class="col" style="margin-top:10px">
                <p class="h1" style="text-align:center">原始設定</p>
            </div>
        </div>
    </div>
    <div class="container">
        <!-- Content here -->
        <div class="card" id="card_desk">
            <div class="col mb-3">
                <div class="card mb-3">
                    <img src="images/person_1.jpg" class="card-img-top  img-fluid" alt="...">
                    <div class="card-body">
                        <h5 class="card-title"> 鐵砧山風景區</h5>
                        <p class="card-text">台中 宗教聖地 景觀徒步區.</p>
                    </div>
                    <div class="card-footer">
                        <small class="text-muted">Last updated 2020/3/4 下午3:53:07</small>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}


    {{-- 測試firebase/datatable --}}
    {{-- <div>
        <p><b>我的最愛</b></p>
    </div> --}}


    {{-- 測試datatable --}}
    {{-- <table id="myDataTalbe" class="display">
        <thead>
            <!--必填-->

            <tr>
                <th>加入最愛時間</th>
                <th>景點名稱</th>
                <th>城市</th>
                <th>類別1</th>
                <th>類別2</th>
                <th>動作</th>
            </tr>
        </thead>
        <tbody id="tbody">
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td>載入中..</td>
                <td></td>
                <td></td>
            </tr>

        </tbody>
    </table> --}}


    {{-- <script type="text/javascript">
        $(function () {

            $("#myDataTalbe").DataTable({
                searching: false, //關閉filter功能
                columnDefs: [{
                    targets: [3],
                    orderable: false,
                }]
            });
        });

    </script> --}}



    {{-- 測試firebase --}}
    {{-- 原本的ajax script位置 --}}
    <script>
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


        const db = firebase.firestore();
        const settings = {
            /* your settings... */
            timestampsInSnapshots: true
        };
        db.settings(settings);
        getdata();
        // var db = firebase.firestore();

        function test123() {
            // db.collection("喜好項目").doc("喜歡的地點").set({
            //     name: "行天宮",
            //     date: "202002",
            //     desctiption: "本劇改編自阿瑟·柯南·道爾爵士家喻戶曉的推理小說，一位脾氣古怪的大偵探在現代倫敦的街頭悄悄巡行，四處搜尋線索。",
            //     actors: ["班尼迪克·康柏拜區", "馬丁·費曼"]
            // });
            // console.log("傳資料");

        }


        function getdata() {
            var index = 1;
            var lastIndex = 0;
            var htmls = [];
            var htmls_noData = [];
            var htmls_card = [];
            var htmls_model = [];

            var doc = [];

            var docRef = db.collection("喜歡的地點");
            // 根據date排序



            docRef = docRef.orderBy("date");

            docRef.get().then(function (querySnapshot) {
                if (querySnapshot.empty) {
                    // htmls_noData.push('<tr>\
                    //             <td>' + '</td>\
                    //             <td>' + '</td>\
                    //             <td>' + '</td>\
                    //             <td>' + "無資料" + '</td>\
                    //             <td>' + '</td>\
                    //             <td>' + '</td>\
                    //         </tr>');
                    // $('#tbody').html(htmls_noData);

                    // 無資料時提示
                    // htmls_noData.push('<div class="row">\
                    //                 <div class="col" style="margin-top:10px">\
                    //                     <p class="h3" style="text-align:center;font-family: Microsoft JhengHei;">無資料</p>\
                    //                 </div>\
                    //             </div>');

                    htmls_noData.push('\
                                    <div class="card">\
                                    <img src="images/person_1.jpg" class="card-img-top" alt="...">\
                                    <div class="card-body">\
                                        <h5 class="card-title">這邊是地名(測試，之後請改無資料頁面)</h5>\
                                        <p class="card-text"></p>\
                                        <a href="#" id="thisIsidforlike" onclick="delete_button()" class="delete_like btn btn-primary">取消收藏</a>\
                                        <a href="#" id="thisIsidformodel" data-toggle="modal" data-target="#model_card"\
                                            class="btn btn-outline-success">詳細資訊</a>\
                                    </div>\
                                    <div class="card-footer">\
                                        <small class="text-muted">加入時間xxxxxx</small>\
                                    </div>\
                                </div>');

                    $("#loading").html(htmls_noData);

                    // 無資料清空loading按鈕(上一筆資料清除更新)
                    $("#card_append").html('');

                } else {
                    querySnapshot.forEach(function (doc) {
                        // doc.data() is never undefined for query doc snapshots
                        console.log(doc.id, " => ", doc.data().desctiption);
                        if (doc.exists && name !== undefined) {
                            // console.log(doc.id, doc.data());
                            lastIndex += index;
                            console.log("計次：" + lastIndex);

                            // htmls.push('<tr>\
                            //     <td>' + doc.data().date + '</td>\
                            //     <td>' + doc.data().desctiption + '</td>\
                            //     <td>' + doc.data().city + '</td>\
                            //     <td>' + doc.data().catagory_1 + '</td>\
                            //     <td>' + doc.data().catagory_2 + '</td>\
                            //     <td><button>修改最愛</button>\
                            //         <button id=' + doc.id + ' onclick="delete_button()">刪除最愛</button>\
                            // </tr>');


                            // $('#tbody').html(htmls);

                            //測試可入資料card(成功)

                            htmls_card.push('<div class="card">\
                                <img src="images/person_1.jpg" class="card-img-top" alt="...">\
                                <div class="card-body">\
                                    <h5 class="card-title">' + doc.data().desctiption + '</h5>\
                                    <p class="card-text">' + doc.data().city + ' ' + doc.data().catagory_1 + ' ' + doc
                                .data().catagory_2 + '</p>\
                                    <a href="#" id=' + doc.id + ' onclick="delete_button()" class="delete_like btn btn-primary">取消收藏</a>\
                                    <a href="#" id=' + doc.id + ' onclick="model_button()" data-toggle="modal" data-target="#model_card" class="card_info btn btn-outline-success">詳細資訊</a>\
                                </div>\
                                <div class="card-footer">\
                                    <small class="text-muted">加入時間 ' + doc.data().date + '</small>\
                                </div>\
                            </div>');

                            $("#card_append").html(htmls_card);

                            $('#loading').html("");



                        };
                    }); //
                };
                // querySnapshot catch error
            }).catch(function (error) {
                console.log("Error getting documents: ", error);
            });



            // log 資料讀取狀態
            docRef.onSnapshot(querySnapshot => {
                let changes = querySnapshot.docChanges();
                for (let change of changes) {
                    console.log(`資料動態：A document was ${change.type}.`);
                }
            });

        }

        // 用來辨識抓到onclick是否為該id
        var id_delete = "";

        function delete_button() {

            // if the delete_like are added after the page load (i.e. by clicking a button)
            // you need to use event delegation by using jquery .on().

            // Event delegation allows us to attach a single event listener, to a parent element, that
            // will fire for all descendants matching a selector, whether those descendants exist now
            //or are added in the future.

            $(document).on('click', '.delete_like', function () {
                id_delete = $(this).attr('id');
                console.log("已刪除ID: " + id_delete + " 的資料");

                deletedata(id_delete);

                //重整頁面
                getdata();
            });
            // document.body.onclick = function (event) { //抓到刪除 id(此方法會抓到所有click，不推薦)
            //     id_delete = event.target.id;
            //     console.log("已刪除ID: " + id_delete + " 的資料");

            //     deletedata(id_delete);

            //     //重整頁面
            //     getdata();
            // }
        };

        // 詳細資訊按鈕事件
        find_id = "";

        function model_button() {
            $(document).on('click', '.card_info', function () {
                find_id = $(this).attr('id');
                console.log("正在搜尋: " + find_id + " 的資料");
                // 找到此id的data
                var docRef = db.collection("喜歡的地點").doc(find_id);

                docRef.get().then(function (doc) {
                    if (doc.exists) {
                        console.log("Document data:", doc.data());
                        $('#model_title').html(doc.data().desctiption);
                        $('#model_info').html('<p>地點：' + doc.data().city + '</p> ' + '<p>類別：' + doc
                            .data().catagory_1 + ' ' + doc
                            .data().catagory_2 + '</p>');

                    } else {
                        // doc.data() will be undefined in this case
                        console.log("無此資料!");
                    }
                }).catch(function (error) {
                    console.log("Error getting document:", error);
                });

            });



    }



    function deletedata(id_delete) {
    var id = id_delete;
    //doc文件內資料清空
    // db.collection("喜歡的地點").doc(id).set({});
    //doc整個刪除
    db.collection("喜歡的地點").doc(id).delete();
    }


    function getdata_onlog() {
    var docRef = db.collection("喜歡的地點");


    docRef.get().then(querySnapshot => {
    querySnapshot.forEach(function (doc) {
    if (doc.exists) {
    console.log(doc.id, doc.data());
    } else {
    console.log("找不到文件");
    }
    });
    });
    // 網路
    // var ref = db.collection('fruit');
    // ref.get().then(querySnapshot => {
    // querySnapshot.forEach(doc => {
    // console.log(doc.id, doc.data());
    // });
    // });

    // 原始myself
    // docRef.get().then(function(doc) {
    // if (doc.exists) {
    // console.log(doc.data());
    // } else {
    // console.log("找不到文件");
    // }
    // }).catch(function(error) {
    // console.log("提取文件時出錯:", error);
    // });
    }

    function updatedata() {
    db.collection("喜好項目").doc("新世紀福爾摩斯").set({
    date: "1000",
    });
    }

    </script>


    {{-- vue測試 --}}
    {{-- <div>
        答案是
        <example-Component>
            <div id="app">
                @{{ message }}
    </div>

    <div id="app">
        @{{ state }}
    </div>
    </example-component>
    </div> --}}




    <div>


        <body>
            <div id="locationField">
                <input id="autocomplete" placeholder="Enter your address" onFocus="geolocate()" type="text" />
            </div>

            <!-- Note: The address components in this sample are typical. You might need to adjust them for
               the locations relevant to your app. For more information, see
         https://developers.google.com/maps/documentation/javascript/examples/places-autocomplete-addressform
    -->

            <table id="address">
                <tr>
                    <td class="label">Street address</td>
                    <td class="slimField"><input class="field" id="street_number" disabled="true" /></td>
                    <td class="wideField" colspan="2"><input class="field" id="route" disabled="true" /></td>
                </tr>
                <tr>
                    <td class="label">City</td>
                    <td class="wideField" colspan="3"><input class="field" id="locality" disabled="true" /></td>
                </tr>
                <tr>
                    <td class="label">State</td>
                    <td class="slimField"><input class="field" id="administrative_area_level_1" disabled="true" /></td>
                    <td class="label">Zip code</td>
                    <td class="wideField"><input class="field" id="postal_code" disabled="true" /></td>
                </tr>
                <tr>
                    <td class="label">Country</td>
                    <td class="wideField" colspan="3"><input class="field" id="country" disabled="true" /></td>
                </tr>
            </table>

            <script>
                // This sample uses the Autocomplete widget to help the user select a
                // place, then it retrieves the address components associated with that
                // place, and then it populates the form fields with those details.
                // This sample requires the Places library. Include the libraries=places
                // parameter when you first load the API. For example:
                // <script
                // src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDkS6nBwtRIUe55-p_oHZh6QocvIyUAG2A&libraries=places">

                var placeSearch, autocomplete;

                var componentForm = {
                    street_number: 'short_name',
                    route: 'long_name',
                    locality: 'long_name',
                    administrative_area_level_1: 'short_name',
                    country: 'long_name',
                    postal_code: 'short_name'
                };

                function initAutocomplete() {
                    // Create the autocomplete object, restricting the search predictions to
                    // geographical location types.
                    autocomplete = new google.maps.places.Autocomplete(
                        document.getElementById('autocomplete'), {
                            types: ['geocode']
                        });

                    // Avoid paying for data that you don't need by restricting the set of
                    // place fields that are returned to just the address components.
                    autocomplete.setFields(['address_component']);

                    // When the user selects an address from the drop-down, populate the
                    // address fields in the form.
                    autocomplete.addListener('place_changed', fillInAddress);
                }

                function fillInAddress() {
                    // Get the place details from the autocomplete object.
                    var place = autocomplete.getPlace();

                    for (var component in componentForm) {
                        document.getElementById(component).value = '';
                        document.getElementById(component).disabled = false;
                    }

                    // Get each component of the address from the place details,
                    // and then fill-in the corresponding field on the form.
                    for (var i = 0; i < place.address_components.length; i++) {
                        var addressType = place.address_components[i].types[0];
                        if (componentForm[addressType]) {
                            var val = place.address_components[i][componentForm[addressType]];
                            document.getElementById(addressType).value = val;
                        }
                    }
                }

                // Bias the autocomplete object to the user's geographical location,
                // as supplied by the browser's 'navigator.geolocation' object.
                function geolocate() {
                    if (navigator.geolocation) {
                        navigator.geolocation.getCurrentPosition(function (position) {
                            var geolocation = {
                                lat: position.coords.latitude,
                                lng: position.coords.longitude
                            };
                            var circle = new google.maps.Circle({
                                center: geolocation,
                                radius: position.coords.accuracy
                            });
                            autocomplete.setBounds(circle.getBounds());
                        });
                    }
                }

            </script>
            {{-- google place api --}}
            <script
                src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDkS6nBwtRIUe55-p_oHZh6QocvIyUAG2A&libraries=places&callback=initAutocomplete"
                async defer></script>


            <!--引用jQuery-->
            <script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.js"></script>
            <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet" />
            <!--引用dataTables.js-->
            <script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js">
            </script>

            <!-- Optional JavaScript -->
            <!-- jQuery first, then Popper.js, then Bootstrap JS -->
            {{-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
                integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
                crossorigin="anonymous">
            </script> --}}
            <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"
                integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut"
                crossorigin="anonymous">
            </script>
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"
                integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k"
                crossorigin="anonymous">
            </script>


    </div>



    <div id="newapp">


        <div class="container">
            <div class="row">
                <div class="col" style="margin-top:10px">
                    <strong>
                        <p class="h1" style="text-align:center;">我的測試資料(POST)</p>
                    </strong>
                </div>
            </div>
        </div>

        <example-component></example-component>

        <hr>

        <input type="text" v-model="message">
        <p>@{{ message }}</p>
        <h1>@{{ content }}</h1>

        <p v-if="content_1">print if content is true</p>
        <p v-else-if="type == 'a'">a</p>
        <p v-else-if="type == 'b'">b</p>
        <p v-else>content is false</p>
        <li v-for="(item, index) in lst">
            @{{index}} -- @{{item.text}}
        </li>

        <li v-for="(key, value, index) in lst2">
            @{{key}} @{{value}} @{{index}}
        </li>

    </div>

    <div id="test">

    </div>

</body>
{{-- 引入vue.js --}}
<script type="text/javascript" src="{{ asset('js/app.js') }}"></script>
{{-- <script type="text/javascript" src="{{ asset('js/new.js') }}"></script> --}}

</html>
