<template>
  <!-- 懶人包 -->
  <div class="q-pa-md doc-container"  v-if="isShow_data">
    <!-- 標題 -->
    <div class="gt-xs q-pa-lg q-ma-sm column text-black bg-blue-grey-1" style="height: 300px;">
      <div class="col">
        <div class="img_background">
          <div>
            <p
              style="font-size: 26px;font-family: Microsoft JhengHei;"
            >去過<span style="font-weight:bold">{{selected_site}}</span>的人會去:</p>
            <div>
               <q-scroll-area style="height: 210px; max-width: auto;">
                <div v-for="a in pathData.data" :key="a.id">
                  <q-btn flat @click="second_request(a.name)" :label="a.name" style="color: #FF0080;font-family: Microsoft JhengHei;font-weight:bold" icon-right="arrow_forward_ios"/>
                  有 {{ a.weight}} 人選擇這裡
                </div>

              </q-scroll-area>
            </div>
          </div>
        </div>

      </div>
    </div>
    <div class="gt-xs q-pa-lg q-ma-sm column text-white bg-blue-grey-6" style="height: 406px;">
      <div class="col">
        <div class="img_background">
          <div>
            <p
              style="font-size: 26px;font-family: Microsoft JhengHei;"
            >去過<span style="font-weight:bold">{{selected_site_2}}</span>的人會去:</p>
            <div>
              <div>
                <q-scroll-area style="height: 210px; max-width: auto;">
                <div v-for="b in pathData_2.data" :key="b.id">
                  <q-btn flat  @click="third_request(b.name)" :label="b.name" style="color: #faffff;font-family: Microsoft JhengHei;font-weight:bold" icon-right="arrow_forward_ios"/>
                  有 {{ b.weight}} 人選擇這裡
                </div>
              </q-scroll-area>
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
      isShow_data:true,
      model: '2',
    };
  },
  computed: {
    // 取得vuex state值
    ...mapGetters("path", [
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
    ...mapActions("path", ["fetchPath","fetchPath_2"]),

    second_request(val){
      console.log(val);
      this.$store.commit("path/Update_Selected_Site_2", val);
      this.fetchPath_2();
    },
    third_request(val){
      console.log(val);
      this.$store.commit("path/Update_Selected_Site_3", val);
    }
  },
  watch:{
    data_index(val){
      console.log("偵測到data_index改變：取得val",val);
    }
  },

};
</script>
