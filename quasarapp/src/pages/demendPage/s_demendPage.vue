<template>
  <q-page>
    <!-- web page 區域 -->
    <div class="q-pa-md doc-container">
      <div class="gt-xs q-pa-lg column items-center text-black bg-grey-3" style="height: 200px;">
        <div class="col">
          <div class="text-center img_background">
            <p style="font-size: 28px;font-family: Microsoft JhengHei;">景點需求分析</p>
          </div>
        </div>
        <div class="col">
          <div class="text-center img_background">
            <div>
              <b class="text" style="font-size: 30px;font-family: Microsoft JhengHei;">選擇想分析的景點城市/類型</b>
              <br />
              <p>{{selected_p}} {{selected_p_detail_item}} {{selected_p_detail_item_2}}</p>
            </div>
          </div>
        </div>

        <div class="col">
          <!-- 三個下拉式選單 -->
          <div class="row">
            <div class="col">
              <!-- 下拉式選單 -->

              <div class="q-pa-md">
                <div class="q-gutter-md row">
                  <q-select
                    filled
                    v-model="selected_p_trigger"
                    v-on:change="onProductChange"
                    use-input
                    hide-selected
                    fill-input
                    input-debounce="0"
                    :options="Object.values(citys).map(city => city.city_name)"
                    @filter="filterFn"
                    hint="請選擇城市"
                    style="width: 250px; padding-bottom: 32px"
                  >
                    <template v-slot:no-option>
                      <q-item>
                        <q-item-section class="text-grey">沒有結果</q-item-section>
                      </q-item>
                    </template>
                  </q-select>
                </div>
              </div>
              <!--  -->
            </div>
            <div class="col">
              <!-- 下拉式選單 -->

              <div class="q-pa-md">
                <div class="q-gutter-md row">
                  <q-select
                    filled
                    v-model="selected_p_detail_item_trigger"
                    use-input
                    hide-selected
                    fill-input
                    input-debounce="0"
                    :options="product_detail[selected_p]"
                    @filter="filterFn"
                    hint="請選擇類型"
                    style="width: 250px; padding-bottom: 32px"
                  >
                    <template v-slot:no-option>
                      <q-item>
                        <q-item-section class="text-grey">沒有結果</q-item-section>
                      </q-item>
                    </template>
                  </q-select>
                </div>
              </div>
              <!--  -->
            </div>
            <div class="col">
              <!-- 下拉式選單 -->

              <div class="q-pa-md">
                <div class="q-gutter-md row">
                  <q-select
                    filled
                    v-model="selected_p_detail_item_2_trigger"
                    use-input
                    hide-selected
                    fill-input
                    input-debounce="0"
                    :options="product_detail[selected_p]"
                    loading="true"
                    @filter="filterFn"
                    hint="請選擇類型"
                    style="width: 250px; padding-bottom: 32px"
                  >
                    <template v-slot:no-option>
                      <q-item>
                        <q-item-section class="text-grey">沒有結果</q-item-section>
                      </q-item>
                    </template>
                  </q-select>
                </div>
              </div>
              <!--  -->
            </div>
          </div>
        </div>
      </div>
      <div class="gt-xs q-pa-lg column items-center text-black bg-grey-3">
        <div class="col">
          <!-- 按鈕 -->
          <q-btn
            :loading="loading4"
            color="cyan-9"
            @click="simulateProgress(4)"
            v-on:click="upload"
            style="width: 150px"
          >
            開始分析
            <template v-slot:loading>
              <q-spinner-hourglass class="on-left" />Loading...
            </template>
          </q-btn>
          <!-- end -->
        </div>
      </div>
    </div>
    <!-- end web page -->

    <!-- mobile 區域 -->
    <div class="q-pa-md doc-container">
      <div class="lt-sm column items-center" style="height: 350px;">
        <div class="col">
          <div class="text-center img_background">
            <div>
              <b class="text" style="font-size: 30px;font-family: Microsoft JhengHei;">選擇想分析的景點類型</b>
            </div>
          </div>
        </div>
        <div class="col">
          <!-- 下拉式選單 -->

          <div class="q-pa-md">
            <div class="q-gutter-md row">
              <q-select
                filled
                v-model="selected_p"
                v-on:change="onProductChange"
                use-input
                hide-selected
                fill-input
                input-debounce="0"
                :options="product_lists"
                @filter="filterFn"
                hint="請選擇城市"
                style="width: 250px; padding-bottom: 32px"
              >
                <template v-slot:no-option>
                  <q-item>
                    <q-item-section class="text-grey">沒有結果</q-item-section>
                  </q-item>
                </template>
              </q-select>
            </div>
          </div>
          <!--  -->
        </div>
        <div class="col">
          <!-- 下拉式選單 -->

          <div class="q-pa-md">
            <div class="q-gutter-md row">
              <q-select
                filled
                v-model="selected_p_detail_item"
                use-input
                hide-selected
                fill-input
                input-debounce="0"
                :options="product_detail[selected_p]"
                @filter="filterFn"
                hint="請選擇類型"
                style="width: 250px; padding-bottom: 32px"
              >
                <template v-slot:no-option>
                  <q-item>
                    <q-item-section class="text-grey">沒有結果</q-item-section>
                  </q-item>
                </template>
              </q-select>
            </div>
          </div>
          <!--  -->
        </div>
        <div class="col">
          <!-- 下拉式選單 -->

          <div class="q-pa-md">
            <div class="q-gutter-md row">
              <q-select
                filled
                v-model="selected_p_detail_item"
                use-input
                hide-selected
                fill-input
                input-debounce="0"
                :options="product_detail[selected_p]"
                loading="true"
                @filter="filterFn"
                hint="請選擇類型"
                style="width: 250px; padding-bottom: 32px"
              >
                <template v-slot:no-option>
                  <q-item>
                    <q-item-section class="text-grey">沒有結果</q-item-section>
                  </q-item>
                </template>
              </q-select>
            </div>
          </div>
          <!--  -->
        </div>
        <!-- 按鈕 -->
        <div class="col" style>
          <q-btn
            :loading="loading4"
            color="primary"
            @click="simulateProgress(4)"
            style="width: 150px"
          >
            開始分析
            <template v-slot:loading>
              <q-spinner-hourglass class="on-left" />Loading...
            </template>
          </q-btn>
        </div>
        <!-- end -->
      </div>
    </div>
    <!-- end mobile page -->

    <!-- 左右區域 web -->
    <div class="q-pa-md">
      <div class="row">
        <div class="col">
          <!-- iframe col div -->
          <div class="gt-xs col">
            <q-page>
              <iframe
                style="height: 602px"
                frameborder="0"
                id="myFrame"
                :src="src"
                class="frameStyle"
                ref="404 not found!"
              ></iframe>
            </q-page>
            <!--  -->
          </div>
          <!-- iframe end -->
        </div>
        <!-- 懶人包區域 -->
        <div class="col">
          <div class="text-center img_background">
            <div>
              <b class="text" style="font-size: 30px;font-family: Microsoft JhengHei;">{{txtinfo}}</b>
            </div>
          </div>
          <div class="center q-pa-md" style="font-family: Microsoft JhengHei;padding-top:15px;">
            <q-list bordered>
              <q-item v-for="txtdata in txtdatas" :key="txtdata.id" v-ripple>
                <q-item-section side top>
                  <q-checkbox v-model="txtdata.completed" />
                </q-item-section>

                <q-item-section>
                  <q-item-label>{{ txtdata.name}}</q-item-label>
                </q-item-section>
              </q-item>
            </q-list>

            <!-- list start -->
            <!-- <q-list bordered>
              <q-item v-for="b in result" :key="b.id" v-ripple>
                <q-item-section side top>
                  <q-checkbox v-model="b.completed" />
                </q-item-section>

                <q-item-section>
                  <q-item-label>{{ b.name}}</q-item-label>
                </q-item-section>
              </q-item>
            </q-list>-->
            <!-- list end -->
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
          <div></div>
        </div>
      </div>
    </div>
    <!-- end -->

    <!-- web iframe 下方區域 gt-xs -->
    <div class="q-pa-md doc-container"></div>

    <!-- phone iframe 區域 lt-sm-->
    <div class="q-pa-md doc-container">
      <!-- iframe col div -->
      <div class="lt-sm col">
        <q-page>
          <iframe
            style="height: 617px"
            frameborder="0"
            id="myFrame"
            :src="src"
            class="frameStyle"
            ref="404 not found!"
          ></iframe>
          <div v-for="city in citys" :key="city" class="card">
            <div class="card-header">{{ city.city_name }}</div>

            <div class="card-body"></div>
            <br />
            <button class="btn btn-xs btn-primary">修改</button>
            <button class="btn btn-xs btn-danger">刪除</button>
            <br />
          </div>
        </q-page>
        <!--  -->
      </div>
      <!-- iframe end -->
    </div>
  </q-page>
