<template>
  <div
    class="body"
    style="font-family:Microsoft JhengHei;
    background-image: url(statics/images/beach.jpg);
    height: 100%;background-position: center;
    background-repeat: no-repeat;
    background-size: cover;"
  >
    <!-- 標題 -->
    <div
      class="q-pa-lg text-h4 text-white text-center"
      style="font-family:Microsoft JhengHei;"
    >開始你的旅程</div>
    <!--  -->
    <!-- 登入 -->
    <q-card class="auto-tabs" style="margin-bottom:50px">
      <q-tabs
        v-model="tab"
        class="text-grey"
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
  </div>
</template>
<script>
import { mapActions } from "vuex";
export default {
  data() {
    return {
      tab: "登入"
    };
  },
  components: {
    Loginregister: () => import("components/Auth/Login-register.vue")
  },
  methods: {}
};
</script>
<style>
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
</style>
