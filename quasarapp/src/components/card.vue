<template>
  <card-site>
    <div class="q-pa-md row items-start q-gutter-md">
      <!-- 4 -->
      <q-card
        class="my-card"
        clickable
        v-for="{siteData, index} in site_datas"
        :key="site_datas.id"
      >
        <q-img clickable src="https://cdn.quasar.dev/img/chicken-salad.jpg" />

        <q-card-section>
          <q-btn
            fab
            color="primary"
            icon="touch_app"
            class="absolute"
            style="top: 0; right: 12px; transform: translateY(-50%);"
          />
          <div class="row no-wrap items-center">
            <div class="col text-h6 ellipsis">台北101</div>
            <div class="col-auto text-grey text-caption q-pt-md row no-wrap items-center">
              <q-icon name="place" />250 ft
            </div>
          </div>

          <div class="row no-wrap items-center">
            <q-rating size="18px" v-model="stars" :max="5" color="primary" />
            <span class="text-caption text-grey q-ml-sm">4.2 (551)</span>
          </div>
        </q-card-section>

        <q-separator />

        <q-card-actions align="left">
          <q-btn flat round color="red" icon="delete" />
          <q-btn flat color="teal" icon="bookmark" label="加入最愛" />

          <q-space />

          <q-btn
            color="grey"
            round
            flat
            dense
            :icon="expanded ? 'keyboard_arrow_up' : 'keyboard_arrow_down'"
            @click="expanded = !expanded"
          />
        </q-card-actions>

        <q-slide-transition>
          <div v-show="expanded">
            <q-separator />
            <q-card-section class="q-pt-none">
              <div class="text-subtitle1">TAIPEI 101 Club</div>
              <div class="text-caption text-grey">{{ site_info }}</div>
            </q-card-section>
            <q-card-section class="text-subitle2">文字</q-card-section>
          </div>
        </q-slide-transition>
      </q-card>
    </div>
  </card-site>
</template>

<script>
export default {
  data() {
    return {
      stars: 4,
      expanded: false,
      // site_info: "台北・景點與地標, 古蹟",
      site_datas: [
        {
          id: 0,
          site: "aaa232",
          site_info: "台北・景點與地標, 古蹟"
        },
        {
          id: 1,
          site: "bbb",
          site_info: "台北・景點與地標, 古蹟"
        },
        {
          id: 2,
          site: "ccc",
          site_info: "台北・景點與地標, 古蹟"
        },
        {
          id: 3,
          site: "cc4c",
          site_info: "台北・景點與地標, 古蹟"
        },
        {
          id: 4,
          site: "cc",
          site_info: "台北・景點與地標, 古蹟"
        }
      ]
    };
  }
};
</script>

<style lang="sass" scoped>
.my-card
  width: 100%
  max-width: 300px
</style>
