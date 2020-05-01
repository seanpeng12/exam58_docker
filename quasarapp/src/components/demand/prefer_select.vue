<template>
  <div class="q-pa-md doc-container  text-black bg-grey-3">
    <div class="row-12">
      <div class="text-center img_background">
        <b
          style="font-size: 28px;font-family: Microsoft JhengHei;padding-top:10px"
        >
          需求推薦分析
        </b>
        <!-- <b class="text" style="font-size: 30px;font-family: Microsoft JhengHei;"
          >選擇想到達的城市</b
        > -->
      </div>
    </div>
    <div class="gt-xs q-pa-sm row items-center" style="height: 100px;">
      <!-- <div class="row q-pt-md q-mb-lg"> -->
      <div class="col-3"></div>
      <div class="col-4">
        <q-select
          filled
          v-model="selected_p_local"
          v-on:change="onProductChange"
          use-input
          hide-selected
          fill-input
          input-debounce="0"
          :options="options"
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

      <div class="col">
        <!-- 按鈕 -->
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
import { mapActions } from "vuex";
const stringOptions = ["台北", "桃園", "新竹", "苗栗", "台東"];
export default {
  props: [
    // vuex from props 測試觀察用
    "selected_p",
    "selected_p_detail_item",
    "selected_p_detail_item_2",
    // 選單選擇資料
    "citys",
    "cats"
  ],
  data() {
    return {
      // 選單選擇資料
      selected_p_local: "",
      selected_p_detail_item_local: "",
      selected_p_detail_item_local2: "",
      // 預設options資料
      options: stringOptions,
      isShow: false,
      // 設定loading秒數
      n: 2000,
      loading4: false,
      // 預設options資料
      options: stringOptions
    };
  },
  // computed: {
  //   // 第一層
  //   selected_p_local: {
  //     get() {
  //       return this.selected_p_local;
  //     },
  //     set(val) {
  //       this.$emit("changed_1", val);
  //     }
  //   },
  //   // 第二層
  //   selected_p_detail_item_local: {
  //     get() {
  //       return this.selected_p_detail_item_local;
  //     },
  //     set(val) {
  //       this.$emit("changed_2", val);
  //     }
  //   },
  //   // 第三層
  //   selected_p_detail_item_local2: {
  //     get() {
  //       return this.selected_p_detail_item_local2;
  //     },
  //     set(val) {
  //       this.$emit("changed_3", val);
  //     }
  //   }
  // },
  methods: {
    ...mapActions("demand", ["resetTxtdatas", "resetTxtdatas_diff"]),
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
    // ???
    onProductChange: function() {
      // reset!
      this.selected_p_detail_item = "";
    },
    runR(val) {
      this.resetTxtdatas().then(() => {
        this.$emit("runR", val);
      });
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
      var b1 = Object.values(this.cats).map(cat => cat.tag);
      update(() => {
        const needle = val.toLowerCase();
        this.options = b1.filter(v => v.toLowerCase().indexOf(needle) > -1);
      });
    },
    // 第三層過濾清單
    filterFn_3(val, update, abort) {
      var b2 = Object.values(this.cats).map(cat => cat.tag);
      update(() => {
        const needle = val.toLowerCase();
        this.options = b2.filter(v => v.toLowerCase().indexOf(needle) > -1);
      });
    }
  },
  // 當選定第一層時emit回parent
  watch: {
    selected_p_local(val) {
      this.$emit("changed_1", val);
    },
    selected_p_detail_item_local(val) {
      this.$emit("changed_2", val);
    },
    selected_p_detail_item_local2(val) {
      this.$emit("changed_3", val);
    }
  }
};
</script>
>
