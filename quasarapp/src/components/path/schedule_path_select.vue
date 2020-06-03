<template>
  <div class="q-pa-md">
    <div class="row">
      <div class="col">
        <q-select
          filled
          v-model="selected_p_local"
          v-on:change="onProductChange"
          use-input
          hide-selected
          fill-input
          input-debounce="0"
          :options="schedule_select"
          @filter="filterFn"
          label="選擇城市"
          style="width: 250px;"
        >
          <template v-slot:no-option>
            <q-item>
              <q-item-section class="text-grey">沒有結果</q-item-section>
            </q-item>
          </template>
        </q-select>
      </div>
      <div class="col q-mt-md" style="margin-left:130px">
        <q-btn
          :loading="loading4"
          color="cyan-9"
          @click="simulateProgress(4)"
          v-on:click="runR(1)"
        >
          開始分析
          <template v-slot:loading>
            <q-spinner-hourglass />Loading...
          </template>
        </q-btn>
      </div>
    </div>
  </div>
</template>
<script>
import { mapGetters } from "vuex";
export default {
  data() {
    return {
      schedule_select: []
    };
  },

  computed: { ...mapGetters("travel", ["everydaySites"]) },
  methods: {
    gatAllSites() {
      const dateList = Object.keys(this.everydaySites);
      const item_1 = [];
      // 日期作為下面item的物件選項(radio)
      dateList.forEach((item, index, array) => {
        var allDaysSites = this.everydaySites[item];
        allDaysSites.forEach((data, index) => {
          this.schedule_select.push(data);
          // console.log("allDaysSites:", data);
        });

        console.log("date:", item);
      });
      // var everydaySites = this.everydaySites["2020-05-21"];
      // console.log("everydaySites", everydaySites);
      // everydaySites.forEach((item, index) => {
      //   this.originOptions.push(item);
      //   this.waypointOptions.push(item);
      //   this.endOptions.push(item);
      // });
    }
  },
  mounted: function() {
    // 初始化時取第一層城市資料(vuex)
    this.gatAllSites();
  }
};
</script>
