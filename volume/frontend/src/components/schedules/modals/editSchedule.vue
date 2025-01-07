<template>
  <q-card>
    <modalHeader>建立旅程表</modalHeader>
    <q-form @submit="submitForm">
      <q-card-section class="q-pt-none"> </q-card-section>
      <modalScheduleName
        :name.sync="scheduleToSubmit.title"
        ref="modalScheduleName"
      />
      <modalStartDate
        :startDate.sync="scheduleToSubmit.startDate"
      ></modalStartDate>
      <modalButtons></modalButtons>

      <!-- <q-input
        class="q-px-md"
        outlined
        v-model="scheduleToSubmit.date"
        label="輸入起始天"
      >
        <template v-slot:append>
          <q-icon name="event" class="cursor-pointer">
            <q-popup-proxy
              ref="qDateProxy"
              transition-show="scale"
              transition-hide="scale"
            >
              <q-date
                v-model="scheduleToSubmit.date"
                @input="() => $refs.qDateProxy.hide()"
              />
            </q-popup-proxy>
          </q-icon>
        </template>
      </q-input> -->

      <!-- <q-card-actions align="right">
        <q-btn label="save" type="submit" color="primary" />
      </q-card-actions> -->
      <pre>{{ scheduleToSubmit }}</pre>
    </q-form>
  </q-card>
</template>
<script>
import { mapActions } from "vuex";
export default {
  props: ["schedule", "id"],
  data() {
    return {
      scheduleToSubmit: {
        title: "",
        startDate: "",
      },
    };
  },
  methods: {
    ...mapActions("schedules", ["updateSchedule"]),
    submitForm() {
      this.$refs.modalScheduleName.$refs.name.validate();
      //   console.log(this.$refs.name.hasError);
      if (!this.$refs.modalScheduleName.$refs.name.hasError) {
        //有填資料=>false
        this.submitSchedule();
      }
    },
    submitSchedule() {
      // this.addSchedule(this.scheduleToSubmit);
      this.updateSchedule({
        id: this.id,
        updates: this.scheduleToSubmit,
      });
      this.$emit("close");
    },
  },
  components: {
    modalHeader: () =>
      import("components/schedules/modals/shared/modalHeader.vue"),
    modalScheduleName: () =>
      import("components/schedules/modals/shared/modalScheduleName.vue"),
    modalStartDate: () =>
      import("components/schedules/modals/shared/modalStartDate.vue"),
    modalButtons: () =>
      import("components/schedules/modals/shared/modalButtons.vue"),
  },
  mounted() {
    this.scheduleToSubmit = Object.assign({}, this.schedule);
  },
};
</script>
