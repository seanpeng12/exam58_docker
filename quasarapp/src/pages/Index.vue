<template>
  <div class="q-pa-md layout-font bg-white">
    <q-option-group v-model="navPos" :options="bottom" inline class="q-mb-md" />
    <q-carousel
      arrows
      animated
      v-model="slide"
      infinite
      height="670px"
      transition-prev="jump-right"
      transition-next="jump-left"
      swipeable
      control-color="white"
      prev-icon="arrow_left"
      next-icon="arrow_right"
      navigation-icon="radio_button_checked"
      navigation
      padding
      class="bg-grey-3 text-white shadow-1 rounded-borders"
    >
      <q-carousel-slide name="1" img-src="~assets/index_1.jpg">
        <div
          class="row justify-start items-center no-wrap bg-grey-3"
          style="text-align:center;width:auto;padding:0px;margin:120px;"
        >
          <div class="col-5">
            <div class="col">
              <div align="center">
                <q-img width="100%" src="~assets/logo_0.png"></q-img>
              </div>
            </div>
          </div>
          <div class="col-7">
            <div class="col" style="font-family:NSimSun;text-align:left">
              <h4
                class="text-black"
                style="font-size:30px;line-height:45px;font-weight:bold;margin-bottom:70px;margin-top:70px"
              >
                SIGHTSEEING。
                <br />一個輕鬆規劃旅程
                <br />節省您大量時間爬文的網站
                <br />透過資料分析
                <br />給你想要的旅遊景點
                <br />並輕鬆排好你的旅程
              </h4>
            </div>
          </div>
        </div>
      </q-carousel-slide>
      <q-carousel-slide name="2" img-src>
        <!-- 需求分析 -->
        <div class="q-pa-md row">
          <div class="col-7 bg-grey-3 text-center text-h5">
            <div class="container" style="position: relative;color: black;">
              <div
                style="position: absolute;
            left:66px;
            top:150px;
            font-size:50px;
            font-family:NSimSun;"
              >
                <b>給拿不定主意的你</b>
              </div>
              <div
                style="position: absolute;
            text-align: left;
            left:66px;
            top:250px;
            font-size:28px;
            font-family:Microsoft JhengHei;"
              >
                <p>僅需選擇兩個想去的景點的類型</p>
              </div>
              <div
                style="position: absolute;
            text-align: left;
            left:66px;
            top:300px;
            font-size:28px;
            font-family:Microsoft JhengHei;"
              >
                <p>快速找出符合兩種類型的景點</p>
              </div>
              <div
                style="position: absolute;
            text-align: left;
            left:66px;
            top:350px;
            font-size:28px;
            font-family:Microsoft JhengHei;"
              >
                <q-btn
                  class="q-pl-md"
                  size="20px"
                  color="blue"
                  icon-right="keyboard_arrow_right"
                  label="景點"
                  style="font-family:NSimSun;"
                />&nbsp;
                <q-btn
                  class="q-pl-md"
                  size="20px"
                  color="blue"
                  icon-right="keyboard_arrow_right"
                  label="飯店"
                  style="font-family:NSimSun;"
                />
              </div>
            </div>
          </div>
          <div class="col-5 bg-grey-3 text-center">
            <div
              class="container"
              style="position: relative;text-align: center;color: white;max-width:650px"
            >
              <img
                src="~assets/index_demand.jpeg"
                alt="Snow"
                style="max-width:600px;width:100%;height:70ex;border-radius: 2%;"
              />
              <div
                style="position: absolute;
            bottom: 100px;
            right: 50px;
            font-size:48px;
            font-family:Microsoft YaHei;"
              >需求分析</div>
              <div
                style="position: absolute;
            bottom: 36px;
            right: 50px;
            font-size:36px;
            font-family:Georgia;"
              >Demand Analysis</div>
            </div>
          </div>
        </div>
        <!-- 需求分析 end -->
      </q-carousel-slide>

      <q-carousel-slide name="3" img-src="~assets/index_2.jpg">
        <div class="row item-center" style="text-align: center;color:white;">
          <div>
            <q-img width="70%" style="height:auto;"></q-img>
          </div>
        </div>

        <h2>Pros and Cons</h2>
        <div>
          <div class="content">
            <div
              class="text-h4"
              style="font-family:NSimSun;background-color: rgba(0, 0, 0, 0.3);padding:40px;"
            >
              <div class="rol text-h2">不想踩雷的你</div>
              <div>
                <br />使用我們的優缺點分析功能
                <br />輸入景點或飯店名稱，優點與缺點一目瞭然
              </div>
            </div>
          </div>
        </div>
      </q-carousel-slide>
    </q-carousel>
    <!-- 需求分析 end -->
    <!-- 游標 -->
    <q-page-scroller reverse position="top-right" :scroll-offset="20" :offset="[18, 18]">
      <q-btn fab icon="keyboard_arrow_down" color="dark" />
    </q-page-scroller>
    <!-- end -->
    <!-- card -->
    <div class="row relative-position" style="margin-left: 40px;">
      <q-card
        class="my-card"
        style="margin: 20px; width: 250px;"
        flat
        bordered
        v-for="func in funcs"
        :key="func.name"
      >
        <!-- <q-responsive :ratio="4 / 3" class="col"> -->
        <q-img v-bind:src="func.img" style="height:140px; width:140px; margin: 60px"></q-img>
        <!-- </q-responsive> -->
        <!-- <q-img src="~assets/comment.jpg" /> -->
        <q-card-section>
          <div class="text-overline text-orange-9">{{ func.tip }}</div>
          <div class="text-h5 q-mt-sm q-mb-xs">{{ func.name }}</div>
          <div class="text-caption text-grey"></div>
        </q-card-section>
        <q-card-actions>
          <!-- <q-btn flat color="dark" label="Share" /> -->
          <q-btn flat color="primary" label="進入分析" :to="func.link" style="font-weight: bold;" />
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
            <q-card-section class="text-subitle2">
              {{
              func.illustrate
              }}
            </q-card-section>
          </div>
        </q-slide-transition>
      </q-card>
    </div>
    <!-- card end -->
  </div>
