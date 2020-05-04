<template>
  <!-- 折疊式優缺點R圖 -->
  <div class="q-pa-sm" style="max-width: auto" v-if="isShow_R">
    <div
      class="q-pa-md q-ma-sm bg-teal-3"
      style="color:white;font-weight: bold;font-size : 25px;font-family: Microsoft JhengHei;"
    >
      <p>路徑分析圖</p>

      <!--  -->
      <q-card>
        <q-card-section>
          <!-- 左優點 右缺點 -->
          <div class="q-pa-none" align="center">
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
                  <q-tab
                    name="mails"
                    class="text-black"
                    label="給定起點分析第一層/第二層景點"
                    style="font-weight:bold;font-family: Microsoft JhengHei;"
                  />
                </q-tabs>

                <q-separator />

                <q-tab-panels
                  class="text-dark"
                  v-model="tab"
                  style="max-height: 500px;"
                  animated
                >
                  <q-tab-panel name="mails">
                    <iframe
                      style="height: 1500px"
                      frameborder="0"
                      id="myFrame_good"
                      :src="src_path"
                      class="frameStyle"
                      ref="myFrame_good"
                    ></iframe>
                  </q-tab-panel>
                </q-tab-panels>
              </q-card>
            </div>
          </div>
          <!--  -->
        </q-card-section>
      </q-card>
      <!-- end -->
    </div>
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
      expanded: true,
      isShow_R: true
    };
  },
  computed: {
    // 取得vuex state變動偵測值
    ...mapGetters("path", ["run_index", "data_index"]),
    // src_good src_bad
    ...mapGetters("path", ["src_path"])
  },
  methods: {
    // 由此找vuex所需method
    ...mapActions("path", ["fetchProsConsR"]),
    changeSrc() {
      // 重新整理myframe_good
      this.$refs.myFrame_good.contentWindow.location.reload();
      console.log("change重整畫面成功!");

      this.$store.commit("path/Update_Data_Index", 1);
    }
  },
  watch: {
    run_index(val) {
      this.changeSrc();
      console.log("R組件偵測到Run_Index改變：執行changeSrc", val);
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
