@extends('frontend_sna.layouts.master');
@section('content')
<style>
    .btn_submit{
        background-color: #0e0e0e;
        border-color: rgba(255,255,255,0.2);
        border: 0px;
        font-weight:bolder;
        color: white;
        font-size:35px;
        font-family:NSimSun;
    }
</style>
<section class="probootstrap-section">
    <div class="container">
        <div id="s" class="row">
            {{-- <form action="{{ url("/my_itinerary") }}" method="post">
                @csrf
                <div id = "test" class="col-md-4 col-sm-6 col-xs-6 probootstrap-animate">
                    <input type="hidden" name="username" value="2222">
                    <div class="probootstrap-team">
                        <img src="images/DSC07401-2.jpg" alt="" class="img-responsive img-rounded">
                        <div class="card bg-secondary text-white" align="center">
                            <span class="font-size:100px">
                                <span id="title" style="font-family:NSimSun; font-size:20"><br></span>
                            </span>
                        </div>
                        <div class="probootstrap-team-info">
                            <h3 id="title_inside">kk</h3>
                        </div>
                    </div>
                </div>
                <button type="submit">登入</button>
            </form> --}}
            <h1 id="create_itinerary"></h1>
            <h1 id="123"></h1>
        </div>
    </div>
</section>
<script>
    firebase.auth().onAuthStateChanged(function (user) {
        if (user) {
            var db = firebase.firestore();
            var user = firebase.auth().currentUser;
            var uid = user.uid;
            var itinerary_co = db.collection("sightseeingMember").doc(uid).collection("我的旅程表");

            itinerary_co.get().then(function (querySnapshot) {
                if (querySnapshot.size == "0") {
                    $("#create_itinerary").append("建立您的旅程表吧!");
                    $("#exist_itinerary").empty();
                } else {
                    //var count = 0;
                    querySnapshot.forEach(function (doc) {

                        var title = doc.data().title;
                        var id = doc.id;
                        append_div(title, id);
                        //passEve_id(id);

                        //("#title").append(doc.data().title);
                        //$("#title_inside").append(doc.data().title);

                    });
                }

            });

            
        }

    });

    function append_div(title, eve_id) {
        $("#s").append('<form action="{{ url("/my_itinerary") }}" method="post">\
            @csrf\
            <div id = "test" class="col-md-4 col-sm-6 col-xs-6">\
                <input type="hidden" name="eve_id" value="'+eve_id+'">\
                <div class="probootstrap-team">\
                    <img src="images/DSC07401-2.jpg" alt="" class="img-responsive img-rounded">\
                    <div class="card bg-secondary text-white" align="center">\
                        <span class="font-size:100px">\
                            <span id="title" style="font-family:NSimSun; font-size:20"><br>'+title+'</span>\
                        </span>\
                    </div>\
                    <div class="probootstrap-team-info">\
                        <button class = "btn_submit" type="submit">'+title+'</button>\
                    </div>\
                </div>\
            </div>\</form>');
        //console.log($("div[id="+eve_id+"]").selector);
        //(console.log($(eve_id).selector);)
        //$("#"+eve_id).click(function () {
        //   alert($(eve_id).selector);
        // });

    } 
            {{-- var tt = 55;
            $("#123").append('<button type="button" id = ' + 55 + '>HOLA</button>');
        


                $("#" + eve_id).click(function () {
                                alert("OK");
                                console.log("OK");
                            }); --}}
        

</script>


{{-- <script>
    docRef.get().then(function(doc) {

        if (doc.exists) {
        console.log("Document data:", doc.data());
        } else {
        // doc.data() will be undefined in this case
        
        console.log("No such document!");
        }
        }).catch(function(error) {
        console.log("Error getting document:", error);
        
        });
        
</script> --}}

@endsection
