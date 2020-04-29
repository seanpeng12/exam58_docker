<template>
  <q-layout view="lHh LpR fFf">
    <q-header elevated class="bg-dark text-white">
      <q-toolbar>
        <q-btn dense flat round icon="menu" @click="left = !left" />

        <q-toolbar-title
          >自我規劃旅程{{ id }}{{ firstPrefer.prefer1 }}</q-toolbar-title
        >
      </q-toolbar>
    </q-header>

    <q-drawer show-if-above v-model="left" side="left" bordered :width="260">
      <!-- 往上一頁 -->
      <q-btn
        icon="keyboard_backspace"
        color="white"
        class="text-black"
        flat
        @click="darkDialog = true"
      />

      <!-- <q-btn
        dense
        color="warning"
        icon="add"
        @click="addDay"
        label="增加天數"
        class="absolute-top-right"
        style="margin-right:4px"
        flat
      />-->

      <q-dialog v-model="darkDialog">
        <q-card>
          <q-card-section>
            <div class="text-h4 font-color: warn">
              <q-icon name="report_problem" class="text-red" />提醒您
            </div>
          </q-card-section>

          <q-card-section class="q-pt-none"
            >請先儲存再跳回上一頁，以確保資料不會遺失</q-card-section
          >

          <q-card-actions align="right">
            <q-btn
              flat
              label="前往上一頁"
              color="primary"
              @click="lastReloadPage()"
              v-close-popup
            />
            <q-btn flat label="取消" color="primary" v-close-popup />
          </q-card-actions>
        </q-card>
      </q-dialog>

      <!-- 往上一頁結束 -->

      <div class="row">
        <div class="col-12">
          <draggableC
            v-model="EverydaySites"
            v-for="(everydaySite, key, index) in EverydaySites"
            :key="index"
            :index="index"
            :date="key"
            :id="id"
          ></draggableC>
        </div>
      </div>
    </q-drawer>

    <q-page-container>
      <q-page padding>
        <!-- <search /> -->
        <q-card>
          <q-tabs
            v-model="tab"
            dense
            class="text-grey"
            active-color="warning"
            indicator-color="warning"
            align="justify"
            narrow-indicator
          >
            <q-tab name="mails" label="Step1 " icon:label_important />
            <q-icon name="label_important" style="font-size: 32px;" />
            <q-tab name="alarms" label="Step2" />
            <q-icon name="label_important" style="font-size: 32px;" />
            <q-tab name="movies" label="路徑規劃分析" />
            <q-icon name="label_important" style="font-size: 32px;" />
            <q-tab name="advantage" label="優缺點分析" />
            <q-icon name="label_important" style="font-size: 32px;" />
            <q-tab name="aa" label="Google自動行程安排" />
          </q-tabs>

          <q-separator />
          <q-tab-panels v-model="tab" animated>
            <q-tab-panel name="mails">
              <!-- <q-banner class="bg-primary text-white">
                <div class="text-h6 row"></div>
              </q-banner>-->
              <div class="col-5" style="max-width: 300px">
                <search />
              </div>
              <!-- <div>透過需求分析</div>
              <div>自行搜尋</div>-->

              <div class="row">
                <LCard
                  v-for="(item, index, key) in collections"
                  :key="key"
                  :collection="item"
                  :index="key"
                  style="margin:4px;"
                >
                  <!-- 加入排程鈕 -->
                  <template slot="addToSchedule">
                    <q-btn
                      icon-right="add"
                      label="加進排程"
                      color="warning"
                      @click="promptToAddSite({ id: id, site: item.site_name })"
                      dense
                      size="12px"
                      style="margin-left:30px"
                    />
                  </template>
                </LCard>
              </div>
              <q-btn
                dense
                label="前往下一步"
                class="row absolute-bottom-right"
                color="secondary"
                style="max-width: 300px"
              />
            </q-tab-panel>

            <q-tab-panel name="alarms">
              <div class="text-h6">
                Tip: 需求分析
                <q-toggle
                  v-model="fourth"
                  checked-icon="check"
                  color="red"
                  label="使用您過去的偏好類別"
                  unchecked-icon="clear"
                />
              </div>
              <!-- <p>{{ after_axios }}</p> -->
              <!-- 需求分析 select -->

              <demand-select
                v-if="fourth == false"
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
              <!-- 偏好分析 -->
              <demand-prefer
                v-else
                :citys="citys"
                :cats="cats"
                :selected_p="selected_p"
                :selected_p_detail_item="selected_p_detail_item"
                :selected_p_detail_item_2="selected_p_detail_item_2"
                @changed_1="pre_selected_1"
                @changed_2="selected_2"
                @changed_3="selected_3"
                @runR="run_R"
              ></demand-prefer>

              <!-- 需求分析 R圖 -->

              <div class="q-pt-none">
                <div class="row">
                  <div class="col">
                    <demand-r :src="src" :runR_value="runR_value"></demand-r>
                  </div>

                  <!-- 需求分析 懶人包 -->

                  <div class="col">
                    <p
                      class="text"
                      style="font-size: 30px;font-family: Microsoft JhengHei;"
                    >
                      {{ txtinfo }}
                    </p>

                    <q-list bordered>
                      <q-expansion-item
                        group="somegroup"
                        icon="explore"
                        :label="
                          selected_p_detail_item +
                            '&&' +
                            selected_p_detail_item_2
                        "
                        default-opened
                        header-class="text-purple"
                      >
                        <q-card>
                          <q-card-section>
                            <q-scroll-area
                              style="height:200px; max-width: 600px;"
                            >
                              <q-list>
                                <demand-data
                                  v-for="(txtdata, key) in txtdatas"
                                  :key="key"
                                  :txtinfo="txtinfo"
                                  :txtdata="txtdata"
                                  @txtdatas_Update="txtdatas_toVuex"
                                >
                                  <template slot="addToSchedule">
                                    <q-space />
                                    <q-btn
                                      icon-right="add"
                                      label="加進排程"
                                      color="warning"
                                      @click="
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
                              style="height:200px; max-width: 600px;"
                            >
                              <q-list>
                                <demandDataDiff
                                  v-for="(txtdata, key) in txtdatas_diff"
                                  :key="key"
                                  :txtinfo_diff="txtinfo"
                                  :txtdata_diff="txtdata"
                                  :selected_p_detail_item="
                                    selected_p_detail_item
                                  "
                                  @txtdatas_Update="txtdatas_toVuex"
                                >
                                  <template slot="addToSchedule">
                                    <q-space />
                                    <q-btn
                                      icon-right="add"
                                      label="加進排程"
                                      color="warning"
                                      @click="
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
                        icon="explore"
                        :label="selected_p_detail_item_2"
                        header-class="text-primary"
                      >
                        <q-card>
                          <q-card-section>
                            <q-scroll-area
                              style="height:200px; max-width: 600px;"
                            >
                              <q-list>
                                <demandDataDiff2
                                  v-for="(txtdata, key) in txtdatas_diff"
                                  :key="key"
                                  :txtinfo_diff="txtinfo"
                                  :txtdata_diff="txtdata"
                                  :selected_p_detail_item_2="
                                    selected_p_detail_item_2
                                  "
                                  @txtdatas_Update="txtdatas_toVuex"
                                >
                                  <template slot="addToSchedule">
                                    <q-space />
                                    <q-btn
                                      icon-right="add"
                                      label="加進排程"
                                      color="warning"
                                      @click="
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
              </div>
              <!-- END -->
              <q-btn
                dense
                label="前往下一步"
                class="row absolute-bottom-right"
                color="secondary"
                size="20px"
                style="margin:8px"
              />
            </q-tab-panel>

            <q-tab-panel name="movies">
              <div class="text-h6">
                Tip: 路徑規畫分析(請從您的排程容器中選擇一個景點最為起始點)
              </div>
              <div class="row">
                <q-select
                  outlined
                  v-model="model_route"
                  :options="route"
                  label="選擇路徑的起點"
                  style="width: 250px; margin-left:32px"
                />
                <q-btn
                  dense
                  label="開始分析"
                  class
                  color="secondary"
                  size="15px"
                  style="width: 200px; margin-left:32px"
                />
                <q-btn
                  dense
                  label="納入此條路線"
                  class
                  color="warning"
                  size="15px"
                  style="margin-left: 100px"
                />
                <q-btn
                  dense
                  label="納入此景點"
                  class
                  color="warning"
                  size="15px"
                  style="margin-left:20px"
                />
              </div>
              <img src="~assets/route.jpg" />
              <q-btn
                dense
                label="前往下一步"
                class="row absolute-bottom-right"
                color="secondary"
                size="20px"
                style="margin:8px"
              />
            </q-tab-panel>
            <q-tab-panel name="advantage">
              <div class="text-h6">
                Tip: 優缺點分析(請選擇您想了解該景點的評價分析)
              </div>
              <q-page>
                <!-- proscons-select 區域 -->
                <proscons-select></proscons-select>
                <!-- end proscons select -->

                <!-- 左右區域 web -->
                <div class="q-pa-md">
                  <div class="row">
                    <div class="col-6">
                      <proscons-data></proscons-data>
                    </div>
                    <!-- 懶人包區域 -->
                    <div class="col-6">
                      <proscons-r></proscons-r>
                    </div>
                  </div>
                </div>
                <!-- end -->
              </q-page>

              <q-btn
                dense
                label="前往下一步"
                class="row absolute-bottom-right"
                color="secondary"
                size="20px"
                style="margin:8px"
              />
            </q-tab-panel>
            <q-tab-panel name="aa">
              <div class="text-h4">Tip: Google替您規劃最短路徑的景點順序</div>

              <img src="~assets/map.jpg" />
            </q-tab-panel>
          </q-tab-panels>
        </q-card>
      </q-page>
    </q-page-container>
  </q-layout>
