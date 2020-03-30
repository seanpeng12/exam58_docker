<template>
  <q-page class="flex flex-center">
    <img alt="Quasar logo" src="~assets/quasar-logo-full.svg" />
    <input v-model="message" />
    <p>{{ message }}</p>
    <button @click="clear">clear</button>
  </q-page>
</template>

<script>
export default {
  name: "PageIndex",
  data() {
    return {
      message: "I love vue.js++++++++++++++++++++"
    };
  },
  methods: {
    clear() {
      this.message = "";
    }
  }
};
</script>
