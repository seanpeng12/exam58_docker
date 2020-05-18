<template>
  <div class="container mt-4 q-my-md">
    <!-- <h2 class=" text-center text-secondary pb-2">台北市營運餐廳</h2> -->
    <div class="row border rounded">
      <div class="col">
        <ul class="nav justify-content-center border-bottom">
          <!--營運地區 nav-->
        </ul>
        <!--地圖呈現在此-->
        <div class="google-map" id="map" ref="bmap"></div>
      </div>
      <div class="col q-px-lg">
        <q-form @submit="prompt()" class="q-gutter-md">
          <div class="row-8 q-py-sm">
            <p>選擇想要安排順序的日期</p>

            <q-btn
              dense
              label="點我"
              color="light-green-8"
              push
              icon="touch_app"
              @click="chooseForArrange()"
            ></q-btn>
            <span class="q-ml-md">目前選擇的日期: {{ chooseDate }}</span>
          </div>
          <div class="row-8 q-py-sm">
            <p>起點</p>
            <q-select id="start" filled v-model="start" :options="originOptions" label="請選擇您的起點" />
          </div>
          <div class="row-8 q-py-sm">
            <p>中繼點(多選)</p>
            <q-select
              id="waypoints"
              name="accepted_genres"
              v-model="waypoint"
              multiple
              :options="waypointOptions"
              color="primary"
              filled
              clearable
              label="請選擇您的中繼點"
            />
          </div>
          <div class="row-8 q-py-sm">
            <p>終點</p>
            <q-select id="end" filled v-model="end" :options="endOptions" label="請選擇您的終點" />
          </div>
          <div class="row-8 q-py-sm">
            <p>路徑結果</p>
            <q-scroll-area
              class="bg-lime-3 text-black rounded-borders"
              style="height: 186px; max-width: 500px; "
            >
              <div class="q-pa-xs" id="directions-panel"></div>
            </q-scroll-area>
          </div>
          <div class="row-8 q-py-sm">
            <q-btn class="col" label="Submit" type="submit" color="red" />
          </div>
          <!-- <slot name="chooseForArrange"></slot> -->
          <!-- <q-btn label="test" @click="deleteMarkers()"></q-btn> -->
        </q-form>
      </div>
    </div>
  </div>
</template>

<script>
import { mapGetters } from "vuex";
var polyUtil = require("polyline-encoded");

