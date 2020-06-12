<template>
  <q-layout view="lHh LpR fFf">
    <q-header elevated class="bg-blue-grey-7 text-white">
      <q-toolbar>
        <q-btn dense flat round icon="menu" @click="left = !left" />

        <q-toolbar-title style="font-weight:bold">{{ title }}</q-toolbar-title>
        <q-item class="gt-xs" exact clickable to="/index">
          <q-item-section>
            <q-item-label class>首頁</q-item-label>
          </q-item-section>
        </q-item>
        <q-item class="gt-xs" exact clickable to="/mySchedule">
          <q-item-section>
            <q-item-label class>我的旅程表</q-item-label>
          </q-item-section>
        </q-item>
      </q-toolbar>
    </q-header>

    <q-drawer show-if-above v-model="left" side="left" bordered :width="260">
      <!-- 往上一頁 -->
      <q-icon class="q-mt-none q-mb-xs q-ml-md" color="#cccccc" name="help" size="26px">
        <q-tooltip anchor="top middle" content-class="q-pa-md bg-amber-2 text-black shadow-4"
          content-style="font-size: 14px" transition-show="fade" transition-hide="fade" :offset="[10, 10]">
          <span style="font-family:Microsoft JhengHei;">您可以搭配我們的分析步驟，把喜愛的景點飯店加入排程</span>
        </q-tooltip>
      </q-icon>
      <q-breadcrumbs-el label="天數" icon="touch_app" style="width:70px;margin-left:80px;magin-right:50px" size="18px"
        class="absolute-middle text-primary q-mt-sm" />
      <!-- <q-btn
        icon="keyboard_backspace"
        color="white"
        class="text-black"
        label="我的旅程表"
        flat
        @click="darkDialog = true"
      />-->

      <!-- <q-dialog v-model="darkDialog">
        <q-card>
          <q-card-section>
            <div class="text-h4 font-color: warn">
              <q-icon name="report_problem" class="text-red" />提醒您
            </div>
          </q-card-section>

          <q-card-section class="q-pt-none">請先儲存再跳回上一頁，以確保資料不會遺失</q-card-section>

          <q-card-actions align="right">
            <q-btn flat label="前往上一頁" color="primary" @click="lastReloadPage()" v-close-popup />
            <q-btn flat label="取消" color="primary" v-close-popup />
          </q-card-actions>
        </q-card>
      </q-dialog>-->

      <!-- 往上一頁結束 -->

      <div class="row">
        <div class="col-12">
          <draggableC v-model="EverydaySites" v-for="(everydaySite, key, index) in EverydaySites" :key="index"
            :index="index" :date="key" :id="id" :startDate="startDate"></draggableC>
        </div>
      </div>
    </q-drawer>

    <q-page-container>
      <q-page padding>
        <!-- <search /> -->
        <q-card>
          <q-tabs v-model="tab" dense class="text-grey title" active-color="warning" indicator-color="warning"
            align="justify" narrow-indicator>
            <q-tab name="collections" label="Step1(您的收藏) " icon:label_important />
            <q-icon name="label_important" style="font-size: 32px;" />
            <q-tab name="prosCons" label="Step2(加入自選景點或飯店)" />
            <q-icon name="label_important" style="font-size: 32px;" />

            <q-tab name="searchSite" label="Step3(找景點)" />
            <q-icon name="label_important" style="font-size: 32px;" />
            <q-tab name="searchHotel" label="Step4(找飯店)" />
            <q-icon name="label_important" style="font-size: 32px;" />
            <q-tab name="movies" label="Step5(路徑規劃分析)" />
            <q-icon name="label_important" style="font-size: 32px;" />

            <q-tab name="aa" label="Step6(Google自動行程安排)" />
          </q-tabs>

          <q-separator />
          <q-tab-panels v-model="tab" animated>
            <q-tab-panel name="collections">
              <!-- <q-banner class="bg-primary text-white">
                <div class="text-h6 row"></div>
              </q-banner>-->
              <div class="row q-pa-md doc-container text-black bg-grey-3">
                <q-tabs v-model="step1Tab" class="text-black">
                  <q-tab name="site" icon="fas fa-car-side" label="景點收藏" />
                  <q-tab name="hotel" icon="fas fa-hotel" label="飯店收藏" />
                </q-tabs>
                <q-space />
                <div class="col-5 q-pa-md" style="max-width: 300px">
                  <search />
                </div>
              </div>
              <!-- <div>透過需求分析</div>
              <div>自行搜尋</div>-->

              <div class="row q-mt-md" v-if="step1Tab == 'site'">
                <LCard v-for="(item, index, key) in collections" :key="key" :collection="item" :index="key"
                  style="margin:4px;">
                  <!-- 加入排程鈕 -->
                  <template slot="addToSchedule">
                    <q-btn icon-right="add" label="加進排程" color="warning"
                      @click="promptToAddSite({ id: id, site: item.site_name })" dense size="12px"
                      style="margin-left:45px" />
                  </template>
                </LCard>
              </div>
              <div class="row q-mt-md" v-else>
                <hCard v-for="(item, key) in h_collections" :key="key" :h_collection="item" :index="key"
                  style="margin-right: 4px;">
                  <template slot="addToSchedule">
                    <q-btn icon-right="add" label="加進排程" color="warning"
                      @click="promptToAddSite({ id: id, site: item.site_name })" dense size="12px"
                      style="margin-left:45px" />
                  </template>
                </hCard>
              </div>
            </q-tab-panel>
            <q-tab-panel name="prosCons">
              <div class="row q-mx-md q-pa-sm q-mb-none doc-container text-black bg-grey-3">
                <q-tabs v-model="step2Tab" class="text-black" dense>
                  <q-tab name="site" icon="fas fa-car-side" label="自選景點" />
                  <q-tab name="hotel" icon="fas fa-hotel" label="自選飯店" />
                </q-tabs>
              </div>
              <div v-if="step2Tab == 'site'">
                <!-- 選單部分 -->
                <div class="q-pa-md q-mt-none">
                  <div class="q-pa-md doc-container text-black bg-grey-3">
                    <div class="row text-h4">
                      <b>自選景點</b>

                      <!-- <prosconsInfo></prosconsInfo> -->
                    </div>
                    <div class="row q-pl-xl">
                      <!-- proscons-select 區域 -->
                      <proscons-select></proscons-select>
                      <!-- end proscons select -->
                    </div>
                  </div>
                </div>

                <q-page>
                  <!-- 左右區域 web -->
                  <transition name="hotel-select">
                    <div v-if="site_select" class="q-pa-md">
                      <div class="row">
                        <div class="col-6">
                          <proscons-data>
                            <template slot="addToSchedule">
                              <q-btn rounded icon="add" label="景點加進排程" color="warning" @click="promptToAddProsSite()"
                                dense size="12px" style="margin-left:30px;font-weight:bold" />
                            </template>
                            <template slot="text_ProsExplain">
                              <div class="row">
                                <div class="col-1 text-center">
                                  <q-avatar color="green-8" text-color="white" size="15px"></q-avatar>
                                </div>
                                <div class="col">
                                  <span style="font-size: 15px;">
                                    <b>顏色越深，好評中提及該關鍵字的人數越多，為此景點的特色</b>
                                  </span>
                                </div>
                              </div>
                            </template>
                            <template slot="text_ConsExplain">
                              <div class="row">
                                <div class="col-1 text-center">
                                  <q-avatar color="red-8" text-color="white" size="15px"></q-avatar>
                                </div>
                                <div class="col-11">
                                  <span style="font-size: 15px;">
                                    <b>顏色越深，負評中提及該關鍵字的人數越多，您可以從中考慮是否要前往</b>
                                  </span>
                                </div>
                              </div>
                            </template>
                          </proscons-data>
                        </div>
                        <!-- 懶人包區域 -->
                        <div class="col-6">
                          <proscons-r>
                            <template slot="photoExplain">
                              <sitePhotoInfo></sitePhotoInfo>
                            </template>
                          </proscons-r>
                        </div>
                      </div>
                    </div>
                  </transition>
                  <div v-if="!site_select" class="row" style="font-family: Microsoft JhengHei;">
                    <div class="col q-ma-md text-center text-h4 text-white"
                      style="padding:150px; background-size: cover;background-position: center;background-repeat: no-repeat;background-image: url('https://images.unsplash.com/photo-1557683311-eac922347aa1?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1315&q=80');">
                      <p>
                        請先選擇
                        <b>城市</b>

                        <br />
                        <b>再選擇你想去的景點</b>，按開始給你優缺點
                      </p>
                    </div>
                  </div>
                  <!-- end -->
                </q-page>
              </div>
              <div v-if="step2Tab == 'hotel'">
                <!-- 選單部分 -->
                <div class="q-pa-md">
                  <div class="q-pa-md doc-container text-black bg-grey-3">
                    <div class="row text-h4">
                      <b>自選飯店</b>

                      <!-- <prosconsInfo></prosconsInfo> -->
                    </div>
                    <div class="row-12 q-pl-xl">
                      <!-- proscons-select 區域 -->
                      <hotelProsconsSelect></hotelProsconsSelect>
                      <!-- end proscons select -->
                    </div>
                  </div>
                </div>

                <q-page>
                  <!-- 左右區域 web -->
                  <transition name="hotel-select">
                    <div v-if="hotel_select" class="q-pa-md">
                      <div class="row">
                        <div class="col-6">
                          <hotelProsconsData>
                            <template slot="addToSchedule">
                              <q-btn rounded icon="add" label="飯店加進排程" color="warning"
                                @click="promptToAddHotelProsSite()" dense size="12px"
                                style="margin-left:30px;font-weight:bold" />
                            </template>
                            <template slot="text_ProsExplain">
                              <div class="row">
                                <div class="col-1 text-center">
                                  <q-avatar color="green-8" text-color="white" size="15px"></q-avatar>
                                </div>
                                <div class="col-11">
                                  <span style="font-size: 15px;">
                                    <b>顏色越深，好評中提及該關鍵字的人數越多，為此飯店較受其他旅客喜愛的特點</b>
                                  </span>
                                </div>
                              </div>
                            </template>
                            <template slot="text_ConsExplain">
                              <div class="row">
                                <div class="col-1 text-center">
                                  <q-avatar color="red-8" text-color="white" size="15px"></q-avatar>
                                </div>
                                <div class="col-11">
                                  <span style="font-size: 15px;">
                                    <b>顏色越深，負評中提及該關鍵字的人數越多，您可以從中考慮是否要入住</b>
                                  </span>
                                </div>
                              </div>
                            </template>
                          </hotelProsconsData>
                        </div>
                        <!-- 懶人包區域 -->
                        <div class="col-6">
                          <hotelProsconsR>
                            <template slot="photoExplain">
                              <hotelPhotoInfo></hotelPhotoInfo>
                            </template>
                          </hotelProsconsR>
                        </div>
                      </div>
                    </div>
                  </transition>
                  <div v-if="!hotel_select" class="row" style="font-family: Microsoft JhengHei;">
                    <div class="col q-ma-md text-center text-h4 text-white"
                      style="padding:150px; background-size: cover;background-position: center;background-repeat: no-repeat;background-image: url('https://images.unsplash.com/photo-1557683311-eac922347aa1?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1315&q=80');">
                      <p>
                        請先選擇
                        <b>城市</b>

                        <br />
                        <b>再選擇你想去的飯店</b>，按開始給你優缺點
                      </p>
                    </div>
                  </div>

                  <!-- end -->
                </q-page>
              </div>
            </q-tab-panel>
            <q-tab-panel name="searchSite">
              <div class="text-h6">
                <!-- Tip: 需求分析 -->
                <q-toggle class="q-pa-md title" v-model="prefer" checked-icon="check" color="red" label="依照您曾經收藏類型推薦"
                  unchecked-icon="clear" />
              </div>
              <!-- <p>{{ after_axios }}</p> -->
              <!-- 偏好分析 -->
              <div class="q-pa-md" v-if="prefer == false">
                <DemandPage :id="id">
                  <!-- <template slot="addToSchedule">
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
                  </template>-->
                </DemandPage>
              </div>
              <!-- 需求分析 -->
              <div class="q-pa-md" v-else>
                <preferDemandAll :id="id"></preferDemandAll>
              </div>

              <!-- END -->
            </q-tab-panel>
            <q-tab-panel name="searchHotel">
              <hDemandPage :id="id"></hDemandPage>
              <!-- <p>{{ after_axios }}</p> -->
              <!-- 飯店需求分析 select -->
              <!-- <div class="q-pa-md">
                <div class="q-pa-md doc-container text-black bg-grey-3">
                  <div class="row text-h4">
                    <b>飯店需求分析</b>
                    <demandInfo></demandInfo>
                  </div>

                  <div class="row q-pl-xl">
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
                </div>
              </div>-->

              <!-- 需求分析 R圖 -->

              <!-- END -->
            </q-tab-panel>

            <q-tab-panel name="movies">
              <!-- 選單部分 -->
              <div class="q-pa-md">
                <div class="q-pa-md doc-container text-black bg-grey-3">
                  <div class="row text-h4">
                    <b>路徑規畫分析</b>

                    <!-- <pathInfo></pathInfo> -->
                  </div>
                  <div class="row">
                    <path-select></path-select>
                  </div>
                </div>
              </div>
            <transition name="hotel-select">
              <div v-if="path_select" class="q-pa-none">
                <div class="row">
                  <div class="col-6">
                    <path-data>
                      <template slot="addToSchedule">
                        <q-btn class="q-mt-sm" icon="add" label="加進排程" color="warning" @click="promptToAddRouteSites()"
                          dense size="12px" style="font-weight:bold" />
                      </template>
                      <template slot="finishTip">
                        <div class="text-h6 text-bold" style="font-family:NSimSun">完成</div>
                      </template>
                    </path-data>
                  </div>
                  <!-- 懶人包區域 -->
                  <div class="col-6">
                    <path-r>
                      <template slot="photoExplain">
                        <pathPhotoInfo></pathPhotoInfo>
                      </template>
                    </path-r>
                  </div>
                </div>
              </div>
            </transition>
              <div v-if="!path_select" class="row" style="font-family: Microsoft JhengHei;">
                <div class="col q-ma-md text-center text-h4 text-white"
                  style="padding:150px; background-size: cover;background-position: center;background-repeat: no-repeat;background-image: url('https://images.unsplash.com/photo-1557683311-eac922347aa1?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1315&q=80');">
                  <p>
                    請先選擇
                    <b>景點</b>

                    <br />系統將以此 <b>景點作為你的起始點</b>，按開始以進行分析
                  </p>
                </div>
              </div>
            </q-tab-panel>

            <q-tab-panel name="aa">
              <div class="text-h4">
                GoogleMap找出最短路線
                <q-icon color="red" name="report_problem" size="20px" />
                <span class="text-subtitle2" style="color:red">起點與終點為固定順序</span>
              </div>

              <googleMap>
                <!-- <template slot="chooseForArrange">
                  <q-btn
                    label="選擇想安排的日期"
                    glossy
                    color="amber"
                    @click="chooseForArrange()"
                  ></q-btn></template
                >-->
              </googleMap>
            </q-tab-panel>
          </q-tab-panels>
        </q-card>
      </q-page>
    </q-page-container>
  </q-layout>
