<template>
  <q-page>
    <!-- proscons-select 區域 -->
    <path-select></path-select>
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
    return {


    };
  },
  computed: {
    // 取得vuex state變動值

  },

};
</script>

<style>
</style>