export default {
  name: "Restaurants",
  data() {
    return {
      // 舊順序
      old_list: [],
      // 新順序
      new_list: [],
      map: null,
      // 預設經緯度在信義區附近
      lat: 23.7,
      lng: 121,
      chooseDate: "",
      accepted: [],
      start: "",
      waypoint: [],
      end: "",
      markers: [],
      originOptions: [],

      waypointOptions: [],
      endOptions: [],
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
  computed: {
    ...mapGetters("travel", ["everydaySites"])
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
        // 信義區附近
        center: { lat: this.lat, lng: this.lng },
        zoom: 8.3,
        maxZoom: 20,
        minZoom: 3
      });

      // 畫圖
      var polylinePathPoints = [
        { lat: 25.0336962, lng: 121.5643673 },
        { lat: 25.033755, lng: 121.565412 },
        { lat: 25.031985, lng: 121.56538 },
        { lat: 25.032083, lng: 121.561324 }
      ];
      var polylinePath = new google.maps.Polyline({
        path: polylinePathPoints,
        geodesic: true,
        strokeColor: "#008800",
        strokeOpacity: 0.8,
        strokeWeight: 10,
        editable: true,
        geodesic: false,
        draggable: false
      });
      polylinePath.setMap(this.map);

      /* directionsService.route(
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
      );*/
    },
    chooseForArrange() {
      this.endOptions = [];
      this.originOptions = [];
      this.waypointOptions = [];
      const dateList = Object.keys(this.everydaySites);
      const item_1 = [];
      // 日期作為下面item的物件選項(radio)
      dateList.forEach(function(item, index, array) {
        item_1.push({
          label: item,
          value: item,
          color: "secondary"
        });
      });

      this.$q
        .dialog({
          title: "選擇您安排的日期",
          message: "日期:",
          options: {
            type: "radio",
            model: "opt1",
            // inline: true
            items: item_1
          },
          cancel: true,
          persistent: true
        })
        .onOk(data => {
          this.chooseDate = data;
          var everydaySites = this.everydaySites[data];
          everydaySites.forEach((item, index) => {
            this.originOptions.push(item);
            this.waypointOptions.push(item);
            this.endOptions.push(item);
          });
          console.log("this.originOptions: ", this.originOptions);

          /* this.$store.dispatch("travel/fbAddEverySiteData", {
            site: this.h_prosConsselected_site,
            date: data,
            scheduleId: this.id
          });*/

          // console.log('>>>> OK, received', data)
        })
        .onCancel(() => {
          // console.log('>>>> Cancel')
        })
        .onDismiss(() => {
          // console.log('I am triggered on both OK and Cancel')
        });
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
            console.log(response);
            console.log("=========");
            console.log(response.routes[0].waypoint_order);

            // SEAN
            console.log("=========");
            var latlngs = polyUtil.decode(response.routes[0].overview_polyline);

            L.PolylineUtil.decode;
            console.log(latlngs);
            var polylinePath_2 = new google.maps.Polyline({
              path: latlngs,
              geodesic: true,
              strokeColor: "#008800",
              strokeOpacity: 0.8,
              strokeWeight: 10,
              editable: true,
              geodesic: false,
              draggable: false
            });
            polylinePath_2.setMap(this.map);

            // 加入起點到新舊串列
            _this.old_list.push(response.request.origin.query);
            _this.new_list.push(response.request.origin.query);

            for (var j = 0; j < response.routes[0].waypoint_order.length; j++) {
              // 加入中繼站(舊)
              _this.old_list.push(response.request.waypoints[j].location.query);

              // 加入中繼站(google排程新順序)
              var new_order = response.routes[0].waypoint_order[j];

              _this.new_list.push(
                response.request.waypoints[new_order].location.query
              );
            }
            // 加入終點到新舊串列
            _this.old_list.push(response.request.destination.query);
            _this.new_list.push(response.request.destination.query);

            console.log("舊順序:" + _this.old_list);
            console.log("新順序:" + _this.new_list);
            // sean 結束

            (this.lat = response.routes[0].legs[0].start_location.lat(name)),
              (this.lng = response.routes[0].legs[0].start_location.lng(name));
            this.initMap();

            // setMarker設定
            for (var i = 0; i < response.routes[0].legs.length; i++) {
              if (i != response.routes[0].legs.length - 1) {
                // first
                this.setMarker(
                  String.fromCharCode((i + 97).toString()),
                  response.routes[0].legs[i].start_address,
                  _this.new_list[i],
                  response.routes[0].legs[i].start_location.lat(name),
                  response.routes[0].legs[i].start_location.lng(name)
                );
              } else {
                console.log("setMarker", i);
                //start
                this.setMarker(
                  String.fromCharCode((i + 97).toString()),
                  response.routes[0].legs[i].start_address,
                  _this.new_list[i],
                  response.routes[0].legs[i].start_location.lat(name),
                  response.routes[0].legs[i].start_location.lng(name)
                );

                //end
                var index = _this.new_list.length - 1;
                this.setMarker(
                  String.fromCharCode((i + 98).toString()),
                  response.routes[0].legs[i].end_address,
                  _this.new_list[index],
                  response.routes[0].legs[i].end_location.lat(name),
                  response.routes[0].legs[i].end_location.lng(name)
                );
              }
            }

            //這裡是他文字路線的顯示(成功)
            var route = response.routes[0];
            var summaryPanel = document.getElementById("directions-panel");
            summaryPanel.innerHTML = "";

            for (var i = 0; i < response.routes[0].legs.length; i++) {
              if (i != response.routes[0].legs.length - 1) {
                summaryPanel.innerHTML +=
                  String.fromCharCode((i + 97).toString()).toUpperCase() +
                  ": " +
                  response.routes[0].legs[i].start_address +
                  "<br />" +
                  "↓" +
                  "<br />";
              } else {
                summaryPanel.innerHTML +=
                  String.fromCharCode((i + 97).toString()).toUpperCase() +
                  ": " +
                  response.routes[0].legs[i].start_address +
                  "<br />" +
                  "↓" +
                  "<br />" +
                  String.fromCharCode((i + 98).toString()).toUpperCase() +
                  ": " +
                  response.routes[0].legs[i].end_address;
              }
            }
          } else {
            window.alert(
              "無法規劃該路線 Directions request failed due to " + status
            );
          }
        }
      );
    },
    deleteMarkers() {
      var sydney = new google.maps.LatLng(-33.867, 151.195);
      this.map = new google.maps.Map(this.$refs.bmap, {
        center: sydney,
        zoom: 7.9,
        maxZoom: 20,
        minZoom: 3
      });

      /*map = new google.maps.Map(document.getElementById("map"), {
        center: sydney,
        zoom: 15
      });*/

      var request = {
        query: "Museum of Contemporary Art Australia",
        fields: ["name", "geometry"]
      };

      const service = new google.maps.places.PlacesService(map);

      service.findPlaceFromQuery(request, (results, status) => {
        if (status === google.maps.places.PlacesServiceStatus.OK) {
          for (var i = 0; i < results.length; i++) {
            this.createMarker(results[i]);
          }
        }
      });
    },

    createMarker(place) {
      var marker = new google.maps.Marker({
        map: map,
        position: place.geometry.location
      });
      console.log("name: ", place.name);
      console.log("place: ", place);
      /*google.maps.event.addListener(marker, "click", function() {
        infowindow.setContent(place.name);
        infowindow.open(map, this);
      });*/
    },
    setMarker(order, address, site_name, lat, lng) {
      console.log(lat, lng);
      // this.deleteMarkers();
      // 建立一個新地標
      const marker = new google.maps.Marker({
        // 設定地標的座標
        position: { lat: parseFloat(lat), lng: parseFloat(lng) },
        // 設定地標要放在哪一個地圖
        label: order.toUpperCase(),
        map: this.map
      });
      this.markers.push(marker);

      const infowindow = new google.maps.InfoWindow({
        // 設定想要顯示的內容
        content:
          `
           <b> ${site_name} </b> </br>` +
          `
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
  },
  watch: {
    start: function(val) {
      // console.log("start:", this.originOptions);
      this.waypointOptions = this.waypointOptions.filter(item => {
        return item != this.start;
      });
      this.endOptions = this.endOptions.filter(item => {
        return item != this.start;
      });
      //console.log("this.item_1:", this.waypointOptions);
    },
    waypoint: function(val) {
      console.log("waypoint:", this.waypoint);

      this.waypoint.forEach((item, index) => {
        this.endOptions = this.endOptions.filter(a => {
          console.log(a);
          return a != item;
        });
        console.log("this.item_1:", this.endOptions);
      });
    }
  }
};
</script>
<style scoped>
.google-map {
  width: 100%;
  height: 700px;
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
/*#directions-panel {
  margin-top: 10px;
  background-color: #ffee77;
  padding: 5px;
  overflow: scroll;
  height: 174px;
}*/
</style>
