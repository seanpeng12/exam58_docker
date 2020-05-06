<template>
  <div class="col">
    <!-- 三個下拉式選單 -->
    <div class="row">
      <div class="col">
        <!-- 下拉式選單 -->

        <div class="q-pa-md">
          <div class="q-gutter-md row">
            <q-select
              filled
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
        <!-- 按鈕 -->
        <q-btn
          :loading="loading1"
          :percentage="percentage1"
          color="cyan-9"
          @click="startComputing(1)"
          v-on:click="runR()"
          style="width: 150px"
        >
          開始
          <template v-slot:loading>
            <q-spinner-gears class="on-left" />分析中...
          </template>
        </q-btn>
        <slot name="addToCollection"></slot>

        <q-btn size="10px" round color="blue-grey-8" icon="help" style="margin-left:10px">
          <q-tooltip
            anchor="center right"
            self="center left"
            :offset="[10, 10]"
            content-class="bg-blue-grey-8"
          >
            依您
            <strong>選擇的景點</strong>做分析，統整優點/缺點
          </q-tooltip>
        </q-btn>
        <!-- end -->
      </div>
    </div>
  </div>
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

      // 預設options資料
      options: stringOptions,

      // 分析按鈕
      loading1: false,
      // 按鈕百分比
      percentage1: 0
    };
  },
  computed: {
    // 取得vuex state值
    ...mapGetters("proscons", [
      "citys",
      "sites",
      "selected_city",
      "selected_site",
      "start_index",
      "run_index",
      "data_index"
    ])
  },

  methods: {
    // 由此找vuex所需method
    ...mapActions("proscons", ["fetchCitys"]),
    ...mapActions("proscons", ["fetchSites"]),
    ...mapActions("proscons", ["fetchProsConsR"]),
    ...mapActions("proscons", ["fetchCons"]),
    ...mapActions("proscons", ["fetchPros"]),

    startComputing(id) {
      // 開啟loading狀態
      this[`loading${id}`] = true;
      this[`percentage${id}`] = 0;
      // 設定增加速度間距
      this[`interval${id}`] = setInterval(() => {
        this[`percentage${id}`] += Math.floor(Math.random() * 8 + 10);
        if (this[`percentage${id}`] >= 100) {
          clearInterval(this[`interval${id}`]);
          // 完成時關閉loading狀態
          this[`loading${id}`] = false;
        }
      }, 700);
    },

    runR() {
      // start_index 開始
      this.$store.commit("proscons/Update_Start_Index", 1);
      console.log("start_index+1");
      // R
      this.fetchProsConsR();
      // 懶人包
      this.fetchCons();
      this.fetchPros();
      console.log("觸發 fetchProsConsR及優缺懶人包，run_index+1");
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
      this.$store.commit("proscons/Update_Selected_City", val);
      // 執行第二層ajax(vuex)
      this.fetchSites();
      // 清空下一層
      this.selected_site_local = "";
    },
    selected_site_local(val) {
      console.log("偵測到變動 commit site!", val);
      this.$store.commit("proscons/Update_Selected_Site", val);
    },
    data_index(val) {
      this[`percentage1`] = 97;
    }
  },
  mounted: function() {
    // 初始化時取第一層城市資料(vuex)
    this.fetchCitys();
  }
};
</script>
>
