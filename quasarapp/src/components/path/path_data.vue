<template>
  <!-- 懶人包 -->
  <div class="q-pa-sm q-mt-sm doc-container">
    <div class="gt-xs q-pa-sm column text-black bg-white" style="width: auto">
      <q-tabs
        class="bg-green-4 text-grey-4 q-mb-lg"
        style="font-family: Microsoft JhengHei;border-radius: 10px;"
        indicator-color="transparent"
        active-color="white"
        v-model="tab"
        align="justify"
        narrow-indicator
      >
        <q-tab icon="place" name="tab_1" :label="tab_1" />
        <q-icon name="fast_forward" style="font-size: 18px;color:black" />
        <q-tab icon="place" name="tab_2" :label="tab_2" />
        <q-icon name="fast_forward" style="font-size: 18px;color:black" />
        <q-tab icon="place" name="tab_3" :label="tab_3" />
      </q-tabs>

      <div class="q-gutter-y-sm">
        <q-tab-panels
          v-model="tab"
          animated
          transition-prev="fade"
          transition-next="fade"
          class="bg-grey-6 text-white text-center"
        >
          <q-tab-panel name="tab_1">
            <div class="text-h6 text-bold" style="font-family:NSimSun">
              去過 {{ selected_site }} 還會去
            </div>

            <q-expansion-item
              v-model="expanded1"
              group="somegroup"
              icon="directions_run"
              :label="'請選擇'"
              header-class="text-grey-3"
              style="font-weight:bold;font-family: Microsoft JhengHei;"
            >
              <q-card>
                <q-card-section>
                  <q-scroll-area style="height: 250px; max-width: auto;">
                    <div v-for="a in pathData.data" :key="a.id" class="q-ml-sm">
                      <q-icon
                        v-if="a.type == 'R'"
                        name="fas fa-utensils"
                        color="black"
                      />
                      <q-icon
                        v-else-if="a.type == 'S'"
                        name="fas fa-car-side"
                        color="black"
                      />
                      <q-icon v-else name="fas fa-hotel" color="black" />
                      <!-- button -->
                      <q-btn
                        flat
                        @click="
                          second_request(a.name), getSiteGoogleDetail(a.name)
                        "
                        :label="a.name"
                        style="width:250px;color:#699c4c;font-family: Microsoft JhengHei;font-weight:bold"
                        icon-right="arrow_forward_ios"
                      ></q-btn>
                      <!--  -->
                      <span class="text-black"
                        >有 {{ a.weight }} 人選擇這裡</span
                      >
                    </div>
                  </q-scroll-area>
                </q-card-section>
              </q-card>
            </q-expansion-item>
          </q-tab-panel>

          <q-tab-panel name="tab_2">
            <div class="text-h6 text-bold" style="font-family:NSimSun">
              去過 {{ selected_site_2 }} 還會去
            </div>
            <q-expansion-item
              group="somegroup"
              v-model="expanded2"
              icon="directions_run"
              :label="'請選擇'"
              header-class="text-grey-3"
              style="font-weight:bold;font-family: Microsoft JhengHei;"
            >
              <q-card>
                <q-card-section>
                  <q-scroll-area style="height: 210px; max-width: auto;">
                    <div v-for="b in pathData_2.data" :key="b.id">
                      <q-icon
                        v-if="b.type == 'R'"
                        name="fas fa-utensils"
                        color="black"
                      />
                      <q-icon
                        v-else-if="b.type == 'S'"
                        name="fas fa-car-side"
                        color="black"
                      />
                      <q-icon v-else name="fas fa-hotel" color="black" />
                      <!-- button -->
                      <q-btn
                        flat
                        @click="
                          third_request(b.name), getSiteGoogleDetail(b.name)
                        "
                        :label="b.name"
                        style="width:250px;color: #0062c4;font-family: Microsoft JhengHei;font-weight:bold"
                        icon-right="arrow_forward_ios"
                      ></q-btn>
                      <!--  -->
                      <span class="text-black"
                        >有 {{ b.weight }} 人選擇這裡</span
                      >
                    </div>
                  </q-scroll-area>
                </q-card-section>
              </q-card>
            </q-expansion-item>
          </q-tab-panel>

          <q-tab-panel name="tab_3"
            ><slot name="finishTip"></slot>

            <slot name="addToSchedule"></slot>
            <!-- <q-btn>景點加入排程</q-btn> -->
          </q-tab-panel>
        </q-tab-panels>
      </div>
    </div>
  </div>

  <!--  -->
</template>

<script>
import { mapGetters } from "vuex";
import { mapActions } from "vuex";

export default {
  data() {
    return {
      // dropdownitem
      expanded1: true,
      expanded2: true,

      model: "2",
      tab: "tab_1",
      tab_1: "地點一",
      tab_2: "地點二",
      tab_3: "地點三"
    };
  },
  computed: {
    // 取得vuex state值
    ...mapGetters("path", [
      "start_index",
      "run_index",
      "data_index",
      "pathData",
      "pathData_2",
      "selected_city",
      "selected_site",
      "selected_site_2",
      "selected_site_3"
    ])
  },
  methods: {
    // 由此找vuex所需method
    ...mapActions("path", ["fetchPath", "fetchPath_2", "getSiteGoogleDetail"]),
    // 第二次查詢
    second_request(val) {
      console.log(val);
      this.$store.commit("path/Update_Selected_Site_2", val);
      this.fetchPath_2();
      this.tab = "tab_2";
      this.tab_2 = this.selected_site_2;
    },
    third_request(val) {
      console.log(val);
      this.$store.commit("path/Update_Selected_Site_3", val);
      this.tab = "tab_3";
      this.tab_3 = this.selected_site_3;
    }
  },
  watch: {
    start_index(val) {
      this.tab = "tab_1";
      console.log("start");
    },
    data_index(val) {
      console.log("(測試)偵測到data_index改變：取得val", val);
    },
    selected_city(val) {
      this.$store.commit("path/Update_Selected_Site_2", "請選擇");
      this.$store.commit("path/Update_Selected_Site_3", "請選擇");
      this.tab_1 = "地點一";
      this.tab_2 = "地點二";
      this.tab_3 = "地點三";
    },
    selected_site(val) {
      this.$store.commit("path/Update_Selected_Site_2", "請選擇");
      this.$store.commit("path/Update_Selected_Site_3", "請選擇");
      this.tab_1 = val;
      this.tab_2 = "地點二";
      this.tab_3 = "地點三";
    }
    // selected_site_2(val) {
    //   this.tab_2 = val;
    // }
  }
};
</script>
