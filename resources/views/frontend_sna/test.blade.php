<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

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
    <button onclick="getdata()">取得喜好項目內資料</button>
    <button onclick="updatedata()">更新日期</button>
    <p></p><br>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
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
                    querySnapshot.forEach(function(doc) {
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


    <table id="myDataTalbe" class="display">
        <thead>
            <!--必填-->

            <tr>
                <th>#</th>
                <th>MyTitle</th>
                <th>MyMoney</th>
                <th>ActionButton</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1</td>
                <td>Apple</td>
                <td>2000</td>
                <td>
                    <button type="button">修改</button>
                    <button type="button">刪除</button>
                </td>
            </tr>
            <tr>
                <td>2</td>
                <td>Banana</td>
                <td>3000</td>
                <td>
                    <button type="button">修改</button>
                    <button type="button">刪除</button>
                </td>
            </tr>
            <tr>
                <td>3</td>
                <td>Cherry</td>
                <td>4000</td>
                <td>
                    <button type="button">修改</button>
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
</body>

</html>
