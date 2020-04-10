<template>
  <q-page>
    <!-- web page 區域 -->
    <div class="q-pa-md doc-container">
      <div class="gt-xs column items-center" style="height: 170px;">
        <div class="col">
          <div class="text-center img_background">
            <div>
              <b
                class="text"
                style="font-size: 30px;font-family: Microsoft JhengHei;"
              >選擇想分析的景點類型 {{model}} {{s1}} {{s2}}</b>
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
                    v-model="selected_p"
                    v-on:change="onProductChange"
                    use-input
                    hide-selected
                    fill-input
                    input-debounce="0"
                    :options="citys"
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
          </div>
        </div>
        <!-- 按鈕 -->
        <div class="col" style="margin-top: 80px">
          <q-btn
            :loading="loading4"
            color="cyan-9"
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
    <!-- end web page -->

    <!-- mobile 區域 -->
    <div class="q-pa-md doc-container">
      <div class="lt-sm column items-center" style="height: 350px;">
        <div class="col">
          <div class="text-center img_background">
            <div>
              <b
                class="text"
                style="font-size: 30px;font-family: Microsoft JhengHei;"
              >選擇想分析的景點類型 {{model}} {{s1}} {{s2}}</b>
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
              <div v-for="city in citys" :key="city" class="card">
                <div class="card-header">{{ city.city_name }}</div>

                <div class="card-body">{{ city.city_name }}</div>
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
        <!-- 懶人包區域 -->
        <div class="col">
          <div class="text-center img_background">
            <div>
              <b
                class="text"
                style="font-size: 30px;font-family: Microsoft JhengHei;"
              >分析完成! 請點選您喜歡的景點：</b>
            </div>
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
        </div>
      </div>
    </div>
    <!-- end -->

    <!-- web iframe 區域 gt-xs -->
    <div class="q-pa-md doc-container">
      <div>====================</div>
       <div v-for="city in citys" :key="city" class="card">
            <div class="card-header">{{ city.city_name }}</div>

            <div class="card-body">{{ city.city_name }}</div>
            <br />
            <button class="btn btn-xs btn-primary">test</button>
            <button class="btn btn-xs btn-danger">test</button>
            <br />
          </div>
    </div>

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

            <div class="card-body">{{ city.city_name }}</div>
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
const stringOptions = ["台北", "桃園", "新竹", "苗栗", "台東"];
export default {
  name: "vueFrame",
  components: {},
  data() {
    return {
      n: 5000,
      loading4: false,
      selected_p: "",
      selected_p_detail_item: "",
      product_lists: ["台北", "高雄"],
      product_detail: {
        台北: ["沙灘", "公園", "台北101"],
        高雄: ["觀光風景區", "購物商城", "lativ"]
      },
      citys: [],
      city: {
        city_name: ""
      },
      tab: "mails",
      src: "./statics/between_relationship.html",
      options: stringOptions
    };
  },
  methods: {
    init: function() {
      let self = this;
      this.$axios
        .get("http://127.0.0.1/api/site_dataCity")
        .then(function(response) {
          self.city_json = response.data;
          var citys= JSON.parse(city_json);
          console.log("成功");
        })
        .catch(function(response) {
          console.log(response);
        });
    },
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
    simulateProgress(number) {
      // we set loading state
      this[`loading${number}`] = true;
      // simulate a delay
      setTimeout(() => {
        // we're done, we reset loading state
        this[`loading${number}`] = false;
      }, this.n);
    }
  },
  mounted: function() {
    this.init();
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
