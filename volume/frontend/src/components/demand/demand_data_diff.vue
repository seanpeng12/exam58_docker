<template>
  <!-- <q-page> -->
  <q-item
    clickable
    v-ripple
    v-on:click="data(txtdata_diff.name)"
    v-if="txtdata_diff.tag == selected_p_detail_item"
  >
    <q-item-section>{{ txtdata_diff.name }}</q-item-section>
    <slot name="addToSchedule"></slot>
    <slot name="addToCollection"></slot>
  </q-item>

  <!-- test -->
  <!-- </q-page> -->

  <!-- test end -->
</template>
<script>
export default {
  props: ["txtinfo_diff", "txtdata_diff", "selected_p_detail_item"],
  data() {
    return {
      loading4: false,
      loading2: false
    };
  },
  computed: {
    // 雙向綁定txtdatas資料(懶人包)
    completed_trigger: {
      get: function() {
        console.log("取得資料");
        txtdata.completed;
        return this.txtdatas_diff;
      },
      // 回傳並要s_demandPage上傳vuex
      set: function(value) {
        console.log("被觸發");

        this.$emit("txtdatas_diff_Update", val);
      }
    }
  },
  methods: {
    data(val) {
      console.log(val);
      this.$emit("site_name", val);
    },
    selectionChanged: function(data) {
      console.log("被觸發");

      // this.$emit("txtdatas_Update", val);
    },
    addToCollection(value) {
      console.log(value);
    }
  },
  components: {
    addToCollectionBtn: () => import("components/demand/addTocollectionBtn.vue")
  }
};
</script>
