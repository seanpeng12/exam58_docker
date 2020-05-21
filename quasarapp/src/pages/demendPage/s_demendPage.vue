<template>
  <q-page>
    <!-- select 區塊 -->
    <transition name="demand-select">
      <div v-if="demand_select" class="q-pa-md" style="align-items: center">
        <div class="q-gt-xs q-pa-lg items-center text-black bg-grey-3" style="height: 300px;">
          <div class="row" style>
            <div class="col"></div>
            <div class="col-12 col-md-auto">
              <p style="font-size: 28px;font-family: Microsoft JhengHei;">景點需求分析</p>
            </div>

            <div class="col q-mt-sm q-ml-sm">
              <sSiDemandInfo></sSiDemandInfo>
            </div>
          </div>

          <div class="row">
            <div class="col"></div>

            <div class="col-md-auto">
              <div>
                <b
                  class="text"
                  style="font-size: 30px;font-family: Microsoft JhengHei;"
                >選擇想分析的景點城市/類型</b>
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
    </transition>
    <!--  -->

    <!-- 左右區域-->

    <div v-if="isShow">
      <!-- 第一行 -->
      <div class="row q-pa-sm">
        <div class="col-md-6 q-pa-md" style="overflow:hidden;height:100%;margin:0px auto;">
          <!-- 懶人包區域 -->
          <q-card
            class="my-card bg-secondary text-white"
            style="height:100%;width:100%;max-height:600px;max-width:100%;"
          >
            <q-card-section>
              <b class="text" style="font-size: 25px;font-family: Microsoft JhengHei;">
                <q-circular-progress
                  v-show="!txtdatas_diff_ok"
                  indeterminate
                  size="50px"
                  color="lime"
                  class="q-ma-md"
                />
                {{ txtinfo }}
              </b>
            </q-card-section>

            <q-separator dark />
          </q-card>
          <div></div>

          <div class="q-pt-lg" style="height:100%;width:100%;max-width:100%;">
            <q-list bordered>
              <q-expansion-item
                group="somegroup"
                icon="explore"
                :label="selected_p_detail_item + ' / ' + selected_p_detail_item_2"
                default-opened
                header-class="text-purple"
              >
                <!-- txtdatas有資料 -->
                <q-card>
                  <q-card-section>
                    <q-scroll-area style="height:200px;width:100%;max-width: auto;">
                      <q-list>
                        <div v-if="txtdatas_ok">
                          <demand-data
                            v-for="(txtdata, key) in txtdatas"
                            :key="key"
                            :txtinfo="txtinfo"
                            :txtdata="txtdata"
                            @txtdatas_Update="txtdatas_toVuex"
                          >
                            <template slot="addToCollection" v-if="loggedIn == true">
                              <q-space />
                              <addToCollectionBtn
                                :txtdata="txtdata"
                                :id="key"
                                :city_name="txtdata.city_name"
                                :site_name="txtdata.name"
                                :address="txtdata.address"
                                :comment="txtdata.comment"
                                :rate="txtdata.rate"
                              ></addToCollectionBtn>
                            </template>
                          </demand-data>
                        </div>
                        <div v-if="!txtdatas_ok">
                          <q-item clickable v-ripple>
                            <q-item-section style="font-family: Microsoft JhengHei;">無交集資料</q-item-section>
                          </q-item>
                        </div>
                      </q-list>
                    </q-scroll-area>
                  </q-card-section>
                </q-card>
                <!-- loading 插件 -->
                <!-- <transition name="fade">
                  <loading v-if="ok" :active.sync="ok" :can-cancel="false" :is-full-page="fullPage"></loading>
                </transition>-->
                <!--  -->
              </q-expansion-item>

              <q-separator />

              <q-expansion-item
                group="somegroup"
                icon="explore"
                :label="selected_p_detail_item"
                header-class="text-primary"
              >
                <!-- txtdatas_diff有資料 -->
                <q-card>
                  <q-card-section>
                    <!-- test txtdatas_diff -->
                    <q-scroll-area style="height:200px;width:100%;max-width: auto;">
                      <q-list>
                        <demandDataDiff
                          v-for="(txtdata, key) in txtdatas_diff"
                          :key="key"
                          :txtinfo_diff="txtinfo"
                          :txtdata_diff="txtdata"
                          :selected_p_detail_item="selected_p_detail_item"
                          @txtdatas_Update="txtdatas_toVuex"
                        >
                          <template slot="addToCollection" v-if="loggedIn == true">
                            <q-space />
                            <addToCollectionBtn
                              :txtdata="txtdata"
                              :id="key"
                              :city_name="txtdata.city_name"
                              :site_name="txtdata.name"
                              :address="txtdata.address"
                              :comment="txtdata.comment"
                              :rate="txtdata.rate"
                            ></addToCollectionBtn>
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
                <!-- txtdatas_diff有資料 -->
                <q-card v-if="Object.keys(this.txtdatas_diff).length">
                  <q-card-section>
                    <q-scroll-area style="height:200px;width:100%;max-width: auto;">
                      <q-list>
                        <demandDataDiff2
                          v-for="(txtdata, key) in txtdatas_diff"
                          :key="key"
                          :txtinfo_diff="txtinfo"
                          :txtdata_diff="txtdata"
                          :selected_p_detail_item_2="selected_p_detail_item_2"
                          @txtdatas_Update="txtdatas_toVuex"
                        >
                          <template slot="addToCollection" v-if="loggedIn == true">
                            <q-space />
                            <addToCollectionBtn
                              :txtdata="txtdata"
                              :id="key"
                              :city_name="txtdata.city_name"
                              :site_name="txtdata.name"
                              :address="txtdata.address"
                              :comment="txtdata.comment"
                              :rate="txtdata.rate"
                            ></addToCollectionBtn>
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
      <!-- 第二行 -->
      <div class="row q-pa-sm">
        <div class="col-md-6 q-pa-md" style="overflow:hidden;height:100%;margin:0px auto;">
          <!-- iframe區域 -->
          <q-card
            class="my-card text-center q-pa-sm"
            style="height:100%;width:100%;max-height:800px;max-width:100%;"
          >
            <q-card-section>
              <div class="text-h6">需求分析圖</div>
              <div class="text-subtitle2">{{ r_title_1 }} {{ r_title_2 }} {{ r_title_3 }}</div>
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
      </div>
    </div>
    <!-- 介紹頁面 -->
    <div v-else class="row" style="font-family: Microsoft JhengHei;">
      <div
        class="col q-ma-md text-center text-h4 text-white"
        style="padding:150px; background-size: cover;background-position: center;background-repeat: no-repeat;background-image: url('https://images.unsplash.com/photo-1557683311-eac922347aa1?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1315&q=80');"
      >
        <p>
          請先選擇
          <b>城市</b>

          <br />
          <b>再選擇兩種類別</b>，按開始以進行分析
        </p>
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
import { mapActions, mapStates } from "vuex";
// Import component
import Loading from "vue-loading-overlay";
// Import stylesheet
import "vue-loading-overlay/dist/vue-loading.css";

