<template>
  <q-layout view="hHh lpR fFf">
    <q-header
      class="bg-dark
 text-white"
      elevated
    >
      <q-toolbar>
        <q-toolbar-title>
          <!-- <img
            alt="Quasar logo"
            src="~assets/Logo.png"
            style="height: 40px; max-width: 60px"
          /> -->

          SightSeeing</q-toolbar-title
        >
        <q-btn
          v-for="nav in navs"
          v-model="navs"
          :label="nav.label"
          :to="nav.link"
          :key="nav.label"
          style="background: dark; color: white"
        />
        <q-btn
          v-if="!loggedIn"
          to="/PageAuth"
          flat
          color="amber"
          icon-right="account_circle"
          label="LogIn with Google"
        />
        <q-btn
          v-else
          @click="logoutUser"
          flat
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
          label: "home",
          icon: "school",
          link: "/"
        },
        {
          color: false,
          label: "個人頁面",
          icon: "list",
          link: "/class"
        },
        {
          color: false,
          label: "自我規劃旅程",
          icon: "chat",
          link: "https://chat.quasar.dev"
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
    ...mapActions("auth", ["logoutUser"])
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
</style>
