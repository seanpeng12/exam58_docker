<template>
  <q-page>
    <!-- web page 區域 -->
    <!-- <div>
      debug用
      <p>vuex：{{selected_p}} {{selected_p_detail_item}} {{selected_p_detail_item_2}}</p>
    </div>-->
    <demand-select
      :citys="citys"
      :cats="cats"
      :selected_p="selected_p"
      :selected_p_detail_item="selected_p_detail_item"
      :selected_p_detail_item_2="selected_p_detail_item_2"
      @changed_1="selected_1"
      @changed_2="selected_2"
      @changed_3="selected_3"
      @runR="run_R"
    ></demand-select>
    <!-- end web page -->

    <!-- 左右區域 web -->
    <div class="q-pa-md">
      <div class="row">
        <!-- iframe區域 -->
        <div class="col">
          <demand-r :src="src" :runR_value="runR_value"></demand-r>
        </div>
        <!-- 懶人包區域 -->
        <div class="col">
          <demand-data :txtinfo="txtinfo" :txtdatas="txtdatas" @txtdatas_Update="txtdatas_toVuex"></demand-data>
        </div>
      </div>
    </div>
    <!-- end -->

    <!-- web iframe 下方區域 gt-xs -->
    <div class="q-pa-md doc-container"></div>

    <!-- phone iframe 區域 lt-sm-->
  </q-page>
</template>

<script>
import { mapGetters } from "vuex";
import { mapActions } from "vuex";

export default {
  name: "vueFrame",
  components: {
    demandSelect: () => import("components/demand/demand_select.vue"),
    demandR: () => import("components/demand/demand_R.vue"),
    demandData: () => import("components/demand/demand_data.vue")
  },
  computed: {
    // 取得vuex state值
    ...mapGetters("demand", [
      "citys",
      "cats",
      "txtdatas",
      "src",
      "Rdata",
      "txtinfo"
    ]),
    ...mapGetters("demand", [
      "selected_p",
      "selected_p_detail_item",
      "selected_p_detail_item_2",
      "after_axios",
      "runR_value"
    ])

    // selected_p_trigger: {
    //   get: function() {
    //     return this.$store.state.selected_p;
    //   },
    //   set: function(value) {
    //     this.$store.commit("demand/update_selected_p", value);
    //   }
    // },
    // selected_p_detail_item_trigger: {
    //   get: function() {
    //     return this.$store.state.selected_p_detail_item;
    //   },
    //   set: function(value) {
    //     this.$store.commit("demand/update_selected_p_detail_item", value);
    //   }
    // },
    // selected_p_detail_item_2_trigger: {
    //   get: function() {
    //     return this.$store.state.selected_p_detail_item_2;
    //   },
    //   set: function(value) {
    //     this.$store.commit("demand/update_selected_p_detail_item_2", value);
    //   }
    // }
  },
  data() {
    return {
      // 給加入最愛使用
      loading4: false
    };
  },

  methods: {
    // 由此找vuex所需method
    ...mapActions("demand", ["fetchCitys"]),
    ...mapActions("demand", ["fetchCats"]),
    ...mapActions("demand", ["changeSrc"]),
    ...mapActions("demand", ["upload_axios"]),
    ...mapActions("demand", ["upload_axios_2"]),

    changeSrc() {
      document.getElementById("myFrame").contentWindow.location.reload(true);
      document.getElementById("myFrame").src =
        "./statics/between_relationship.html";
      // this.src = "./statics/between_relationship.html";
      this.$store.commit(
        "demand/update_txtinfo",
        "分析完成! 已列出所有符合兩類別景點，請點選加入最愛："
      );
    },

    // from emit local then set vuex
    selected_1(value) {
      console.log("收到emit!");
      this.$store.commit("demand/update_selected_p", value);
      this.fetchCats();
    },
    // from emit local then set vuex
    selected_2(value) {
      this.$store.commit("demand/update_selected_p_detail_item", value);
    },
    // from emit local then set vuex
    selected_3(value) {
      this.$store.commit("demand/update_selected_p_detail_item_2", value);
    },
    // 傳送runR引數至vuex
    run_R(value) {
      console.log("runRRRRRRRRRRRRRRR");
      this.$store.commit("demand/update_runR_value", value);
      this.$store.commit("demand/update_txtinfo", "載入中...");
      // 更改為loading
      document.getElementById("myFrame").src = "./statics/images/loader.gif";
      // vuex 跑R
      this.upload_axios();
    },
    // demand_data元件更改txtdatas至vuex
    txtdatas_toVuex(value) {
      this.$store.commit("demand/update_txtdatas", value);
    }
  },
  watch: {
    // 用以偵測R跑完成
    after_axios: function(val) {
      // 更換iframe
      this.changeSrc();
      // 在呼叫ajax取懶人包(vuex)
      this.upload_axios_2();
      // 隱藏按鈕
      this.isShow = false;
      // 清空選取資料
      this.selected_p_local = "";
      this.selected_p_detail_item_local = "";
      this.selected_p_detail_item_local2 = "";
    }
    // 第一層選擇城市 > 回傳第二層資料
    // selected_p_local: {
    //   handler(val) {
    //     // 傳送第一層城市到vuex

    //   },
    //   deep: true
    // },

    // selected_p_detail_item_local: function(val) {
    //   this.$store.commit("demand/update_selected_p_detail_item", val);
    // },
    // selected_p_detail_item_local2: function(val) {
    //   this.$store.commit("demand/update_selected_p_detail_item_2", val);
    // },
  },
  mounted: function() {
    // 初始化時取第一層城市資料(vuex)
    this.fetchCitys();
  }
};
</script>

<style>
.frameStyle {
  width: 100%;
  height: 500px;
}
.de {
  padding-bottom: 50px;
}
</style>
