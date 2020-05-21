<template class="template">
  <q-layout view="hHh lpR fFf">
    <q-header elevated class="bg-blue-grey-7 text-white">
      <q-toolbar>
        <q-toolbar-title>
          <q-btn class="capital" clickable to="/" flat>SIGHTSEEING</q-btn>
        </q-toolbar-title>
      </q-toolbar>
    </q-header>

    <q-page-container class="overflow-hidden">
      <transition name="card-1">
        <div v-if="card_1" class="row">
          <div class="col"></div>

          <q-item v-ripple class="bg-grey-2 q-ma-lg q-pa-xs capital-item">
            <q-item-section avatar>
              <!-- <q-avatar rounded> -->
              <q-icon size="60px" style="color:#ed74ad" name="fas fa-user-tag" class="q-ma-xl" />
              <!-- </q-avatar> -->
            </q-item-section>

            <q-item-section>
              <q-item-label class="col-12 col-md-auto text-h4 text-bold layout-font">
                <p>SIGHTSEEING 依照您的身分</p>
                <p>提供不一樣的分析功能</p>
              </q-item-label>
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
            <q-card class="q-pa-sm my-card bg-lime-2" flat to="/manager_index">
              <q-card-section horizontal style="height:270px">
                <q-card-section class="q-pt-xs">
                  <div class="text-overline">您的身分?</div>
                  <div
                    class="text-h5 q-mt-sm q-mb-xs layout-font"
                    style="font-weight:bold;color:#261873"
                  >飯店景點管理者</div>
                  <div class="text-h7 text-grey-10">
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
                  size="18px"
                  class="layout-font"
                  style="width:100%;font-weight:bold;color:#4B76D9"
                  @click="chooseRole('manager')"
                >進入功能</q-btn>
              </q-card-actions>
            </q-card>
          </div>
          <div class="col-6 col-md-auto q-ma-sm">
            <q-card class="q-pa-sm my-card bg-lime-2" flat>
              <q-card-section horizontal style="height:270px">
                <q-card-section class="q-pt-xs">
                  <div class="text-overline">您的身分?</div>
                  <div
                    class="text-h5 q-mt-sm q-mb-xs layout-font"
                    style="font-weight:bold;color:#261873"
                  >一般旅客</div>
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
                  size="18px"
                  class="layout-font"
                  style="width:100%;font-weight:bold;color:#4B76D9"
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
      // manager: false,
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
    // 過渡效果
    this.card_1 = true;
  },
  watch: {}
};
</script>

<style scoped>
.template {
  margin: 0;
  padding: 0;
}
.overflow-hidden {
  overflow: hidden;
}
.layout-font {
  font-family: Microsoft JhengHei;
}
.capital {
  font-family: Trebuchet MS, Papyrus, Verdana, Geneva, sans-serif;
  font-size: 22px;
  font-weight: bold;
}
.capital-item {
  width: 920px;
}
.my-card {
  width: 100%;
  max-width: 450px;
}

.card-1-enter-active {
  transition: all 1s;
}
.card-1-enter {
  transform: translateY(50px);
  opacity: 0;
}
</style>
