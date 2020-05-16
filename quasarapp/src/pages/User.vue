<template>
  <q-page>
    <div class="q-pa-md" style="text-align: center;">
      <div class="text-h5">Sightseeing</div>
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
    </div>
  </q-page>
</template>

<script>
import { mapGetters, mapActions } from "vuex";
export default {
  data() {
    return {
      manager: false
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
</style>
