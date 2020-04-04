<template>
  <q-card>
    <q-card-section class="row">
      <div class="text-h6">建立旅程表</div>
      <q-space />
      <q-btn v-close-popup flat round dense icon="close" />
    </q-card-section>
    <q-form @validation-error="submitForm">
      <q-card-section class="q-pt-none">
        <q-input
          outlined
          ref="name"
          v-model="scheduleToSubmit.title"
          label="Schedule title"
          :rules="[(val) => !!val || 'Field is required']"
        />
      </q-card-section>

      <q-input
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
      </q-input>

      <q-card-actions align="right">
        <q-btn flat label="save" type="submit" color="primary" v-close-popup />
      </q-card-actions>
    </q-form>
  </q-card>
</template>
<script>
export default {
  data() {
    return {
      scheduleToSubmit: {
        title: "",
        date: "",
      },
    };
  },
  methods: {
    submitForm() {
      console.log("save");
      this.$refs.name.validate();
      //   console.log(this.$refs.name);
      if (!this.$refs.name.hasError) {
        this.submitTask;
      }
    },
    submitTask() {
      console.log("submitTask");
    },
  },
};
</script>
