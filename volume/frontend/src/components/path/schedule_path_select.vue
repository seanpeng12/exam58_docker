<template>
  <div class="col">
    <q-form @submit="runR()" class="q-gutter-md">
      <div class="row justify-center">
        <div class="q-gutter-xs">
          <div class="row q-pa-md">
            <q-select
              filled
              v-model="selected_site_local"
              :options="schedule_select"
              :rules="[ val => val && val.length > 1 || '請選擇景點']"
              label="選擇起始景點"
              style="width: auto;min-width:200px"
            >
              <template v-slot:no-option>
                <q-item>
                  <q-item-section class="text-grey">沒有結果</q-item-section>
                </q-item>
              </template>
            </q-select>
          </div>
        </div>
        <div class="q-gutter-xs" style="margin-top:8px">
          <div class="row q-pa-md">
            <q-btn :loading="loading4" color="cyan-9" type="submit">
              開始分析
              <template v-slot:loading>
                <q-spinner-hourglass />Loading...
              </template>
            </q-btn>
          </div>
        </div>
      </div>
    </q-form>
  </div>
</template>
<script>
import { mapGetters, mapActions } from "vuex";
export default {
  data() {
    return {
      schedule_select: [],
      selected_site_local: "",
      loading4: false
    };
  },

  computed: {
    ...mapGetters("travel", ["everydaySites"]),
    ...mapGetters("path", ["start_index_2"])
  },
  methods: {
    ...mapActions("path", ["searchCity"]),
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
      });
    },
    runR() {
      var _this = this;
      let promise = new Promise(function(resolve, reject) {
        _this.$store.commit(
          "path/Update_Selected_Site",
          _this.selected_site_local
        );
        resolve("result");
      });

      promise.then(function(result) {
        _this.searchCity(_this.selected_site_local);
        // start_index_2 +1
        _this.$store.commit("path/Update_Start_Index_2", 1);
      });
      //
      // this.searchCity(this.selected_site_local);
      // this.$store.commit("path/Update_Selected_Site", this.selected_site_local);
    },
    startComputing(id) {
      // 開啟loading狀態
      this[`loading${id}`] = true;
      this[`percentage${id}`] = 0;
      // 設定增加速度間距
      this[`interval${id}`] = setInterval(() => {
        this[`percentage${id}`] += Math.floor(Math.random() * 8 + 5);
        if (this[`percentage${id}`] >= 100) {
          clearInterval(this[`interval${id}`]);
          // 完成時關閉loading狀態
          this[`loading${id}`] = false;
        }
      }, 2100);
    }
  },
  mounted: function() {
    // 初始化時取第一層城市資料(vuex)
    this.gatAllSites();
  }
};
</script>
