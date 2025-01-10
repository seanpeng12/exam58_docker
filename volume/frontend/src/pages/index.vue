<template>
  <div class="q-pa-md layout-font bg-white">
    <div class="q-pa-lg full-height">
      <q-carousel
        arrows
        animated
        v-model="slide"
        autoplay
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
            class="row justify-start items-center rounded-borders bg-grey-3"
            style="text-align:center;width:auto;padding:0px;margin:auto;margin-top: 130px"
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
                <!-- <h4
                class="text-black"
                style="font-size:30px;line-height:45px;margin-bottom:70px;margin-top:70px"
              >
                <b>
                  <br />懶人的福音!
                  <br />不用再花大量時間爬文
                  <br />
                </b>
                <span style="font-family:Trebuchet MS;">SIGHTSEEING</span>
                <b>
                  幫你發現專屬於你的景點
                  <br />規劃旅程一次搞定
                </b>
                </h4>-->
                <h4
                  class="text-black"
                  style="font-weight:bold;font-size:30px;line-height:45px;margin:70px"
                >
                  sightseeing是一個可以節省你大量爬文時間的旅程規劃網站。
                  <br />透過系統分析資料，讓你輕鬆的找到想要的旅遊景點或飯店並讓你安排屬於自己的旅程
                </h4>
              </div>
            </div>
          </div>
        </q-carousel-slide>
        <q-carousel-slide name="2" img-src>
          <!-- 需求分析 -->
          <div class="q-pa-md row">
            <div class="col-6 bg-grey-3 text-h5">
              <div style="color: black;padding-top:150px;padding-bottom:150px;padding-left:50px;">
                <div style="font-size:50px;font-family:NSimSun;height:auto;line-height:50px;">
                  <b>給拿不定主意的你</b>
                </div>
                <div style="padding-top:50px;font-size:28px; font-family:Microsoft JhengHei;">
                  <p>還在為找不到想去的景點煩惱？</p>
                  <p>選擇喜歡的類型</p>
                  <p>符合的景點報你知!</p>
                </div>
              </div>
            </div>
            <div class="col-6 bg-grey-3 text-center">
              <div class="container" style="position: relative;text-align: center;color: white;">
                <img
                  src="~assets/index_demand_txt.png"
                  alt="Snow"
                  style="max-width:500px;width:auto;height:70ex;border-radius: 2%;"
                />
                <!-- <div
                style="position: absolute;
            bottom: 100px;
            right: 100px;
            font-size:48px;
            font-family:Microsoft YaHei;"
              >需求分析</div>
              <div
                style="position: absolute;
            bottom: 36px;
            right: 100px;
            font-size:36px;
            font-family:Georgia;"
                >Demand Analysis</div>-->
              </div>
            </div>
          </div>
          <!-- 需求分析 end -->
        </q-carousel-slide>

        <q-carousel-slide name="3" img-src>
          <!-- 需求分析 -->
          <div class="q-pa-md row">
            <div class="col-6 bg-grey-3 text-h5">
              <div style="color: black;padding-top:150px;padding-bottom:150px;padding-left:50px">
                <div style="font-size:50px;font-family:NSimSun;height:auto;line-height:50px;">
                  <b>不想踩雷的你</b>
                </div>
                <div style="padding-top:50px;font-size:28px; font-family:Microsoft JhengHei;">
                  <p>
                    使用我們的優缺點分析功能
                    輸入景點或飯店名稱，優點與缺點一目瞭然
                  </p>
                </div>
              </div>
            </div>
            <div class="col-6 bg-grey-3 text-center">
              <div class="container" style="position: relative;text-align: center;color: white;">
                <img
                  src="~assets/proscons.jpg"
                  alt="Snow"
                  style="max-width:600px;width:auto;height:70ex;border-radius: 2%;"
                />
              </div>
            </div>
          </div>
          <!-- 需求分析 end -->
        </q-carousel-slide>
        <q-carousel-slide name="4" img-src>
          <!-- 需求分析 -->
          <div class="q-pa-md row">
            <div class="col-6 bg-grey-3 text-h5">
              <div style="color: black;padding-top:150px;padding-bottom:150px;padding-left:50px">
                <div style="font-size:50px;font-family:NSimSun;height:auto;line-height:50px;">
                  <b>想要找尋受歡迎路線的你</b>
                </div>
                <div style="padding-top:50px;font-size:28px; font-family:Microsoft JhengHei;">
                  <p>只要輸入一個想去的景點作為起點，就可以找到受大眾歡迎的路線</p>
                </div>
              </div>
            </div>
            <div class="col-6 bg-grey-3 text-center">
              <div class="container" style="position: relative;text-align: center;color: white;">
                <img
                  src="~assets/path.png"
                  alt="Snow"
                  style="max-width:600px;width:auto;height:70ex;border-radius: 2%;"
                />
              </div>
            </div>
          </div>
          <!-- 需求分析 end -->
        </q-carousel-slide>
        <!-- <q-carousel-slide name="5" img-src="~assets/index_2.jpg">
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
        </q-carousel-slide>-->
      </q-carousel>
    </div>

    <!-- 需求分析 end -->
    <!-- 游標 -->
    <q-page-scroller reverse position="top-right" :scroll-offset="20" :offset="[18, 18]">
      <q-btn fab icon="keyboard_arrow_down" color="dark" />
    </q-page-scroller>
    <!-- end -->
    <!-- card 卡片 -->
    <div>
      <div
        class="q-pa-lg row justify-center item-center text-h4 text-bold"
        style="padding-top:100px"
      >功能一覽</div>
      <div
        class="row justify-center full-height full-width text-center"
        style="overflow:hidden;width:auto;height:100%;margin:0px auto;"
      >
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
            <q-btn
              flat
              color="primary"
              :label="func.enterTxt"
              :to="func.link"
              style="font-weight: bold;"
            />
            <q-btn
              v-if="func.name == '需求分析功能'"
              flat
              color="primary"
              :label="func.enterTxt2"
              to="/hotel_demend"
              style="font-weight: bold;"
            />
            <q-btn
              v-if="func.name == '優缺點分析功能'"
              flat
              color="primary"
              :label="func.enterTxt2"
              to="/hotel_ProsCons"
              style="font-weight: bold;"
            />

            <q-space />
          </q-card-actions>
        </q-card>
        <!--  -->
        <q-card class="my-card" style="margin: 20px; width: 250px;" flat bordered>
          <q-img src="~assets/vacation.png" style="height:140px; width:140px; margin: 60px"></q-img>

          <q-card-section>
            <div class="text-overline text-orange-9">想要來一趟旅程的你</div>
            <div class="text-h5 q-mt-sm q-mb-xs">安排一趟旅程</div>
            <div class="text-caption text-grey"></div>
          </q-card-section>
          <q-card-actions>
            <!-- <q-btn flat color="dark" label="Share" /> -->
            <q-btn
              v-if="loggedIn == true"
              flat
              color="primary"
              label="進入分析"
              to="mySchedule"
              style="font-weight: bold;"
            />
            <q-chip
              v-else
              class="q-pa-sm"
              dense
              text-color="white"
              icon="announcement"
              label="登入後即可使用"
              color="red"
            />
          </q-card-actions>
        </q-card>
      </div>
    </div>

    <!-- card end -->
  </div>
