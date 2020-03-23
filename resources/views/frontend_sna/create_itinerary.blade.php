@extends('frontend_sna.layouts.master');

@section('content');
<style>
     {{--  tab   --}}
    * {
        box-sizing: border-box;
    }

    /* Create four equal columns that floats next to each other */
    .column {
        margin-top: 50px;
        float: left;
        width: 25%;
        padding-left: 20px;
        padding-top: 0px;
        height: 100%;
        overflow: scroll;
        /* Should be removed. Only for demonstration */
    }

    .column1 {
        margin-top: 50px;
        float: left;
        width: 75%;
        padding: ;
        height: 100%;
        overflow: visible;

        /* Should be removed. Only for demonstration */
    }

    /* Clear floats after the columns */
    .row:after {
        content: "";
        display: table;
        clear: both;


    }

    /* Style tab links */
    .tablink {
        background-color: #555;
        color: white;
        float: left;
        border: none;
        outline: none;
        cursor: pointer;
        padding: 10px 16px;
        font-size: 14px;
        width: 25%;
    }

    .tablink:hover {
        background-color: #777;
    }

    /* Style the tab content (and add height:100% for full page content) */
    .tabcontent {
        color: white;
        display: none;
        padding: 100px;
        height: 100%;
    }

    #Home {
        background-color: #ffcccc;
    }

    #News {
        background-color: #a2d0d0;
    }

    #Contact {
        background-color: #ccccff;
    }

    #About {
        background-color: #ffe0c1;
    }


    //-- drag and sort --



    h1,
    h2,
    h3,
    h4,
    h5,
    p {
        font-family: NSimSun;
    }

    ul {
        margin: 0;
        padding: 0;

    }


    .items .ui-selected {
        background: red;
        color: white;
        font-weight: bold;
    }

    .items {
        list-style-type: none;
        margin: 0;
        padding: 0;
        width: 100px;
    }

    .items li {
        margin: 2px;
        padding: 2px;
        cursor: pointer;
        border-radius: 3px;
    }

    .weekday {
        float: top;
        text-align: left;
    }


    .button {
        width: 300px;
        height: 35px;
        cursor: pointer;
        font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
        font-size: 20px;
        //border:2px #54a9a9 dashed;
        border-width: 2px 7px 5px 7px;
        border-bottom-color: #400080;
        border-style: solid dotted;

    }

    .list {
        margin: 50px;
        -webkit-text-fill-color: #220044;
        background-color: #ffe3e3;
        //border: 2px solid;
    }

</style>


<link rel="stylesheet" href="http://code.jquery.com/ui/1.9.2/themes/base/jquery-ui.css" />

<script type="text/javascript" src="http://code.jquery.com/jquery.min.js"></script>
<script type="text/javascript" src="http://code.jquery.com/ui/1.9.2/jquery-ui.js"></script>
<script type="text/javascript" src="http://www.pureexample.com/js/lib/jquery.ui.touch-punch.min.js"></script>


<section class="probootstrap-section probootstrap-bg-gray">

    <div class="row">
        <div class="column" style="background-color:#ffffff;">
            <center>
                <h4>我的旅程</h4>
                <hr>
                <div id="timetable">
                    {{--  <div class="weekday">
                        <h4 id="day"class="button" data-toggle="collapse" data-target="#multiCollapseExample1"></h4>
                        <ul class="items" id="multiCollapseExample1">
                            <li class="list">a</li>
                            <li class="list">s</li>
                            <li class="list">c</li>
                            <li class="list">d</li>

                        </ul>
                    </div>  --}}
                    {{--  <div class="weekday">
                        <h4 class="button" data-toggle="collapse" data-target="#multiCollapseExample2">Day2</h4>

                        <ul class="items" id="multiCollapseExample2">
                            <li class="list">a</li>
                            <li class="list">s</li>
                            <li class="list">c</li>
                            <li class="list">d</li>

                        </ul>
                    </div>  --}}
                    <script>
                        var j;
                        for (j = 1; j < 6; j++) {
                            $('#timetable').append('<div class="weekday">\
                                <h4 class="button" data-toggle="collapse" data-target="#multiCollapseExample' + j +
                                '">day' + j + '</h4>\
                                <ul class="items" id="multiCollapseExample' + j + '">\
                                    <li class="list">a</li>\
                                    <li class="list">s</li>\
                                    <li class="list">c</li>\
                                    <li class="list">d</li>\
                                </ul>\
                            </div>');
                        }

                    </script>

                </div>

            </center>

        </div>
        <div class="column1" style="background-color:#bbb;">
            <button class="tablink" onclick="openPage('Home', this, 'red')" id="defaultOpen">Home</button>
            <button class="tablink" onclick="openPage('News', this, 'green')">News</button>
            <button class="tablink" onclick="openPage('Contact', this, 'blue')">Contact</button>
            <button class="tablink" onclick="openPage('About', this, 'orange')">About</button>

            <div id="Home" class="tabcontent">
                <h3>Home</h3>
                <p id = "home_p"></p>
            </div>

            <div id="News" class="tabcontent">
                @yield('hola')
                <p>Some news this fine day!</p>
            </div>

            <div id="Contact" class="tabcontent">
                <h3>Contact</h3>
                <p>Get in touch, or swing by for a cup of coffee.</p>
            </div>

            <div id="About" class="tabcontent">
                <h3>About</h3>
                <p>Who we are and what we do.</p>
            </div>
            <script>
                function openPage(pageName, elmnt, color) {
                    var i, tabcontent, tablinks;
                    tabcontent = document.getElementsByClassName("tabcontent");
                    for (i = 0; i < tabcontent.length; i++) {
                        tabcontent[i].style.display = "none";
                    }
                    tablinks = document.getElementsByClassName("tablink");
                    for (i = 0; i < tablinks.length; i++) {
                        tablinks[i].style.backgroundColor = "";
                    }
                    document.getElementById(pageName).style.display = "block";
                    elmnt.style.backgroundColor = color;
                }

                // Get the element with id="defaultOpen" and click on it
                document.getElementById("defaultOpen").click();
                //apend()


                //移動
                var $j = jQuery.noConflict();

                $j(document).ready(function () {
                    $j("#timetable .items").sortable({
                        connectWith: "ul"
                    });

                    $j("ul[id^='available']").draggable({
                        helper: "clone",
                        connectToSortable: ".items"
                    });
                });

            </script>
            <script>
                var eve_id;
                eve_id = "<?php echo $eve_id; ?>";

            </script>

            <script>
                function passEve_id(id) {
                    firebase.auth().onAuthStateChanged(function (user) {
                        if (user) {
                            var db = firebase.firestore();
                            var user = firebase.auth().currentUser;
                            var uid = user.uid;
                            var itinerary_eve = db.collection("sightseeingMember").doc(uid).collection("我的旅程表")
                                .doc(id).collection("每一天");

                            itinerary_eve.get().then(function (querySnapshot) {
                                if (querySnapshot.size == "0") {
                                    console.log("null");
                                } else {
                                    //var count = 0;
                                    querySnapshot.forEach(function (doc) {

                                        var eve = doc.data().site;
                                        $('#home_p').append(doc.id+"->"+eve+"</br>");
                                        console.log(eve);
                                    });
                                }
                            });
                        }
                    });
                }
                passEve_id(eve_id);

            </script>
           

        </div>
    </div>
</section>
@endsection
