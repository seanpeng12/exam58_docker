<template>
  <div class="container mt-4">
    <h2 class=" text-center text-secondary pb-2">台北市營運餐廳</h2>
    <div class=" row border rounded">
      <div class="col">
        <ul class="nav justify-content-center border-bottom">
          <!--營運地區 nav-->
        </ul>
        <!--地圖呈現在此-->
        <div class="google-map" id="map"></div>
      </div>
      <div class="col q-px-lg">
        <q-form @submit="calculateAndDisplayRoute" class="q-gutter-md">
          <div class="row-8">
            <p>origin</p>
            <q-select
              id="start"
              filled
              v-model="model"
              :options="originOptions"
              label="Filled"
            />
          </div>
          <div class="row-8">
            <p>waypoints</p>
            <q-select
              id="waypoints"
              name="accepted_genres"
              v-model="accepted"
              multiple
              :options="waypointOptions"
              color="primary"
              filled
              clearable
              label="Accepted genres"
            />
          </div>
          <div class="row-8">
            <p>end</p>
            <q-select
              id="end"
              filled
              v-model="model"
              :options="endOptions"
              label="Filled"
            />
          </div>
          <div class="row" id="directions-panel"></div>
          <q-btn label="Submit" type="submit" color="red" />
        </q-form>
      </div>
    </div></div
></template>

<script>
export default {
  name: "Restaurants",
  data() {
    return {
      map: null,
      // 預設經緯度在信義區附近
      lat: 25.0325917,
      lng: 121.5624999,
      model: null,
      accepted: [],
      originOptions: ["Halifax, NS", "Boston, MA", "New York, NY", "Miami, FL"],
      waypointOptions: [
        "Montreal, QBC",
        "Toronto, ONT",
        "Chicago",
        "Winnipeg",
        "Fargo"
      ],
      endOptions: [
        "Vancouver, BC",
        "Seattle, WA",
        "San Francisco, CA",
        "Los Angeles, CA"
      ],
      streetViewControl: {
        type: Boolean,
        default: true
      },
      mapTypeControl: {
        type: Boolean,
        default: true
      },
      fullscreenControl: {
        type: Boolean,
        default: true
      },
      zoomControl: {
        type: Boolean,
        default: true
      }
    };
  },
  mounted() {
    this.initMap();
    this.setMarker();
  },
  methods: {
    // 建立地圖
    initMap() {
      this.map = new google.maps.Map(document.getElementById("map"), {
        center: this.center,
        zoom: this.zoom,
        maxZoom: 20,
        minZoom: 3,
        streetViewControl: this.streetViewControl,
        mapTypeControl: this.mapTypeControl,
        fullscreenControl: this.fullscreenControl,
        zoomControl: this.zoomControl
      });
    },
    calculateAndDisplayRoute(directionsService, directionsRenderer) {
      this.calculateAndDisplayRoute(directionsService, directionsRenderer);
    },
    calculateAndDisplayRoute(directionsService, directionsRenderer) {
      var waypts = [];
      var checkboxArray = document.getElementById("waypoints");
      for (var i = 0; i < checkboxArray.length; i++) {
        if (checkboxArray.options[i].selected) {
          waypts.push({
            location: checkboxArray[i].value,
            stopover: true
          });
        }
      }

      this.directionsService.route(
        {
          origin: document.getElementById("start").value,
          destination: document.getElementById("end").value,
          waypoints: waypts,
          optimizeWaypoints: true,
          travelMode: "DRIVING"
        },
        function(response, status) {
          if (status === "OK") {
            directionsRenderer.setDirections(response);
            var route = response.routes[0];
            var summaryPanel = document.getElementById("directions-panel");
            summaryPanel.innerHTML = "";
            // For each route, display summary information.
            for (var i = 0; i < route.legs.length; i++) {
              var routeSegment = i + 1;
              summaryPanel.innerHTML +=
                "<b>Route Segment: " + routeSegment + "</b><br>";
              summaryPanel.innerHTML += route.legs[i].start_address + " to ";
              summaryPanel.innerHTML += route.legs[i].end_address + "<br>";
              summaryPanel.innerHTML +=
                route.legs[i].distance.text + "<br><br>";
            }
          } else {
            window.alert("Directions request failed due to " + status);
          }
        }
      );
    },
    // 建立地標
    setMarker() {
      // 建立一個新地標
      const marker = new google.maps.Marker({
        // 設定地標的座標
        position: { lat: this.lat, lng: this.lng },
        // 設定地標要放在哪一個地圖
        map: this.map
      });
    }
  }
};
</script>
<style scoped>
.google-map {
  width: 100%;
  height: 400px;
}
#right-panel {
  font-family: "Roboto", "sans-serif";
  line-height: 30px;
  padding-left: 10px;
}

#right-panel select,
#right-panel input {
  font-size: 15px;
}

#right-panel select {
  width: 100%;
}

#right-panel i {
  font-size: 12px;
}
html,
body {
  height: 100%;
  margin: 0;
  padding: 20px;
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
  background-color: #ffee77;
  padding: 10px;
  overflow: scroll;
  height: 174px;
}
</style>
