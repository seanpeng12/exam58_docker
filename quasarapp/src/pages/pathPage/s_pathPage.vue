<template>
  <q-page>
    <div class="q-pa-md doc-container">
      <div
        class="gt-xs q-pa-lg items-center text-black bg-grey-3"
        style="height:250px;"
      >
        <div class="row">
          <div class="col"></div>

          <div class="col-12 col-md-auto">
            <p style="font-size: 28px;font-family: Microsoft JhengHei;">
              路徑推薦分析
            </p>
          </div>

          <div class="col q-mt-sm q-ml-sm">
            <siPathInfo></siPathInfo>
          </div>
        </div>

        <div class="row">
          <div class="col"></div>

          <div class="col-12 col-md-auto">
            <div>
              <b
                class="text"
                style="font-size: 20px;font-family: Microsoft JhengHei;"
                >不採雷的路線推薦，給拿不定下一站的您!</b
              >
              <br />
            </div>
          </div>
          <div class="col"></div>
        </div>

        <!-- proscons-select 區域 -->
        <div class="row">
          <div class="col"></div>
          <div class="col-12 col-md-auto">
            <path-select></path-select>
          </div>
          <div class="col"></div>
        </div>

        <!-- end proscons select -->
      </div>
    </div>

    <!--  -->

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
    pathButtonToggle: () => import("components/path/path_button_toggle.vue"),
    siPathInfo: () => import("components/path/si_path_info.vue")
  },
  data() {
    return {};
  },
  computed: {
    // 取得vuex state變動值
  }
};
</script>

<style></style>
