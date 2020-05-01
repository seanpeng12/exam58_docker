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
              路徑分析
            </p>
          </div>
        </div>
        <div class="col">
          <div class="text-center img_background">
            <div>
              <b
                class="text"
                style="font-size: 20px;font-family: Microsoft JhengHei;"
                >不採雷的路線推薦，給拿不定下一站的您!</b
              >
              <br />
            </div>
          </div>
        </div>
        <path-select></path-select>
      </div>
    </div>
    <!-- </div> -->
    <!-- end proscons select -->
    <div class="q-pa-md">
      <div class="q-gutter-y-md">
        <path-button-toggle></path-button-toggle>
      </div>
    </div>
    <!-- 左右區域 web -->
    <div class="q-pa-md">
      <div class="row">
        <div class="col-6">
          <path-data></path-data>
        </div>
        <!-- 懶人包區域 -->
        <div class="col-6">
          <path-r></path-r>
        </div>
      </div>
    </div>
    <!-- end -->
  </q-page>
</template>

<script>
import { mapGetters } from "vuex";
import { mapActions } from "vuex";

export default {
  name: "vueFrame",
  components: {
    pathSelect: () => import("components/path/path_select.vue"),
    pathR: () => import("components/path/path_R.vue"),
    pathData: () => import("components/path/path_data.vue"),
    pathButtonToggle: () => import("components/path/path_button_toggle.vue")
  },
  data() {
    return {};
  },
  computed: {
    // 取得vuex state變動值

  },

};
</script>

<style></style>
