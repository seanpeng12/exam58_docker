<template>
  <q-page padding>
    <div class="row">
      <q-card class="my-card">
        <q-img src="~assets/IMG_3593.jpg">
          <div class="absolute-bottom">
            <div class="text-h7" style="font-weight:bold;">我的花蓮之旅</div>
          </div>
        </q-img>

        <q-card-actions>
          <q-btn
            to="/arrange-schedule"
            flat
            class="text-overline text-pink-9;"
            style="font-family:NSimSun; font-size:14px"
          >
            進入編輯</q-btn
          >
          <q-btn
            flat
            class="text-overline text-orange-9"
            style="font-family:NSimSun; font-size:14px"
            >查看旅程</q-btn
          >
        </q-card-actions>
      </q-card>

      <q-card class="my-card">
        <q-img src="~assets/IMG_3593.jpg">
          <div class="absolute-bottom">
            <div class="text-h6">Our Changing Planet</div>
            <div class="text-subtitle2">by John Doe</div>
          </div>
        </q-img>

        <q-card-actions>
          <q-btn flat>Action 1</q-btn>
          <q-btn flat>Action 2</q-btn>
        </q-card-actions>
      </q-card>
      <q-card class="my-card">
        <q-img src="~assets/IMG_3593.jpg">
          <div class="absolute-bottom">
            <div class="text-h6">Our Changing Planet</div>
            <div class="text-subtitle2">by John Doe</div>
          </div>
        </q-img>

        <q-card-actions>
          <q-btn flat>Action 1</q-btn>
          <q-btn flat>Action 2</q-btn>
        </q-card-actions>
      </q-card>

      <q-card class="my-card">
        <q-img src="~assets/IMG_3593.jpg">
          <div class="absolute-bottom">
            <div class="text-h6">Our Changing Planet</div>
            <div class="text-subtitle2">by John Doe</div>
          </div>
        </q-img>

        <q-card-actions>
          <q-btn flat>Action 1</q-btn>
          <q-btn flat>Action 2</q-btn>
        </q-card-actions>
      </q-card>

      <q-card class="my-card">
        <q-img src="~assets/IMG_3593.jpg">
          <div class="absolute-bottom">
            <div class="text-h6">Our Changing Planet</div>
            <div class="text-subtitle2">by John Doe</div>
          </div>
        </q-img>

        <q-card-actions>
          <q-btn flat color="primary">Action 1</q-btn>
          <q-btn flat>Action 2</q-btn>
        </q-card-actions>
      </q-card>
    </div>
  </q-page>
</template>
<script>
// import task from "components/task.vue";
export default {
  data() {
    return {
      tab: "mails"
    };
  },
  components: {
    search: () => import("components/search.vue")
  }
};
</script>
<style lang="scss">
.my-card {
  width: 100%;
  max-width: 250px;
  margin: 20px;
  margin-left: 30px;
}
</style>
