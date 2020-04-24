<template>
  <!-- 懶人包 -->
  <div class="q-pa-md doc-container">
    <!-- 標題 -->
    <div class="gt-xs q-pa-lg q-ma-sm column text-black bg-blue-grey-3" style="height: 180px;">
      <div class="col">
        <div class="img_background">
          <div>
            <p
              style="font-size: 26px;font-weight:bold;font-family: Microsoft JhengHei;"
            >{{selected_site}}的優點</p>
            <div>
              <div>
                <q-chip square v-for="a in prosData.data" :key="a.id">
                  <q-avatar icon="bookmark" color="green" text-color="white" />
                  {{a.segment}}
                </q-chip>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="gt-xs q-pa-lg q-ma-sm column text-black bg-blue-grey-3" style="height: 180px;">
      <div class="col">
        <div class="img_background">
          <div>
            <p
              style="font-size: 26px;font-weight:bold;font-family: Microsoft JhengHei;"
            >{{selected_site}}的缺點</p>
            <div>
              <div>
                <q-chip square v-for="a in consData.data" :key="a.id">
                  <q-avatar icon="bookmark" color="red" text-color="white" />
                  {{a.segment}}
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
      expanded: true
    };
  },
  computed: {
    // 取得vuex state值
    ...mapGetters("proscons", [
      "run_index",
      "prosData",
      "consData",
      "selected_site"
    ])
  },
  methods: {
    // 由此找vuex所需method
    ...mapActions("proscons", ["fetchPros", "fetchCons"])
  },
  mounted() {
    this.fetchCons();
    this.fetchPros();
  }
};
</script>
