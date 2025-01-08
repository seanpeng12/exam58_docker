<template>
  <q-page>
    <!-- select 區塊 -->
    <transition name="demand-select">
      <div v-if="demand_select" class="q-pa-md" style="align-items: center">
        <div class="q-gt-xs q-pa-lg items-center text-black bg-grey-3" style="height: auto;">
          <div class="row" style>
            <div class="col"></div>
            <div class="col-12 col-md-auto">
              <b style="font-size: 30px;font-family: Microsoft JhengHei;">景點推薦</b>
            </div>

            <div class="col q-mt-sm q-ml-sm">
              <!-- <preferInfo></preferInfo> -->
            </div>
          </div>

          <div class="row">
            <div class="col"></div>

            <div class="col-md-auto">
              <div>
                <span
                  class="text"
                  style="font-size: 28px;font-family: Microsoft JhengHei;"
                >選擇想前往的城市，我們將依照您的喜好推薦景點</span>
                <br />
              </div>
            </div>
            <div class="col"></div>
          </div>
          <div class="row">
            <div class="col"></div>
            <div class="col-12 col-md-auto">
              <demand-prefer :citys="citys" :cats="cats" @changed_1="pre_selected_1" @runR="run_R"></demand-prefer>
            </div>
            <div class="col"></div>
          </div>
        </div>
      </div>
    </transition>
    <!--  -->

    <!-- 左右區域-->

    <div v-if="isShow">
      <!-- 彈出式視窗 -->
      <q-dialog v-model="icon">
        <q-card style="width: 1000px; max-width: 80vw;">
          <q-card-section class="row items-center q-pb-none">
            <div
              class="q-px-md q-py-none text-h6 text-bold"
              style="font-family: Microsoft JhengHei;"
            >優缺點與詳細資訊</div>
            <q-space />
            <q-btn icon="close" flat round dense v-close-popup />
          </q-card-section>

          <q-card-section>
            <div class="row">
              <!-- 優缺點 -->
              <div class="col-6 q-px-xs">
                <proscons>
                  <template slot="text_ProsExplain">
                    <!-- <q-chip>
                      <q-avatar color="green-8" text-color="white" size="15px"></q-avatar>
                      <span style="font-size: 15px;">
                        <b>{{prosdata}}顏色越深，好評中提及該關鍵字的人數越多，為此景點的特色</b>
                      </span>
                    </q-chip>-->
                  </template>
                  <template slot="text_ConsExplain">
                    <!-- <q-chip>
                      <q-avatar color="red-8" text-color="white" size="15px"></q-avatar>
                      <span style="font-size: 15px;">
                        <b>顏色越深，負評中提及該關鍵字的人數越多，您可以從中考慮是否要前往</b>
                      </span>
                    </q-chip>-->
                  </template>
                </proscons>
              </div>
              <!-- 詳細資訊介紹 -->
              <div class="col-6 q-pa-sm">
                <div class="row items-start q-gutter-md">
                  <q-card class="my-card" bordered style="width:100%;max-width:100%;">
                    <q-img style="height:200px;width:100%;" :src="Gdata.photos[0].url"></q-img>
                    <!-- <q-parallax :src="Gdata.photos[0].url" :height="300" /> -->
                    <q-card-section>
                      <div class="text-overline text-orange-9">
                        {{
                        Gdata.opening_hours.open_now
                        ? "營業中"
                        : "休息中/無營業時間資訊"
                        }}
                      </div>
                      <div class="text-h5 q-mt-sm q-mb-xs">{{ Gdata.name }}</div>
                      <div class="text-caption text-grey">
                        <q-chip
                          class="glossy"
                          color="orange"
                          text-color="white"
                          icon-right="star"
                        >{{ Gdata.rating }}</q-chip>
                        總評價數:{{ Gdata.rating_total }}
                      </div>
                    </q-card-section>

                    <q-card-actions>
                      <q-tabs v-model="tab" class="text-teal">
                        <q-tab label="詳細資訊" name="one" />
                        <q-tab label="營業時間" name="two" />
                      </q-tabs>
                    </q-card-actions>
                    <!-- tab -->
                    <q-separator />

                    <q-tab-panels v-model="tab" animated>
                      <q-tab-panel name="one">
                        <div v-if="Gdata.website != '無資料'">
                          <q-btn
                            rounded
                            type="a"
                            :href="Gdata.website"
                            target="__blank"
                            color="blue"
                            class="text-bold"
                            label="官方網站"
                          />
                        </div>
                        <div v-else>
                          <q-btn rounded color="primary" disable label="無官方網站" />
                        </div>
                        <div>
                          <q-chip
                            color="grey-7"
                            text-color="white"
                            icon="directions"
                          >{{ Gdata.address }}</q-chip>
                        </div>
                        <div>
                          <q-chip
                            outline
                            color="black"
                            text-color="white"
                            icon="phone"
                          >{{ Gdata.phone_number }}</q-chip>
                        </div>
                      </q-tab-panel>

                      <q-tab-panel name="two">
                        <div class="q-pa-xs">
                          營業時間:
                          <div v-if="Gdata.opening_hours == '無資料'">
                            <b>{{ Gdata.opening_hours }}</b>
                          </div>
                          <div
                            v-else
                            v-for="(a, index) in Gdata.opening_hours
                              .weekday_text"
                            :key="index"
                          >
                            <b>{{ a }}</b>
                          </div>
                        </div>
                      </q-tab-panel>
                    </q-tab-panels>
                  </q-card>
                </div>
              </div>
            </div>
          </q-card-section>
        </q-card>
      </q-dialog>
      <!-- 第一行 -->
      <div class="row q-pa-sm">
        <div
          class="col-md-6 q-pa-md"
          style="overflow:hidden;width:auto;height:100%;margin:0px auto;"
        >
          <!-- 懶人包區域 -->
          <div class="row">
            <div class="col-6">
              <div class="q-pa-lg" style="height:900px;width:800px;max-width:100%;">
                <q-toolbar class="bg-primary text-white shadow-2">
                  <q-toolbar-title>分析結果</q-toolbar-title>
                </q-toolbar>
                <q-list
                  bordered
                  class="bg-grey-1 text-bold"
                  style="height:100%;width:100%;max-width:100%;font-family: Microsoft JhengHei;"
                >
                  <q-expansion-item
                    group="somegroup"
                    icon="donut_small"
                    :label="
                      selected_p_detail_item + ' / ' + selected_p_detail_item_2
                    "
                    default-opened
                    header-class="text-purple"
                  >
                    <!-- txtdatas有資料 -->
                    <q-card>
                      <q-card-section>
                        <q-scroll-area style="height:200px;width:100%;max-width: auto;">
                          <q-list>
                            <div v-if="txtdatas_ok">
                              <!-- 元件一 -->
                              <demand-data
                                v-for="(txtdata, key) in txtdatas"
                                :key="key"
                                :index="key"
                                :txtinfo="txtinfo"
                                :txtdata="txtdata"
                                @txtdatas_Update="txtdatas_toVuex"
                                @site_name="getName"
                              >
                                <template slot="addToSchedule">
                                  <q-space />
                                  <q-btn
                                    icon-right="add"
                                    label="加進排程"
                                    color="warning"
                                    @click.stop="
                                      promptToAddSite({
                                        id: key,
                                        site: txtdata.name
                                      })
                                    "
                                    dense
                                    size="12px"
                                    style="margin-left:20px"
                                  />
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
                  </q-expansion-item>

                  <q-separator />

                  <q-expansion-item
                    group="somegroup"
                    icon="donut_large"
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
                              v-for="(txtdata, key) in txtdatas_diff2"
                              :key="key"
                              :txtinfo_diff="txtinfo"
                              :txtdata_diff="txtdata"
                              :selected_p_detail_item="selected_p_detail_item"
                              @txtdatas_Update="txtdatas_toVuex"
                              @site_name="getName"
                            >
                              <template slot="addToSchedule">
                                <q-space />
                                <q-btn
                                  icon-right="add"
                                  label="加進排程"
                                  color="warning"
                                  @click.stop="
                                    promptToAddSite({
                                      id: key,
                                      site: txtdata.name
                                    })
                                  "
                                  dense
                                  size="12px"
                                  style="margin-left:20px"
                                />
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
                    icon="donut_large"
                    :label="selected_p_detail_item_2"
                    header-class="text-primary"
                  >
                    <!-- txtdatas_diff有資料 -->
                    <q-card v-if="Object.keys(this.txtdatas_diff3).length">
                      <q-card-section>
                        <q-scroll-area style="height:200px;width:100%;max-width: auto;">
                          <q-list>
                            <demandDataDiff2
                              v-for="(txtdata, key) in txtdatas_diff3"
                              :key="key"
                              :txtinfo_diff="txtinfo"
                              :txtdata_diff="txtdata"
                              :selected_p_detail_item_2="
                                selected_p_detail_item_2
                              "
                              @txtdatas_Update="txtdatas_toVuex"
                              @site_name="getName"
                            >
                              <template slot="addToSchedule">
                                <q-space />
                                <q-btn
                                  icon-right="add"
                                  label="加進排程"
                                  color="warning"
                                  @click.stop="
                                    promptToAddSite({
                                      id: key,
                                      site: txtdata.name
                                    })
                                  "
                                  dense
                                  size="12px"
                                  style="margin-left:20px"
                                />
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
            <!-- 右 -->
            <div class="col-6">
              <div class="q-pa-lg">
                <div>
                  <!-- 介紹 -->
                  <q-card
                    class="my-card bg-secondary text-white text-center"
                    style="height:100%;max-height:600px;max-width:100%;"
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

                  <!-- iframe區域 -->

                  <q-card
                    class="my-card text-center q-pa-sm iframe"
                    style="height:100%;width:100%;max-height:800px;max-width:100%;"
                  >
                    <q-card-section>
                      <div class="row">
                        <div class="col-3"></div>
                        <div class="col text-h6">社會網絡分析圖</div>
                        <div class="col text-h6">
                          <demandInfo></demandInfo>
                        </div>
                      </div>
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
          </div>
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

    demandR: () => import("components/demand/demand_R.vue"),
    demandData: () => import("components/demand/demand_data.vue"),
    demandDataDiff: () => import("components/demand/demand_data_diff.vue"),
    demandDataDiff2: () => import("components/demand/demand_data_diff2.vue"),
    preferInfo: () => import("components/demand/prefer_info.vue"),
    demandPrefer: () => import("components/demand/prefer_select.vue"),
    demandInfo: () => import("components/demand/demand_info.vue"),

    addToCollectionBtn: () =>
      import("components/demand/addTocollectionBtn.vue"),

    // 優缺點(排程使用)
    proscons: () => import("components/proscons/proscons_data.vue")
  },
  computed: {
    // 取得vuex state值
    ...mapGetters("demand", [
      "citys",
      "cats",
      "txtdatas",
      "txtdatas_diff2",
      "txtdatas_diff3",
      "src",
      "Rdata",
      "txtinfo",
      "site_name",
      "Gdata"
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
    ...mapGetters("auth", ["loggedIn"]),
    ...mapGetters("travel", ["everydaySites"]),
    ...mapGetters("proscons", ["selected_site"])
  },
  props: ["id"],
  data() {
    return {
      //彈出式視窗觸發
      icon: false,
      //轉場觸發
      demand_select: false,
      // 觸發顯示右側詳細資訊
      Info_clicked: false,
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

      // card
      expanded: false,
      tab: "one",
      lorem:
        "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat."
    };
  },

  methods: {
    // 由此找vuex所需method
    ...mapActions("demand", ["fetchCitys"]),
    ...mapActions("demand", ["fetchCats"]),
    ...mapActions("demand", ["upload_axios", "fetchInfo"]),
    ...mapActions("demand", [
      "upload_axios_2",
      "upload_axios_2_diff",
      "upload_axios_3_diff"
    ]),
    ...mapActions("proscons", ["fetchPros", "fetchCons"]),
    ...mapActions("prefers", ["searchPrefer"]),

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

    getName(val) {
      // 開啟彈出式視窗
      this.icon = true;
      console.log("你點", val);
      // 同步state
      this.$store.commit("demand/FETCH_site_name", val);

      // 取dialog優缺數值
      var _this = this;
      let promise = new Promise(function(resolve, reject) {
        _this.$store.commit("proscons/Update_Selected_Site", val);
        resolve();
      });

      promise.then(function() {
        _this.fetchPros();
        _this.fetchCons();
      });

      // 取google資訊
      this.fetchInfo();
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
    },
    // 傳送runR引數至vuex
    run_R(value) {
      //是否顯示
      this.isShow = false;
      // info
      this.Info_clicked = false;

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
    },
    promptToAddSite(value) {
      const dateList = Object.keys(this.everydaySites);
      const item_1 = [];
      // 日期作為下面item的物件選項(radio)
      dateList.forEach(function(item, index, array) {
        item_1.push({
          label: item,
          value: item,
          color: "secondary"
        });
      });

      this.$q
        .dialog({
          title: "選擇您想加入的日期",
          message: "日期:",
          options: {
            type: "radio",
            model: "opt1",
            // inline: true
            items: item_1
          },
          cancel: true,
          persistent: true
        })
        .onOk(data => {
          console.log("promptToAddSite:", value, data);
          this.$store.dispatch("travel/fbAddEverySiteData", {
            site: value.site,
            date: data,
            scheduleId: this.id
          });

          // console.log('>>>> OK, received', data)
        })
        .onCancel(() => {
          // console.log('>>>> Cancel')
        })
        .onDismiss(() => {
          // console.log('I am triggered on both OK and Cancel')
        });
    },
    pre_selected_1(value) {
      console.log("收到emit!");
      this.searchPrefer();
      this.$store.commit("demand/update_selected_p", value);
      //.then(() => {
      //   this.$store.commit(
      //     "demand/update_selected_p_detail_item",
      //     this.firstPrefer.prefer1
      //   );
      //   this.$store.commit(
      //     "demand/update_selected_p_detail_item_2",
      //     this.firstPrefer.prefer2
      //   );
      // });
      // console.log(this.firstPrefer.prefer1, this.firstPrefer.prefer2);
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
      this.upload_axios_3_diff();

      // 清空選取資料
      this.selected_p_local = "";
      this.selected_p_detail_item_local = "";
      this.selected_p_detail_item_local2 = "";
    },

    txtdatas_diff_ok: function(val) {
      var _this = this;
      if (val == true) {
        let promise = new Promise(function(resolve, reject) {
          _this.$store.commit(
            "demand/update_txtinfo",
            "分析完成! 已列出所有符合兩類別景點，可以點選加入最愛："
          );

          resolve("result");
        });

        promise.then(function(result) {
          console.log("全部完成資料載入");
        });
      } else {
        console.log("error!檢查txtdatas_diff_ok");
      }
    },
    site_name: function(val) {
      this.Info_clicked = true;
    }
  },
  mounted: function() {
    // 初始化時取第一層城市資料(vuex)
    this.fetchCitys();
    // transition
    this.demand_select = true;
    // info
    this.Info_clicked = false;
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
