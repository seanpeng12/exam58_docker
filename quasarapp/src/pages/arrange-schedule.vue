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
        <p class="weekday">Day1</p>
        <draggable></draggable>
        <p class="weekday">Day2</p>
        <div
          class="row"
          v-for="everydaySite in everydaySites"
          :key="everydaySite.id"
        >
          <p class="weekday">{{ everydaySite.id }}</p>

          <div v-for="site in everydaySite.site" :key="site">
            <div>{{ site }}</div>
          </div>
        </div>
      </div>
      <!-- <q-btn
        dense
        label="儲存"
        class="fixed-bottom-right"
        color="secondary"
        size="15px"
        style="margin-right:20px; width: 100px"
      />
      <q-btn
        dense
        label="新增日期"
        class="fixed-bottom-left"
        color="warning"
        size="15px"
        style="margin-left:20px; width: 100px"
      /> -->
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
              <div class="text-h6">Tip: 加入您收藏景點</div>
              <!-- <div>透過需求分析</div>
              <div>自行搜尋</div> -->
              <q-select
                outlined
                v-model="model"
                :options="options"
                label="選擇您想去的縣市"
                style="width: 250px; padding-bottom: 32px"
              />
              <img src="~assets/step1.jpg" />

              <q-btn
                dense
                label="前往下一步"
                class="row absolute-bottom-right"
                color="secondary"
                size="20px"
                style="margin:8px"
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
                  :options="site"
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
import { mapGetters } from "vuex";
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
      route: ["台北101", "象山", "十分老街"],
      site: ["台北101", "象山", "十分老街"],
      options: ["台北市", "基隆市", "高雄市", "南投縣", "台南市"],
      id: ""
    };
  },
  components: {
    search: () => import("components/search.vue"),
    draggable: () => import("components/drag/draggable.vue")
  },
  created() {
    var pass_id = this.$route.query.pass_id;
    this.id = pass_id;
  },
  computed: {
    ...mapGetters("travel", ["everydaySites"])
    // ...mapGetters("schedules", ["sightseeingMembers"])
  }
};
</script>
<style lang="stylus">
.weekday {
        min-width: 350px;
        height: 35px;
        // cursor: pointer;
        font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
        font-size: 20px;
        //border:2px #54a9a9 dashed;
        border-width: 2px 7px 5px 7px;
        border-bottom-color: #400080;
        border-style: solid dotted;

    }
</style>