</template>

<script>
  import {
    mapActions
  } from "vuex";
  import {
    mapGetters,
    mapState
  } from "vuex";
  import draggable from "vuedraggable";

  export default {
    data() {
      return {
        tab: "collections",
        left: false,
        darkDialog: false,
        model: null,
        model_route: null,
        model_city: null,
        // step1(需求轉偏好) toggle
        prefer: true,
        // (step2景點轉飯店優缺點分析)toggle,
        site: true,
        id: "",
        date: "",
        prompt: false,
        // 排程表起始日
        startDate: "",
        // 排程表名稱
        title: "",
        slider: 1,
        step: 1,
        step1Tab: "site",
        step2Tab: "site",
        // step2自選景點用
        site_select: false,
        // step2自選飯店用
        hotel_select: false,
        // step5路徑分析用
        path_select: false

      };
    },
    components: {
      draggableC: () => import("components/drag/draggableC.vue"),
      LCard: () => import("components/collection/LCard.vue"),
      hCard: () => import("components/collection/h_card.vue"),
      search: () => import("components/search.vue"),
      // 引用需求元件
      demandSelect: () => import("components/demand/demand_select.vue"),
      demandPrefer: () => import("components/demand/prefer_select.vue"),
      demandR: () => import("components/demand/demand_R.vue"),
      demandData: () => import("components/demand/demand_data.vue"),
      demandDataDiff: () => import("components/demand/demand_data_diff.vue"),
      demandDataDiff2: () => import("components/demand/demand_data_diff2.vue"),
      demandInfo: () => import("components/demand/demand_info.vue"),
      preferInfo: () => import("components/demand/prefer_info.vue"),
      preferDemandAll: () =>
        import("components/schedules/page/preferDemand_all.vue"),
      // 引用景點需求元件(整頁)
      DemandPage: () => import("components/schedules/page/demand_all.vue"),
      // 引用飯店需求元件(整頁)
      hDemandPage: () => import("components/schedules/page/h_demand_all.vue"),
      // 引用景點優缺點元件
      prosconsSelect: () => import("components/proscons/proscons_select.vue"),
      prosconsR: () => import("components/proscons/proscons_R.vue"),
      prosconsData: () => import("components/proscons/proscons_data.vue"),
      prosconsInfo: () => import("components/proscons/proscons_info.vue"),
      sitePhotoInfo: () =>
        import("components/proscons/generalUser/sitePhotoInfo.vue"),
      // 引用飯店優缺點元件
      hotelProsconsSelect: () =>
        import("components/proscons/h_proscons_select.vue"),
      hotelProsconsR: () => import("components/proscons/h_proscons_R.vue"),
      hotelProsconsData: () => import("components/proscons/h_proscons_data.vue"),
      hotelPhotoInfo: () =>
        import("components/proscons/generalUser/hotelPhotoInfo.vue"),
      // path
      // pathSelect: () => import("components/path/path_select.vue"),
      // pathInfo: () => import("components/path/path_info.vue"),
      pathSelect: () => import("components/path/schedule_path_select.vue"),

      pathR: () => import("components/path/path_R.vue"),
      pathData: () => import("components/path/path_data.vue"),
      pathButtonToggle: () => import("components/path/path_button_toggle.vue"),
      pathPhotoInfo: () =>
        import("components/path/generalUser/pathPhotoInfo.vue"),
      //map
      googleMap: () => import("components/map/googleMap.vue")
    },
    computed: {
      ...mapGetters("travel", ["everydaySites"]),
      ...mapGetters("collections", ["collections", "h_collections"]),
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
        "txtdatas_diff2",
        "txtdatas_diff3"
      ]),
      // 路徑規畫
      ...mapGetters("path", [
        "start_index_2",
        "start_index",
        "selected_site",
        "selected_site_2",
        "selected_site_3"
      ]),
      // 優缺點景點
      ...mapGetters("proscons", ["run_index", "prosConsSelected_site"]),
      ...mapGetters("h_proscons", ["start_index", "h_prosConsselected_site"]),
      // 取得vuex state變動值、優缺分析
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
      ...mapActions("demand", [
        "upload_axios_2",
        "upload_axios_2_diff",
        "upload_axios_3_diff"
      ]),
      // 偏好分析
      ...mapActions("prefers", ["searchPrefer"]),
      // ...mapActions("travel", ["fbAddEverySiteData"]),
      lastReloadPage() {
        this.$router.push("/mySchedule").then(() => {
          this.$router.go(0);
        });
      },
      promptToAddSite(value) {
        const dateList = Object.keys(this.everydaySites);
        const item_1 = [];
        // 日期作為下面item的物件選項(radio)
        dateList.forEach(function (item, index, array) {
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
      promptToAddRouteSites() {
        const dateList = Object.keys(this.everydaySites);
        const item_1 = [];
        // 日期作為下面item的物件選項(radio)
        dateList.forEach(function (item, index, array) {
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
            var routeSites = [
              this.selected_site,
              this.selected_site_2,
              this.selected_site_3
            ];
            console.log(routeSites);

            routeSites.forEach((item, index) => {
              this.$store.dispatch("travel/fbAddEverySiteData", {
                site: item,
                date: data,
                scheduleId: this.id
              });
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
      // 優缺點加入排程
      promptToAddProsSite() {
        const dateList = Object.keys(this.everydaySites);
        const item_1 = [];
        // 日期作為下面item的物件選項(radio)
        dateList.forEach(function (item, index, array) {
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
            console.log(this.prosConsSelected_site);

            this.$store.dispatch("travel/fbAddEverySiteData", {
              site: this.prosConsSelected_site,
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
      promptToAddHotelProsSite() {
        const dateList = Object.keys(this.everydaySites);
        const item_1 = [];
        // 日期作為下面item的物件選項(radio)
        dateList.forEach(function (item, index, array) {
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
            console.log(this.h_prosConsselected_site);

            this.$store.dispatch("travel/fbAddEverySiteData", {
              site: this.h_prosConsselected_site,
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
          "http://140.136.155.116:8080/statics/between_relationship.html";
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
      //Step6 googlemp選擇想分析的日期
      // chooseForArrange() {
      //   const dateList = Object.keys(this.everydaySites);
      //   const item_1 = [];
      //   // 日期作為下面item的物件選項(radio)
      //   dateList.forEach(function(item, index, array) {
      //     item_1.push({
      //       label: item,
      //       value: item,
      //       color: "secondary"
      //     });
      //   });

      //   this.$q
      //     .dialog({
      //       title: "選擇您想加入的日期",
      //       message: "日期:",
      //       options: {
      //         type: "radio",
      //         model: "opt1",
      //         // inline: true
      //         items: item_1
      //       },
      //       cancel: true,
      //       persistent: true
      //     })
      //     .onOk(data => {
      //       console.log(this.h_prosConsselected_site);

      //       this.$store.dispatch("travel/fbAddEverySiteData", {
      //         site: this.h_prosConsselected_site,
      //         date: data,
      //         scheduleId: this.id
      //       });

      //       // console.log('>>>> OK, received', data)
      //     })
      //     .onCancel(() => {
      //       // console.log('>>>> Cancel')
      //     })
      //     .onDismiss(() => {
      //       // console.log('I am triggered on both OK and Cancel')
      //     });
      // }
    },
    created() {
      // 旅程表ID
      var pass_id = this.$route.query.pass_id;
      this.id = pass_id;

      var pass_startDate = this.$route.query.startDate;
      this.startDate = pass_startDate;

      var pass_title = this.$route.query.title;
      this.title = pass_title;
      // console.log(this.$route.query.pass_id);

      // this.fbEverySiteData(this.id);
    },

    watch: {
      // 需求分析 用以偵測R跑完成
      after_axios: function (val) {
        // 更換iframe
        this.changeSrc();
        // 在呼叫ajax取懶人包(vuex)
        this.upload_axios_2();
        this.upload_axios_2_diff();
        this.upload_axios_3_diff();

        // 隱藏按鈕
        this.isShow = false;
        // 清空選取資料
        this.selected_p_local = "";
        this.selected_p_detail_item_local = "";
        this.selected_p_detail_item_local2 = "";
      },
      //step2自選景點用
      run_index(val) {
        this.site_select = true;
      },
      //step2自選飯店用
      start_index(val) {
        this.hotel_select = true;
      },
      // step5路徑規劃分析用
      start_index_2(val) {
        this.path_select = true;
      }
    },
    mounted: function () {
      // 需求分析 初始化時取第一層城市資料(vuex)
      this.fetchCitys();
      this.$store.dispatch("auth/handleAuthStateChange", this.id);

    }
  };

</script>

<style scoped>
  .title {
    font-family: Microsoft JhengHei;
  }

  .hotel-select-enter-active {
    transition: all 1s ease;
  }

  .hotel-select-enter {
    transform: translateY(10px);
    opacity: 0;
  }

</style>
