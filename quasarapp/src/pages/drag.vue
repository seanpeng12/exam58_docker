<template>
  <q-btn label="get" @click="getDay()"></q-btn>
</template>
<script>
import { mapActions, mapGetters } from "vuex";
export default {
  computed: { ...mapGetters("travel", ["everydaySites"]) },
  methods: {
    getDay() {
      console.log("getDay", this.everydaySites);
      const dateList = Object.keys(this.everydaySites);
      const item_1 = [];
      // 日期作為下面item的物件選項(radio)
      dateList.forEach(function(item, index, array) {
        item_1.push({
          label: item,
          value: item,
          color: "secondary"
        });
        console.log("item_1:", item_1);
      });
    }
  }
};
</script>
