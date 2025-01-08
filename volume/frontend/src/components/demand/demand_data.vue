<template>
  <!-- <q-page> -->
  <q-item clickable v-on:click="data(txtdata.name), data_key(index)" v-ripple>
    <q-item-section>{{ txtdata.name }}</q-item-section>
    <slot name="addToSchedule"></slot>
    <slot name="addToCollection"></slot>
  </q-item>

  <!-- test -->
  <!-- </q-page> -->

  <!-- test end -->
</template>
<script>
export default {
  props: ["txtinfo", "txtdata", "index"],
  data() {
    return {
      //
      splitterModel: 50,
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
        return this.txtdatas;
      },
      // 回傳並要s_demandPage上傳vuex
      set: function(value) {
        console.log("被觸發");

        this.$emit("txtdatas_Update", val);
      }
    }
  },
  methods: {
    data(val) {
      // console.log(val);
      this.$emit("site_name", val);
    },

    data_key(val) {
      // console.log("key", val);
      this.$emit("txtdata_key", val);
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
