<template class="template">
  <q-layout view="hHh lpR fFf">
    <q-header elevated class="bg-blue-grey-7 text-white">
      <q-toolbar>
        <q-toolbar-title>
          <q-btn class="capital" @click="logoutUser()" flat>SIGHTSEEING</q-btn>
        </q-toolbar-title>
      </q-toolbar>
    </q-header>

    <q-page-container class="overflow-hidden">
      <transition name="card-1">
        <div v-if="card_1" class="row">
          <div class="col"></div>

          <q-item v-ripple class="q-ma-lg q-pa-xs capital-item text-white" style="background-color:#7a9e9f;">
            <q-item-section avatar>
              <!-- <q-avatar rounded> -->
              <q-icon
                size="60px"
                style="color:white"
                name="fas fa-user-tag"
                class="q-ma-xl"
              />
              <!-- </q-avatar> -->
            </q-item-section>

            <q-item-section>
              <q-item-label
                class="col-12 col-md-auto text-h4 text-bold layout-font"
              >
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
            <q-card  class="q-pa-sm my-card bigger" style="background-color:#f6de98;" flat to="/manager_index">
              <q-card-section horizontal style="height:300px">
                <q-card-section class="q-pt-xs layout-font">
                  <div class="text-overline text-bold">您的身分?</div>
                  <div
                    class="text-h5 q-mt-sm q-mb-xs layout-font"
                    style="font-weight:bold;color:#261873"
                  >
                    飯店景點管理者
                  </div>
                  <div class="text-h7 text-grey-10">
                    不論您是飯店業者或景點管理者，我們的分析可以:
                    <p><b>
                      洞察自身與競爭者在消費者眼中的主要優劣因素
                      、並透過消費者的旅遊軌跡發現新的合作對象 </b
                    >，共創雙贏。</p>
                  </div>
                </q-card-section>

                <q-card-section class="col-5 flex flex-center">
                  <q-img class="rounded-borders" src="~assets/manager.png" />
                </q-card-section>
              </q-card-section>



              <q-card-actions>
                <q-space />
                <q-btn
                  to="/PageAuth"
                  size="18px"
                  class="layout-font"
                  style="width:100%;font-weight:bold;color:#4B76D9"
                  @click="chooseRole('manager')"
                  >進入功能</q-btn
                >
              </q-card-actions>
            </q-card>
          </div>
          <div class="col-6 col-md-auto q-ma-sm">
            <q-card class="q-pa-sm my-card bigger" style="background-color:#eef5db;" flat>
              <q-card-section horizontal style="height:300px">
                <q-card-section class="q-pt-xs layout-font">
                  <div class="text-overline text-bold">您的身分?</div>
                  <div
                    class="text-h5 q-mt-sm q-mb-xs layout-font"
                    style="font-weight:bold;color:#261873"
                  >
                    一般旅客
                  </div>
                  <span class="text-h7 text-grey-10">
                    喜歡自己規劃旅遊行程的您，苦惱於不熟悉旅遊城市的景點、
                    飯店、又不想花費大把時間在網上找尋評價，SIGHTSEEING幫你搞定!
                    <br />
                    <b
                      >我們提供符合需求的景點/飯店，並整合各景點/飯店評論優缺點，讓您無須再上網爬文。</b
                    >
                  </span>
                </q-card-section>

                <q-card-section class="col-5 flex flex-center">
                  <q-img class="rounded-borders" src="~assets/traveler.png" />
                </q-card-section>
              </q-card-section>


              <q-card-actions>
                <q-space />
                <q-btn
                  size="18px"
                  class="layout-font"
                  style="width:100%;font-weight:bold;color:#4B76D9"
                  @click="chooseRole('generalUser')"
                  to="/index"
                  >進入功能</q-btn
                >
              </q-card-actions>
            </q-card>
          </div>
          <div class="col"></div>
        </div>
      </transition>

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
    ...mapActions("auth", ["chooseRole", "logoutUser"]),
    // mouseOver: function(){
    //   alert("你hover的business user");
    // }
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
/* transition */
.card-1-enter-active {
  transition: all 1s;
}
.card-1-enter {
  transform: translateY(50px);
  opacity: 0;
}
.bigger{
  /* hover off */
  transition: all 0.3s;
}
.bigger:hover{
  /* hover */
  transition: all 0.3s ease;
  transform:scale(1.05,1.05);
}

</style>
