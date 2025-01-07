import Vue from "vue";
import * as VueGoogleMaps from "vue2-google-maps";

export default ({ app, router, Vue }) => {
  Vue.use(VueGoogleMaps, {
    load: {
      apiKey: "AIzaSyDkS6nBwtRIUe55-p_oHZh6QocvIyUAG2A",
      libraries: ["places"]
    },
    installComponents: true
  });
};