</template>

<script>
// 824 (it's in pixels always)
import { mapgetters } from "vuex";
export default {
  data() {
    return {
      slide: "3",
      autoplay: true,
      navPos: "bottom",
      name: "PageIndex",

      funcs: [
        {
          name: "需求功能",
          tip: "給拿不定主意的你",
          illustrate:
            "只要選擇兩個想去的景點的類型，您即可找出符合A類型及B類型的景點",
          img: require("assets/idea.png"),
          link: "/arrange-schedule",

          expanded: false
        },

        {
          name: "景點優缺點分析功能",
          tip: "不想踩雷的你",
          illustrate:
            "只要輸入您想了解的景點名稱，景點優缺點馬上一目瞭然，不必再花大量時間爬文。",
          img: require("assets/plus.png"),
          link: "/arrange-schedule",

          expanded: false
        },
        {
          name: "路徑規劃",
          tip: "想要找尋受歡迎路線的你",
          illustrate:
            "只要輸入一個想去的景點作為起點，就可以找到受大眾歡迎的路線",
          img: require("assets/road.png"),
          link: "/arrange-schedule",

          expanded: false
        },
        {
          name: "安排一趟旅程",
          tip: "想要來一趟旅程的你",
          illustrate: "集合我們所有的分析功能，讓您一步一步的規畫屬於您的旅程",
          img: require("assets/vacation.png"),
          link: "/mySchedule",
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
h2 {
  text-align: center;
}

.content {
  width: 700px;
  height: 180px;
  position: absolute;
  top: 0;
  right: 0;
  bottom: 0;
  left: 0;
  margin: auto;
}
</style>

