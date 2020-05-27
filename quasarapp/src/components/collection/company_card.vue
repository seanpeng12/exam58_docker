<template>
  <q-card class="my-card" style="width:400px">
    <q-img style="height:180px" :src="company_collection.img" />

    <q-card-section>
      <div class="row no-wrap items-center">
        <div class="col text-h6 ellipsis" style="font-weight:bold">
          <!-- {{ selected_site_2 }} -->
          {{ company_collection.site_name }}
        </div>
      </div>

      <q-rating
        v-model="company_collection.rating"
        :max="5"
        size="25px"
        color="yellow-8"
      />
      <span class="q-pa-sm  text-grey">{{ company_collection.rating }}</span>
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
          {{ company_collection.address }}
        </q-chip>
      </div>
      <div class="text-h8 text-grey">
        <q-chip>
          <q-avatar icon="fas fa-phone-square" color="red" text-color="white" />
          {{ company_collection.phone_number }}
        </q-chip>
        <!-- <q-icon name="" />電話: -->
      </div>
    </q-card-section>

    <!-- <q-separator /> -->

    <q-card-actions>
      <q-space />
      <slot name="deleteCollection"></slot>
    </q-card-actions>
  </q-card>
</template>
<script>
import { mapGetters, mapActions } from "vuex";
export default {
  props: ["company_collection", "index"],
  data() {
    return {};
  },
  computed: {},
  methods: {},
  watch: {}
};
</script>
<style lang="sass" scoped>
.my-card
  width: 100%
  max-width: 300px
</style>
