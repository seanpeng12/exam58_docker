<template>
  <div class="q-pa-md">
    <q-carousel arrows animated v-model="slide" height="400px">
      <q-carousel-slide name="first" img-src="~assets/slider_2.jpg">
        <div class="row absolute-center">
          <div class="col">
            <q-img
              width="70%"
              src="~assets/logo_0.png"
              style="max-height: 400px;"
            ></q-img>
          </div>

          <div class="col text-h6" style="color:white">
            這是一套幫助您在規劃旅程時，可以節省您許多時間的系統。
            幫您蒐集網路的資料，分析出您所期望的旅遊景點，
            以及透過一連串設計好的流程，幫您快速排好旅程表。
          </div>
          <!-- <div class="text-subtitle1">Mountains</div> -->
        </div>
      </q-carousel-slide>
    </q-carousel>
  </div>
</template>

<script>
export default {
  data() {
    return {
      slide: "first"
    };
  }
};
</script>
<style lang="sass" scoped>
.custom-caption
  text-align: center
  padding: 12px
  color: white
  background-color: rgba(0, 0, 0, .3)
</style>
