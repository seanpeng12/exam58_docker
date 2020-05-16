<template>
  <q-page>
    <div class="row">
      <div class="col"></div>

      <q-item v-ripple class="bg-grey-2 q-ma-md" style="width:1100px">
        <q-item-section avatar>
          <!-- <q-avatar rounded> -->
          <q-icon
            size="60px"
            color="red"
            name="fas fa-user-tag"
            class="q-ma-xl"
          />
          <!-- </q-avatar> -->
        </q-item-section>

        <q-item-section>
          <q-item-label>
            <h4 class="col-12 col-md-auto" style="font-weight:bold">
              SIGHTSEEING依照您的身分，提供不一樣的分析功能
            </h4>
          </q-item-label>
          <!-- <q-item-label caption>
            <q-badge color="yellow-6" text-color="black">
              3
              <q-icon name="warning" size="14px" class="q-ml-xs" />
            </q-badge>
          </q-item-label> -->
        </q-item-section>

        <!-- <q-item-section side>
          <span>2 min ago</span>
        </q-item-section> -->
      </q-item>
      <div class="col"></div>

      <!--  -->
    </div>
    <div class="row">
      <div class="col"></div>
      <div class="col-6 col-md-auto q-ma-md">
        <q-card class="my-card" flat bordered>
          <q-card-section horizontal style="height:250px">
            <q-card-section class="q-pt-xs">
              <div class="text-overline">您的身分?</div>
              <div
                class="text-h5 q-mt-sm q-mb-xs"
                style="font-weight:bold;color:#261873"
              >
                飯店景點管理者
              </div>
              <div class="text-h7 text-grey-10">
                作為旅遊業者，不管是景點或旅館經營業者，可透過我們的分析洞察產業在消費者眼中的主要優缺分析
                、尋找適合的合作對象，獲得消費者消費動向，創造共榮共生。
              </div>
            </q-card-section>

            <q-card-section class="col-5 flex flex-center">
              <q-img class="rounded-borders" src="~assets/manager.png" />
            </q-card-section>
          </q-card-section>

          <q-separator />

          <q-card-actions>
            <!-- <q-btn flat>
              7:30PM
            </q-btn> -->
            <q-btn flat style="font-weight:bold;color:#6aa0d9">
              進入功能
            </q-btn>
          </q-card-actions>
        </q-card>
      </div>
      <div class="col-6 col-md-auto q-ma-md">
        <q-card class="my-card" flat bordered>
          <q-card-section horizontal style="height:250px">
            <q-card-section class="q-pt-xs">
              <div class="text-overline">您的身分?</div>
              <div
                class="text-h5 q-mt-sm q-mb-xs"
                style="font-weight:bold;color:#261873"
              >
                一般旅客
              </div>
              <div class="text-h7 text-grey-10">
                如果您是喜愛自己規劃旅行，但又沒有甚麼頭緒抑或是覺得要上網爬分享的文章，
                覺得要花許多時間，那你一定要點進來。
                提供符合您需求的景點與飯店、快速整理每個旅遊景點的綜合評論優缺點，無須在上網爬文
              </div>
            </q-card-section>

            <q-card-section class="col-5 flex flex-center">
              <q-img class="rounded-borders" src="~assets/traveler.png" />
            </q-card-section>
          </q-card-section>

          <q-separator />

          <q-card-actions>
            <q-btn flat style="font-weight:bold;color:#6aa0d9">
              進入功能
            </q-btn>
          </q-card-actions>
        </q-card>
      </div>
      <div class="col"></div>
    </div>

    <!--  -->
    <div class="q-pa-lg" style="text-align: center;">
      <div></div>
      <q-btn
        size="22px"
        class="q-px-xl q-py-xs"
        color="teal-4"
        label="管理人員/旅館業者"
        @click="chooseRole('manager')"
      />
    </div>
    <div class="q-pa-lg" style="text-align: center;">
      <q-btn
        size="22px"
        class="q-px-xl q-py-xs"
        color="teal-4"
        label="一般使用者"
        @click="chooseRole('generalUser')"
      />
    </div>
    <div>現在身分：{{ role }}</div>
  </q-page>
</template>

<script>
import { mapGetters, mapActions } from "vuex";
export default {
  data() {
    return {};
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
    } else if (this.role == "generalUser") {
      console.log("確認為一般使用者");
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
</style>
