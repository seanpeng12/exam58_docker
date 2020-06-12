<template>
  <q-card class="my-card" style="width:250px;font-family:Microsoft JhengHei;">
    <q-img style="height:150px" :src="collection.src" />

    <q-card-section>
      <div class="row no-wrap items-center">
        <div class="col text-h7 ellipsis">{{ collection.site_name }}</div>
      </div>

      <div class="row text-caption text-grey q-mt-sm">
        <!-- <div class="col" style="margin-top:10px;"> -->
        <div class="col-1">
          <q-icon name="star" color="orange" size="20px" />
        </div>

        <div
          class="col-2"
          style=" color:orange; font-size:14px; margin-left:5px"
        >{{ collection.rate }}</div>
        <div class="col-4" style="margin-left:2px">{{ collection.comment }}則評價</div>
        <div class="col-3" style="margin-left:20px">
          <q-space />
          <q-btn label="詳細地址" color="secondary" @click="dialog = true" dense outlined size="10px" />
        </div>
        <!-- </div> -->
        <!-- dialog -->
        <q-dialog v-model="dialog">
          <q-card style="width: 350px">
            <q-linear-progress :value="16" color="blue-2" />

            <q-card-section class="row items-center no-wrap">
              <div>
                <div class="text-weight-bold">
                  <q-icon name="place" color="orange-5" size="20px" />
                  地址: {{ collection.address }}
                </div>
              </div>
            </q-card-section>
            <q-linear-progress :value="1" color="blue-2" />
          </q-card>
        </q-dialog>
      </div>
    </q-card-section>

    <q-card-section class="q-pt-none">
      <div class="col-auto text-secondary text-caption q-pt-md row no-wrap items-center">
        <q-icon name="place" />
        台灣，{{ collection.city }}
        <slot name="addToSchedule"></slot>
        <slot name="deleteCollection"></slot>
      </div>
    </q-card-section>

    <q-separator />
  </q-card>
  <!-- 選擇加入哪天 -->

  <!-- </div> -->
</template>
<script>
// import axios from "axios";

export default {
  props: ["collection", "index"],
  data() {
    return {
      stars: 3.5,
      dialog: false,
      position: "top",
      src: "https://tw.bring-you.info/imgs/2017/08/Seine-3.jpg"
    };
  },
  methods: {}
  // updated() {
  //   axios
  //     .post("http://140.136.155.116/api/getGoogleImg", {
  //       name: collection.site_name
  //     })
  //     .then(res => {
  //       this.src = res.data;
  //       console.log("取得google照片");
  //     })
  //     .catch(err => {
  //       console.log(err);
  //     });
  // }
};
</script>
<style lang="sass" scoped>
.my-card
  width: 100%
  max-width: 250px
</style>
