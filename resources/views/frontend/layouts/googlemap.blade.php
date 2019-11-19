
<h3>__________________My Google Maps Demo</h3>
    <!--The div element for the map -->
    {{-- <div id="map"></div> --}}
   
   
    <script>
      // Initialize and add the map
      function initMap() {
        // The location of Uluru
        var uluru = {lat: 25.023571, lng: 121.467988};
        // The map, centered at Uluru
        // getGeocode('Los Angeles, CA');
        var map = new google.maps.Map(
            document.getElementById('map'), {zoom: 17, center:uluru });
        // The marker, positioned at Uluru
        var marker = new google.maps.Marker({position: uluru, map: map});
      }
    

    </script>
     
<script>
     var geocoder;
  var map;
  function initialize() {
    geocoder = new google.maps.Geocoder();
    var latlng = new google.maps.LatLng(-34.397, 150.644);
    var mapOptions = {
      zoom: 10,
      center: latlng
    }
    map = new google.maps.Map(document.getElementById('map'), mapOptions);
  }

  function codeAddress() {
    var address = document.getElementById('address').value;
    geocoder.geocode( { 'address': address}, function(results, status) {
      if (status == 'OK') {
        map.setCenter(results[0].geometry.location);
        var marker = new google.maps.Marker({
            map: map,
            position: results[0].geometry.location
        });
      } else {
        alert('Geocode was not successful for the following reason: ' + status);
      }
    });
  }
  </script>
 <script async defer
          src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDkS6nBwtRIUe55-p_oHZh6QocvIyUAG2A&callback=initMap">
  </script>
   
