<template>
  <q-layout view="hHh lpR fFf">
    <q-header class="bg-dark text-white" elevated>
      <q-toolbar>
        <q-toolbar-title class="title">
          <!-- <img
            alt="Quasar logo"
            src="~assets/Logo.png"
            style="height: 40px; max-width: 60px"
          /> -->

          SightSeeing</q-toolbar-title
        >
        <q-item
          exact
          clickable
          v-for="nav in navs"
          v-model="navs"
          :to="nav.link"
          :key="nav.label"
        >
          <q-item-section>
            <q-item-label class="">{{ nav.label }}</q-item-label>
          </q-item-section>
        </q-item>
        <q-item exact clickable to="/arrange-schedule">
          <q-item-section>
            <q-item-label class="">建立旅程表</q-item-label>
          </q-item-section>
        </q-item>

        <q-btn
          v-if="!loggedIn"
          to="/PageAuth"
          color="amber"
          icon-right="account_circle"
          label="Email註冊&登入"
        />
        <q-btn
          v-if="!loggedIn"
          @click="loginWithGoogle"
          color="negative"
          icon-right="account_circle"
          label="Google帳號登入"
          style="margin-left: 20px;"
        />

        <q-btn-dropdown v-if="loggedIn" flat label="會員功能">
          <q-list>
            <q-item clickable v-close-popup @click="onItemClick">
              <q-item-section>
                <q-item-label>我的收藏景點</q-item-label>
              </q-item-section>
            </q-item>

            <q-item
              clickable
              v-close-popup
              @click="onItemClick"
              to="/mySchedule"
            >
              <q-item-section>
                <q-item-label>我的旅程表</q-item-label>
              </q-item-section>
            </q-item>
          </q-list>
        </q-btn-dropdown>
        <q-btn
          v-if="loggedIn"
          flat
          @click="logoutUser"
          color="amber"
          icon-right="account_circle"
          label="LogOut"
        />
      </q-toolbar>
    </q-header>

    <q-page-container>
      <router-view />
    </q-page-container>
  </q-layout>
</template>

<script>
// import EssentialLink from "components/EssentialLink";
import { mapState, mapActions } from "vuex";
export default {
  prop: ["text"],
  name: "MainLayout",

  // components: {
  //   EssentialLink
  // },

  data() {
    return {
      tab: "",
      leftDrawerOpen: false,
      navs: [
        {
          color: false,
          label: "Home",
          icon: "school",
          link: "/",
        },

        // {
        //   color: false,
        //   label: "建立旅程",
        //   icon: "chat",
        //   link: "/arrange-schedule"
        // }
        // {
        //   color: false,
        //   label: "登入",
        //   icon: "record_voice_over",
        //   link: "https://forum.quasar.dev"
        // }
      ],
    };
  },
  computed: {
    ...mapState("auth", ["loggedIn"]),
  },
  methods: {
    ...mapActions("auth", ["logoutUser"]),
    ...mapActions("auth", ["loginWithGoogle"]),
    onItemClick() {},
  },
};
</script>
<style lang="scss">
.color {
  color: brown;
  font-size: 45px;
}
.my-card {
  width: 100%;
  max-width: 350px;
}
.title {
  font-family: cursive;
}
</style>
