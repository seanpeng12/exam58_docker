<template>
  <q-card class="my-card">
    <q-img src="~assets/IMG_3593.jpg">
      <div class="absolute-bottom">
        <div class="text-h7" style="font-weight: bold;">
          {{ schedule.title }}
        </div>
        <p class="absolute-right q-pt-lg">{{ schedule.startDate }}</p>
      </div>
    </q-img>

    <q-card-actions>
      <q-btn
        flat
        class="text-overline text-orange-9"
        style="font-family: NSimSun; font-size: 14px;"
        @click="updateSchedule({ id: id })"
        >查看旅程</q-btn
      >
      <q-btn
        to="/arrange-schedule"
        flat
        class="text-overline text-pink-9;"
        style="font-family: NSimSun; font-size: 14px;"
        @click="updateSchedule({ id: id })"
      >
        進入編輯</q-btn
      >
      <q-btn
        class="col-1"
        flat
        round
        color="primary"
        dense
        icon="edit"
        @click.stop="showEditSchedule = true"
      />
      <q-btn
        class="col-1"
        flat
        round
        color="red"
        dense
        icon="delete"
        @click="promptToDelete(id)"
      />
    </q-card-actions>
    <q-dialog v-model="showEditSchedule">
      <editSchedule
        @close="showEditSchedule = false"
        :schedule="schedule"
        :id="id"
      ></editSchedule
    ></q-dialog> </q-card
></template>
<script>
import { mapActions } from "vuex";
export default {
  props: ["schedule", "id"],
  data() {
    return { showEditSchedule: false };
  },
  methods: {
    ...mapActions("schedules", ["updateSchedule", "deleteSchedule"]),
    promptToDelete(id) {
      this.$q
        .dialog({
          title: "Confirm",
          message: "確定要刪除嗎?",
          cancel: true,
          persistent: true,
        })
        .onOk(() => {
          this.deleteSchedule(id);
        });
    },
  },
  components: {
    editSchedule: () => import("components/schedules/modals/editSchedule.vue"),
  },
};
</script>
