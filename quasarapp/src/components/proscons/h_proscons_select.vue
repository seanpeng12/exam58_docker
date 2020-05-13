<template>
  <!-- 三個下拉式選單 -->
  <div class="row">
    <div class="q-gutter-xs">
      <!-- 下拉式選單 -->
      <div class="q-pa-md">
        <div class="row">
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
            style="width:250px; padding-bottom: 32px"
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
    <div class="q-gutter-xs ">
      <!-- 下拉式選單 -->
      <div class="q-pa-md">
        <div class="row">
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
            style="width:250px; padding-bottom: 32px"
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
    <div class="q-gutter-xs q-pa-md" style="margin-top:8px;">
      <!-- 按鈕 -->
      <q-btn
        :loading="loading1"
        :percentage="percentage1"
        color="cyan-9"
        @click="startComputing(1), showAddColletionFilter()"
        v-on:click="runR()"
        style="width:150px; margin-right:10px"
      >
        開始
        <template v-slot:loading>
          <q-spinner-gears class="on-left" />分析中...
        </template>
      </q-btn>
      <slot
        name="addToCollection"
        v-if="
          loggedIn == true &&
            showAddToCollection == true &&
            checkCollectionExist.exists == false
        "
      ></slot>
      <q-btn
        v-else-if="
          loggedIn == true &&
            showAddToCollection == true &&
            checkCollectionExist.exists == true
        "
        :disable="!progress"
        color="red-7"
        @click="progress = false"
        label="已在收藏列表"
      ></q-btn>
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
      percentage1: 0,
      showAddToCollection: false,
      progress: false
    };
  },
  computed: {
    // 取得vuex state值
    ...mapGetters("h_proscons", [
      "citys",
      "sites",
      "selected_city",
      "h_prosConsselected_site",
      "start_index",
      "run_index",
      "data_index",
      "checkCollectionExist"
    ]),
    ...mapGetters("auth", ["loggedIn"])
  },

  methods: {
    // 由此找vuex所需method
    ...mapActions("h_proscons", ["fetchCitys"]),
    ...mapActions("h_proscons", ["fetchSites"]),
    ...mapActions("h_proscons", ["fetchProsConsR"]),
    ...mapActions("h_proscons", ["fetchCons"]),
    ...mapActions("h_proscons", ["fetchPros", "siteExistsCollection"]),

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
      this.$store.commit("h_proscons/Update_Start_Index", 1);
      console.log("start_index+1");
      // R
      this.fetchProsConsR();
      // 懶人包
      this.fetchCons();
      this.fetchPros();
    },

    showAddColletionFilter() {
      // 顯示收藏鈕開關
      this.$store
        .dispatch("h_proscons/siteExistsCollection", this.selected_site_local)
        .then(() => {
          console.log("test:", this.checkCollectionExist.exists);

          setTimeout(() => {
            this.showAddToCollection = true;
          }, 2000);
        })
        .then(() => {
          // console.log(this.showAddToCollection);
        });

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
      this.$store.commit("h_proscons/Update_Selected_City", val);
      // 執行第二層ajax(vuex)
      this.fetchSites();
      // 清空下一層
      this.selected_site_local = "";
      // 顯示收藏鈕開關

      this.showAddToCollection = false;
    },
    selected_site_local(val) {
      console.log("偵測到變動 commit site!", val);
      this.$store.commit("h_proscons/Update_Selected_Site", val);
      // 顯示收藏鈕開關

      this.showAddToCollection = false;
      // this.$store.dispatch(
      //   "h_proscons/siteExistsCollection",
      //   this.selected_site_local
      // );
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
