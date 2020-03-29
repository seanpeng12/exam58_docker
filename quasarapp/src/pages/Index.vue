<template>
  <q-page padding>
    <button style="position:absolute; right:10px" @click="counter++">{{ counter }}</button>
    <input
      type="text"
      v-model="message"
      @keyup.esc="clearMessage"
      @keyup.enter="alertMessage"
      v-autofocus
      v-bind:class="{ 'error' : message.length > 22}"
      v-bind:style=" errorStyle"
    />
    <div>{{ message.length }} 個字</div>

    <button @click="message = ''">Clear</button>

    <button @click="clearMessage">呼叫刪除</button>

    <h5 class="border_grey" v-if="message.length">{{ message }}</h5>
    <h6 v-else>請輸入資料!</h6>

    <hr />
    <p>Uppercase message: {{ messageUppercase }}</p>
    <p>Lowercase message: {{ message | messageLowercase}}</p>
  </q-page>
</template>

<script>
export default {
  data() {
    return {
      message: "test test test",
      counter: 0
    };
  },
  computed: {
    messageUppercase() {
      console.log("被觸發一次");
      return this.message.toUpperCase() + " ，數字為：" + this.counter;
    },
    errorStyle() {
      if (this.message.length > 5) {
        return {
          color: "gray",
          background: "yellow"
        };
      }
    }
  },
  methods: {
    clearMessage() {
      this.message = "";
    },
    // handleKeyup(e) {
    //   console.log(e);
    //   if (e.keyCode == 84) {
    //     this.clearMessage();
    //   } else if (e.keyCode == 13) {
    //     this.alertMessage();
    //   }
    // },
    alertMessage() {
      alert(this.message);
    }
  },
  filters: {
    messageLowercase(value) {
      return value.toLowerCase();
    }
  },
  directives: {
    autofocus: {
      inserted(el) {
        console.log("input inserted.");
        el.focus();
      }
    }
  }
};
</script>

<style>
.border_grey {
  border: 1px solid grey;
}
.error {
  color: red;
  background: pink;
}
</style>
