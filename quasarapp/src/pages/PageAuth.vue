Loginregister<template>
  <q-card class="auto-tabs">
    <q-tabs
      v-model="tab"
      dense
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

      <q-tab-panel name="註冊"> <Loginregister :tab="tab" /> </q-tab-panel>
    </q-tab-panels>
  </q-card>
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
.auto-tabs {
  max-width: 500px;
  margin: 0 auto;
}
</style>
