<template>
  <!-- 折疊式優缺點R圖 -->
  <div class="q-pa-md" style="max-width: auto">
    <q-expansion-item
      dark
      class="q-pa-lg q-ma-sm bg-teal-6"
      style="color:white;font-weight: bold;font-size : 25px;font-family: Microsoft JhengHei;"
      v-model="expanded"
      icon="show_chart"
      label="優缺點分析結果"
      caption="景點名稱"
    >
      <div class="text-h6 q-md-lg text-center">
        <b>拖曳畫面以檢視，滾輪可放大</b>
      </div>
      <q-card>
        <q-card-section>
          <!-- 左右頁 -->
          <div class="q-pa-md" align="center">
            <div class="q-gutter-y-md" style="max-width: 1200px;">
              <q-card>
                <q-tabs
                  v-model="tab"
                  class="text-black"
                  active-color="primary"
                  indicator-color="primary"
                  align="justify"
                  narrow-indicator
                >
                  <q-tab name="mails" label="優點" style="font-weight:bold" />
                  <q-tab name="alarms" label="缺點" style="font-weight:bold" />
                </q-tabs>

                <q-separator />

                <q-tab-panels class="text-dark" v-model="tab" style="max-height: 500px;" animated>
                  <q-tab-panel name="mails">
                    <iframe
                      style="height: 1500px"
                      frameborder="0"
                      id="myFrame_good"
                      :src="src_good"
                      class="frameStyle"
                      ref="404 not found!"
                    ></iframe>
                  </q-tab-panel>

                  <q-tab-panel name="alarms">
                    <iframe
                      style="height: 1500px"
                      frameborder="0"
                      id="myFrame_bad"
                      :src="src_bad"
                      class="frameStyle"
                      ref="404 not found!"
                    ></iframe>
                  </q-tab-panel>
                </q-tab-panels>
              </q-card>
            </div>
          </div>
          <!--  -->
        </q-card-section>
      </q-card>
    </q-expansion-item>
  </div>
</template>
<script>
import { mapGetters } from "vuex";
import { mapActions } from "vuex";

export default {
  data() {
    return {
      tab: "mails",
      // dropdownitem
      expanded: true
    };
  },
  computed: {
    // 取得vuex state變動值
    ...mapGetters("proscons", ["run_index"]),
    // src_good src_bad
    ...mapGetters("proscons", ["src_good", "src_bad"])
  },
  methods: {
    // 由此找vuex所需method
    ...mapActions("proscons", ["fetchGoodR", "fetchBadR"])
  },
  watch: {
    run_index(val) {
      this.changeSrc();
      console.log("Update_Run_Index!");
    }
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
