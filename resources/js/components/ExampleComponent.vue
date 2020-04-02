<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header">Example 這是!!!!!!!!!!!!元素</div>

          <div class="card-body">h</div>
          <input type="text" v-model="message" />
          <br />
          <button @click="toggleMessage">Show / hide message</button>
          <!-- 顯示剛剛v-model寫入的數值 -->
          <!-- 使用v-show做判斷顯示 -->
          <p v-show="showMessage">{{ message }}</p>
        </div>
      </div>
    </div>
  </div>
</template>


<script>
export default {
  mounted() {
    console.log("Component mounted. 測試成功");
  },
  data() {
    return {
      message: "i love vue.js!",
      showMessage: true
    };
  },
  methods: {
    toggleMessage() {
      this.showMessage = !this.showMessage;
      this.message = "message was reset";
    }
  }
};
</script>

<style>
p {
  color: black;
}
</style>
