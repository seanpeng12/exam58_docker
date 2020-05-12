<template>
  <q-page>
    <div class="q-pa-md" style="align-items: center">
      <div
        class="q-gt-xs q-pa-lg items-center text-black bg-grey-3"
        style="height: 300px;"
      >
        <div class="row" style>
          <div class="col"></div>
          <div class="col-12 col-md-auto">
            <p style="font-size: 28px;font-family: Microsoft JhengHei;">
              飯店需求分析
            </p>
          </div>

          <div class="col q-mt-sm q-ml-sm">
            <hSiDemandInfo></hSiDemandInfo>
          </div>
        </div>

        <div class="row">
          <div class="col"></div>

          <div class="col-md-auto">
            <div>
              <b
                class="text"
                style="font-size: 30px;font-family: Microsoft JhengHei;"
                >選擇想分析飯店的城市/類型</b
              >
              <br />
            </div>
          </div>
          <div class="col"></div>
        </div>
        <div class="row">
          <div class="col"></div>
          <div class="col-12 col-md-auto">
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
          </div>
          <div class="col"></div>
        </div>
      </div>
    </div>
    <!--  -->

    <!-- end web page -->

    <!-- 左右區域 web -->

    <div class="row q-pa-sm">
      <div class="col-md-6 q-pa-md" style="overflow:hidden;height:100%">
        <!-- iframe區域 -->
        <q-card
          class="my-card text-center q-pa-sm"
          style="height:100%;width:100%;max-height:800px;max-width:100%;"
        >
          <q-card-section>
            <div class="text-h6">需求分析圖</div>
            <div class="text-subtitle2">
              {{ r_title_1 }} {{ r_title_2 }} {{ r_title_3 }}
            </div>
          </q-card-section>

          <q-separator />

          <q-card-section>
            <demand-r :src="src" :runR_value="runR_value"></demand-r>
            <!-- loading 插件 -->
            <transition name="fade">
              <loading
                v-if="isLoading"
                :active.sync="isLoading"
                :can-cancel="false"
                :is-full-page="fullPage"
              ></loading>
            </transition>
            <!--  -->
          </q-card-section>
        </q-card>
      </div>
      <div class="col-md-6 q-pa-md" style="overflow:hidden;height:100%">
        <!-- 懶人包區域 -->
        <q-card
          class="my-card bg-secondary text-white"
          style="height:100%;width:100%;max-height:600px;max-width:100%;"
        >
          <transition name="fade" mode="out-in">
            <q-card-section>
              <b
                class="text"
                style="font-size: 25px;font-family: Microsoft JhengHei;"
                >{{ txtinfo }}</b
              >
            </q-card-section>
          </transition>

          <q-separator dark />
        </q-card>
        <div></div>

        <div class="q-pt-lg" style="height:100%;width:100%;max-width:100%;">
          <q-list bordered>
            <q-expansion-item
              group="somegroup"
              icon="explore"
              :label="
                selected_p_detail_item + ' ＆ ' + selected_p_detail_item_2
              "
              default-opened
              header-class="text-purple"
            >
              <q-card>
                <q-card-section>
                  <q-scroll-area
                    style="height:200px;width:100%;max-width: auto;"
                  >
                    <q-list>
                      <demand-data
                        v-for="(txtdata, key) in txtdatas"
                        :key="key"
                        :txtinfo="txtinfo"
                        :txtdata="txtdata"
                        @txtdatas_Update="txtdatas_toVuex"
                      >
                        <template
                          slot="addToCollection"
                          v-if="loggedIn == true"
                        >
                          <q-space />
                          <hAddToCollectionBtn
                            :txtdata="txtdata"
                            :id="key"
                            :city_name="txtdata.city_name"
                            :site_name="txtdata.name"
                            :address="txtdata.address"
                            :comment="txtdata.comment"
                            :rate="txtdata.rate"
                          ></hAddToCollectionBtn>
                        </template>
                      </demand-data>
                    </q-list>
                  </q-scroll-area>
                </q-card-section>
              </q-card>
            </q-expansion-item>

            <q-separator />

            <q-expansion-item
              group="somegroup"
              icon="explore"
              :label="selected_p_detail_item"
              header-class="text-primary"
            >
              <q-card>
                <q-card-section>
                  <!-- test txtdatas_diff -->
                  <q-scroll-area
                    style="height:200px;width:100%;max-width: auto;"
                  >
                    <q-list>
                      <demandDataDiff
                        v-for="(txtdata, key) in txtdatas_diff"
                        :key="key"
                        :txtinfo_diff="txtinfo"
                        :txtdata_diff="txtdata"
                        :selected_p_detail_item="selected_p_detail_item"
                        @txtdatas_Update="txtdatas_toVuex"
                      >
                        <template
                          slot="addToCollection"
                          v-if="loggedIn == true"
                        >
                          <q-space />
                          <hAddToCollectionBtn
                            :txtdata="txtdata"
                            :id="key"
                            :city_name="txtdata.city_name"
                            :site_name="txtdata.name"
                            :address="txtdata.address"
                            :comment="txtdata.comment"
                            :rate="txtdata.rate"
                          ></hAddToCollectionBtn>
                        </template>
                      </demandDataDiff>
                    </q-list>
                  </q-scroll-area>
                </q-card-section>
              </q-card>
            </q-expansion-item>

            <q-separator />

            <q-expansion-item
              group="somegroup"
              icon="explore"
              :label="selected_p_detail_item_2"
              header-class="text-primary"
            >
              <q-card>
                <q-card-section>
                  <q-scroll-area
                    style="height:200px;width:100%;max-width: auto;"
                  >
                    <q-list>
                      <demandDataDiff2
                        v-for="(txtdata, key) in txtdatas_diff"
                        :key="key"
                        :txtinfo_diff="txtinfo"
                        :txtdata_diff="txtdata"
                        :selected_p_detail_item_2="selected_p_detail_item_2"
                        @txtdatas_Update="txtdatas_toVuex"
                      >
                        <template
                          slot="addToCollection"
                          v-if="loggedIn == true"
                        >
                          <q-space />
                          <hAddToCollectionBtn
                            :txtdata="txtdata"
                            :id="key"
                            :city_name="txtdata.city_name"
                            :site_name="txtdata.name"
                            :address="txtdata.address"
                            :comment="txtdata.comment"
                            :rate="txtdata.rate"
                          ></hAddToCollectionBtn>
                        </template>
                      </demandDataDiff2>
                    </q-list>
                  </q-scroll-area>
                </q-card-section>
              </q-card>
            </q-expansion-item>

            <q-separator />
          </q-list>
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

