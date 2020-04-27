<template>
  <div class="q-pa-md layout-font">
    <q-carousel
      v-model="slide"
      transition-prev="slide-right"
      transition-next="slide-left"
      swipeable
      autoplay
      animated
      control-color="primary"
      padding
      height="500px"
      class="bg-white-1"
    >
      <q-carousel-slide :name="1" class="row no-wrap">
        <div
          class="row fit justify-start items-center q-gutter-xs q-col-gutter no-wrap"
        >
          <div class="col" style="height: 500px;">
            <div class="col" style="margin-top:65px">
              <div align="center">
                <q-img
                  width="70%"
                  src="~assets/logo_0.png"
                  style="max-height: 400px;"
                ></q-img>
              </div>
              <!-- <h2 class="q-mt-xl q-ml-xl absolute-top h2">
                來去旅行
              </h2>-->
              <!-- <div align="center">
                <q-img
                  width="70%"
                  src="~assets/logo_0.png"
                  style="max-height: 400px;"
                ></q-img>
              </div> -->
            </div>
          </div>
          <div class="col" style="margin-top:65px">
            <div class="col" style="margin-left: 80spx;">
              <h5 class="q-mt-none q-ml-xl">
                <br />這是一套幫助您在規劃旅程時，
                <br />可以節省您許多時間的系統。 <br />幫您蒐集網路的資料，
                <br />分析出您所期望的旅遊景點，
                <br />以及透過一連串設計好的流程 ， <br />幫您快速排好旅程表。
              </h5>
            </div>
          </div>
        </div>
      </q-carousel-slide>
    </q-carousel>
    <q-page-scroller
      reverse
      position="top-right"
      :scroll-offset="20"
      :offset="[18, 18]"
    >
      <q-btn fab icon="keyboard_arrow_down" color="dark" />
    </q-page-scroller>

    <div class="row" style="margin-left: 40px;">
      <q-card
        class="my-card"
        style="margin: 20px; width: 250px;"
        flat
        bordered
        v-for="func in funcs"
        :key="func.name"
      >
        <!-- <q-responsive :ratio="4 / 3" class="col"> -->
        <q-img
          v-bind:src="func.img"
          style="height:140px; width:140px; margin: 60px"
        ></q-img>
        <!-- </q-responsive> -->
        <!-- <q-img src="~assets/comment.jpg" /> -->
        <q-card-section>
          <div class="text-overline text-orange-9">{{ func.tip }}</div>
          <div class="text-h5 q-mt-sm q-mb-xs">{{ func.name }}</div>
          <div class="text-caption text-grey"></div>
        </q-card-section>
        <q-card-actions>
          <!-- <q-btn flat color="dark" label="Share" /> -->
          <q-btn
            flat
            color="primary"
            label="進入分析"
            style="font-weight: bold;"
          />
          <q-space />
          <q-btn
            color="grey"
            round
            flat
            dense
            :icon="func.expanded ? 'keyboard_arrow_up' : 'keyboard_arrow_down'"
            @click="func.expanded = !func.expanded"
          />
        </q-card-actions>
        <q-slide-transition>
          <div v-show="func.expanded">
            <q-separator />
            <q-card-section class="text-subitle2">{{
              func.illustrate
            }}</q-card-section>
          </div>
        </q-slide-transition>
      </q-card>
    </div>
  </div>
</template>

<script>
// 824 (it's in pixels always)
import { mapgetters } from "vuex";
export default {
  // computed: {
  //   funcs() {
  //     return this.$store.getters("funcs", [funcs]);
  //   },
  //   name: "PageIndex",
  //   slide: "style",
  //   expend: false
  // }

  data() {
    return {
      name: "PageIndex",
      slide: 1,
      // expanded: false,

      funcs: [
        {
          name: "需求功能",
          tip: "給拿不定主意的你",
          illustrate:
            "只要選擇兩個想去的景點的類型，您即可找出符合A類型及B類型的景點",
          img: require("assets/idea.png"),
          expanded: false
        },

        {
          name: "景點優缺點分析功能",
          tip: "不想踩雷的你",
          illustrate:
            "只要輸入您想了解的景點名稱，景點優缺點馬上一目瞭然，不必再花大量時間爬文。",
          img: require("assets/plus.png"),
          expanded: false
        },
        {
          name: "路徑規劃",
          tip: "想要找尋受歡迎路線的你",
          illustrate:
            "只要輸入一個想去的景點作為起點，就可以找到受大眾歡迎的路線",
          img: require("assets/road.png"),
          expanded: false
        },
        {
          name: "安排一趟旅程",
          tip: "想要來一趟旅程的你",
          illustrate: "集合我們所有的分析功能，讓您一步一步的規畫屬於您的旅程",
          img: require("assets/vacation.png"),
          expanded: false
        }
      ],
      watch: {
        vertical(val) {
          this.navPos = val === true ? "right" : "bottom";
        }
      }
    };
  }
};
</script>

<style>
.layout-font {
  font-family: Microsoft JhengHei;
  /* font-family: NSimSun; */
}
.color-carousel {
  color: white;
  font-size: 45px;
}
.h2 {
  color: yellowgreen;
}
</style>
