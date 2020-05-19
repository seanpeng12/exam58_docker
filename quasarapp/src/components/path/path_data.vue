<template>
  <!-- 懶人包 -->
  <div class="q-pa-sm doc-container">
    <!-- 標題 -->
    <!-- <div class="gt-xs q-pa-lg q-ma-sm column text-black bg-blue-grey-1" style="height:400px;">
      <div class="col">
        <div class="img_background">
          <div>

            <q-list bordered>
              <q-expansion-item
                v-model="expanded1"
                group="somegroup"
                icon="directions_run"
                :label="'去過<' + selected_site + '>還會去:'"
                header-class="text-blue-grey-10"
                style="font-weight:bold;"
              >
                <q-card>
                  <q-card-section>
                    <q-scroll-area style="height: 250px; max-width: auto;">
                      <div v-for="a in pathData.data" :key="a.id">
                        <q-icon v-if="a.type == 'R'" name="fas fa-utensils" />
                        <q-icon v-else-if="a.type == 'S'" name="fas fa-car-side" />
                        <q-icon v-else name="fas fa-hotel" />

                        <q-btn
                          flat
                          @click="second_request(a.name)"
                          :label="a.name"
                          style="color:  #699c4c;font-family: Microsoft JhengHei;font-weight:bold"
                          icon-right="arrow_forward_ios"
                        />

                        <span class="text-caption">有 {{ a.weight }} 人選擇這裡</span>
                      </div>
                    </q-scroll-area>
                  </q-card-section>
                </q-card>
              </q-expansion-item>

              <q-separator />

              <q-expansion-item
                v-model="expanded2"
                group="somegroup"
                icon="directions_run"
                :label="'去過<' + selected_site_2 + '>還會去:'"
                header-class="text-blue-grey-10"
                style="font-weight:bold;"
              >
                <q-card>
                  <q-card-section>
                    <q-scroll-area style="height: 210px; max-width: auto;">
                      <div v-for="b in pathData_2.data" :key="b.id">
                        <q-icon v-if="b.type == 'R'" name="fas fa-utensils" />
                        <q-icon v-else-if="b.type == 'S'" name="fas fa-car-side" />
                        <q-icon v-else name="fas fa-hotel" />

                        <q-btn
                          flat
                          @click="third_request(b.name)"
                          :label="b.name"
                          style="color: #0062c4;font-family: Microsoft JhengHei;font-weight:bold"
                          icon-right="arrow_forward_ios"
                        />

                        <span class="text-caption">有 {{ b.weight }} 人選擇這裡</span>
                      </div>
                    </q-scroll-area>
                  </q-card-section>
                </q-card>
              </q-expansion-item>

              <q-separator />
            </q-list>

          </div>
        </div>
      </div>
    </div>-->

    <!-- 測試用 -->
    <div style="max-width: 600px">
      <q-tabs class="q-mb-lg" v-model="tab" align="justify" narrow-indicator>
        <q-tab class="text-purple" name="tab_1" :label="tab_1" />
        <q-tab class="text-orange" name="tab_2" :label="tab_2" />
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
            <div class="text-h6 text-bold">{{selected_site}}</div>
            <q-expansion-item
              v-model="expanded1"
              group="somegroup"
              icon="directions_run"
              :label="'去過<' + selected_site + '>還會去:'"
              header-class="text-blue-grey-10"
              style="font-weight:bold;"
            >
              <q-card>
                <q-card-section>
                  <q-scroll-area style="height: 250px; max-width: auto;">
                    <div v-for="a in pathData.data" :key="a.id">
                      <q-icon v-if="a.type == 'R'" name="fas fa-utensils" />
                      <q-icon v-else-if="a.type == 'S'" name="fas fa-car-side" />
                      <q-icon v-else name="fas fa-hotel" />
                      <!-- button -->
                      <q-btn
                        flat
                        @click="second_request(a.name)"
                        :label="a.name"
                        style="color:  #699c4c;font-family: Microsoft JhengHei;font-weight:bold"
                        icon-right="arrow_forward_ios"
                      />
                      <!--  -->
                      <span>有 {{ a.weight }} 人選擇這裡</span>
                    </div>
                  </q-scroll-area>
                </q-card-section>
              </q-card>
            </q-expansion-item>
          </q-tab-panel>

          <q-tab-panel name="tab_2">
            <div class="text-h6 text-bold">{{selected_site_2}}</div>
            <q-expansion-item
              group="somegroup"
              v-model="expanded2"
              icon="directions_run"
              :label="'去過<' + selected_site_2 + '>還會去:'"
              header-class="text-blue-grey-10"
              style="font-weight:bold;"
            >
              <q-card>
                <q-card-section>
                  <q-scroll-area style="height: 210px; max-width: auto;">
                    <div v-for="b in pathData_2.data" :key="b.id">
                      <q-icon v-if="b.type == 'R'" name="fas fa-utensils" />
                      <q-icon v-else-if="b.type == 'S'" name="fas fa-car-side" />
                      <q-icon v-else name="fas fa-hotel" />
                      <!-- button -->
                      <q-btn
                        flat
                        @click="third_request(b.name)"
                        :label="b.name"
                        style="color: #0062c4;font-family: Microsoft JhengHei;font-weight:bold"
                        icon-right="arrow_forward_ios"
                      />
                      <!--  -->
                      <span class="text-caption">有 {{ b.weight }} 人選擇這裡</span>
                    </div>
                  </q-scroll-area>
                </q-card-section>
              </q-card>
            </q-expansion-item>
          </q-tab-panel>

          <!-- <q-tab-panel name="tab_3">
            <div class="text-h6">Movies</div>Nostrum necessitatibus expedita dolores? Voluptatem repudiandae magni ea.
          </q-tab-panel>-->
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
      expanded1: false,
      expanded2: false,

      model: "2",
      tab: "tab_1",
      tab_1: "地點二",
      tab_2: "地點三"
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
      "selected_site",
      "selected_site_2",
      "selected_site_3"
    ])
  },
  methods: {
    // 由此找vuex所需method
    ...mapActions("path", ["fetchPath", "fetchPath_2"]),
    // 第二次查詢
    second_request(val) {
      console.log(val);
      this.$store.commit("path/Update_Selected_Site_2", val);
      this.fetchPath_2();
    },
    third_request(val) {
      console.log(val);
      this.$store.commit("path/Update_Selected_Site_3", val);
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
    selected_site(val) {
      // this.tab_1 = val;
      // console.log("tab_1:", this.tab_1);
    },

    selected_site_2(val) {
      this.tab = "tab_1";
      // function change() {
      this.expanded1 = true;
      this.expanded2 = true;
      // }
      // change().then(() => {
      //   this.expanded1 = false;
      // });
    }
  }
};
</script>
