<template>
  <q-page>
    <div class="text-center img_background">
      <div>
        <b class="text" style="font-size: 30px;font-family: Microsoft JhengHei;">{{txtinfo}}</b>
        <!-- <p>{{txtdatas}}</p> -->
      </div>
    </div>
    <div class="center q-pa-md" style="font-family: Microsoft JhengHei;padding-top:15px;">
      <q-list bordered>
        <q-item v-for="txtdata in txtdatas" :key="txtdata.id">
          <q-item-section side top>
            <q-checkbox
              :value="txtdata.name"
              v-model="txtdata.completed"
              true-value="1"
              false-value="0"
            />
          </q-item-section>

          <q-item-section>
            <q-item-label>{{ txtdata.name }}</q-item-label>
          </q-item-section>

          <q-item-section side top>
            <q-icon name="done_all" size="18px"></q-icon>
            <q-item-label caption>城市</q-item-label>
            <q-item-label caption>
              <small>類別 類別</small>
            </q-item-label>
          </q-item-section>
        </q-item>
      </q-list>
    </div>
    <div class="text-center img_background">
      <div
        class="text"
        style="font-size: 25px;font-family: Microsoft JhengHei;padding-top:15px;"
      >國立台灣科學教育館</div>
    </div>
    <!-- 加入最愛button -->
    <div class="q-pa-md doc-container">
      <div class="gt-xs column items-center" style="height: 170px;">
        <div class="col" style="margin-top: 80px">
          <q-btn
            :loading="loading4"
            color="cyan-9"
            @click="simulateProgress(4)"
            style="width: 300px"
          >
            加入最愛
            <template v-slot:loading>
              <q-spinner-hourglass class="on-left" />Loading...
            </template>
          </q-btn>
        </div>
      </div>
    </div>
    <!-- button end -->
  </q-page>
</template>
<script>
export default {
  props: ["txtinfo", "txtdatas"],
  data() {
    return {
      loading4: false
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
    }
  }
};
</script>
