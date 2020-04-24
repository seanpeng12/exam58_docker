<template>
  <div class="">
    <q-carousel
      v-model="slide"
      color="white"
      infinite
      arrows
      autoplay
      height="400px"
    >
      <q-carousel-slide
        :name="1"
        img-src="https://global-uploads.webflow.com/576fd5a8f192527e50a4b95c/5bfe550d9464455edc331bee_Thaproban%20Beach%20House-min.jpg"
      >
        <div class="absolute-center custom-caption">
          <div class="text-h2" style="font-weight: bold;font-family:NSimSun">
            我的口袋名單
          </div>
          <div class="text-h5" style="font-weight: bold; font-family:cursive">
            My Collection
          </div>
          <br /><br /><br /><br />
          <search />
        </div>
      </q-carousel-slide>
    </q-carousel>
    <div class="row">
      <LCard
        v-for="(item, key) in collections"
        :key="key"
        :collection="item"
        :index="key"
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
            style="font-family: NSimSun; margin-left:40px"
          />
        </template>
      </LCard>
    </div>
    <!-- <div class="row">
      <q-card class="my-card" v-for="item in collections" :key="item.site_name">
        <q-img src="https://cdn.quasar.dev/img/chicken-salad.jpg" />

        <q-card-section>
          <div class="row no-wrap items-center">
            <div class="col text-h8 ellipsis">
              {{ item.site_name }}
            </div>
            <div
              class="col-auto text-secondary text-caption q-pt-md row no-wrap items-center"
            >
              <q-icon name="place" />

              台灣，{{ item.city }}
            </div>
          </div>

          <div class="row text-caption text-grey">
            <q-rating v-model="stars" :max="5" size="25px" />
            <div class="col" style="margin-top:5px">
              {{ item.rate }}
            </div>
            <div
              class="text-caption text-grey"
              style="margin-top:5px; margin:left:10px"
            >
              {{ item.comment }}則評價
            </div>
          </div>
        </q-card-section>

        <q-card-section class="q-pt-none">
          <div class="ttext-caption text-grey">{{ item.address }}</div>
        </q-card-section>

        <q-separator />
      </q-card>
    </div> -->
  </div>
</template>

<script>
import { mapGetters, mapState, mapActions } from "vuex";
export default {
  data() {
    return {
      slide: 1
      // stars: 3.5
      // search: ""
    };
  },
  computed: {
    ...mapGetters("collections", ["collections"]),
    ...mapState("collections", ["search"])
  },
  components: {
    search: () => import("components/search.vue"),
    LCard: () => import("components/collection/LCard.vue")
  },
  methods: {
    ...mapActions("collections", ["fbDeleteCollection"]),
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
    }
  }
};
</script>
<style lang="stylus">
.custom-caption {
  text-align: center;
  padding: 12px;
  color: white;
  font-weight :bold

  }
  .my-card {
    width: 80%;
    max-width: 300px
    margin: 20px
  }
</style>
