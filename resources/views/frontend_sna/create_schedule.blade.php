@extends('frontend_sna.layouts.master')

    {{-- @section('title', 'services') --}}

@section('content')
    <style>
      #right-panel {
        font-family: 'Roboto','sans-serif';
        line-height: 30px;
        padding-left: 10px;
      }

      #right-panel select, #right-panel input {
        font-size: 15px;
      }

      #right-panel select {
        width: 100%;
      }

      #right-panel i {
        font-size: 15px;
      }
      html, body {
        height: 100%;
        margin: 50px;
        padding: 0;
      }
      #map {
        height: 100%;
        float: left;
        width: 70%;
        height: 90%;
        padding-top: 20px;
      }
      #right-panel {
        margin: 20px;
        border-width: 2px;
        width: 20%;
        height: 400px;
        float: left;
        text-align: left;
        padding-top: 0;
      }
      #directions-panel {
        margin-top: 10px;
        background-color: #FFEE77;
        padding: 10px;
        overflow: scroll;
        height: 174px;
      }
	</style>
	
	<section class="probootstrap-section probootstrap-bg-gray">
        <div class="container">
            <div class="row">
                <div class="col-md-4 probootstrap-animate" data-animate-effect="fadeIn">
                        <div class="form-group">
                        </div>
                </div>
                <div class="col-md-6 col-md-push-0 probootstrap-animate" data-animate-effect="fadeIn">
                </div>
            </div>
        </div>
    </section>

    <div id="map"></div>
    <div id="right-panel">
    <div>
    <b>請選擇縣市:</b>
    <select name="country" id="country" class="form-control input-lg dynamic"
                                data-dependent="name" style="height: 50px">
                                @foreach ($country_list as $country)
                                <option value="{{$country->city_name}}">{{$country->city_name}}</option>
                                @endforeach
    </select>
    {{-- <select id="start">
      <option value="和安宮, 台北">和安宮, 台北</option>
      <option value="Boston, MA">Boston, MA</option>
      <option value="New York, NY">New York, NY</option>
      <option value="Miami, FL">Miami, FL</option>
    </select> --}}
    <b>請選擇起點:</b>
    <select name="name[]" id="name" class=" form-control input-lg dropdown-primary md-form "
                                data-dependent="name2"" style="height: 50px" data-live-search="true">
    </select>
    <br>
    <b>請選擇中繼點:</b> <br>
    <i>(Ctrl+Click or Cmd+Click for multiple selection)</i> <br>
    {{-- <select multiple id="waypoints">
      <option value="大龍峒保安宮, 台北">大龍峒保安宮, 台北</option>
      <option value="台灣大學, 台灣">台灣大學, 台灣</option>
   
    </select> --}}
    <select name="name2[]" id="name2" class=" form-control input-lg dropdown-primary md-form "
                                data-dependent="name3" style="height: 200px" data-live-search="true" multiple="multiple">
    </select>
    <br>
    <b>End:</b>
    {{-- <select id="end"> --}}
    <select name="name3[]" id="name3" class=" form-control input-lg dropdown-primary md-form "
                                     style="height: 50px" data-live-search="true">
                                    
    </select>      {{-- <option value="Seattle, WA">Seattle, WA</option>
      <option value="San Francisco, CA">San Francisco, CA</option>
      <option value="Los Angeles, CA">Los Angeles, CA</option> --}}
    </select>
    <br>
      <input type="submit" id="submit">
      <button id="save" onclick="printout()">印出來</button>

    </div>
    <div id="directions-panel"></div>
    </div>
    <script>
      function initMap() {
        var directionsService = new google.maps.DirectionsService;
        var directionsRenderer = new google.maps.DirectionsRenderer;
        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 8,
        //   center: {lat: 41.85, lng: -87.65}
		  center: {lat: 24.155, lng: 121.045523}
        });
        directionsRenderer.setMap(map);

        document.getElementById('submit').addEventListener('click', function() {
          calculateAndDisplayRoute(directionsService, directionsRenderer);
        });
      }

      function calculateAndDisplayRoute(directionsService, directionsRenderer) {
        var waypts = [];
        var checkboxArray = document.getElementById('name2');
        var i;
        for (i = 0; i < checkboxArray.length; i++) {
          if (checkboxArray.options[i].selected) {
            
            waypts.push({
              location: checkboxArray[i].value,
              stopover: true
            });
          }
        }

        directionsService.route({
          origin: document.getElementById('name').value,
          destination: document.getElementById('name3').value,
          waypoints: waypts,
          optimizeWaypoints: true,
          travelMode: 'DRIVING'
        }, function(response, status) {
          if (status === 'OK') {
            directionsRenderer.setDirections(response);
            var route = response.routes[0];
            var summaryPanel = document.getElementById('directions-panel');
            summaryPanel.innerHTML = '';
            // For each route, display summary information.
            for (var i = 0; i < route.legs.length; i++) {
              var routeSegment = i + 1;
              summaryPanel.innerHTML += '<b>Route Segment: ' + routeSegment +
                  '</b><br>';
              summaryPanel.innerHTML += route.legs[i].start_address + ' to ';
              summaryPanel.innerHTML += route.legs[i].end_address + '<br>';
              summaryPanel.innerHTML += route.legs[i].distance.text + '<br><br>';
              console.log("route.legs[i].start_address "+ i +route.legs[i].start_address);
              console.log("route.legs[i].end_address "+ i +route.legs[i].end_address);

            }
          } else {
            window.alert('Directions request failed due to ' + status);
          }
        });


      var user = firebase.auth().currentUser;

    
      
   
      // No user is signed in.
    
        // print
      printout = function(){
    if (!user) {
      alert('請先登入帳號，才可使用收藏功能');
    }
    else{
          console.log("縣市: "+document.getElementById('country').value);
          console.log("起點: "+document.getElementById('name').value);
          console.log("終點: "+document.getElementById('name3').value);
          var date = new Date();
          console.log(date);
          // for(var j=0 ; j<waypts.length ; j++){
            console.log(waypts);
          
            // 寫入資料庫firebase
            
          // }
          var db = firebase.firestore();
            var user = firebase.auth().currentUser;
            var country, origin, destination, waypoints
            country = document.getElementById('country').value;
            origin = document.getElementById('name').value;
            destination = document.getElementById('name3').value;
            db.collection("sightseeingMember").doc(user.email).collection("google路線規劃").doc().set({
                        city: country,
                        origin: origin,
                        destination: destination,
                        waypoints: waypts,
                        
                        timestamp: date
                        
                      });



        }
      }
      

    }

  
    </script>

    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDkS6nBwtRIUe55-p_oHZh6QocvIyUAG2A&callback=initMap">
    </script>

    {{-- ajax --}}

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

                        <script type="text/javascript">

    
    
    $(document).ready(function(){
    
        $('.dynamic').change(function(){
            if($(this).val() != '')
            {
                var select = $(this).attr('id');   
                var value = $(this).val();
                var dependent = $(this).data('dependent');  
                var _token = $('input[name="_token"]').val();
                
                $.ajax({
                    headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    method:"POST",
                    url:'/schedule/fetch',
                    dataType: "html",
                    data:{
                    select:select, value:value, dependent:dependent, '_token': $('meta[name="csrf-token"]').attr('content'), 
                    },
                    // 成功則填充到指定位置select box 
                    success: function(result){
                        $('#'+dependent).html(result);
                        $('#name2').html(result);
                        $('#name3').html(result);

                        console.log("ajax 成功");
                        // console.log("結果為:");
                        // console.log(result);
                        // setTimeout(function(){
                        //     console.log(result);
                        // },10000);
                    },
                    error: function(result) {
                        console.log(result);
                        console.log("ajax 失敗：");
                    }
    
                });
            }
        })
    })
    </script>

 @endsection