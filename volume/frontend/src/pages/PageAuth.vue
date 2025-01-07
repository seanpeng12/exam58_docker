<template>
  <q-layout view="hHh lpR fFf">
    <q-header class="bg-blue-grey-7 text-white" elevated>
      <q-toolbar>
        <q-btn
          class="title"
          to="/"
          @click="logoutUser()"
          flat
          style="font-family:Trebuchet MS,Papyrus,Verdana, Geneva, sans-serif;font-size:22px;font-weight:bold"
        >SightSeeing</q-btn>
      </q-toolbar>
    </q-header>

    <div
      class="body"
      style="font-family:Microsoft JhengHei;
    background-image: url(statics/images/beach.jpg);
    height: 100%;width:100%;max-height:auto;background-position: center;
    background-repeat: no-repeat;
    background-size: cover;"
    >
      <!-- 標題 -->
      <transition name="title-fade">
        <div
          v-if="title"
          class="q-pa-lg text-h4 text-white text-center"
          style="font-family:Microsoft JhengHei;"
        >開始你的旅程</div>
      </transition>
      <!--  -->
      <!-- 登入 -->
      <transition name="card-fade">
        <q-card v-if="card" class="auto-tabs" style="margin-bottom:50px;width:400px">
          <q-tabs
            v-model="tab"
            class="text-grey-7"
            active-color="primary"
            indicator-color="primary"
            align="justify"
            narrow-indicator
          >
            <q-tab name="登入" label="登入" />
            <q-tab name="註冊" label="註冊" />
          </q-tabs>

          <q-separator />

          <q-tab-panels v-model="tab" animated>
            <q-tab-panel name="登入">
              <Loginregister :tab="tab" />
            </q-tab-panel>

            <q-tab-panel name="註冊">
              <Loginregister :tab="tab" />
            </q-tab-panel>
          </q-tab-panels>
        </q-card>
      </transition>
    </div>
  </q-layout>
</template>
<script>
import { mapActions } from "vuex";
export default {
  data() {
    return {
      title: false,
      card: false,
      tab: "登入"
    };
  },
  components: {
    Loginregister: () => import("components/Auth/Login-register.vue")
  },
  methods: {},
  mounted: function() {
    this.title = true;
    this.card = true;
  }
};
</script>
<style scoped>
.body {
  position: absolute;
  padding: 50px;
  height: auto;
  width: 100%;
}
.auto-tabs {
  max-width: 500px;
  margin: 0 auto;
}

.title-fade-enter-active {
  transition: all 0.3s;
}
.title-fade-enter {
  transform: translateY(5px);
  opacity: 0;
}

.card-fade-enter-active {
  transition: all 0.7s;
}
.card-fade-enter {
  transform: translateY(10px);
  opacity: 0;
}
</style>

