<template>
  <q-page>
    <!-- navbar start -->
    <div class="q-pa-md q-gutter-y-sm">
      <div class="bg-orange text-white">
        <q-toolbar>
          <q-btn flat round dense icon="menu" class="q-mr-sm" />
          <q-space />
        </q-toolbar>
        <q-toolbar inset>
          <q-toolbar-title>
            <strong>我的收藏</strong> favorite
          </q-toolbar-title>
        </q-toolbar>
      </div>

      <div class="bg-cyan text-white">
        <q-toolbar inset>
          <q-breadcrumbs active-color="white" style="font-size: 16px">
            <q-breadcrumbs-el label="首頁" icon="home" />
            <q-breadcrumbs-el label="我的收藏" icon="widgets" />
          </q-breadcrumbs>
        </q-toolbar>
      </div>
    </div>
    <!-- navbar end -->

    <!-- 印出card -->
    <div class="q-pa-md row items-start q-gutter-md">
      <sitecard v-for="post in posts" :key="post.id" :post="post" :rate="post.rate"></sitecard>
    </div>
    <q-page-sticky position="bottom-right" :offset="[18, 18]">
      <q-fab
        color="teal-4"
        text-color="white"
        position="bottom-right"
        icon="keyboard_arrow_left"
        direction="left"
      >
        <q-fab-action color="amber" text-color="black" @click="onClick" icon="mail" label="聯絡我們" />
        <q-fab-action
          color="amber"
          to="/"
          text-color="black"
          @click="onClick"
          icon="home"
          label="回到首頁"
        />
      </q-fab>
    </q-page-sticky>
  </q-page>
</template>

<script>
export default {
  data() {
    return {
      posts: [],
      post: {
        id: "",
        name: "",
        city_name: "",
        address: "",
        type: "",
        comment: null,
        rate: 0,
        href: "",
        color: "",
        shape: ""
      }
    };
  },
  components: {
    sitecard: require("components/card.vue").default
  },
  methods: {
    init: function() {
      let self = this;
      this.$axios
        .get("http://127.0.0.1:80/api/site_data")
        .then(function(response) {
          self.posts = response.data;
          console.log("成功");
        })
        .catch(function(response) {
          console.log(response);
        });
    }
  },

  mounted: function() {
    this.init();
  }
};
</script>

<style>
</style>
