<template>
  <q-layout view="lHh Lpr lFf" class="layout-font">
    <q-header elevated>
      <q-toolbar color="primary" text-color="pink-13" inverted>
        <q-toolbar-title>
          SIGHTSEEING
          <div slot="subtitle">SIGHTSEEING</div>
        </q-toolbar-title>

        <div class="gt-xs">
          <q-btn to="/" flat class="q-mr-md">首頁</q-btn>
          <q-btn to="/settings" flat class="q-mr-md">分析GO</q-btn>
          <q-btn to="/cardV" flat class="q-mr-md">我的收藏</q-btn>
          <q-btn to="/sql" flat class="q-mr-md">POST</q-btn>
          <q-btn flat class="q-mr-md">登入</q-btn>
          <q-btn flat class="q-mr-md">註冊</q-btn>
        </div>
        <!-- sm（768px）phone mode -->
        <div class="lt-sm">
          <q-btn icon="menu" flat @click="rightDrawerOpen = !rightDrawerOpen" />
        </div>
      </q-toolbar>
      <!--  -->
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
  }
};
</script>

<style>
.layout-font {
  font-family: Microsoft JhengHei;
  font-family: monospace;
}
</style>
