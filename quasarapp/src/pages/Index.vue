<template>
  <div class="q-pa-md layout-font">
<<<<<<< HEAD
    <!-- <img
      alt="Quasar logo"
      src="~assets/Logo.png"
      style="height: 40px; max-width: 60px"
    />-->

=======
>>>>>>> 492104b314b18d369f8bf718758d402ed8670981
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
<<<<<<< HEAD
      <q-carousel-slide
        name="style"
        class="column no-wrap flex-center"
        img-src="https://images.pexels.com/photos/917494/pexels-photo-917494.jpeg?auto=compress&cs=tinysrgb&dpr=3&h=750&w=1260"
      >
        <q-icon name="style" size="56px" class="text-white" />
        <div class="q-mt-md text-center color-carousel">來去旅行</div>
=======
      <q-carousel-slide :name="1" class="row no-wrap">
        <div
          class="row fit justify-start items-center q-gutter-xs q-col-gutter no-wrap"
        >
          <div class="column" style="height: 500px;">
            <div class="col">
              <!-- <h2 class="q-mt-xl q-ml-xl absolute-top h2">
                來去旅行
              </h2> -->
              <div align="center">
                <q-img
                  width="70%"
                  src="~assets/logo_0.png"
                  style="max-height: 400px;"
                ></q-img>
              </div>
            </div>

            <div class="col" style="margin-left: 80spx;">
              <h5 class="q-mt-none q-ml-xl">
                <br />
                這是一套幫助您在規劃旅程時，
                <br />可以節省您許多時間的系統。<br />幫您蒐集網路的資料，<br />
                分析出您所期望的旅遊景點，<br />以及透過一連串設計好的流程 ，<br />幫您快速排好旅程表。
              </h5>
            </div>
          </div>
          <q-img
            class="rounded-borders col-6 full-height absolute-right"
            src="https://www.taiwan.net.tw/att/1/big_scenic_spots/pic_631_10.jpg"
          />
        </div>
>>>>>>> 492104b314b18d369f8bf718758d402ed8670981
      </q-carousel-slide>
    </q-carousel>
    <q-page-scroller reverse position="top-right" :scroll-offset="20" :offset="[18, 18]">
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
        <q-img v-bind:src="func.img" style="height: 300px;"></q-img>
        <!-- <q-img src="~assets/comment.jpg" /> -->
        <q-card-section>
          <div class="text-overline text-orange-9">{{ func.tip }}</div>
          <div class="text-h5 q-mt-sm q-mb-xs">{{ func.name }}</div>
          <div class="text-caption text-grey"></div>
        </q-card-section>
        <q-card-actions>
          <!-- <q-btn flat color="dark" label="Share" /> -->
          <q-btn flat color="primary" label="進入分析" style="font-weight: bold;" />
          <q-space />
          <q-btn
            color="grey"
            round
            flat
            dense
            :icon="expanded ? 'keyboard_arrow_up' : 'keyboard_arrow_down'"
            @click="expanded = !expanded"
          />
        </q-card-actions>
        <q-slide-transition>
          <div v-show="expanded">
            <q-separator />
            <q-card-section class="text-subitle2">{{ func.illustrate }}</q-card-section>
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
      expanded: false,

      funcs: [
        {
          name: "需求功能",
          tip: "給拿不定主意的你",
          illustrate:
<<<<<<< HEAD
            "使用者可透過在系統介面上勾選「需求類別」找到符合需求類別的景點。 此分析方法先藉由景點的屬性 (site_attr) 做分組，再利用SNA中的中介點中心度（betweenness centrality）找出符合使用者選取屬性的資料。 在本系統中，使用者可以選取兩種屬性，經過分析後即 會出現與此兩種屬性相符程度最高的景點。",
          img: require("assets/need.jpg")
=======
            "只要選擇兩個想去的景點的類型，您即可找出符合A類型及B類型的景點",
          img: require("assets/idea.png")
>>>>>>> 492104b314b18d369f8bf718758d402ed8670981
        },

        {
          name: "景點優缺點分析功能",
          tip: "不想踩雷的你",
          illustrate:
<<<<<<< HEAD
            "使用者可透過在系統介面上勾選「需求類別」找到符合需求類別的景點。 此分析方法先藉由景點的屬性 (site_attr) 做分組，再利用SNA中的中介點中心度（betweenness centrality）找出符合使用者選取屬性的資料。 在本系統中，使用者可以選取兩種屬性，經過分析後即 會出現與此兩種屬性相符程度最高的景點。",
          img: require("assets/comment.jpg")
=======
            "只要輸入您想了解的景點名稱，景點優缺點馬上一目瞭然，不必再花大量時間爬文。",
          img: require("assets/plus.png")
        },
        {
          name: "路徑規劃",
          tip: "想要找尋受歡迎路線的你",
          illustrate:
            "只要輸入一個想去的景點作為起點，就可以找到受大眾歡迎的路線",
          img: require("assets/road-1.png")
>>>>>>> 492104b314b18d369f8bf718758d402ed8670981
        },
        {
          name: "安排一趟旅程",
          tip: "想要來一趟旅程的你",
          illustrate: "集合我們所有的分析功能，讓您一步一步的規畫屬於您的旅程",
<<<<<<< HEAD
          img: require("assets/route.jpg")
=======
          img: require("assets/vacation.png")
>>>>>>> 492104b314b18d369f8bf718758d402ed8670981
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
