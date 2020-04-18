<template>
  <q-card>
    <!-- <q-card-section class="row">
      <div class="text-h6">建立旅程表</div>
      <q-space />
      <q-btn v-close-popup flat round dense icon="close" />
    </q-card-section> -->
    <modalHeader>建立旅程表</modalHeader>
    <q-form @submit="submitForm">
      <q-card-section class="q-pt-none">
        <!-- <q-input
          outlined
          ref="name"
          v-model="scheduleToSubmit.title"
          label="Schedule title"
          :rules="[(val) => !!val || 'Field is required']"
        /> -->
      </q-card-section>
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
      <!-- <pre>{{ scheduleToSubmit }}</pre> -->
    </q-form>
  </q-card>
</template>
<script>
import { mapActions } from "vuex";
export default {
  data() {
    return {
      scheduleToSubmit: {
        title: "",
        startDate: ""
      }
    };
  },
  methods: {
    ...mapActions("travel", ["fbAddData"]),
    submitForm() {
      this.$refs.modalScheduleName.$refs.name.validate();
      //   console.log(this.$refs.name.hasError);
      if (!this.$refs.modalScheduleName.$refs.name.hasError) {
        //有填資料=>false
        this.submitSchedule();
      }
    },
    submitSchedule() {
      this.fbAddData(this.scheduleToSubmit);
      this.$emit("close");
    }
  },
  components: {
    modalHeader: () =>
      import("components/schedules/modals/shared/modalHeader.vue"),
    modalScheduleName: () =>
      import("components/schedules/modals/shared/modalScheduleName.vue"),
    modalStartDate: () =>
      import("components/schedules/modals/shared/modalStartDate.vue"),
    modalButtons: () =>
      import("components/schedules/modals/shared/modalButtons.vue")
  }
};
</script>
