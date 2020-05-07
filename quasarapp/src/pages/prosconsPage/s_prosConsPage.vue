<template>
  <q-page>
    <div class="q-pa-md doc-container">
      <div class="gt-xs q-pa-lg column items-center text-black bg-grey-3" style="height:300px;">
        <div class="col">
          <div class="text-center img_background">
            <p style="font-size: 28px;font-family: Microsoft JhengHei;">景點優缺點分析</p>
          </div>
        </div>
        <div class="col">
          <div class="text-center img_background">
            <div>
              <b
                class="text"
                style="font-size: 20px;font-family: Microsoft JhengHei;"
              >從網站評論資訊，幫您分析景點是否適合您</b>
              <br />
            </div>
          </div>
        </div>
        <!-- proscons-select 區域 -->
        <proscons-select>
          <template slot="addToCollection">
            <q-btn
              :loading="loading2"
              class="q-ml-md"
              @click="
            addToCollection(prosConsSelected_site),simulateProgress(2)"
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
</template>

<script>
import { mapGetters } from "vuex";
import { mapActions } from "vuex";

export default {
  name: "vueFrame",
  components: {
    prosconsSelect: () => import("components/proscons/proscons_select.vue"),
    prosconsR: () => import("components/proscons/proscons_R.vue"),
    prosconsData: () => import("components/proscons/proscons_data.vue")
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
