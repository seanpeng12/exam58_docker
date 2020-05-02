<template>
  <q-page>
    <!-- web page 區域 -->
    <!-- <div>
      debug用
      <p>vuex：{{selected_p}} {{selected_p_detail_item}} {{selected_p_detail_item_2}}</p>
    </div>-->
    <div class="q-pa-md doc-container">
      <div
        class="gt-xs q-pa-lg column items-center text-black bg-grey-3"
        style="height: 300px;"
      >
        <div class="col">
          <div class="text-center img_background">
            <p style="font-size: 28px;font-family: Microsoft JhengHei;">
              景點需求分析
            </p>
          </div>
        </div>
        <div class="col">
          <div class="text-center img_background">
            <div>
              <b
                class="text"
                style="font-size: 30px;font-family: Microsoft JhengHei;"
                >選擇想分析的景點城市/類型</b
              >
              <br />
            </div>
          </div>
        </div>
        <demand-select
          :citys="citys"
          :cats="cats"
          :selected_p="selected_p"
          :selected_p_detail_item="selected_p_detail_item"
          :selected_p_detail_item_2="selected_p_detail_item_2"
          @changed_1="selected_1"
          @changed_2="selected_2"
          @changed_3="selected_3"
          @runR="run_R"
        >
        </demand-select>
      </div>
    </div>
    <!-- end web page -->

    <!-- 左右區域 web -->
    <div class="q-pa-md">
      <div class="row">
        <!-- iframe區域 -->
        <div class="col">
          <demand-r :src="src" :runR_value="runR_value"></demand-r>
        </div>
        <!-- 懶人包區域 -->
        <div class="col">
          <div>
            <b
              class="text"
              style="font-size: 30px;font-family: Microsoft JhengHei;"
              >{{ txtinfo }}</b
            >
          </div>

          <div class="q-pa-md" style="max-width: 600px">
            <q-list bordered>
              <q-expansion-item
                group="somegroup"
                icon="explore"
                :label="
                  selected_p_detail_item + '&&' + selected_p_detail_item_2
                "
                default-opened
                header-class="text-purple"
              >
                <q-card>
                  <q-card-section>
                    <q-scroll-area style="height:200px; max-width: 600px;">
                      <q-list>
                        <demand-data
                          v-for="(txtdata, key) in txtdatas"
                          :key="key"
                          :txtinfo="txtinfo"
                          :txtdata="txtdata"
                          @txtdatas_Update="txtdatas_toVuex"
                        >
                          <template slot="addToCollection">
                            <q-space />
                            <addToCollectionBtn
                              :exists="txtdata.exists"
                              :id="key"
                              :city_name="txtdata.city_name"
                              :site_name="txtdata.name"
                              :address="txtdata.address"
                              :comment="txtdata.comment"
                              :rate="txtdata.rate"
                            ></addToCollectionBtn>
                          </template>
                        </demand-data>
                      </q-list>
                    </q-scroll-area>
                  </q-card-section>
                </q-card>
              </q-expansion-item>

              <q-separator />

              <q-expansion-item
                group="somegroup"
                icon="explore"
                :label="selected_p_detail_item"
                header-class="text-primary"
              >
                <q-card>
                  <q-card-section>
                    <!-- test txtdatas_diff -->
                    <q-scroll-area style="height:200px; max-width: 600px;">
                      <q-list>
                        <demandDataDiff
                          v-for="(txtdata, key) in txtdatas_diff"
                          :key="key"
                          :txtinfo_diff="txtinfo"
                          :txtdata_diff="txtdata"
                          :selected_p_detail_item="selected_p_detail_item"
                          @txtdatas_Update="txtdatas_toVuex"
                        >
                          <template slot="addToCollection">
                            <q-space />
                            <addToCollectionBtn
                              :exists="txtdata.exists"
                              :id="key"
                              :city_name="txtdata.city_name"
                              :site_name="txtdata.name"
                              :address="txtdata.address"
                              :comment="txtdata.comment"
                              :rate="txtdata.rate"
                            ></addToCollectionBtn>
                          </template>
                        </demandDataDiff>
                      </q-list>
                    </q-scroll-area>
                  </q-card-section>
                </q-card>
              </q-expansion-item>

              <q-separator />

              <q-expansion-item
                group="somegroup"
                icon="explore"
                :label="selected_p_detail_item_2"
                header-class="text-primary"
              >
                <q-card>
                  <q-card-section>
                    <q-scroll-area style="height:200px; max-width: 600px;">
                      <q-list>
                        <demandDataDiff2
                          v-for="(txtdata, key) in txtdatas_diff"
                          :key="key"
                          :txtinfo_diff="txtinfo"
                          :txtdata_diff="txtdata"
                          :selected_p_detail_item_2="selected_p_detail_item_2"
                          @txtdatas_Update="txtdatas_toVuex"
                        >
                          <template slot="addToCollection">
                            <q-space />
                            <addToCollectionBtn
                              :exists="txtdata.exists"
                              :id="key"
                              :city_name="txtdata.city_name"
                              :site_name="txtdata.name"
                              :address="txtdata.address"
                              :comment="txtdata.comment"
                              :rate="txtdata.rate"
                            ></addToCollectionBtn>
                          </template>
                        </demandDataDiff2>
                      </q-list>
                    </q-scroll-area>
                  </q-card-section>
                </q-card>
              </q-expansion-item>

              <q-separator />
            </q-list>
          </div>
        </div>
      </div>
    </div>
    <!-- end -->

    <!-- web iframe 下方區域 gt-xs -->
    <div class="q-pa-md doc-container"></div>

    <!-- phone iframe 區域 lt-sm-->
  </q-page>
