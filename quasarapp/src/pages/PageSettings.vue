<template>
  <q-page>
    <div class="q-pa-md doc-container">
      <div class="column items-center" style="height: 170px;">
        <div class="col">
          <div class="text-center img_background">
            <div>
              <b class="text" style="font-size: 30px;font-family: Microsoft JhengHei;">選擇想選擇的分析</b>
            </div>
          </div>
        </div>
        <div class="col">
          <!-- 下拉式選單 -->

          <div class="q-pa-md">
            <div class="q-gutter-md row">
              <q-select
                filled
                v-model="model"
                use-input
                hide-selected
                fill-input
                input-debounce="0"
                :options="options"
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

          <!-- 下拉式選單 end-->
        </div>
      </div>
      <div class="col">
        <!--  -->
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
      citys: [],
      city: {
        city_name: ""
      },
      tab: "mails",
      src: "./statics/between_relationship.html",
      model: null,
      options: stringOptions
    };
  },
  methods: {
    init: function() {
      let self = this;
      this.$axios
        .get("http://127.0.0.1:80/api/site_dataCity")
        .then(function(response) {
          self.citys = response.data;
          console.log("成功");
        })
        .catch(function(response) {
          console.log(response);
        });
    },
    filterFn(val, update, abort) {
      update(() => {
        const needle = val.toLowerCase();
        this.options = stringOptions.filter(
          v => v.toLowerCase().indexOf(needle) > -1
        );
      });
    }
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
