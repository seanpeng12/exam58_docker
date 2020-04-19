<template>
  <!-- <div class="col"> -->
  <!-- <q-card class="my-card" v-for="item in collections" :key="item.site_name"> -->
  <q-card class="my-card">
    <q-img src="https://cdn.quasar.dev/img/chicken-salad.jpg" />

    <q-card-section>
      <!-- <q-btn
            fab
            color="primary"
            icon="place"
            class="absolute"
            style="top: 0; right: 12px; transform: translateY(-50%);"
          /> -->

      <div class="row no-wrap items-center">
        <div class="col text-h8 ellipsis">
          {{ collection.site_name }}
        </div>
        <div
          class="col-auto text-secondary text-caption q-pt-md row no-wrap items-center"
        >
          <q-icon name="place" />

          台灣，{{ collection.city }}
        </div>
      </div>

      <div class="row text-caption text-grey">
        <q-rating v-model="stars" :max="5" size="25px" />
        <div class="col" style="margin-top:5px">
          {{ collection.rate }}
        </div>
        <div
          class="text-caption text-grey"
          style="margin-top:5px; margin:left:10px"
        >
          {{ collection.comment }}則評價
        </div>
      </div>
    </q-card-section>

    <q-card-section class="q-pt-none">
      <div class="ttext-caption text-grey">{{ collection.address }}</div>
      <!-- <div class="text-caption text-grey">
            3621人瀏覽
          </div> -->
    </q-card-section>

    <q-separator />
  </q-card>
  <!-- </div> -->
</template>
<script>
export default {
  props: ["collection"],
  data() {
    return {
      stars: 3.5
    };
  }
};
</script>
