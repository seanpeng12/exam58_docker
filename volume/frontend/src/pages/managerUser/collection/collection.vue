<template>
  <div>
    <q-carousel v-model="slide" color="white" infinite arrows autoplay height="200px">
      <q-carousel-slide :name="1" img-src="~assets/managerCollection.jpg">
        <div class="absolute-center custom-caption" style="margin-top:25px">
          <div class="text-h3" style="font-weight: bold;font-family:NSimSun">我的店家資訊收藏</div>
          <div class="text-h5" style="font-weight: bold; font-family:cursive">My Collection</div>

          <br />
          <!-- <br />
          <br />
          <br />-->
        </div>
      </q-carousel-slide>
    </q-carousel>
    <div class="row" style="background-color:#463470">
      <div class="col">
        <p
          class="q-ma-md text-h5 text-white"
          style="font-weight: bold; font-family:NSimSun;"
        >您可使用快速搜尋，找到您收藏店家資訊</p>
      </div>
      <div class="col-3 q-ma-xs">
        <search />
      </div>

      <!-- <q-tabs v-model="tab" class="text-black">
        <q-tab name="site" icon="fas fa-car-side" label="景點收藏" />
        <q-tab name="hotel" icon="fas fa-hotel" label="飯店收藏" />
      </q-tabs>-->
    </div>
    <div class="row">
      <companyCard
        v-for="(item, key) in company_collections"
        :key="key"
        :company_collection="item"
        :index="key"
        style="margin-right: 4px;"
      >
        <template slot="deleteCollection">
          <q-btn
            no-caps
            flat
            dense
            label="刪除收藏"
            icon-right="delete"
            size="14px"
            color="red"
            @click="promptToDelete(key)"
            style="font-family: NSimSun; margin-left:60px"
          />
        </template>
      </companyCard>
    </div>
  </div>
</template>

<script>
import { mapGetters, mapState, mapActions } from "vuex";
export default {
  data() {
    return {
      slide: 1
      // tab: "site"
      // stars: 3.5
      // search: ""
    };
  },
  computed: {
    ...mapGetters("collections", ["company_collections"]),
    ...mapState("collections", ["search"])
  },
  components: {
    search: () => import("components/search.vue"),
    companyCard: () => import("components/collection/company_card.vue")
  },
  methods: {
    ...mapActions("collections", [
      "company_fbReadData",
      "fbDeleteCompanyCollection"
    ]),
    promptToDelete(value) {
      this.$q
        .dialog({
          class: "title text-bold",
          title: "confirm",
          message: "確定要刪除嗎?",
          cancel: true,
          persistent: true
        })
        .onOk(() => {
          this.fbDeleteCompanyCollection(value);
        });
    }
  }
};
</script>
<style lang="stylus">
.custom-caption {
  text-align: center;
  padding: 12px;
  color: white;
  font-weight: bold;
}

.my-card {
  width: 80%;
  max-width: 300px;
  margin: 20px;
}
</style>