</template>

<script>
import { mapActions } from "vuex";
import { mapGetters, mapState } from "vuex";
import draggable from "vuedraggable";

export default {
  data() {
    return {
      tab: "mails",
      left: false,
      darkDialog: false,
      model: null,
      model_route: null,
      model_city: null,
      fourth: true,
      route: ["台北101", "象山", "我家"],
      ssite: ["台北101", "象山", "十分老街"],
      options: ["台北市", "基隆市", "高雄市", "南投縣", "台南市"],
      id: "",
      date: "",
      prompt: false
    };
  },
  components: {
    draggableC: () => import("components/drag/draggableC.vue"),
    LCard: () => import("components/collection/LCard.vue"),
    search: () => import("components/search.vue"),
    // 引用需求元件
    demandSelect: () => import("components/demand/demand_select.vue"),
    demandPrefer: () => import("components/demand/prefer_select.vue"),
    demandR: () => import("components/demand/demand_R.vue"),
    demandData: () => import("components/demand/demand_data.vue"),
    demandDataDiff: () => import("components/demand/demand_data_diff.vue"),
    demandDataDiff2: () => import("components/demand/demand_data_diff2.vue"),
    // 引用優缺點元件
    prosconsSelect: () => import("components/proscons/proscons_select.vue"),
    prosconsR: () => import("components/proscons/proscons_R.vue"),
    prosconsData: () => import("components/proscons/proscons_data.vue")
  },
  computed: {
    ...mapGetters("travel", ["everydaySites"]),
    ...mapGetters("collections", ["collections"]),
    ...mapState("collections", ["search"]),
    ...mapGetters("prefers", ["firstPrefer"]),
    // demand
    ...mapGetters("demand", [
      "citys",
      "cats",
      "selected_p",
      "selected_p_detail_item",
      "selected_p_detail_item_2",
      "src",
      "runR_value",
      "txtdatas",
      "txtinfo",
      "after_axios",
      "txtdatas_diff"
    ]),
    // 取得vuex state變動值、優缺分析
    ...mapGetters("proscons", ["run_index"]),
    EverydaySites: {
      get() {
        // console.log("parent from get:", this.everydaySites);
        return this.everydaySites;
      },
      set(value) {
        // console.log("parent from set:", this.everydaySite);
        this.setDragkey(value);
      }
    }
  },
  methods: {
    ...mapActions("travel", [
      "updateDragSite",
      "setDragkey",
      "fbEverySiteData"
    ]),
    // 需求分析 由此找vuex所需method
    ...mapActions("demand", ["fetchCitys"]),
    ...mapActions("demand", ["fetchCats"]),
    ...mapActions("demand", ["changeSrc"]),
    ...mapActions("demand", ["upload_axios"]),
    ...mapActions("demand", ["upload_axios_2", "upload_axios_2_diff"]),
    // 偏好分析
    ...mapActions("prefers", ["searchPrefer"]),
    // ...mapActions("travel", ["fbAddEverySiteData"]),
    lastReloadPage() {
      this.$router.push("/mySchedule");
      this.$router.go(0);
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
    // 需求分析
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
    // 需求分析  from emit local then set vuex
    selected_1(value) {
      console.log("收到emit!");
      this.$store.commit("demand/update_selected_p", value);
      this.fetchCats();
    },
    // 需求分析  from emit local then set vuex
    selected_2(value) {
      this.$store.commit("demand/update_selected_p_detail_item", value);
    },
    // 需求分析  from emit local then set vuex
    selected_3(value) {
      this.$store.commit("demand/update_selected_p_detail_item_2", value);
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
    },
    // 需求分析  傳送runR引數至vuex
    run_R(value) {
      console.log("runRRRRRRRRRRRRRRR");
      this.$store.commit("demand/update_runR_value", value);
      this.$store.commit("demand/update_txtinfo", "載入中...");
      // 更改為loading
      document.getElementById("myFrame").src = "./statics/images/loader.gif";
      // vuex 跑R
      this.upload_axios();
    },
    // 需求分析 demand_data元件更改txtdatas至vuex
    txtdatas_toVuex(value) {
      this.$store.commit("demand/update_txtdatas", value);
    }
  },
  created() {
    var pass_id = this.$route.query.pass_id;
    this.id = pass_id;
    // console.log(this.$route.query.pass_id);

    // this.fbEverySiteData(this.id);
  },
  watch: {
    // 需求分析 用以偵測R跑完成
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
  },
  mounted: function() {
    // 需求分析 初始化時取第一層城市資料(vuex)
    this.fetchCitys();
  }
};
</script>
