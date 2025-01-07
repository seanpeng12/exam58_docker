@extends('frontend_sna.layouts.master')

{{-- @section('title', 'services') --}}


@section('firebase')
{{-- firestore引入 --}}
<!-- Insert these scripts at the bottom of the HTML, but before you use any Firebase services -->

<!-- Firebase App (the core Firebase SDK) is always required and must be listed first -->
<script src="https://www.gstatic.com/firebasejs/6.2.0/firebase-app.js"></script>

<!-- Add Firebase products that you want to use -->
<script src="https://www.gstatic.com/firebasejs/6.2.0/firebase-auth.js"></script>
<script src="https://www.gstatic.com/firebasejs/6.2.0/firebase-firestore.js"></script>

@endsection


@section('dataTables')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.css">

<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.js"></script>
@endsection


@section('content')




<section class="probootstrap-section probootstrap-bg-gray">
    <div class="container">
        <div class="row">
            <div class="col-md-6 probootstrap-animate" data-animate-effect="fadeIn">

                <form action="{{ url("/deal") }}" method="post">
                    @csrf
                    <div class="container box"></div>
                    <div class="form-group">

                        <select name="country" id="country"
                            class="form-control input-lg custom-select custom-select-lg mb-3 dynamic"
                            data-dependent="tag" required>
                            <option value="">請選擇城市</option>
                            {{-- database country --}}
                            @foreach ($country_list as $country)
                            <option value="{{$country->city_name}}">{{$country->city_name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">

                        <select name="tag" id="tag" class="form-control input-lg custom-select custom-select-lg mb-3"
                            data-dependent="tag2" required>
                            {{-- Ajax --}}
                            <option value="">請先選擇城市</option>
                        </select>
                    </div>

                    <div class="form-group">

                        <select name="tag2" id="tag2" class="form-control input-lg custom-select custom-select-lg mb-3"
                            required>
                            {{-- Ajax --}}
                            <option value="">請先選擇城市</option>
                        </select>
                    </div>

                    <div class="form-group">

                        {{-- <select name="tag3[]" id="tag3" class="form-control input-lg" multiple="mutiple">
                <option value="none">請先選擇城市 測試傳送數值</option>
                <option value="1">1</option>
                <option value="33">33</option>
                <option value="5555">5555</option>
                <option value="12">12</option>
                <option value="24">24</option>
                <option value="48">48</option>
            </select> --}}
                    </div>

                    <div>

                        <button class="btn btn-primary btn-lg btn-block" type="submit">確認</button>
                    </div>
                </form>
                {{-- ajax部分 --}}
                {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script> --}}

                <script type="text/javascript">
                    $(document).ready(function () {

                        $('.dynamic').change(function () {
                            if ($(this).val() != '') {
                                var select = $(this).attr('id');
                                var value = $(this).val();
                                var dependent = $(this).data('dependent');
                                var _token = $('input[name="_token"]').val();

                                $.ajax({
                                    headers: {
                                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                                            'content')
                                    },
                                    method: "POST",
                                    url: '/ajax2/fetch',
                                    dataType: "html",
                                    data: {
                                        select: select,
                                        value: value,
                                        dependent: dependent,
                                        '_token': $('meta[name="csrf-token"]').attr('content'),
                                    },
                                    // 成功則填充到指定位置select box
                                    success: function (result) {
                                        $('#' + dependent).html(result);
                                        $('#tag2').html(result);

                                        console.log("ajax 成功");
                                        // console.log("結果為:");
                                        // console.log(result);
                                        // setTimeout(function(){
                                        //     console.log(result);
                                        // },10000);
                                    },
                                    error: function (result) {
                                        console.log(result);
                                        console.log("ajax 失敗：");
                                    }

                                });
                            }
                        })
                    })

                </script>
            </div>
            <div class="col-md-6 col-md-push-1 probootstrap-animate" data-animate-effect="fadeIn">
                <h2>Get in touch</h2>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Iusto provident qui tempore natus quos
                    quibusdam soluta at.</p>

                <h4>USA</h4>
                <ul class="probootstrap-contact-info">
                    <li><i class="icon-pin"></i> <span>198 West 21th Street, Suite 721 New York NY 10016</span></li>
                    <li><i class="icon-email"></i><span>info@domain.com</span></li>
                    <li><i class="icon-phone"></i><span>+123 456 7890</span></li>
                </ul>

                <h4>Europe</h4>



                <div class="form-group">
                    {{-- firestore引入 --}}
                    <!-- Insert these scripts at the bottom of the HTML, but before you use any Firebase services -->

                    <!-- Firebase App (the core Firebase SDK) is always required and must be listed first -->
                    <script src="https://www.gstatic.com/firebasejs/6.2.0/firebase-app.js"></script>

                    <!-- Add Firebase products that you want to use -->
                    <script src="https://www.gstatic.com/firebasejs/6.2.0/firebase-auth.js"></script>
                    <script src="https://www.gstatic.com/firebasejs/6.2.0/firebase-firestore.js"></script>



                    {{-- 測試firebase --}}
                    <div>
                        <p>建立檔案：</p>
                    </div>

                    {{-- <button onclick="test123()">建立喜好項目</button>
                    <button onclick="getdata()">取得喜好項目內資料</button>
                    <button onclick="updatedata()">更新日期</button> --}}
                    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
                    {{-- <script>
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

                        function test123() {
                            db.collection("喜好項目").doc("喜歡的地點").set({
                                name: "行天宮",
                                date: "202002",
                                desctiption: "本劇改編自阿瑟·柯南·道爾爵士家喻戶曉的推理小說，一位脾氣古怪的大偵探在現代倫敦的街頭悄悄巡行，四處搜尋線索。",
                                actors: ["班尼迪克·康柏拜區", "馬丁·費曼"]
                            });
                            console.log("傳資料");
                        }

                        function getdata() {
                            var docRef = db.collection("喜歡的地點");
                            // 網路
                            // var ref = db.collection('fruit');
                            // ref.get().then(querySnapshot => {
                            //     querySnapshot.forEach(doc => {
                            //         console.log(doc.id, doc.data());
                            //     });
                            // });


                            docRef.get().then(querySnapshot => {
                                querySnapshot.forEach(function (doc) {
                                    if (doc.exists) {
                                        console.log(doc.id, doc.data());
                                    } else {
                                        console.log("找不到文件");
                                    }
                                });.catch(function (error) {
                                    console.log("提取文件時出錯:", error);
                                });
                            });
                            // 原本
                            // docRef.get().then(function(doc) {
                            //         if (doc.exists) {
                            //             console.log(doc.data());
                            //         } else {
                            //             console.log("找不到文件");
                            //         }
                            //     }).catch(function(error) {
                            //     console.log("提取文件時出錯:", error);
                            // });
                        }

                        function updatedata() {
                            db.collection("喜好項目").doc("新世紀福爾摩斯").set({
                                date: "1000",
                            });
                        }

                    </script> --}}



                </div>
                <ul class="probootstrap-contact-info">
                    <li><i class="icon-pin"></i> <span>198 West 21th Street, Suite 721 New York NY 10016</span></li>
                    <li><i class="icon-email"></i><span>info@domain.com</span></li>
                    <li><i class="icon-phone"></i><span>+123 456 7890</span></li>
                </ul>
            </div>
        </div>


    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3 text-center section-heading probootstrap-animate">
                <h2>所有景點</h2>
            </div>
        </div>
        <!-- END row -->
        <div class="row" id="card_test">
            <div class="col-md-3 col-sm-6 col-xs-6 probootstrap-animate">
                <a href="#" class="probootstrap-team">
                    <div class="card" id="id?????">

                        <div class="card mb-3 col-auto">
                            <img src="images/person_1.jpg" class="card-img-top img-responsive img-rounded" alt="...">

                            <div class="card-body">
                                <h3 class="card-title"> 鐵砧山風景區(測試)</h3>
                                <p class="card-text">台中 宗教聖地 景觀徒步區</p>
                            </div>
                            <div class="card-footer probootstrap-team-info">
                                <small class="text-muted">Last updated 2020/3/4 下午3:53:07</small>
                                <button onclick="new_getdata_2()">加入最愛</button>
                            </div>
                        </div>
                    </div>
                </a>
            </div>



            {{-- <div class="col-md-3 col-sm-6 col-xs-6 probootstrap-animate">
                <a href="#" class="probootstrap-team">
                    <img src="images/person_2.jpg" alt="Free Bootstrap Template by uicookies.com"
                        class="img-responsive img-rounded">
                    <div class="probootstrap-team-info">
                        <h3>懸浮顯示標題 <span class="position">懸浮副標題</span></h3>
                    </div>
                </a>
            </div>

            <div class="clearfix visible-sm-block visible-xs-block"></div>

            <div class="col-md-3 col-sm-6 col-xs-6 probootstrap-animate">
                <a href="#" class="probootstrap-team">
                    <img src="images/person_3.jpg" alt="Free Bootstrap Template by uicookies.com"
                        class="img-responsive img-rounded">
                    <div class="probootstrap-team-info">
                        <h3>Matthew Smith <span class="position">Developer</span></h3>
                    </div>
                </a>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-6 probootstrap-animate">
                <a href="#" class="probootstrap-team">
                    <img src="images/person_4.jpg" alt="Free Bootstrap Template by uicookies.com"
                        class="img-responsive img-rounded">
                    <div class="probootstrap-team-info">
                        <h3>Ivan Dubovtsev <span class="position">Designer</span></h3>

                    </div>
                </a>
            </div>

            <div class="clearfix visible-sm-block visible-xs-block"></div>

            <div class="col-md-3 col-sm-6 col-xs-6 probootstrap-animate">
                <a href="#" class="probootstrap-team">
                    <img src="images/person_2.jpg" alt="Free Bootstrap Template by uicookies.com"
                        class="img-responsive img-rounded">
                    <div class="probootstrap-team-info">
                        <h3>James Butterly <span class="position">Co-Founder / Creative</span></h3>
                    </div>
                </a>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-6 probootstrap-animate">
                <a href="#" class="probootstrap-team">
                    <img src="images/person_1.jpg" alt="Free Bootstrap Template by uicookies.com"
                        class="img-responsive img-rounded">
                    <div class="probootstrap-team-info">
                        <h3>Jeremy Slater <span class="position">Co-Founder / Tech</span></h3>
                    </div>
                </a>
            </div>

            <div class="clearfix visible-sm-block visible-xs-block"></div>

            <div class="col-md-3 col-sm-6 col-xs-6 probootstrap-animate">
                <a href="#" class="probootstrap-team">
                    <img src="images/person_4.jpg" alt="Free Bootstrap Template by uicookies.com"
                        class="img-responsive img-rounded">
                    <div class="probootstrap-team-info">
                        <h3>Ivan Dubovtsev <span class="position">Designer</span></h3>

                    </div>
                </a>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-6 probootstrap-animate">
                <a href="#" class="probootstrap-team">
                    <img src="images/person_3.jpg" alt="Free Bootstrap Template by uicookies.com"
                        class="img-responsive img-rounded">
                    <div class="probootstrap-team-info">
                        <h3>Matthew Smith <span class="position">Developer</span></h3>
                    </div>
                </a>
            </div> --}}

            <script>
                // Your web app's Firebase configuration
                var firebaseConfig = {
                    apiKey: "AAAACkc-D50:APA91bFu7SiD6q5btWTQoZM-iV5DLbTCNZ1G7f22y_29I9dgla3ilSEzy0r15wGt6fKanWdfl-Gcwkw_Aa7v3i7Q-0teHBWv9cyl9XfPjcCXOMfQFw7EsXHqugdSc2D4F14Q1H_IgZzN",
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


                function new_getdata_2() {

                    var doc = [];
                    var index = 1;
                    var lastIndex = 0;

                    var htmls = [];
                    var htmls_2 = [];
                    var htmls_card = [];



                    var docRef = db.collection("喜歡的地點");
                    // 根據date排序



                    docRef = docRef.orderBy("date");

                    docRef.get().then(function (querySnapshot) {
                        if (querySnapshot.empty) {
                            console.log("無資料");


                        } else {
                            querySnapshot.forEach(function (doc) {
                                // doc.data() is never undefined for query doc snapshots

                                if (doc.exists && name !== undefined) {
                                    console.log(doc.id, doc.data());

                                    // 新增一個格子
                                    $("#card_test").html('<div class="col-md-3 col-sm-6 col-xs-6 probootstrap-animate">\
                                        <a href="#" class="probootstrap-team">\
                                            <div class="card" id="' + doc.id + '">\
                                                \
                                                <div class="card mb-3 col-auto">\
                                                    <img src="images/person_1.jpg" class="card-img-top img-responsive img-rounded" alt="...">\
                                                    \
                                                    <div class="card-body">\
                                                        <h3 class="card-title">' + doc.data().desctiption + '</h3>\
                                                        <p class="card-text">' + doc.data().city + ' ' + doc.data()
                                        .catagory_1 + ' ' + doc.data().catagory_2 + '</p>\
                                                    </div>\
                                                    <div class="card-footer probootstrap-team-info">\
                                                        <small class="text-muted">Last updated ' + doc.data().date + '</small>\
                                                        <button onclick="new_getdata()">加入最愛</button>\
                                                    </div>\
                                                </div>\
                                            </div>\
                                        </a>\
                                    </div>');
                                    // $("#card_test").append('<p>'+ doc.data().desctiption +'</p>');
                                    // console
                                    console.log(doc.id, " => ", doc.data().desctiption);

                                    //
                                };
                            }); //
                        };
                        // querySnapshot catch error
                    }).catch(function (error) {
                        console.log("Error getting documents: ", error);
                    });



                    docRef.onSnapshot(querySnapshot => {
                        let changes = querySnapshot.docChanges();
                        for (let change of changes) {
                            console.log(`資料動態：A document was ${change.type}.`);
                        }
                    });
                }

            </script>
        </div>
    </div>
</section>
@endsection
