<template>
  <!-- <div class="text-center img_background">
      <div>
        <b
          class="text"
          style="font-size: 30px;font-family: Microsoft JhengHei;"
          >{{ txtinfo }}</b
        >
      </div>
    </div> -->
  <!-- <div
      class="center q-pa-md"
      style="font-family: Microsoft JhengHei;padding-top:15px;"
    > -->
  <!-- <q-list>
      {{ txtdata }}
      <q-item clickable v-ripple> -->
  <!-- <q-item-section side top>
              <q-checkbox
                :value="txtdata.name"
                v-model="txtdata.completed"
                true-value="1"
                false-value="0"
              />
            </q-item-section>-->
  <q-item clickable v-ripple>
    <q-item-section>{{ txtdata.name }}</q-item-section>
    <slot name="addToSchedule"></slot>
    <slot name="addToCollection"></slot>
  </q-item>

  <!-- <q-item-section>
      <q-item-label></q-item-label>
    </q-item-section> -->

  <!-- </q-item>
    </q-list> -->
  <!-- </q-scroll-area> -->
  <!-- </div> -->
  <!-- </q-page> -->
</template>
<script>
export default {
  props: ["txtinfo", "txtdata"],
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
    selectionChanged: function(data) {
      console.log("被觸發");

      // this.$emit("txtdatas_Update", val);
    },
    addToCollection(value) {
      console.log(value);
    }
  },
  components: {
    addToCollectionBtn: () => import("components/demand/addToCollectionBtn.vue")
  }
};
</script>
