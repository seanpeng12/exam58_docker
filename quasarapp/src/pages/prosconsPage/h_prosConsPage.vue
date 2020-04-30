<template>
  <q-page>
    <!-- proscons-select 區域 -->
    <proscons-select></proscons-select>
    <!-- end proscons select -->

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
    return {


    };
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

<style>
</style>
