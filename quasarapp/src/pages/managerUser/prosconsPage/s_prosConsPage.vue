<template>
  <q-page>
    <div class="q-pa-md doc-container">
      <!-- select區塊 -->
      <transition name="proscons-select">
        <div
          v-if="proscons_select"
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
                  >為您找出景點綜合評論，讓您了解自身與競爭對手的優劣勢</b
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
                      addToCollection(prosConsSelected_site),
                        simulateProgress(2)
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
                <template slot="havenAdd">
                  <q-btn
                    class="q-ml-sm"
                    :disable="!progress"
                    color="red-7"
                    @click="progress = false"
                    label="已在收藏列表"
                  ></q-btn>
                </template>
              </proscons-select>
            </div>
            <div class="col"></div>
          </div>

          <!-- end proscons select -->
        </div>
      </transition>
    </div>
    <!--  -->

    <!-- 左右區域 web -->
    <transition name="proscons-select">
      <div v-if="isShow">
        <div class="q-pa-md">
          <div class="row">
            <div class="col-6">
              <proscons-data>
                <template slot="text_ProsExplain"
                  ><q-chip>
                    <q-avatar
                      color="green-8"
                      text-color="white"
                      size="15px"
                    ></q-avatar>
                    <span style="font-size: 15px;">
                      <b
                        >顏色越深，好評中提及該關鍵字的人數越多，可能為您的優勢，建議從此進行優化</b
                      >
                    </span>
                  </q-chip></template
                >
                <template slot="text_ConsExplain"
                  ><q-chip>
                    <q-avatar
                      color="red-8"
                      text-color="white"
                      size="15px"
                    ></q-avatar>
                    <span style="font-size: 15px;">
                      <b
                        >顏色越深，負評中提及該關鍵字的人數越多，為您急迫需要解決的問題</b
                      >
                    </span>
                  </q-chip></template
                >
              </proscons-data>
            </div>
            <!-- 懶人包區域 -->
            <div class="col-6">
              <proscons-r>
                <template slot="photoExplain">
                  <sitePhotoInfo></sitePhotoInfo>
                </template>
              </proscons-r>
            </div>
          </div>
        </div>
      </div>
    </transition>

    <!-- 介紹頁面 -->
    <transition name="proscons-select">
      <div v-if="!isShow" class="row" style="font-family: Microsoft JhengHei;">
        <div
          class="col q-ma-md text-center text-h4 text-white"
          style="padding:150px; background-size: cover;background-position: center;background-repeat: no-repeat;background-image: url('https://images.unsplash.com/photo-1557683311-eac922347aa1?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1315&q=80');"
        >
          <p>
            請先選擇
            <b>城市</b>

            <br />
            <b>再選擇你喜歡的景點</b>，按開始以進行分析
          </p>
        </div>
      </div>
    </transition>
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
    sSiProsConsInfo: () => import("components/proscons/s_si_proscons_info.vue"),
    sitePhotoInfo: () => import("components/proscons/manager/sitePhotoInfo.vue")
  },
  data() {
    return {
      // 轉場觸發
      proscons_select: false,
      //
      loading2: false,
      //顯示下方頁面
      isShow: false,
      progress: false
    };
  },
  computed: {
    // 取得vuex state變動值
    ...mapGetters("proscons", [
      "selected_city",
      "prosConsSelected_site",
      "start_index",
      "run_index",
      "prosConsSelected_site"
    ])
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
    start_index(val) {
      this.isShow = true;
    },
    prosConsSelected_site(val) {
      this.loading2 = false;
      this.isShow = false;
    },
    selected_city(val) {
      this.isShow = false;
    }
  },
  mounted: function() {
    // transition
    this.proscons_select = true;
  }
};
</script>

<style scoped>
.proscons-select-enter-active {
  transition: all 1s ease;
}
.proscons-select-enter {
  transform: translateY(10px);
  opacity: 0;
}
</style>
