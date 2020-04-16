<template>
  <q-layout view="hHh lpR fFf">
    <q-header class="bg-dark text-white" elevated>
      <q-toolbar>
        <q-toolbar-title class="title"> SIGHTSEEING</q-toolbar-title>
        <!-- gt-xs view -->
        <q-item class="gt-xs" exact clickable to="/">
          <q-item-section>
            <q-item-label class="">首頁</q-item-label>
          </q-item-section>
        </q-item>
        <q-item
          class="gt-xs"
          exact
          clickable
          to="/arrange-schedule"
          v-if="loggedIn"
        >
          <q-item-section>
            <q-item-label class="">建立旅程表</q-item-label>
          </q-item-section>
        </q-item>
        <div class="gt-xs">
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
              <q-item clickable v-close-popup @click="onItemClick" to="/Like">
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
        </div>

        <!-- end -->

        <!-- sm（768px）phone mode -->
        <div class="lt-sm">
          <q-btn icon="menu" flat @click="rightDrawerOpen = !rightDrawerOpen" />
        </div>
        <!-- end -->
      </q-toolbar>
    </q-header>

    <!-- q-drawer start -->
    <q-drawer
      v-model="rightDrawerOpen"
      :width="200"
      :breakpoint="500"
      bordered
      content-class="bg-grey-3"
    >
      <q-scroll-area class="fit">
        <q-list v-for="(menuItem, index) in menuList" :key="index">
          <q-item
            to="/"
            clickable
            :active="menuItem.label === 'Outbox'"
            v-ripple
            @click="rightDrawerOpen = !rightDrawerOpen"
          >
            <q-item-section avatar>
              <q-icon :name="menuItem.icon" />
            </q-item-section>
            <q-item-section>{{ menuItem.label }}</q-item-section>
          </q-item>

          <q-separator v-if="menuItem.separator" />
        </q-list>
      </q-scroll-area>
    </q-drawer>
    <!-- q-drawer end -->

    <!-- qfooter -->
    <q-footer>
      <!-- tab section -->
      <q-tabs class="lt-sm" v-model="tab">
        <q-route-tab to="/" icon="home" label="首頁" />
        <q-route-tab to="/settings" icon="settings" label="Setting" />
        <q-route-tab to="/sql" icon="settings_remote" label="測試Post" />
        <q-route-tab to="/cardV" icon="book" label="測試Card" />
      </q-tabs>
      <!--  -->
    </q-footer>
    <q-page-container>
      <router-view />
    </q-page-container>
  </q-layout>
</template>

<script>
import { mapState, mapActions } from "vuex";
const menuList = [
  {
    icon: "home",
    label: "首頁",
    to: "/",
    separator: true
  },
  {
    icon: "send",
    label: "Outbox",
    separator: false
  },
  {
    icon: "delete",
    label: "Trash",
    separator: false
  },
  {
    icon: "error",
    label: "Spam",
    separator: true
  },
  {
    icon: "settings",
    label: "Settings",
    separator: false
  },
  {
    icon: "feedback",
    label: "Send Feedback",
    separator: false
  },
  {
    icon: "help",
    iconColor: "primary",
    label: "Help",
    separator: false
  }
];
export default {
  name: "MainLayout",

  data() {
    return {
      tab: "mails",
      rightDrawerOpen: false,
      menuList
    };
  },
  computed: {
    ...mapState("auth", ["loggedIn"])
  },
  methods: {
    ...mapActions("auth", ["logoutUser"]),
    ...mapActions("auth", ["loginWithGoogle"]),
    onItemClick() {}
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
  font-family: Microsoft JhengHei;
}
</style>
