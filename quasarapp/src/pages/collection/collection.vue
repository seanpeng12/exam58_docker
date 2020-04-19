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
          <q-input
            v-model="search"
            filled
            type="search"
            placeholder="輸入城市/景點 或是想去的地方"
            bg-color="white"
            style="size: 50px"
          >
            <template v-slot:append>
              <q-icon name="search" />
            </template>
          </q-input>
        </div>
      </q-carousel-slide>
      <!-- <q-carousel-slide
        :name="2"
        img-src="https://cdn.quasar.dev/img/parallax1.jpg"
      />
      <q-carousel-slide
        :name="3"
        img-src="https://cdn.quasar.dev/img/parallax2.jpg"
      /> -->
    </q-carousel>
    <div>
      <q-card class="my-card" v-for="item in collections" :key="item.site_name">
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
            <div class="col text-h6 ellipsis">
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
          <!-- <div class="text-caption text-grey">
            3621人瀏覽
          </div> -->
        </q-card-section>

        <q-separator />
      </q-card>
    </div>
  </div>
</template>

<script>
import { mapGetters } from "vuex";
export default {
  data() {
    return {
      slide: 1,
      stars: 3.5,
      search: ""
    };
  },
  computed: {
    ...mapGetters("collections", ["collections"])
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
