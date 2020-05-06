<template>
  <div class="container mt-4">
    <!-- <h2 class=" text-center text-secondary pb-2">台北市營運餐廳</h2> -->
    <div class=" row border rounded">
      <div class="col">
        <ul class="nav justify-content-center border-bottom">
          <!--營運地區 nav-->
        </ul>
        <!--地圖呈現在此-->
        <div class="google-map" id="map" ref="bmap"></div>
      </div>
      <div class="col q-px-lg">
        <q-form @submit="prompt()" class="q-gutter-md">
          <div class="row-8">
            <p>origin</p>
            <q-select
              id="start"
              filled
              v-model="start"
              :options="originOptions"
              label="Filled"
            />
          </div>
          <div class="row-8">
            <p>waypoints</p>
            <q-select
              id="waypoints"
              name="accepted_genres"
              v-model="waypoint"
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
              v-model="end"
              :options="endOptions"
              label="Filled"
            />
          </div>
          <div class="row" id="directions-panel"></div>
          <q-btn label="Submit" type="submit" color="red" />
        </q-form>
        <q-btn label="test" @click="addMarkerWithTimeout()"></q-btn>
      </div>
    </div></div
></template>

<script>
export default {
  name: "map",
  data() {
    return {
      map: null,
      // 預設經緯度在信義區附近
      lat: 41.85,
      lng: -87.65,

      accepted: [],
      start: "",
      waypoint: [],
      end: "",
      originOptions: ["台灣大學, 台灣", "輔仁大學, 台灣", "七星山, 台灣"],
      waypointOptions: [
        "陽明山",
        "忘憂谷, 台灣",
        "文化大學",
        "桃源谷",
        "夢幻湖"
      ],
      endOptions: ["潮境公園, 台灣", "大武崙砲台"],
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
    //網頁載入就會讓地圖載入
    this.initMap();
    // this.setMarker();
  },
  compute: {},
  methods: {
    // 建立地圖
    initMap() {
      var directionsService = new google.maps.DirectionsService();
      var directionsRenderer = new google.maps.DirectionsRenderer();

      this.map = new google.maps.Map(this.$refs.bmap, {
        center: { lat: 23.5, lng: 121 },
        zoom: 8,
        maxZoom: 20,
        minZoom: 3
      });

      directionsService.route(
        {
          origin: { lat: 61, lng: 13 },
          destination: { lat: 62, lng: 15 },
          travelMode: "DRIVING"
        },
        function(response, status) {
          if (status === "OK") {
            directionsRenderer.setDirections(response);
          } else {
            console.log("Directions request failed due to " + status);
          }
        }
      );
    },

    //按下去會觸動路線計算
    prompt() {
      var directionsService = new google.maps.DirectionsService();
      var directionsRenderer = new google.maps.DirectionsRenderer();
      this.calculateAndDisplayRoute(directionsService, directionsRenderer);
    },

    calculateAndDisplayRoute(directionsService, directionsRenderer) {
      var waypts = [];
      this.waypoint.forEach(function(item, index) {
        waypts.push({
          location: item,
          stopover: true
        });
      });
      let _this = this;
      directionsService.route(
        {
          origin: this.start,
          destination: this.end,
          waypoints: waypts,
          optimizeWaypoints: true,
          travelMode: "DRIVING"
        },
        (response, status) => {
          if (status === "OK") {
            var map = this.map;
            console.log("response: ", response);
            console.log(
              "response.routes[0].legs.length :",
              response.routes[0].legs.length
            );
            for (var i = 0; i < response.routes[0].legs.length; i++) {
              if (i != response.routes[0].legs.length - 1) {
                this.setMarker(
                  String.fromCharCode((i + 97).toString()),
                  response.routes[0].legs[i].start_address,
                  response.routes[0].legs[i].start_location.lat(name),
                  response.routes[0].legs[i].start_location.lng(name)
                );
              } else {
                console.log(i);
                //start
                this.setMarker(
                  String.fromCharCode((i + 97).toString()),
                  response.routes[0].legs[i].start_address,
                  response.routes[0].legs[i].start_location.lat(name),
                  response.routes[0].legs[i].start_location.lng(name)
                );

                //end
                this.setMarker(
                  String.fromCharCode((i + 98).toString()),
                  response.routes[0].legs[i].end_address,
                  response.routes[0].legs[i].end_location.lat(name),
                  response.routes[0].legs[i].end_location.lng(name)
                );
              }
            }

            //directionsRenderer.setDirections(response);
            //我猜這裏是讓他回傳路線的資訊地方，並重新渲染地圖(呈現路線圖的樣子)

            //這裡是他文字路線的顯示(成功)
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
    setMarker(order, address, lat, lng) {
      // 建立一個新地標
      const marker = new google.maps.Marker({
        // 設定地標的座標
        position: { lat: parseFloat(lat), lng: parseFloat(lng) },
        // 設定地標要放在哪一個地圖
        label: order.toUpperCase(),
        map: this.map
      });
      const infowindow = new google.maps.InfoWindow({
        // 設定想要顯示的內容
        content: `

            ${address}

        `,
        // 設定訊息視窗最大寬度
        maxWidth: 200
      });
      marker.addListener("click", () => {
        // 指定在哪個地圖和地標上開啟訊息視窗
        infowindow.open(this.map, marker);
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
  padding: 5px;
  overflow: scroll;
  height: 174px;
}
</style>
