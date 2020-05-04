<template>
  <q-page>
    <div class="q-pa-md doc-container">
      <div
        class="gt-xs q-pa-lg  column items-center text-black bg-grey-3"
        style="height:300px;"
      >
        <div class="col">
          <div class="text-center img_background">
            <p style="font-size: 28px;font-family: Microsoft JhengHei;">
              飯店優缺點分析
            </p>
          </div>
        </div>
        <div class="col">
          <div class="text-center img_background">
            <div>
              <b
                class="text"
                style="font-size: 20px;font-family: Microsoft JhengHei;"
                >從網站評論資訊，幫您分析飯店是否符合您的需求</b
              >
              <br />
            </div>
          </div>
        </div>
        <!-- proscons-select 區域 -->
        <proscons-select></proscons-select>
        <!-- end proscons select -->
      </div>
    </div>

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
  <!--  -->
</template>

<script>
import { mapGetters } from "vuex";
import { mapActions } from "vuex";

export default {
  name: "vueFrame",
  components: {
    prosconsSelect: () => import("components/proscons/h_proscons_select.vue"),
    prosconsR: () => import("components/proscons/h_proscons_R.vue"),
    prosconsData: () => import("components/proscons/h_proscons_data.vue")
  },
  data() {
    return {};
  },
  computed: {
    // 取得vuex state變動值
    ...mapGetters("h_proscons", ["run_index"])
  },
  methods: {
    changeSrc() {
      document
        .getElementById("myFrame_good")
        .contentWindow.location.reload(true);
      document.getElementById("myFrame_good").src = "./statics/good.html";

      document
        .getElementById("myFrame_bad")
        .contentWindow.location.reload(true);
      document.getElementById("myFrame_bad").src = "./statics/bad.html";
    }
  },
  watch: {}
};
</script>

<style></style>
