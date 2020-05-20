<template style="margin: 0;padding: 0;">
  <q-layout view="hHh lpR fFf">
    <q-header elevated class="bg-blue-grey-7 text-white">
      <q-toolbar>
        <q-toolbar-title>
          <q-btn
            clickable
            to="/"
            flat
            style="font-family:Trebuchet MS,Papyrus,Verdana, Geneva, sans-serif;font-size:22px;font-weight:bold"
          >SIGHTSEEING</q-btn>
        </q-toolbar-title>
      </q-toolbar>
    </q-header>

    <q-page-container style="overflow: hidden;">
      <transition name="card-1">
        <div v-if="card_1" class="row">
          <div class="col"></div>

          <q-item v-ripple class="bg-grey-2 q-ma-md q-pa-xs" style="width:1100px">
            <q-item-section avatar>
              <!-- <q-avatar rounded> -->
              <q-icon size="60px" style="color:#ed74ad" name="fas fa-user-tag" class="q-ma-xl" />
              <!-- </q-avatar> -->
            </q-item-section>

            <q-item-section>
              <q-item-label>
                <h4 class="col-12 col-md-auto" style="font-weight:bold">SIGHTSEEING依照您的身分，提供不一樣的分析功能</h4>
              </q-item-label>
              <!-- <q-item-label caption>
            <q-badge color="yellow-6" text-color="black">
              3
              <q-icon name="warning" size="14px" class="q-ml-xs" />
            </q-badge>
              </q-item-label>-->
            </q-item-section>

            <!-- <q-item-section side>
          <span>2 min ago</span>
            </q-item-section>-->
          </q-item>
          <div class="col"></div>

          <!--  -->
        </div>
      </transition>
      <transition name="card-1">
        <div v-if="card_1" class="row q-mt-none">
          <div class="col"></div>
          <div class="col-6 col-md-auto q-ma-sm">
            <q-card class="my-card bg-lime-2" flat bordered to="/manager_index">
              <q-card-section horizontal style="height:270px">
                <q-card-section class="q-pt-xs">
                  <div class="text-overline">您的身分?</div>
                  <div
                    class="text-h5 q-mt-sm q-mb-xs"
                    style="font-weight:bold;color:#261873"
                  >飯店景點管理者</div>
                  <div class="text-h7 text-grey-10">
                    <!-- 作為旅遊業者，不管是景點或旅館經營業者，可透過我們的分析洞察產業在消費者眼中的主要優缺分析
                    、尋找適合的合作對象，獲得消費者消費動向，創造共榮共生。-->
                    不論您是飯店業者或景點的管理者，可透過我們的
                    <b>
                      分析洞察自己與競爭者在消費者眼中的主要優劣勢
                      、也能透過消費者的旅遊軌跡尋找合適的合作對象
                    </b>，與其共生共榮。
                  </div>
                </q-card-section>

                <q-card-section class="col-5 flex flex-center">
                  <q-img class="rounded-borders" src="~assets/manager.png" />
                </q-card-section>
              </q-card-section>

              <q-separator />

              <q-card-actions>
                <q-space />
                <q-btn
                  to="/manager_index"
                  style="font-weight:bold;color:#6aa0d9"
                  @click="chooseRole('manager')"
                >進入功能</q-btn>
              </q-card-actions>
            </q-card>
          </div>
          <div class="col-6 col-md-auto q-ma-sm">
            <q-card class="my-card bg-lime-2" flat bordered>
              <q-card-section horizontal style="height:270px">
                <q-card-section class="q-pt-xs">
                  <div class="text-overline">您的身分?</div>
                  <div class="text-h5 q-mt-sm q-mb-xs" style="font-weight:bold;color:#261873">一般旅客</div>
                  <span class="text-h7 text-grey-10">
                    如果您喜歡自己規劃旅遊行程，但在一開始又對那個城市的景點、
                    飯店沒有頭緒或是不想花費大把時間在網上找尋每個景點、飯店的評價，那您一定要試試我們的系統!
                    <br />
                    <b>我們可以直接提供您符合需求的景點與飯店，並為您整合各個景點飯店的評論優缺點，讓您無須再上網爬文。</b>
                  </span>
                </q-card-section>

                <q-card-section class="col-5 flex flex-center">
                  <q-img class="rounded-borders" src="~assets/traveler.png" />
                </q-card-section>
              </q-card-section>

              <q-separator />

              <q-card-actions>
                <q-space />
                <q-btn
                  style="font-weight:bold;color:#6aa0d9"
                  @click="chooseRole('generalUser')"
                  to="/index"
                >進入功能</q-btn>
              </q-card-actions>
            </q-card>
          </div>
          <div class="col"></div>
        </div>
      </transition>

      <!--  -->
      <!-- <div class="q-pa-lg" style="text-align: center;">
      <div></div>
      <q-btn
        size="22px"
        class="q-px-xs q-py-xs"
        color="teal-4"
        label="管理人員/旅館業者"
        @click="chooseRole('manager')"
      />&nbsp;
      <q-btn
        size="22px"
        class="q-px-lg q-py-xs"
        color="teal-4"
        label="一般使用者"
        @click="chooseRole('generalUser')"
      />
    </div>

    <div class="text-center text-h3 q-pa-md">身分：{{ role }}</div>
    <div class="text-center" v-if="manager">
      <q-btn class="q-px-lg q-py-xs" to="/manager_index" size="28px">
        <b>前往管理者頁面</b>
      </q-btn>
    </div>
    <div class="text-center" v-else>
      <q-btn class="q-px-lg q-py-xs" to="/index" size="28px">
        <b>前往一般頁面</b>
      </q-btn>
      </div>-->
    </q-page-container>
  </q-layout>
  <!--  -->
</template>

<script>
import { mapGetters, mapActions } from "vuex";
export default {
  data() {
    return {
      manager: false,
      card_1: false
    };
  },
  computed: {
    ...mapGetters("auth", ["loggedIn", "role"])
  },
  methods: {
    ...mapActions("auth", ["chooseRole"])
  },
  mounted: function() {
    this.chooseRole("check");
    if (this.role == "manager") {
      console.log("確認為管理者");
      this.manager = true;
    } else if (this.role == "generalUser") {
      console.log("確認為一般使用者");
      this.manager = false;
    }
    // 過渡效果
    this.card_1 = true;
  },
  watch: {
    role(val) {
      if (this.role == "manager") {
        console.log("確認為管理者");
        this.manager = true;
      } else if (this.role == "generalUser") {
        console.log("確認為一般使用者");
        this.manager = false;
      }
    }
  }
};
</script>

<style scoped>
.layout-font {
  font-family: Microsoft JhengHei;
  /* font-family: NSimSun; */
}
.my-card {
  width: 100%;
  max-width: 450px;
}

.card-1-enter-active {
  transition: all 1s ease;
}
.card-1-enter {
  transform: translateX(50px);
  opacity: 0;
}
</style>