</template>

<script>
import { mapGetters } from "vuex";
import { mapActions } from "vuex";

export default {
  name: "vueFrame",
  components: {
    demandSelect: () => import("components/demand/demand_select.vue"),
    demandR: () => import("components/demand/demand_R.vue"),
    demandData: () => import("components/demand/demand_data.vue"),
    demandDataDiff: () => import("components/demand/demand_data_diff.vue"),
    demandDataDiff2: () => import("components/demand/demand_data_diff2.vue"),

    addToCollectionBtn: () => import("components/demand/addToCollectionBtn.vue")
  },
  computed: {
    // 取得vuex state值
    ...mapGetters("demand", [
      "citys",
      "cats",
      "txtdatas",
      "txtdatas_diff",
      "src",
      "Rdata",
      "txtinfo"
    ]),
    ...mapGetters("demand", [
      "selected_p",
      "selected_p_detail_item",
      "selected_p_detail_item_2",
      "after_axios",
      "runR_value"
    ])
  },
  data() {
    return {
      // 給加入最愛使用
      loading4: false
    };
  },

  methods: {
    // 由此找vuex所需method
    ...mapActions("demand", ["fetchCitys"]),
    ...mapActions("demand", ["fetchCats"]),
    ...mapActions("demand", ["changeSrc"]),
    ...mapActions("demand", ["upload_axios"]),
    ...mapActions("demand", ["upload_axios_2", "upload_axios_2_diff"]),

    changeSrc() {
      document.getElementById("myFrame").contentWindow.location.reload(true);
      document.getElementById("myFrame").src =
        "./statics/between_relationship.html";
      // this.src = "./statics/between_relationship.html";
      this.$store.commit(
        "demand/update_txtinfo",
        "分析完成! 已列出所有符合兩類別景點，請點選加入最愛："
      );
    },

    // from emit local then set vuex
    selected_1(value) {
      console.log("收到emit!");
      this.$store.commit("demand/update_selected_p", value);
      this.fetchCats();
    },
    // from emit local then set vuex
    selected_2(value) {
      this.$store.commit("demand/update_selected_p_detail_item", value);
    },
    // from emit local then set vuex
    selected_3(value) {
      this.$store.commit("demand/update_selected_p_detail_item_2", value);
    },
    // 傳送runR引數至vuex
    run_R(value) {
      console.log("runRRRRRRRRRRRRRRR");
      this.$store.commit("demand/update_runR_value", value);
      this.$store.commit("demand/update_txtinfo", "載入中...");
      // 更改為loading
      document.getElementById("myFrame").src = "./statics/images/loader.gif";
      // vuex 跑R
      this.upload_axios();
    },
    // demand_data元件更改txtdatas至vuex
    txtdatas_toVuex(value) {
      this.$store.commit("demand/update_txtdatas", value);
    }
  },
  watch: {
    // 用以偵測R跑完成
    after_axios: function(val) {
      // 更換iframe
      this.changeSrc();
      // 在呼叫ajax取懶人包(vuex)
      this.upload_axios_2();
      this.upload_axios_2_diff();

      // 隱藏按鈕
      this.isShow = false;
      // 清空選取資料
      this.selected_p_local = "";
      this.selected_p_detail_item_local = "";
      this.selected_p_detail_item_local2 = "";
    }
  },
  mounted: function() {
    // 初始化時取第一層城市資料(vuex)
    this.fetchCitys();
  }
};
</script>

<style>
.frameStyle {
  width: 100%;
  height: 500px;
}
.de {
  padding-bottom: 50px;
}
</style>
