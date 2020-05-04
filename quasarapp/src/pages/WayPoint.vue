<template>
  <div>
    <Gmap id="map" ref="map" :center="center" :zoom="zoom"></Gmap>
    <div id="right-panel">
      <div>
        <b>Start:</b>
        <select id="start">
          <option value="Halifax, NS">Halifax, NS</option>
          <option value="Boston, MA">Boston, MA</option>
          <option value="New York, NY">New York, NY</option>
          <option value="Miami, FL">Miami, FL</option>
        </select>
        <br />
        <b>Waypoints:</b> <br />
        <i>(Ctrl+Click or Cmd+Click for multiple selection)</i> <br />
        <select multiple id="waypoints">
          <option value="montreal, quebec">Montreal, QBC</option>
          <option value="toronto, ont">Toronto, ONT</option>
          <option value="chicago, il">Chicago</option>
          <option value="winnipeg, mb">Winnipeg</option>
          <option value="fargo, nd">Fargo</option>
          <option value="calgary, ab">Calgary</option>
          <option value="spokane, wa">Spokane</option>
        </select>
        <br />
        <b>End:</b>
        <select id="end">
          <option value="Vancouver, BC">Vancouver, BC</option>
          <option value="Seattle, WA">Seattle, WA</option>
          <option value="San Francisco, CA">San Francisco, CA</option>
          <option value="Los Angeles, CA">Los Angeles, CA</option>
        </select>
        <br />
        <input type="submit" id="submit" @click="prompt" />
      </div>
      <div id="directions-panel"></div>
    </div>
  </div>
</template>

<script>
export default {
  name: "WayPoint",
  data() {
    return {
      map: null,
      // 預設經緯度在信義區附近
      center: { lat: 41.85, lng: -87.65 },
      zoom: 6
    };
  },
  mounted() {
    this.initMap();
  },
  methods: {
    initMap() {
      this.directionsService = new google.maps.DirectionsService();
      this.directionsDisplay = new google.maps.DirectionsRenderer();
      this.directionsDisplay.setMap(this.$refs.map.$mapObject);
      this.prompt();
    },

    prompt() {
      //按鈕按下要做麼
      calculateAndDisplayRoute(directionsService, directionsRenderer);
    },

    calculateAndDisplayRoute(directionsService, directionsRenderer) {
      var waypts = [];
      var checkboxArray = this.waypoints;
      for (var i = 0; i < checkboxArray.length; i++) {
        if (checkboxArray.options[i].selected) {
          waypts.push({
            location: checkboxArray[i].value,
            stopover: true
          });
        }
      }
      getRoute();
    },

    getRoute() {
      this.directionsService.route(
        {
          origin: this.start,
          destination: this.end,
          waypoints: waypts,
          optimizeWaypoints: true,
          travelMode: "DRIVING"
        },
        function(response, status) {
          if (status === "OK") {
            this.directionsDisplay.setDirections(response);
          } else {
            console.log("Directions request failed due to " + status);
          }
        }
      );
    }
  },
  components: {
    Gmap: () => import("components/map/googleMap.vue")
  }
};
</script>

<style lang="css">
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

#waypoints {
  height: 150px;
}

#right-panel i {
  font-size: 12px;
}
html,
body {
  height: 100%;
  margin: 0;
  padding: 0;
}
#map {
  height: 100%;
  float: left;
  width: 70%;
  height: 100%;
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
