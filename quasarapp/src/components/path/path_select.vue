<template>
  <!-- <div class="q-pa-md doc-container"> -->
  <!-- <div
      class="gt-xs q-pa-lg column items-center text-black bg-grey-3"
      style="height: 200px;"
  >-->
  <!-- <div class="col">
        <div class="text-center img_background">
          <p style="font-size: 28px;font-family: Microsoft JhengHei;">
            路徑分析
          </p>
        </div>
      </div>
      <div class="col">
        <div class="text-center img_background">
          <div>
            <b
              class="text"
              style="font-size: 20px;font-family: Microsoft JhengHei;"
              >不採雷的路線推薦，給拿不定下一站的您!</b
            >
            <br />
          </div>
        </div>
  </div>-->

  <div class="col">
    <!-- 三個下拉式選單 -->
    <div class="row">
      <div class="col">
        <!-- 下拉式選單 -->

        <div class="q-pa-md">
          <div class="q-gutter-md row">
            <q-select
              filled
              clearable
              v-model="selected_city_local"
              use-input
              hide-selected
              fill-input
              input-debounce="0"
              :options="options"
              @filter="filterFn"
              hint="選擇城市"
              style="width: 250px; padding-bottom: 32px"
            >
              <template v-slot:no-option>
                <q-item>
                  <q-item-section class="text-grey">沒有結果</q-item-section>
                </q-item>
              </template>
            </q-select>
          </div>
        </div>
        <!--  -->
      </div>
      <div class="col">
        <!-- 下拉式選單 -->

        <div class="q-pa-md">
          <div class="q-gutter-md row">
            <q-select
              filled
              clearable
              v-model="selected_site_local"
              use-input
              hide-selected
              fill-input
              input-debounce="0"
              :options="options"
              @filter="filterFn_2"
              hint="選擇景點"
              style="width: 250px; padding-bottom: 32px"
            >
              <template v-slot:no-option>
                <q-item>
                  <q-item-section class="text-grey">沒有結果</q-item-section>
                </q-item>
              </template>
            </q-select>
          </div>
        </div>
        <!--  -->
      </div>
      <div class="col q-pa-md" style="margin-top:8px">
        <q-btn
          :loading="loading4"
          color="cyan-9"
          @click="simulateProgress(4)"
          v-on:click="runR()"
          style="width: 150px"
        >
          選擇你的起始點
          <template v-slot:loading>
            <q-spinner-hourglass class="on-left" />Loading...
          </template>
        </q-btn>
      </div>
    </div>
  </div>
  <!-- </div> -->
  <!-- </div> -->
  <!-- <div class="gt-xs q-pa-lg column items-center text-black bg-grey-3">
  <div class="col">-->
  <!-- 按鈕 -->
  <!-- <q-btn
      :loading="loading4"
      color="cyan-9"
      @click="simulateProgress(4)"
      v-on:click="runR()"
      style="width: 150px"
    >
      選擇你的起始點
      <template v-slot:loading>
        <q-spinner-hourglass class="on-left" />Loading...
      </template>
    </q-btn>
  </div>-->
  <!-- </div>
  </div>-->
</template>

<script>
import { mapGetters } from "vuex";
import { mapActions } from "vuex";

const stringOptions = ["台北", "桃園", "新竹", "苗栗", "台東"];
export default {
  data() {
    return {
      // 選單選擇資料
      selected_city_local: "",
      selected_site_local: "",
      selected_site_2_local: "",

      // 預設options資料
      options: stringOptions,

      // 設定loading秒數
      n: 2000,
      loading4: false
    };
  },
  computed: {
    // 取得vuex state值
    ...mapGetters("path", [
      "citys",
      "sites",
      "selected_city",
      "selected_site",
      "selected_site_2",
      "run_index",
      "data_index"
    ])
  },

  methods: {
    // 由此找vuex所需method
    ...mapActions("path", ["fetchCitys"]),
    ...mapActions("path", ["fetchSites"]),
    ...mapActions("path", ["fetchProsConsR"]),
    ...mapActions("path", ["fetchPath"]),

    // 計算loading時間
    simulateProgress(number) {
      // we set loading state
      this[`loading${number}`] = true;
      // simulate a delay
      setTimeout(() => {
        // we're done, we reset loading state
        this[`loading${number}`] = false;
      }, 1000);
    },

    runR() {
      this.fetchProsConsR();
      // 取第一層懶人包
      this.fetchPath();
      console.log("觸發 fetchProsConsR");
    },
    // 第一層過濾清單
    filterFn(val, update, abort) {
      var a = Object.values(this.citys).map(city => city.city_name);
      update(() => {
        const needle = val.toLowerCase();
        this.options = a.filter(v => v.toLowerCase().indexOf(needle) > -1);
      });
    },
    // 第二層過濾清單
    filterFn_2(val, update, abort) {
      var b1 = Object.values(this.sites).map(site => site.name);
      update(() => {
        const needle = val.toLowerCase();
        this.options = b1.filter(v => v.toLowerCase().indexOf(needle) > -1);
      });
    }
  },

  watch: {
    selected_city_local(val) {
      console.log("偵測到變動 commit city!", val);
      this.$store.commit("path/Update_Selected_City", val);
      // 執行第二層ajax(vuex)
      this.fetchSites();
      // 清除第二層值
      this.selected_site_local = "";
    },
    selected_site_local(val) {
      console.log("偵測到變動 commit site!", val);
      this.$store.commit("path/Update_Selected_Site", val);
    }
  },
  mounted: function() {
    // 初始化時取第一層城市資料(vuex)
    this.fetchCitys();
  }
};
</script>
>
