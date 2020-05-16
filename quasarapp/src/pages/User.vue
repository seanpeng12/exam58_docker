<template>
  <q-page>
    <div class="q-pa-lg" style="text-align: center;">
      <div>
        作為旅遊業者，不管是景點或旅館經營業者，可透過我們的分析洞察產業在消費者眼中的主要優缺分析
        、尋找適合的合作對象，獲得消費者消費動向，創造共榮共生。
      </div>
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
</style>
