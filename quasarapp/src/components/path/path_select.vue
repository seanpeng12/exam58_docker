<template>
  <div class="col">
    <!-- 2個下拉式選單 -->
    <q-form @submit="runR();startComputing(1)" class="q-gutter-md">
      <div class="row">
        <div class="col" style="width:300px">
          <!-- 下拉式選單 -->

          <div style="float: right;">
            <div class="row">
              <q-option-group
                style="width:auto"
                v-model="choose"
                :options="[
                  {
                    label: '景點',
                    value: 'site'
                  },
                  {
                    label: '飯店',
                    value: 'hotel'
                  }
                ]"
                color="primary"
              />
            </div>
          </div>
        </div>

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
                label="選擇城市"
                :rules="[ val => val && val.length > 1 || '請選擇城市']"
                style=" padding-bottom: 32px"
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
                label="選擇景點"
                :rules="[ val => val && val.length > 1 || '請選擇景點']"
                style=" padding-bottom: 32px"
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
            :loading="loading1"
            :percentage="percentage1"
            color="cyan-9"
            type="submit"
            style="width: 200px;"
          >
            開始
            <template v-slot:loading>
              <q-spinner-hourglass class="on-left" />Loading...
            </template>
          </q-btn>
        </div>
      </div>
    </q-form>
  </div>
</template>

<script>
import { mapGetters } from "vuex";
import { mapActions } from "vuex";

const stringOptions = ["台北", "桃園", "新竹", "苗栗", "台東"];
export default {
  data() {
    return {
      // toggle選擇
      choose: "site",
      // 選單選擇資料
      selected_city_local: "",
      selected_site_local: "",
      selected_site_2_local: "",

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
    ...mapGetters("path", [
      "citys",
      "sites",
      "selected_city",
      "selected_site",
      "selected_site_2",
      "start_index",
      "run_index",
      "data_index"
    ])
  },

  methods: {
    // 由此找vuex所需method
    ...mapActions("path", ["fetchCitys"]),
    ...mapActions("path", ["fetchSites"]),
    ...mapActions("path", ["h_fetchSites"]),
    ...mapActions("path", ["fetchPathR"]),
    ...mapActions("path", ["fetchPath"]),

    // 計算loading時間
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
    },

    runR() {
      // start_index +1
      this.$store.commit("path/Update_Start_Index", 1);
      // run path.R
      this.fetchPathR();
      // 取第一層懶人包
      this.fetchPath();
      console.log("觸發 fetchPathR");
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
      if (this.choose == "site") {
        this.fetchSites();
      } else {
        this.h_fetchSites();
      }
      // 清除第二層值
      this.selected_site_local = "";
    },
    selected_site_local(val) {
      // console.log("偵測到變動 commit site!", val);
      this.$store.commit("path/Update_Selected_Site", val);
    },
    run_index(val) {
      this[`percentage1`] = 97;
    },
    choose(val) {
      if (val == "site") {
        this.fetchSites();
      } else {
        this.h_fetchSites();
      }
      // 清除第二層值
      this.selected_site_local = "";
    }
  },
  mounted: function() {
    // 初始化時取第一層城市資料(vuex)
    this.fetchCitys();
  }
};
</script>
>
