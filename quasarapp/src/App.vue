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
    ...mapActions("auth", ["handleAuthStateChange", "readRole"])
  },
  computed: {},
  mounted() {
    this.handleAuthStateChange();
    this.readRole();
  }

  // props: ["text"],
  // name: "App"
};
</script>
