<template>
  <div id="q-app">
    <router-view />
  </div>
</template>

<script>
import { mapActions, mapState } from "vuex";
export default {
  name: "App",
  methods: {
    ...mapActions("auth", [
      "handleAuthStateChange",
      "readRole",
      "getLineUserDetail"
    ])
  },
  computed: {},
  mounted() {
    this.handleAuthStateChange();
    this.readRole();

    // let urlParams = new URLSearchParams(window.location.search);
    // let code = urlParams.get("code");
    // let state = urlParams.get("state");
    // console.log("mounted_code:", code);
    // alert(code + state);
    // this.getLineUserDetail(code);
    // this.getLineUserDetail();
  }

  // props: ["text"],
  // name: "App"
};
</script>
