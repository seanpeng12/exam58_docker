<template>
  <q-layout view="hHh lpR fFf">
    <q-header
      class="bg-dark
 text-white"
      elevated
    >
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

        <!-- <q-item to="/class" exact clickable>
          <q-item-section>
            <q-item-label>首頁2</q-item-label>
          </q-item-section>
        </q-item> -->

        <q-btn
          v-if="!loggedIn"
          to="/PageAuth"
          color="amber"
          icon-right="account_circle"
          label="Email登入"
        />
        <q-btn
          v-if="!loggedIn"
          @click="loginWithGoogle"
          color="negative"
          icon-right="account_circle"
          label="Google帳號登入"
          style="margin-left: 20px"
        />
        <q-btn
          v-else
          flat
          @click="logoutUser"
          color="amber"
          icon-right="account_circle"
          label="LogOut"
        />

        <!--  -->
        <!-- <q-tabs
          v-for="nav in navs"
          v-model="tab"
          inline-label
          class="bg-dark
 text-white "
          :key="nav"
        >
          <q-tab :label="nav.label" :to="nav.link" /> -->
        <!-- <q-tab label="test" link="/" /> -->

        <!-- <q-tab name="mails" label="自我旅程規劃" />
          <q-tab name="alarms" label="登入" />
          <q-tab name="s" label="登出" /> -->

        <!-- <q-btn-dropdown auto-close stretch flat label="個人頁面">
            <q-list>
              <q-item clickable @click="tab = 'movies'">
                <q-item-section>我的景點收藏</q-item-section>
              </q-item>

              <q-item clickable @click="tab = 'photos'">
                <q-item-section>我的旅程收藏</q-item-section>
              </q-item>
            </q-list>
          </q-btn-dropdown> -->
        <!-- </q-tabs> -->
      </q-toolbar>
    </q-header>

    <!-- <q-drawer
      v-model="leftDrawerOpen"
      show-if-above
      bordered
      content-class="bg-grey-1"
    >
      <q-list>
        <q-item-label header class="text-grey-8">Essential Links</q-item-label>
        <EssentialLink
          v-for="link in essentialLinks"
          :key="link.title"
          v-bind="link"
        />
      </q-list>
    </q-drawer> -->

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
          link: "/"
        },
        {
          color: false,
          label: "我的旅程表",
          icon: "list",
          link: "/mySchedule"
        },
        {
          color: false,
          label: "自我規劃旅程",
          icon: "chat",
          link: "/arrange-schedule"
        }
        // {
        //   color: false,
        //   label: "登入",
        //   icon: "record_voice_over",
        //   link: "https://forum.quasar.dev"
        // }
      ]
    };
  },
  computed: {
    ...mapState("auth", ["loggedIn"])
  },
  methods: {
    ...mapActions("auth", ["logoutUser"]),
    ...mapActions("auth", ["loginWithGoogle"])
  }
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
