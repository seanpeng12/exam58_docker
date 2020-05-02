<template>
  <!-- 懶人包 -->
  <div class="q-pa-none doc-container" v-if="isShow_data">
    <!-- 標題 -->
    <div
      class="gt-xs q-pa-lg q-ma-sm column text-black bg-blue-grey-1"
      style="height: 280px;"
    >
      <div class="col">
        <div class="img_background">
          <div>
            <p
              style="font-size: 26px;font-weight:bold;font-family: Microsoft JhengHei;"
            >
              {{ selected_site }}的優點
              <slot name="addToSchedule"></slot>
            </p>
            <div>
              <q-scroll-area style="height: 210px; max-width: auto;">
                <q-chip square v-for="a in prosData.data" :key="a.id">
                  <q-avatar icon="bookmark" color="green" text-color="white" />
                  {{ a.segment }}
                </q-chip>
              </q-scroll-area>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div
      class="gt-xs q-pa-lg q-ma-sm column text-white bg-blue-grey-6"
      style="height: 280px;"
    >
      <div class="col">
        <div class="img_background">
          <div>
            <p
              style="font-size: 26px;font-weight:bold;font-family: Microsoft JhengHei;"
            >
              {{ selected_site }}的缺點
            </p>
            <div>
              <div>
                <q-chip square v-for="a in consData.data" :key="a.id">
                  <q-avatar icon="bookmark" color="red" text-color="white" />
                  {{ a.segment }}
                </q-chip>
              </div>
            </div>
          </div>
        </div>
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
      tab: "mails",
      // dropdownitem
      expanded: true,
      isShow_data: true
    };
  },
  computed: {
    // 取得vuex state值
    ...mapGetters("proscons", [
      "run_index",
      "data_index",
      "prosData",
      "consData",
      "selected_site"
    ])
  },
  methods: {},
  watch: {
    data_index(val) {
      console.log("偵測到data_index改變：取得val", val);
    }
  }
};
</script>
