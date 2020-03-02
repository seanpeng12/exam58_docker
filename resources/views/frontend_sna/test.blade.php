<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    {{-- datatable會用到 --}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    {{-- firebase --}}
    <script src="https://www.gstatic.com/firebasejs/6.5.0/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/5.9.1/firebase-auth.js"></script>
    <script src="https://www.gstatic.com/firebasejs/5.5.5/firebase-firestore.js"></script>
    {{-- <script src="//unpkg.com/jquery@3.3.1/dist/jquery.min.js"></script>
  <script src="//raw.githack.com/hnzzmsf/layui-formSelects/master/dist/formSelects-v4.min.js"></script> --}}

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
    {{-- 測試firebase --}}
    <div>
        <p><b>我的最愛</b></p>
    </div>

    <button onclick="test123()">建立喜好項目</button>
    <button onclick="getdata()">取得資料顯示在log</button>
    <button onclick="updatedata()">更新日期</button>
    <button onclick="new_getdata()">取得喜好項目內資料</button>
    <p></p><br>


    <table id="myDataTalbe" class="display">
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
                <td>1</td>
                <td>Apple</td>
                <td>2000</td>
                <td>Apple</td>
                <td>2000</td>
                <td>
                    <button type=" button">修改</button>
                    <button type="button">刪除</button>
                </td>
            </tr>


        </tbody>
    </table>
    <!--引用jQuery-->
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet" />
    <!--引用dataTables.js-->
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>

    <script type="text/javascript">
        $(function () {

            $("#myDataTalbe").DataTable({
                searching: false, //關閉filter功能
                columnDefs: [{
                    targets: [3],
                    orderable: false,
                }]
            });
        });

    </script>



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

        // var db = firebase.firestore();


        function test123() {
            db.collection("喜好項目").doc("喜歡的地點").set({
                name: "行天宮",
                date: "202002",
                desctiption: "本劇改編自阿瑟·柯南·道爾爵士家喻戶曉的推理小說，一位脾氣古怪的大偵探在現代倫敦的街頭悄悄巡行，四處搜尋線索。",
                actors: ["班尼迪克·康柏拜區", "馬丁·費曼"]
            });
            console.log("傳資料");
        }

        function new_getdata() {
            var index = 0;
            var lastIndex = 0;
            var htmls = [];
            var htmls_2 = [];
            var doc = [];

            var docRef = db.collection("喜歡的地點");
            // 根據date排序


            if (docRef == false) {
                docRef = docRef.orderBy("date");

                docRef.get().then(function (querySnapshot) {
                        querySnapshot.forEach(function (doc) {
                            // doc.data() is never undefined for query doc snapshots
                            console.log(doc.id, " => ", doc.data().desctiption);
                            if (doc.exists && name !== undefined) {
                                // console.log(doc.id, doc.data());

                                htmls.push('<tr>\
                                <td>' + doc.data().date + '</td>\
                                <td>' + doc.data().desctiption + '</td>\
                                <td>' + doc.data().city + '</td>\
                                <td>' + doc.data().catagory_1 + '</td>\
                                <td>' + doc.data().catagory_2 + '</td>\
                                <td><button>修改最愛</button>\
                                    <button id=' + doc.id + ' onclick="delete_button()">刪除最愛</button>\
                            </tr>');
                                lastIndex = index;
                                $('#tbody').html(htmls);
                            };
                        });
                    })
                    .catch(function (error) {
                        console.log("Error getting documents: ", error);
                    });
            } else {
                htmls_2.push('<tr>\
                                <td>' + "無資料" + '</td>\
                                <td>' + "無資料" + '</td>\
                                <td>' + "無資料" + '</td>\
                                <td>' + "無資料" + '</td>\
                                <td>' + "無資料" + '</td>\
                                <td><button>修改最愛</button>\
                                    <button id=' + "無資料" + ' onclick="delete_button()">刪除最愛</button>\
                            </tr>');

                $('#tbody').html(htmls_2);
            };



            docRef.onSnapshot(querySnapshot => {
                let changes = querySnapshot.docChanges();
                for (let change of changes) {
                    console.log(`資料動態：A document was ${change.type}.`);
                }
            });

            // docRef.get().then(querySnapshot => {
            //     querySnapshot.forEach(function (doc, index) {
            //         // doc.data() is never undefined for query doc snapshots
            //         if (doc.exists) {
            //             console.log(doc.id, doc.data());

            //             htmls.push('<tr>\
            //                     <td>' + doc.data().date + '</td>\
            //                     <td>' + doc.data().desctiption + '</td>\
            //                     <td>' + doc.data().city + '</td>\
            //                     <td>' + doc.data().catagory_1 + '</td>\
            //                     <td>' + doc.data().catagory_2 + '</td>\
            //                     <td><button>修改最愛</button>\
            //                         <button id=' + doc.id + ' onclick="delete_button()">刪除最愛</button>\
            //                 </tr>');
            //             lastIndex = index;
            //             $('#tbody').html(htmls);
            //             console.log("已經顯示!");
            //         } else {
            //             // console.log("找不到文件");
            //             console.log("no file!!!!!");
            //         }
            //     });
            // });
        }
        var id_delete = "";

        function delete_button() {

            document.body.onclick = function (event) { //抓到刪除 id
                id_delete = event.target.id;
                console.log("已刪除ID:" + id_delete);

                deletedata(id_delete);

                //重整頁面
                new_getdata();
            }
        }

        function deletedata(id_delete) {
            var id = id_delete;
            //doc文件內資料清空
            db.collection("喜歡的地點").doc(id).set({});
            //doc整個刪除
            db.collection("喜歡的地點").doc(id).delete();
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

    </script>



    <div>
        答案是
        <example-Component>
            <div id="app">
                @{{ message }}
            </div>

            <div id="app">
                @{{ state }}
            </div>
        </example-component>
    </div>
</body>

</html>
