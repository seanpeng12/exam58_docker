<template>
  <q-card class="my-card" style="width:100%">
    <q-img style="height:180px" :src="siteGoogleDetail.img" />

    <q-card-section>
      <div class="row no-wrap items-center">
        <div class="col text-h6 ellipsis" style="font-weight:bold">
          <!-- {{ selected_site_2 }} -->
          {{ siteGoogleDetail.site_name }}
        </div>
      </div>

      <q-rating
        v-model="siteGoogleDetail.rating"
        :max="5"
        size="25px"
        color="yellow-8"
      />
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
      <q-space />
      <q-btn
        :loading="loading2"
        icon="add"
        color="indigo-6"
        style="font-weight:bold"
        @click="
          simulateProgress(2),
            sitePathAddToCollection({
              id: id,
              site_name: siteGoogleDetail.site_name,
              phone_number: siteGoogleDetail.phone_number,
              address: siteGoogleDetail.address,
              rating: siteGoogleDetail.rating,
              img: siteGoogleDetail.img
            })
        "
      >
        加入商家資訊列表
        <template v-slot:loading>
          <q-icon name="check"></q-icon>已加入</template
        >
      </q-btn>
    </q-card-actions>
  </q-card>
</template>
<script>
import { mapGetters, mapActions } from "vuex";
export default {
  props: ["siteGoogleDetail", "id"],
  data() {
    return {
      loading2: false,
      progress: false
    };
  },
  computed: {
    ...mapGetters("path", [
      "selected_site_2",
      "selected_site_3"
      // "siteGoogleDetails"
    ])
  },
  methods: {
    simulateProgress(number) {
      // we set loading state
      this[`loading${number}`] = true;
      // simulate a delay
      // setTimeout(() => {
      //   // we're done, we reset loading state
      //   this[`loading${number}`] = false;
      // }, 300);
    },
    ...mapActions("collections", ["sitePathAddToCollection"])
    // addToCollection(value) {
    //   // this.sitePathAddToCollection(value);
    //   console.log("addToCollection:", value);
    // }
  },
  watch: {}
};
</script>
<style lang="sass" scoped>
.my-card
  width: 100%
  max-width: 300px
</style>
