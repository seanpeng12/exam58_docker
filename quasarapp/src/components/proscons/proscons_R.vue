<template>
  <!-- 折疊式優缺點R圖 -->
  <div class="q-pa-none" style="max-width: auto" v-if="isShow_R">
    <div
      class="q-pa-lg q-ma-sm bg-teal-3"
      style="color:white;font-weight: bold;font-size : 25px;font-family: Microsoft JhengHei;"
    >
      <p>優缺點分析結果</p>

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
                  <q-tab name="pros" label="優點" style="font-weight:bold" />
                  <q-tab name="cons" label="缺點" style="font-weight:bold" />
                </q-tabs>

                <q-separator />

                <q-tab-panels class="text-dark" v-model="tab" style="max-height: 500px;" animated>
                  <q-tab-panel name="pros">
                    <iframe
                      style="height: 1500px"
                      frameborder="0"
                      id="myFrame_good"
                      :src="src_good"
                      class="frameStyle"
                      ref="myFrame_good"
                    ></iframe>
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
                  </q-tab-panel>

                  <q-tab-panel name="cons">
                    <iframe
                      style="height: 1500px"
                      frameborder="0"
                      id="myFrame_bad"
                      :src="src_bad"
                      class="frameStyle"
                    ></iframe>
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

    <!-- <q-expansion-item
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

    </q-expansion-item>-->
  </div>
</template>
<script>
import { mapGetters } from "vuex";
import { mapActions } from "vuex";

// Import component
import Loading from "vue-loading-overlay";
// Import stylesheet
import "vue-loading-overlay/dist/vue-loading.css";

export default {
  data() {
    return {
      tab: "pros",
      // dropdownitem
      expanded: true,
      isShow_R: true,
      //vue-loading-overley套件
      isLoading: false,
      fullPage: false
    };
  },
  components: {
    Loading
  },
  computed: {
    // 取得vuex state變動偵測值
    ...mapGetters("proscons", ["start_index", "run_index", "data_index"]),
    // src_good src_bad
    ...mapGetters("proscons", ["src_good", "src_bad"])
  },
  methods: {
    // 由此找vuex所需method
    ...mapActions("proscons", ["fetchGoodR", "fetchBadR"]),
    changeSrc() {
      // 重新整理myframe_good
      this.$refs.myFrame_good.contentWindow.location.reload();
      console.log("change重整畫面成功!data_index+1");

      this.$store.commit(
        "proscons/Update_Good_Src",
        "http://140.136.155.116:8080/statics/good.html"
      );
      this.$store.commit(
        "proscons/Update_Bad_Src",
        "http://140.136.155.116:8080/statics/bad.html"
      );
      this.isLoading = false;

      this.$store.commit("proscons/Update_Data_Index", 1);
    }
  },
  watch: {
    start_index(val) {
      this.tab = "pros";
      this.isLoading = true;
      this.$store.commit("proscons/Update_Good_Src", "about:blank");
      this.$store.commit("proscons/Update_Bad_Src", "about:blank");
    },
    run_index(val) {
      this.changeSrc();
      console.log("R組件偵測到Run_Index改變：執行changeSrc", val);
    }
  }
};
</script>

<style>
.fade-enter-active,
.fade-leave-active {
  transition: opacity 1s;
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
