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
              景點優缺點分析
            </p>
          </div>

          <div class="col q-mt-sm q-ml-sm">
            <sSiProsConsInfo></sSiProsConsInfo>
          </div>
        </div>

        <div class="row">
          <div class="col"></div>

          <div class="col-12 col-md-auto">
            <div>
              <b
                class="text"
                style="font-size: 20px;font-family: Microsoft JhengHei;"
              >
                為您找出景點綜合評論，讓您不用花大把時間在網路上爬文</b
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
            <proscons-select>
              <template slot="addToCollection">
                <q-btn
                  :loading="loading2"
                  class="q-ml-md"
                  @click="
                    addToCollection(prosConsSelected_site), simulateProgress(2)
                  "
                  dense
                  label="加入收藏"
                  color="warning"
                  style="width:80px"
                >
                  <template v-slot:loading>
                    <q-icon name="check"></q-icon>已加入
                  </template>
                </q-btn>
              </template>
            </proscons-select>
          </div>
          <div class="col"></div>
        </div>

        <!-- end proscons select -->
      </div>
    </div>
    <!--  -->

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
    prosconsSelect: () => import("components/proscons/proscons_select.vue"),
    prosconsR: () => import("components/proscons/proscons_R.vue"),
    prosconsData: () => import("components/proscons/proscons_data.vue"),
    sSiProsConsInfo: () => import("components/proscons/s_si_proscons_info.vue")
  },
  data() {
    return {
      loading2: false
    };
  },
  computed: {
    // 取得vuex state變動值
    ...mapGetters("proscons", ["run_index", "prosConsSelected_site"])
  },
  methods: {
    ...mapActions("collections", [
      "fbAddtoCollection",
      "fbAddToPrefer",
      "proconsAddToCollection"
    ]),
    addToCollection(value) {
      console.log(value);

      this.proconsAddToCollection(value);
    },
    changeSrc() {
      document
        .getElementById("myFrame_good")
        .contentWindow.location.reload(true);
      document.getElementById("myFrame_good").src = "./statics/good.html";

      document
        .getElementById("myFrame_bad")
        .contentWindow.location.reload(true);
      document.getElementById("myFrame_bad").src = "./statics/bad.html";
    },
    simulateProgress(number) {
      // we set loading state
      this[`loading${number}`] = true;
      // simulate a delay
      // setTimeout(() => {
      //   // we're done, we reset loading state
      //   this[`loading${number}`] = false;
      // }, 300);
    }
  },
  watch: {
    prosConsSelected_site(val) {
      this.loading2 = false;
    }
  }
};
</script>

<style></style>
