<template>
  <div class="q-pa-md layout-font">
    <!-- <img
      alt="Quasar logo"
      src="~assets/Logo.png"
      style="height: 40px; max-width: 60px"
    /> -->

    <q-carousel
      v-model="slide"
      transition-prev="scale"
      transition-next="scale"
      swipeable
      animated
      infinite
      control-color="dark"
      navigation
      padding
      arrows
      height="580px"
      class="bg-white text-dark"
    >
      <q-carousel-slide
        name="style"
        class="column no-wrap flex-center"
        img-src="https://images.pexels.com/photos/917494/pexels-photo-917494.jpeg?auto=compress&cs=tinysrgb&dpr=3&h=750&w=1260"
      >
        <q-icon name="style" size="56px" class="text-white" />
        <div class="q-mt-md text-center color-carousel">
          來去旅行
        </div>
      </q-carousel-slide>
      <q-carousel-slide
        name="tv"
        class="column no-wrap flex-center"
        img-src="https://images.pexels.com/photos/917494/pexels-photo-917494.jpeg?auto=compress&cs=tinysrgb&dpr=3&h=750&w=1260"
      >
        <q-icon name="live_tv" size="56px" />
        <div class="q-mt-md text-center color-carousel">需求分析</div>
      </q-carousel-slide>
      <q-carousel-slide
        name="school"
        class="column no-wrap flex-center"
        img-src="https://images.pexels.com/photos/917494/pexels-photo-917494.jpeg?auto=compress&cs=tinysrgb&dpr=3&h=750&w=1260"
      >
        <q-icon name="school" size="56px" />
        <div class="q-mt-md text-center color-carousel">路徑分析</div>
      </q-carousel-slide>
      <q-carousel-slide
        name="time"
        class="column no-wrap flex-center"
        img-src="https://images.pexels.com/photos/917494/pexels-photo-917494.jpeg?auto=compress&cs=tinysrgb&dpr=3&h=750&w=1260"
      >
        <q-icon name="snooze" size="56px" />
        <div class="q-mt-md text-center color-carousel">優缺點分析</div>
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

    <div class="row">
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
          <div class="text-overline text-orange-9">
            {{ func.tip }}
          </div>
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
            :icon="expanded ? 'keyboard_arrow_up' : 'keyboard_arrow_down'"
            @click="expanded = !expanded"
          />
        </q-card-actions>
        <q-slide-transition>
          <div v-show="expanded">
            <q-separator />
            <q-card-section class="text-subitle2">
              {{ func.illustrate }}
            </q-card-section>
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
      slide: "style",
      expanded: false,

      funcs: [
        {
          name: "需求功能",
          tip: "給拿不定主意的你",
          illustrate:
            "使用者可透過在系統介面上勾選「需求類別」找到符合需求類別的景點。 此分析方法先藉由景點的屬性 (site_attr) 做分組，再利用SNA中的中介點中心度（betweenness centrality）找出符合使用者選取屬性的資料。 在本系統中，使用者可以選取兩種屬性，經過分析後即 會出現與此兩種屬性相符程度最高的景點。",
          img: require("assets/need.jpg"),
        },

        {
          name: "景點優缺點分析功能",
          tip: "不想踩雷的你",
          illustrate:
            "使用者可透過在系統介面上勾選「需求類別」找到符合需求類別的景點。 此分析方法先藉由景點的屬性 (site_attr) 做分組，再利用SNA中的中介點中心度（betweenness centrality）找出符合使用者選取屬性的資料。 在本系統中，使用者可以選取兩種屬性，經過分析後即 會出現與此兩種屬性相符程度最高的景點。",
          img: require("assets/comment.jpg"),
        },
        {
          name: "安排一趟旅程",
          tip: "喜歡我們系統分析的你",
          illustrate: "集合我們所有的分析功能，讓您一步一步的規畫屬於您的旅程",
          img: require("assets/route.jpg"),
        },
      ],
      watch: {
        vertical(val) {
          this.navPos = val === true ? "right" : "bottom";
        },
      },
    };
  },
};
</script>

<style>
.layout-font {
  font-family: Microsoft JhengHei;
}
.color-carousel {
  color: white;
  font-size: 45px;
}
</style>
