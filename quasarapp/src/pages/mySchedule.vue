<template>
  <q-page padding>
    <div class="row">
      <!-- <schedule
        v-for="(sightseeingMember, key) in sightseeingMember"
        :key="key"
        :schedule="schedule"
        :id="key"
      ></schedule> -->
      <schedule
        v-for="(sightseeingMember, key) in sightseeingMembers"
        :key="key"
        :sightseeingMember="sightseeingMember"
        :id="key"
      ></schedule>
      <!-- <div
        v-for="sightseeingMember in sightseeingMembers"
        :key="sightseeingMember.id"
      >
        <p>{{ sightseeingMember.title }}</p>
      </div> -->
    </div>
    <div
      class="absolute-bottom-right q-ma-lg"
      style="pading: 20px; font-family: NSimSun;"
    >
      <q-btn
        dense
        color="warning"
        size="24px"
        icon="add"
        label="建立新的旅程 "
        @click="addSchedule = true"
      />
    </div>
    <q-dialog v-model="addSchedule">
      <addSchedule @close="addSchedule = false"></addSchedule
    ></q-dialog>
  </q-page>
</template>
<script>
import { mapGetters } from "vuex";

export default {
  data() {
    return {
      tab: "mails",
      addSchedule: false
      // schedules: [
      //   {
      //     title: "我的花蓮之旅"
      //   },
      //   {
      //     title: "台南行"
      //   },
      //   {
      //     title: "五日花東遊"
      //   }
      // ]
    };
  },
  computed: {
    // ...mapGetters("schedules", ["schedules"]),
    ...mapGetters("travel", ["sightseeingMembers"])
  },
  components: {
    search: () => import("components/search.vue"),
    schedule: () => import("components/schedules/schedule.vue"),
    addSchedule: () => import("components/schedules/modals/addSchedule.vue")
  }
};
</script>
<style lang="scss">
.my-card {
  width: 100%;
  max-width: 280px;
  margin: 20px;
  margin-left: 30px;
}
</style>
