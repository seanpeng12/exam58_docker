<template>
  <q-layout view="lHh LpR fFf">
    <q-header elevated class="bg-dark text-white">
      <q-toolbar>
        <q-btn dense flat round icon="menu" @click="left = !left" />

        <q-toolbar-title>自我規劃旅程 </q-toolbar-title>
      </q-toolbar>
    </q-header>

    <q-drawer show-if-above v-model="left" side="left" bordered :width="260">
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
    </q-drawer>

    <q-page-container>
      <q-page padding>
        <search />
        <q-card>
          <q-tabs
            v-model="tab"
            dense
            class="text-grey"
            active-color="primary"
            indicator-color="primary"
            align="justify"
            narrow-indicator
          >
            <q-tab name="mails" label="Step1 " icon:label_important />
            <q-icon name="label_important" style="font-size: 32px;" />
            <q-tab name="alarms" label="Step2" />
            <q-icon name="label_important" style="font-size: 32px;" />
            <q-tab name="movies" label="優缺點分析" />
            <q-icon name="label_important" style="font-size: 32px;" />
            <q-tab name="aa" label="Google自動行程安排" />
          </q-tabs>

          <q-separator />
          <q-tab-panels v-model="tab" animated>
            <q-tab-panel name="mails">
              <div class="text-h4">選擇起點</div>
              <div>透過需求分析</div>
              <div>自行搜尋</div>
            </q-tab-panel>

            <q-tab-panel name="alarms">
              <div class="text-h4">路徑規劃分析</div>
              選擇您有興趣的景點加入排程
            </q-tab-panel>

            <q-tab-panel name="movies">
              <div class="text-h4">優缺點分析</div>
              選擇您所想要進一步了解的景點
            </q-tab-panel>
            <q-tab-panel name="aa">
              <div class="text-h4">Google替您規劃最短路徑的景點順序</div>
              Lorem ipsum dolor sit amet consectetur adipisicing elit.
            </q-tab-panel>
          </q-tab-panels>
        </q-card>
      </q-page>
    </q-page-container>
  </q-layout>
</template>

<script>
export default {
  data() {
    return {
      tab: "mails",
      left: false,
      darkDialog: false
    };
  },
  components: {
    search: () => import("components/search.vue")
  }
};
</script>