</template>

<script>
import { mapGetters } from "vuex";
import { mapActions } from "vuex";
import { mapFields } from "vuex-map-fields";

const stringOptions = ["台北", "桃園", "新竹", "苗栗", "台東"];
export default {
  name: "vueFrame",
  components: {},
  computed: {
    ...mapGetters("demand", ["citys", "txtdatas", "src", "Rdata"]),
    ...mapGetters("demand", [
      "selected_p",
      "selected_p_detail_item",
      "selected_p_detail_item_2",
      "product_lists",
      "product_detail",
      "after_axios"
    ]),
    // ...mapFields([
    //   'after_axios',
    //   'selected_p',
    // ]),
    selected_p_trigger: {
      get: function() {
        return this.$store.state.selected_p;
      },
      set: function(value) {
        this.$store.commit("demand/update_selected_p", value);
      }
    },
    selected_p_detail_item_trigger: {
      get: function() {
        return this.$store.state.selected_p_detail_item;
      },
      set: function(value) {
        this.$store.commit("demand/update_selected_p_detail_item", value);
      }
    },
    selected_p_detail_item_2_trigger: {
      get: function() {
        return this.$store.state.selected_p_detail_item_2;
      },
      set: function(value) {
        this.$store.commit("demand/update_selected_p_detail_item_2", value);
      }
    }
  },
  data() {
    return {
      // 設定loading秒數
      n: 2000,
      loading4: false,
      input1: "",
      txtinfo: "請先選擇城市與需求",

      tab: "mails",
      // 預設options資料
      options: stringOptions
    };
  },
  // computed:{
  //   part1: require("components/SectionCarousel.vue".default),
  //   // toArrayFormat:function() {
  //   //   citys = this.citys;
  //   //   return  Object.values(citys).map(city => city.city_name);
  //   // }
  // },
  methods: {
    // 由此找vuex所需method
    ...mapActions("demand", ["fetchCitys"]),
    ...mapActions("demand", ["changeSrc"]),
    ...mapActions("demand", ["upload_axios"]),
    ...mapActions("demand", ["upload_axios_2"]),

    onProductChange: function() {
      // reset!
      this.selected_p_detail_item = "";
      see = true;
    },
    filterFn(val, update, abort) {
      update(() => {
        const needle = val.toLowerCase();
        this.options = stringOptions.filter(
          v => v.toLowerCase().indexOf(needle) > -1
        );
      });
    },
    // 計算loading時間
    simulateProgress(number) {
      // we set loading state
      this[`loading${number}`] = true;
      // simulate a delay
      setTimeout(() => {
        // we're done, we reset loading state
        this[`loading${number}`] = false;
      }, this.n);
    },
    changeSrc() {
      document.getElementById("myFrame").contentWindow.location.reload(true);
      document.getElementById("myFrame").src =
        "./statics/between_relationship.html";
      // this.src = "./statics/between_relationship.html";
      this.txtinfo = "分析完成! 已列出所有符合兩類別景點，請點選加入最愛：";
    },

    async upload() {
      this.txtinfo = "載入中...";
      document.getElementById("myFrame").src = "./statics/images/loader.gif";
      // vuex 取資料
      this.upload_axios();

      // let self = this;
      // self.$axios
      //   .post("http://127.0.0.1:80/api/runR_twoC", {
      //     name: this.selected_p,
      //     c1: this.selected_p_detail_item,
      //     c20: this.selected_p_detail_item_2
      //   })
      //   .then(response => {
      //     self.Rdata = response.data;
      //     this.changeSrc();
      //     // console.log("資料為：" + this.$refs.iframe);
      //     this.src = "./statics/between_relationship.html";
      //     console.log("成功!");
      //   })
      //   .catch(function(response) {
      //     console.log(response);
      //   });

      // axiosInstance.all([
      //   axiosInstance.post("http://127.0.0.1:80/api/runR_twoC", {
      //     name: this.selected_p,
      //     c1: this.selected_p_detail_item,
      //     c20: this.selected_p_detail_item_2}),
      //   axiosInstance.post("http://127.0.0.1:80/api/cat", {
      //     name: this.selected_p,
      //     c1: this.selected_p_detail_item,
      //     c20: this.selected_p_detail_item_2}),
      // ])
      // .then(axiosInstance.spread((response1, response2) => {
      //   this.Rdata = response1.data;
      //   this.txtdata = response2.data;
      //   // 更改iframe src
      //   this.changeSrc();
      //   this.src = "./statics/between_relationship.html";
      //   console.log("成功!");
      // })).catch(function(response) {
      //     console.log(response);
      // });
    }
  },
  watch: {
    after_axios: function(val) {
      // console.log("監聽到!");
      this.changeSrc();
      this.upload_axios_2();
    }
  },
  mounted: function() {
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