// Import component
import Loading from "vue-loading-overlay";
// Import stylesheet
import "vue-loading-overlay/dist/vue-loading.css";

export default {
  name: "vueFrame",
  components: {
    Loading,
    demandSelect: () => import("components/demand/h_demand_select.vue"),
    demandR: () => import("components/demand/demand_R.vue"),
    demandData: () => import("components/demand/demand_data.vue"),
    demandDataDiff: () => import("components/demand/demand_data_diff.vue"),
    demandDataDiff2: () => import("components/demand/demand_data_diff2.vue"),

    hAddToCollectionBtn: () =>
      import("components/demand/h_addToCollectionBtn.vue"),
    hSiDemandInfo: () => import("components/demand/h_si_demand_info.vue")
  },
  computed: {
    // 取得vuex state值
    ...mapGetters("h_demand", [
      "citys",
      "cats",
      "txtdatas",
      "txtdatas_diff",
      "src",
      "Rdata",
      "txtinfo"
    ]),
    ...mapGetters("h_demand", [
      "selected_p",
      "selected_p_detail_item",
      "selected_p_detail_item_2",
      "runR_value",
      "after_axios"
    ]),
    ...mapGetters("auth", ["loggedIn"])

    // selected_p_trigger: {
    //   get: function() {
    //     return this.$store.state.selected_p;
    //   },
    //   set: function(value) {
    //     this.$store.commit("h_demand/update_selected_p", value);
    //   }
    // },
    // selected_p_detail_item_trigger: {
    //   get: function() {
    //     return this.$store.state.selected_p_detail_item;
    //   },
    //   set: function(value) {
    //     this.$store.commit("h_demand/update_selected_p_detail_item", value);
    //   }
    // },
    // selected_p_detail_item_2_trigger: {
    //   get: function() {
    //     return this.$store.state.selected_p_detail_item_2;
    //   },
    //   set: function(value) {
    //     this.$store.commit("h_demand/update_selected_p_detail_item_2", value);
    //   }
    // }
  },
  data() {
    return {
      // 暫存R_title
      r_title_1: "",
      r_title_2: "",
      r_title_3: "",
      // 給加入最愛使用
      loading4: false,
      //vue-loading-overley套件
      isLoading: false,
      fullPage: false
    };
  },

  methods: {
    // 由此找vuex所需method
    ...mapActions("h_demand", ["fetchCitys"]),
    ...mapActions("h_demand", ["fetchCats"]),
    ...mapActions("h_demand", ["upload_axios"]),
    ...mapActions("h_demand", ["upload_axios_2", "upload_axios_2_diff"]),

    changeSrc() {
      document.getElementById("myFrame").contentWindow.location.reload(true);
      // document.getElementById("myFrame").src =
      //   "./statics/h_between_relationship.html";
      this.isLoading = false;
      this.$store.commit(
        "h_demand/update_src",
        "./statics/h_between_relationship.html"
      );
      this.$store.commit(
        "h_demand/update_txtinfo",
        "分析完成! 已列出所有符合兩類別景點，請點選加入最愛："
      );
    },

    // from emit local then set vuex
    selected_1(value) {
      console.log("收到emit!");
      this.$store.commit("h_demand/update_selected_p", value);
      this.fetchCats();
      // 更改為初始值
      if (value == "") {
        this.$store.commit("demand/update_txtinfo", "請先選擇城市與需求");
      } else {
        this.$store.commit(
          "demand/update_txtinfo",
          "選擇兩種類別後，按開始以進行分析"
        );
      }
    },
    // from emit local then set vuex
    selected_2(value) {
      this.$store.commit("h_demand/update_selected_p_detail_item", value);
      // 更改為初始值
      this.$store.commit(
        "demand/update_txtinfo",
        "選擇兩種類別後，按開始以進行分析"
      );
    },
    // from emit local then set vuex
    selected_3(value) {
      this.$store.commit("h_demand/update_selected_p_detail_item_2", value);
      // 更改為初始值
      this.$store.commit(
        "demand/update_txtinfo",
        "選擇兩種類別後，按開始以進行分析"
      );
    },
    // 傳送runR引數至vuex
    run_R(value) {
      this.r_title_1 = this.selected_p;
      this.r_title_2 = this.selected_p_detail_item;
      this.r_title_3 = this.selected_p_detail_item_2;
      console.log("runR~h_demand");
      this.$store.commit("h_demand/update_runR_value", value);
      this.$store.commit("h_demand/update_txtinfo", "載入中...");
      // 更改為loading
      this.isLoading = true;
      this.$store.commit("h_demand/update_src", "about:blank");

      // document.getElementById("myFrame").src = "./statics/images/loader.gif";
      // vuex 跑R
      this.upload_axios();
    },
    // demand_data元件更改txtdatas至vuex
    txtdatas_toVuex(value) {
      this.$store.commit("h_demand/update_txtdatas", value);
    }
  },
  watch: {
    // 用以偵測R跑完成
    after_axios: function(val) {
      // 更換iframe
      this.changeSrc();
      // 在呼叫ajax取懶人包(vuex)
      this.upload_axios_2();
      this.upload_axios_2_diff();

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
    //   this.$store.commit("h_demand/update_selected_p_detail_item", val);
    // },
    // selected_p_detail_item_local2: function(val) {
    //   this.$store.commit("h_demand/update_selected_p_detail_item_2", val);
    // },
  },
  mounted: function() {
    // 初始化時取第一層城市資料(vuex)
    this.fetchCitys();
  }
};
</script>

<style>
.fade-enter-active,
.fade-leave-active {
  transition: opacity 2s;
}
.fade-enter, .fade-leave-to /* .fade-leave-active below version 2.1.8 */ {
  opacity: 0;
}

.frameStyle {
  width: 100%;
  height: 500px;
}
.de {
  padding-bottom: 50px;
}
</style>
