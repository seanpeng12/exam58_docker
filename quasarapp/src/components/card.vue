<template>
  <!-- 4 -->
  <q-card class="my-card" clickable>
    <q-img clickable src="https://cdn.wallpapersafari.com/42/36/AXMbe3.jpg" />

    <q-card-section>
      <q-btn
        fab
        color="primary"
        icon="touch_app"
        class="absolute"
        style="top: 0; right: 12px; transform: translateY(-50%);"
      />
      <div class="row no-wrap items-center">
        <div class="col text-h6 ellipsis">{{ post.name }}</div>
        <div class="col-auto text-grey text-caption q-pt-md row no-wrap items-center">
          <q-icon name="place" />250 ft
        </div>
      </div>

      <div class="row no-wrap items-center">
        <q-rating size="18px" v-model="stars" :max="5" color="primary" />
        <span class="text-caption text-grey q-ml-sm">{{post.rate}} (551)</span>
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
          <div class="text-subtitle1">{{post.address}}</div>
          <div class="text-caption text-grey">{{post.city_name}}</div>
          <div class="text caption">參考網站：{{post.href}}</div>
        </q-card-section>
      </div>
    </q-slide-transition>
  </q-card>
</template>

<script>
export default {
  props: ["post", "rate"],
  data() {
    return {
      stars: this.rate,
      expanded: false
    };
  },
  watch: {
    data(val) {
      this.rate = val + "em";
    }
  }
};
</script>

<style lang="sass" scoped>
.my-card
  width: 100%
  max-width: 280px
</style>
