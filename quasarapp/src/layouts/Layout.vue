<template>
  <q-layout view="lHh Lpr lFf">
    <q-header elevated>
      <q-toolbar>
        <q-btn
          flat
          dense
          round
          icon="menu"
          aria-label="Menu"
          @click="leftDrawerOpen = !leftDrawerOpen"
        />

        <q-toolbar-title>SIGHTSEEING 憩</q-toolbar-title>

        <div>Quasar v{{ $q.version }}</div>
      </q-toolbar>
    </q-header>
    <!-- qfooter -->
    <q-footer>
      <!-- tab section -->
      <q-tabs v-model="tab">
        <q-route-tab to="/" icon="star" label="首頁" />
        <q-route-tab to="/settings" icon="settings" label="Setting" />
        <q-route-tab to="/sql" icon="settings_remote" label="測試Post" />
        <q-route-tab to="/cardV" icon="book" label="測試Card" />
      </q-tabs>
      <!--  -->
    </q-footer>
    <!--  -->
    <!-- navbar(left) -->
    <q-drawer v-model="leftDrawerOpen" show-if-above bordered content-class="bg-grey-2">
      <q-item-label header class="text-grey-8">SIGHTSEEING 導覽列</q-item-label>

      <q-item to="/" exact clickable>
        <q-item-section avatar>
          <q-icon name="star"></q-icon>
        </q-item-section>
        <q-item-section>
          <q-item-label>首頁</q-item-label>
        </q-item-section>
      </q-item>

      <q-item to="/settings" exact clickable>
        <q-item-section avatar>
          <q-icon name="settings"></q-icon>
        </q-item-section>
        <q-item-section>
          <q-item-label>Setting</q-item-label>
        </q-item-section>
      </q-item>

      <q-item to="/sql" exact clickable>
        <q-item-section avatar>
          <q-icon name="settings_remote"></q-icon>
        </q-item-section>
        <q-item-section>
          <q-item-label>測試post(testSQL.vue)</q-item-label>
        </q-item-section>
      </q-item>

      <q-item to="/cardV" exact clickable>
        <q-item-section avatar>
          <q-icon name="book"></q-icon>
        </q-item-section>
        <q-item-section>
          <q-item-label>測試Card(testCard.vue)</q-item-label>
        </q-item-section>
      </q-item>

      <!-- <q-list>
        <q-item-label header class="text-grey-8">SIGHTSEEING 導覽列</q-item-label>
        <EssentialLink v-for="link in essentialLinks" :key="link.title" v-bind="link" />
      </q-list>-->
    </q-drawer>

    <q-page-container>
      <router-view />
    </q-page-container>
  </q-layout>
</template>

<script>
import EssentialLink from "components/EssentialLink";

export default {
  name: "MainLayout",

  components: {
    EssentialLink
  },

  data() {
    return {
      leftDrawerOpen: false,
      essentialLinks: [
        {
          label: "備忘事項",
          icon: "list",
          to: "/settings"
        },
        {
          label: "備忘事項",
          icon: "list",
          to: "/settings"
        },
        {
          label: "備忘事項",
          icon: "list",
          to: "/settings"
        },
        {
          label: "備忘事項",
          icon: "list",
          to: "/settings"
        }
      ]
    };
  }
};
</script>

<style lang="stylus">
q-item {
  color: blue;
}
</style>
