<template>
  <div class="q-pa-md">
    <div style="max-width:auto">
      <!-- <q-btn-toggle
        v-model="model"
        class="my-custom-toggle"
        no-caps
        unelevated
        toggle-color="purple"
        color="white"
        text-color="primary"
        :options="options"
      /> -->
    </div>
    <div class="row">
      <div class="col-8">
        <q-tabs
          v-model="tab"
          inline-label
          indicator-color="transparent"
          active-color="white"
          class="bg-lime-5 text-black shadow-2"
        >
          <q-tab name="firstSite" icon="place" :label="selected_site" />

          <q-icon name="fast_forward" style="font-size: 18px;color:black" />

          <q-tab name="secondSite" icon="place" :label="selected_site_2" />

          <q-icon name="fast_forward" style="font-size: 18px;color:black" />

          <q-tab name="thirdSite" icon="place" :label="selected_site_3" />
        </q-tabs>
      </div>
      <div class="col q-ml-lg q-mt-sm">
        <q-btn
          dense
          rounded
          @click="clear()"
          label="清空"
          icon="delete_forever"
          style="font-family: Microsoft JhengHei;font-weight:bold"
        />
        <slot name="addToSchedule"></slot>
      </div>
    </div>
  </div>
</template>
<script>
import { mapGetters } from "vuex";
import { mapActions } from "vuex";

export default {
  data() {
    return {
      options: [
        { label: "請選擇", value: 0 },
        { label: "請選擇", value: 1 },
        { label: "請選擇", value: 2 }
      ],
      model: 0,
      tab: "firstSite"
    };
  },
  computed: {
    // 取得vuex state值
    ...mapGetters("path", [
      "citys",
      "sites",
      "selected_city",
      "selected_site",
      "selected_site_2",
      "selected_site_3",
      "run_index",
      "data_index"
    ])
  },
  methods: {
    // 由此找vuex所需method
    ...mapActions("path", ["fetchCitys"]),
    ...mapActions("path", ["fetchSites"]),
    ...mapActions("path", ["fetchProsConsR"]),
    ...mapActions("path", ["fetchPath"]),

    process: function(val, count) {
      this.options[count].label = val;
      this.model = count;
    },
    clear: function() {
      this.$store.commit("path/Update_Selected_Site", "請選擇");
      this.$store.commit("path/Update_Selected_Site_2", "請選擇");
      this.$store.commit("path/Update_Selected_Site_3", "請選擇");
    }
  },
  watch: {
    selected_site(val) {
      // this.process(val, 0);
      // this.$store.commit("path/Update_Selected_Site", "請選擇");
      this.$store.commit("path/Update_Selected_Site_2", "請選擇");
      this.$store.commit("path/Update_Selected_Site_3", "請選擇");
      this.tab = "firstSite";
    },
    selected_site_2(val) {
      // this.process(val, 1);
      this.tab = "secondSite";
    },
    selected_site_3(val) {
      // this.process(val, 2);
      this.tab = "thirdSite";
    }
  }
};
</script>
