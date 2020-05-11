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
            isValidEmailAddress(val) || 'Please enter a valid Email address'
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
        :rules="[val => val.length >= 6 || 'Please use at least 6 characters']"
        lazy-rules
      />
      <q-space />
      <q-btn
        color="amber"
        style="position: fix; bottom:0px; left:400px"
        :label="tab"
        type="submit"
      />
      <q-btn
        @click="loginWithGoogle"
        color="negative"
        icon-right="account_circle"
        :label="'以Google帳號' + tab"
        style="margin-left: 100px;"
      />
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
