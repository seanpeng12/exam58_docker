<template>
  <q-layout view="lHh LpR fFf">
    <q-header elevated class="bg-dark text-white">
      <q-toolbar>
        <q-btn dense flat round icon="menu" @click="left = !left" />

        <q-toolbar-title>自我規劃旅程{{ id }} </q-toolbar-title>
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
      /> -->

      <q-dialog v-model="darkDialog">
        <q-card>
          <q-card-section>
            <div class="text-h4 font-color: warn">
              <q-icon name="report_problem" class="text-red" />
              提醒您
            </div>
          </q-card-section>

          <q-card-section class="q-pt-none">
            請先儲存再跳回上一頁，以確保資料不會遺失
          </q-card-section>

          <q-card-actions align="right">
            <q-btn
              flat
              label="前往上一頁"
              color="primary"
              to="/mySchedule"
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
              </q-banner> -->
              <div class="col-5" style="max-width: 300px">
                <search />
              </div>
              <!-- <div>透過需求分析</div>
              <div>自行搜尋</div> -->

              <div class="row">
                <LCard
                  v-for="(item, index, key) in collections"
                  :key="item.site_name"
                  :collection="item"
                  :index="key"
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
                      style="margin-left:20px"
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

              <img src="~assets/step2_1.jpg" />
              <img src="~assets/step2_2.jpg" />

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
                  class=""
                  color="secondary"
                  size="15px"
                  style="width: 200px; margin-left:32px"
                />
                <q-btn
                  dense
                  label="納入此條路線"
                  class=""
                  color="warning"
                  size="15px"
                  style="margin-left: 100px"
                />
                <q-btn
                  dense
                  label="納入此景點"
                  class=" "
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
              <div class="row">
                <q-select
                  outlined
                  v-model="model_city"
                  :options="options"
                  label="選擇您想去的縣市"
                  style="width: 250px; margin-left:
              32px"
                />
                <q-select
                  outlined
                  v-model="model"
                  :options="ssite"
                  label="輸入您想去的景點"
                  style="width: 250px; margin-left:32px"
                />
                <q-btn
                  label="開始分析"
                  color="secondary"
                  size="15px"
                  style="width: 200px; margin-left:32px"
                />
                <q-btn
                  label="加入排程"
                  color="warning"
                  size="15px"
                  style="margin-left:100px;"
                />
              </div>
              <img src="~assets/comment.jpg" />
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
    search: () => import("components/search.vue")
  },
  computed: {
    ...mapGetters("travel", ["everydaySites"]),
    ...mapGetters("collections", ["collections"]),
    ...mapState("collections", ["search"]),
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
    // ...mapActions("travel", ["fbAddEverySiteData"]),
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
    }
  },
  created() {
    var pass_id = this.$route.query.pass_id;
    this.id = pass_id;
    // console.log(this.$route.query.pass_id);

    // this.fbEverySiteData(this.id);
  }
};
</script>