export default {
  name: "vueFrame",
  components: {
    Loading,
    demandSelect: () => import("components/demand/demand_select.vue"),
    demandR: () => import("components/demand/demand_R.vue"),
    demandData: () => import("components/demand/demand_data.vue"),
    demandDataDiff: () => import("components/demand/demand_data_diff.vue"),
    demandDataDiff2: () => import("components/demand/demand_data_diff2.vue"),
    sSiDemandInfo: () => import("components/demand/s_si_demand_info.vue"),

    addToCollectionBtn: () => import("components/demand/addToCollectionBtn.vue")
  },
  computed: {
    // 取得vuex state值
    ...mapGetters("demand", [
      "citys",
      "cats",
      "txtdatas",
      "txtdatas_diff",
      "src",
      "Rdata",
      "txtinfo"
    ]),
    ...mapGetters("demand", [
      "selected_p",
      "selected_p_detail_item",
      "selected_p_detail_item_2",
      "after_axios",
      "runR_value",
      "txtdatas_ok",
      "txtdatas_diff_ok"
    ]),
    ...mapGetters("auth", ["loggedIn"])
  },
  data() {
    return {
      //轉場觸發
      demand_select: false,
      // 暫存R_title
      r_title_1: "",
      r_title_2: "",
      r_title_3: "",

      // 給加入最愛使用
      loading4: false,
      //vue-loading-overley套件
      isLoading: false,
      fullPage: false,

      //顯示下方頁面
      isShow: false,
      // ok
      ok: true
    };
  },

  methods: {
    // 由此找vuex所需method
    ...mapActions("demand", ["fetchCitys"]),
    ...mapActions("demand", ["fetchCats"]),
    ...mapActions("demand", ["upload_axios"]),
    ...mapActions("demand", ["upload_axios_2", "upload_axios_2_diff"]),

    changeSrc() {
      //
      var _this = this;
      let promise = new Promise(function(resolve, reject) {
        _this.isShow = true;
        resolve("result");
      });

      promise.then(function(result) {
        _this.isLoading = false;
        document.getElementById("myFrame").contentWindow.location.reload(true);
      });

      // document.getElementById("myFrame").contentWindow.location.reload(true);
      // document.getElementById("myFrame").src =
      //   "./statics/between_relationship.html";

      this.$store.commit(
        "demand/update_src",
        "http://140.136.155.116:8080/statics/between_relationship.html"
      );
      this.$store.commit("demand/update_txtinfo", "文字載入中...");
    },

    // from emit local then set vuex
    selected_1(value) {
      console.log("收到emit!");
      this.$store.commit("demand/update_selected_p", value);
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
      // hide
      this.isShow = false;
      // reset ok(loading關閉)
      this.ok = false;
    },
    // from emit local then set vuex
    selected_2(value) {
      this.$store.commit("demand/update_selected_p_detail_item", value);
      // 更改為初始值
      this.$store.commit(
        "demand/update_txtinfo",
        "選擇兩種類別後，按開始以進行分析"
      );
      // hide
      this.isShow = false;
      // reset ok(loading關閉)
      this.ok = false;
    },
    // from emit local then set vuex
    selected_3(value) {
      this.$store.commit("demand/update_selected_p_detail_item_2", value);
      // 更改為初始值
      this.$store.commit(
        "demand/update_txtinfo",
        "選擇兩種類別後，按開始以進行分析"
      );
      // hide
      this.isShow = false;
      // reset ok(loading關閉)
      this.ok = false;
    },
    // 傳送runR引數至vuex
    run_R(value) {
      //是否顯示
      this.isShow = false;
      this.r_title_1 = this.selected_p;
      this.r_title_2 = this.selected_p_detail_item;
      this.r_title_3 = this.selected_p_detail_item_2;
      console.log("runR~demand");
      this.$store.commit("demand/update_runR_value", value);
      this.$store.commit("demand/update_txtinfo", "載入中...");

      // 開始loading
      this.isLoading = true;
      this.$store.commit("demand/update_src", "about:blank");

      // document.getElementById("myFrame").src = "./statics/images/loader.gif";

      // reset txtdatas_ok
      this.$store.commit("demand/update_txtdatas_ok", false);
      this.$store.commit("demand/update_txtdatas_diff_ok", false);
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
      this.upload_axios_2_diff();

      // 清空選取資料
      this.selected_p_local = "";
      this.selected_p_detail_item_local = "";
      this.selected_p_detail_item_local2 = "";
    },
    // txtdatas_ok: function(val) {
    //   this.ok = !this.txtdatas_ok;
    // },
    txtdatas_diff_ok: function(val) {
      if (val == true) {
        this.$store.commit(
          "demand/update_txtinfo",
          "分析完成! 已列出所有符合兩類別景點，可以點選加入最愛："
        );
      }
      this.ok = !this.txtdatas_diff_ok;
    }
  },
  mounted: function() {
    // 初始化時取第一層城市資料(vuex)
    this.fetchCitys();
    // transition
    this.demand_select = true;
  }
};
</script>

<style scoped>
.fade-enter-active,
.fade-leave-active {
  transition: opacity 2s;
}
.fade-enter, .fade-leave-to /* .fade-leave-active below version 2.1.8 */ {
  opacity: 0;
}
/* transition */
.demand-select-enter-active {
  transition: opacity 1s ease;
}
.demand-select-enter {
  opacity: 0;
}
</style>