</template>

<script>
// 824 (it's in pixels always)
import axios, { axiosInstance } from "boot/axios";
import { mapGetters, mapActions } from "vuex";
import { firebaseAuth, google_provider } from "boot/firebase";

export default {
  data() {
    return {
      slide: "1",
      navPos: "bottom",
      name: "PageIndex",

      funcs: [
        {
          name: "需求分析功能",
          tip: "給拿不定主意的你",
          illustrate:
            "只要選擇兩個想去的景點的類型，您即可找出符合A類型及B類型的景點",
          img: require("assets/idea.png"),
          link: "/site_demend",
          enterTxt: "進入景點分析",
          enterTxt2: "進入飯店分析",
          expanded: false
        },

        {
          name: "優缺點分析功能",
          tip: "不想踩雷的你",
          illustrate:
            "只要輸入您想了解的景點名稱，景點優缺點馬上一目瞭然，不必再花大量時間爬文。",
          img: require("assets/plus.png"),
          link: "/site_ProsCons",
          enterTxt: "進入景點分析",
          enterTxt2: "進入飯店分析",
          expanded: false
        },
        {
          name: "路徑規劃",
          tip: "想要找尋受歡迎路線的你",
          illustrate:
            "只要輸入一個想去的景點作為起點，就可以找到受大眾歡迎的路線",
          img: require("assets/road.png"),
          link: "/site_Path",
          enterTxt: "進入分析",

          expanded: false
        }
        // {
        //   name: "安排一趟旅程",
        //   tip: "想要來一趟旅程的你",
        //   illustrate: "集合我們所有的分析功能，讓您一步一步的規畫屬於您的旅程",
        //   img: require("assets/vacation.png"),
        //   link: "/mySchedule",
        //   enterTxt: "進入排程",

        //   expanded: false
        // }
      ]
    };
  },
  computed: {
    ...mapGetters("auth", ["loggedIn"])
  },
  methods: {
    ...mapActions("auth", ["chooseRole"]),
    setRole(roleName) {
      // console.log("manager");
      this.chooseRole(roleName);
      if (localStorage.getItem("role") == "manager") {
        console.log(localStorage.getItem("role"));
      } else {
        console.log(localStorage.getItem("role"));
      }
    }
  },
  mounted: function() {
    // 過渡效果
    this.card_1 = true;

    // get data from redirect
    // let urlParams = new URLSearchParams(window.location.search);
    // let code = urlParams.get("code");
    // let state = urlParams.get("state");
    // alert(code + state);

    // axiosInstance
    //   .post("api/line_3", {
    //     code: code
    //   })
    //   .then(res => {
    //     console.log("line_3 response:", res.data);
    //     // alert(res.data.name);

    //     firebaseAuth.signInWithCustomToken(res.data.response).catch(error => {
    //       showErrorMessage(error.message);
    //     });
    //   })
    //   .catch(err => {
    //     console.log(err);
    //   });
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
