<template>
  <q-card class="my-card">
    <q-img src="~assets/IMG_3593.jpg">
      <div class="absolute-bottom">
        <div class="text-h7" style="font-weight: bold;">
          {{ sightseeingMember.title }}
        </div>
        <p class="absolute-right q-pt-lg" style="margin-right:8px">
          {{ sightseeingMember.date[0] + "~" + sightseeingMember.date[1] }}
        </p>
      </div>
    </q-img>

    <q-card-actions>
      <!-- <q-btn
        flat
        class="text-overline text-orange-9"
        style="font-family: NSimSun; font-size: 14px;"
        @click="
          updateSchedule({
            id: id,
            updates: { title: sightseeingMember.title }
          })
        "
        >查看旅程</q-btn
      > -->
      <q-btn
        flat
        class="text-overline text-pink-9;"
        style="font-family: NSimSun; font-size: 14px;"
        @click="
          updateSchedule({
            id: id,
            updates: { title: sightseeingMember.title }
          })
        "
      >
        進入編輯</q-btn
      >
      <!-- <q-btn
        class="col-1"
        flat
        round
        color="primary"
        dense
        icon="edit"
        @click.stop="showEditSchedule = true"
      /> -->
      <q-space />

      <q-btn
        no-caps
        flat
        label="刪除旅程表"
        icon-right="delete"
        color="red"
        @click="promptToDelete(id)"
        style="font-family: NSimSun;"
      >
      </q-btn>
    </q-card-actions>
    <q-dialog v-model="showEditSchedule">
      <editSchedule
        @close="showEditSchedule = false"
        :sightseeingMember="sightseeingMember"
        :id="sightseeingMember.id"
      ></editSchedule
    ></q-dialog> </q-card
></template>

<script>
import { mapActions } from "vuex";
import { mapGetters } from "vuex";

export default {
  props: ["sightseeingMember", "sightseeingMember.id", "id"],
  data() {
    return { showEditSchedule: false };
  },
  methods: {
    ...mapActions("travel", ["deleteSchedule", "updateSchedule"]),
    promptToDelete(id) {
      this.$q
        .dialog({
          title: "Confirm",
          message: "確定要刪除嗎?",
          cancel: true,
          persistent: true
        })
        .onOk(() => {
          this.deleteSchedule(id);
        });
    },
    to_arrange_schedule() {
      var id = getTicketParameter("ticket");
      this.$router.push({
        //        path: '/search',
        path: `/search?ticket=${ticket}`,
        query: { param: this.param }
      });
    }
  },
  components: {
    editSchedule: () => import("components/schedules/modals/editSchedule.vue")
  },
  computed: {
    // ...mapGetters("schedules", ["schedules"]),
    ...mapGetters("travel", ["sightseeingMembers"])
  }
};
</script>
<!-- ...mapActions("schedules", ["updateSchedule", "deleteSchedule"]), -->
