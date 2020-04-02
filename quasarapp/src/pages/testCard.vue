<template>
  <Sitecard></Sitecard>
</template>

<script>
export default {
  data() {
    return {
      site_datas: [
        {
          id: 0,
          site: "aaa"
        },
        {
          id: 1,
          site: "bbb"
        },
        {
          id: 2,
          site: "ccc"
        }
      ]
    };
  },
  components: {
    Sitecard: require("components/card.vue").default
  }
};
</script>

<style>
</style>
