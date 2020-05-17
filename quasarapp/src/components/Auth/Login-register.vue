<template>
  <form @submit.prevent="submitForm">
    <div class="col">
      <q-banner class="bg-grey-3" style="margin: 20px">
        <template v-slot:avatar>
          <q-icon name="account_circle" color="primary" />
        </template>

        <p>{{ tab }}</p>
      </q-banner>

      <q-input
        style="margin: 20px"
        class="col"
        outlined
        v-model="formData.email"
        label="Email"
        stack-label
        ref="email"
        :rules="[
          val =>
            isValidEmailAddress(val) || '請輸入Email正確格式'
        ]"
        lazy-rules
      />
      <q-input
        style="margin: 20px"
        class="col"
        outlined
        ref="password"
        type="password"
        v-model="formData.password"
        label="password"
        stack-label
        :rules="[val => val.length >= 6 || '請輸入最少6個字元']"
        lazy-rules
      />
      <q-space />
      <div class="col text-center">
        <q-btn
          color="amber"
          :label="tab"
          type="submit"
          style="padding-left:60px;padding-right:60px;"
        />
      </div>

      <div class="col text-center">
        <!-- <q-linear-progress size="10px" value="1" class="q-mt-md" color="grey"> -->
        <div class="flex flex-center q-mt-md q-pa-none">
          <q-badge
            size="30px"
            color="white"
            text-color="black"
            label="or"
            style="font-weight:bold"
          />
        </div>
        <!-- </q-linear-progress> -->
      </div>

      <div class="col text-center">
        <q-btn
          class="q-mt-md"
          @click="loginWithGoogle"
          color="negative"
          icon="fab fa-google"
          :label="'Google帳號' + tab"
        />
      </div>
    </div>
  </form>
</template>

<script>
import { mapActions } from "vuex";
export default {
  props: ["tab"],
  data() {
    return {
      formData: {
        email: "",
        password: ""
      }
    };
  },

  methods: {
    ...mapActions("auth", ["registerUser", "loginUser", "loginWithGoogle"]),

    isValidEmailAddress(email) {
      var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
      return re.test(String(email).toLowerCase());
    },
    submitForm() {
      this.$refs.email.validate();
      this.$refs.password.validate();
      if (!this.$refs.email.hasError && !this.$refs.password.hasError) {
        if (this.tab == "Login") {
          this.loginUser(this.formData);
        } else {
          this.registerUser(this.formData);
        }
      }
    }
  }
};
</script>
