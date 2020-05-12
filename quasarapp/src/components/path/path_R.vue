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

                <q-tab-panels class="text-dark" v-model="tab" style="max-height: 500px;" animated>
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

                <!-- loading 插件 -->
                <transition name="fade">
                  <loading
                    v-if="isLoading"
                    :active.sync="isLoading"
                    :can-cancel="false"
                    :on-cancel="onCancel"
                    :is-full-page="fullPage"
                  ></loading>
                </transition>
                <!--  -->
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
// Import component
import Loading from "vue-loading-overlay";
// Import stylesheet
import "vue-loading-overlay/dist/vue-loading.css";

export default {
  data() {
    return {
      tab: "mails",
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
    ...mapGetters("path", ["start_index", "run_index", "data_index"]),
    // src_good src_bad
    ...mapGetters("path", ["src_path"])
  },
  methods: {
    // 由此找vuex所需method
    changeSrc() {
      // 重新整理myframe_good
      this.$refs.myFrame_good.contentWindow.location.reload();
      console.log("change重整畫面成功!更新data_index");

      this.$store.commit("path/Update_Data_Index", 1);
    }
  },
  watch: {
    start_index(val) {
      this.isLoading = true;
      this.$store.commit("path/Update_src_path", "about:blank");
    },
    run_index(val) {
      this.changeSrc();
      console.log("R組件偵測到Run_Index改變：執行changeSrc", val);
      this.$store.commit(
        "path/Update_src_path",
        "http://140.136.155.116:8080/statics/path.html"
      );
      this.isLoading = false;
    }
  },
  mounted: function() {}
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
.fade-enter-active,
.fade-leave-active {
  transition: opacity 1s;
}
.fade-enter, .fade-leave-to /* .fade-leave-active below version 2.1.8 */ {
  opacity: 0;
}
</style>
