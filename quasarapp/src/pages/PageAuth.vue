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
      <q-tab name="Login" label="Login" />
      <q-tab name="Register" label="Register" />
    </q-tabs>

    <q-separator />

    <q-tab-panels v-model="tab" animated>
      <q-tab-panel name="Login">
        <Loginregister :tab="tab" />
      </q-tab-panel>

      <q-tab-panel name="Register"> <Loginregister :tab="tab" /> </q-tab-panel>
    </q-tab-panels>
  </q-card>
</template>
<script>
export default {
  data() {
    return {
      tab: "Login"
    };
  },
  components: {
    Loginregister: () => import("components/Auth/Login-register.vue")
  }
};
</script>
<style>
.auto-tabs {
  max-width: 500px;
  margin: 0 auto;
}
</style>
