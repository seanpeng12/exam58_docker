<template>
  <div>
    <q-carousel v-model="slide" color="white" infinite arrows autoplay height="200px">
      <q-carousel-slide
        :name="1"
        img-src="https://global-uploads.webflow.com/576fd5a8f192527e50a4b95c/5bfe550d9464455edc331bee_Thaproban%20Beach%20House-min.jpg"
      >
        <div class="absolute-center custom-caption" style="margin-top:25px">
          <div class="text-h3" style="font-weight: bold;font-family:NSimSun">我的口袋名單</div>
          <div class="text-h5" style="font-weight: bold; font-family:cursive">My Collection</div>
          <br />
          <!-- <br />
          <br />
          <br />-->
        </div>
      </q-carousel-slide>
    </q-carousel>
    <div class="row" style="background-color:#a9c9c6">
      <p
        class="q-ma-md text-h5 text-white"
        style="font-weight: bold; font-family:NSimSun;"
      >您可使用快速搜尋，找到您收藏的景點與飯店資訊</p>
      <search />

      <q-tabs v-model="tab" class="text-black">
        <q-tab name="site" icon="local_car_wash" label="景點收藏" />
        <q-tab name="hotel" icon="hot_tub" label="飯店收藏" />
      </q-tabs>
    </div>
    <div class="row" v-if="tab == 'site'">
      <LCard
        v-for="(item, key) in collections"
        :key="key"
        :collection="item"
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
            size="10px"
            color="red"
            @click="promptToDelete(key)"
            style="font-family: NSimSun; margin-left:60px"
          />
        </template>
      </LCard>
    </div>
    <div class="row" v-else>
      <hCard
        v-for="(item, key) in h_collections"
        :key="key"
        :h_collection="item"
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
            size="10px"
            color="red"
            @click="h_promptToDelete(key)"
            style="font-family: NSimSun; margin-left:60px"
          />
        </template>
      </hCard>
    </div>

    <!--  -->

    <!--  -->
  </div>
</template>

<script>
import { mapGetters, mapState, mapActions } from "vuex";
export default {
  data() {
    return {
      slide: 1,
      tab: "site"
      // stars: 3.5
      // search: ""
    };
  },
  computed: {
    ...mapGetters("collections", ["collections", "h_collections"]),
    ...mapState("collections", ["search"])
  },
  components: {
    search: () => import("components/search.vue"),
    LCard: () => import("components/collection/LCard.vue"),
    hCard: () => import("components/collection/h_card.vue")
  },
  methods: {
    ...mapActions("collections", [
      "fbDeleteCollection",
      "h_fbDeleteCollection"
    ]),
    promptToDelete(value) {
      this.$q
        .dialog({
          title: "Confirm",
          message: "確定要刪除嗎?",
          cancel: true,
          persistent: true
        })
        .onOk(() => {
          this.fbDeleteCollection(value);
        });
    },
    h_promptToDelete(value) {
      this.$q
        .dialog({
          title: "Confirm",
          message: "確定要刪除嗎?",
          cancel: true,
          persistent: true
        })
        .onOk(() => {
          this.h_fbDeleteCollection(value);
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
