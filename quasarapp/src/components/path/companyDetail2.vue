<template>
  <q-card class="my-card" style="width:500px">
    <q-img src="https://cdn.quasar.dev/img/chicken-salad.jpg" />

    <q-card-section>
      <div class="row no-wrap items-center">
        <div class="col text-h6 ellipsis">
          <!-- {{ selected_site_2 }} -->
          {{ siteGoogleDetail.site_name }}
        </div>
      </div>

      <q-rating v-model="siteGoogleDetail.rating" :max="5" size="25px" />
      <span class="q-pa-sm  text-grey">{{ siteGoogleDetail.rating }}</span>
    </q-card-section>

    <q-card-section class="q-pt-none">
      <div class="text-subtitle1">
        <!-- {{ SiteGoogleDetail.id }} -->
      </div>

      <div class="text-h8 text-grey">
        <q-chip>
          <q-avatar
            flat
            size="30px"
            icon="fas fa-map-marked-alt"
            color="red"
            text-color="white"
          />
          {{ siteGoogleDetail.address }}
        </q-chip>
      </div>
      <div class="text-h8 text-grey">
        <q-chip>
          <q-avatar icon="fas fa-phone-square" color="red" text-color="white" />
          {{ siteGoogleDetail.phone_number }}
        </q-chip>
        <!-- <q-icon name="" />電話: -->
      </div>
    </q-card-section>

    <q-separator />

    <q-card-actions>
      <q-btn flat round icon="event" />
      <q-btn flat color="primary">
        Reserve
      </q-btn>
    </q-card-actions>
  </q-card>
</template>
<script>
import { mapGetters } from "vuex";
export default {
  props: ["siteGoogleDetail"],
  data() {
    return {};
  },
  computed: {
    ...mapGetters("path", [
      "selected_site_2",
      "selected_site_3"
      // "siteGoogleDetails"
    ])
  },
  watch: {}
};
</script>
<style lang="sass" scoped>
.my-card
  width: 100%
  max-width: 300px
</style>
