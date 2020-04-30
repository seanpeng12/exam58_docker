<template>
  <div>
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
    <div class="row" style="background-color:#a9c9c6">
      <p class="q-ma-md text-h5 text-white" style="font-weight: bold; font-family:NSimSun;">您可使用快速搜尋，找到您收藏的景點或旅館資訊</p>
    </div>
    <div class="row" style="margin-left :auto;margin-right :auto">
      <LCard
        v-for="(item, key) in collections"
        :key="key"
        :collection="item"
        :index="key"
        style="margin-right: 8px; "
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
