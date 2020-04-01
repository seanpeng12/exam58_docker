<template>
  <div class="q-pa-md">
    <!-- <img
      alt="Quasar logo"
      src="~assets/Logo.png"
      style="height: 40px; max-width: 60px"
    /> -->
    <q-carousel
      v-model="slide"
      transition-prev="scale"
      transition-next="scale"
      swipeable
      animated
      infinite
      control-color="dark"
      navigation
      padding
      arrows
      height="580px"
      class="bg-white text-dark  "
    >
      <q-carousel-slide name="style" class="column no-wrap flex-center">
        <q-icon name="style" size="56px" />
        <div class="q-mt-md text-center color">
          SightSeeing您的旅遊小幫手
        </div>
      </q-carousel-slide>
      <q-carousel-slide name="tv" class="column no-wrap flex-center">
        <q-icon name="live_tv" size="56px" />
        <div class="q-mt-md text-center color">需求分析</div>
      </q-carousel-slide>
      <q-carousel-slide name="school" class="column no-wrap flex-center">
        <q-icon name="school" size="56px" />
        <div class="q-mt-md text-center color">路徑分析</div>
      </q-carousel-slide>
      <q-carousel-slide name="time" class="column no-wrap flex-center">
        <q-icon name="snooze" size="56px" />
        <div class="q-mt-md text-center color">優缺點分析</div>
      </q-carousel-slide>
    </q-carousel>

    <!-- <q-carousel-slide
        :name="page.p"
        class="text-center"
        v-for="page in pages"
        :key="page.p"
      >
        <q-scroll-area class="fit">
          <div class="q-pb-md color">
            <br />
            <br />
            <img
              class="row"
              src="~assets/time.png"
              style="height: 90px; max-width: 100px"
            />
            {{ page.content }}
          </div>
        </q-scroll-area>
      </q-carousel-slide> -->
    <!-- </q-carousel> -->
  </div>
</template>

<script>
export default {
  name: "PageIndex",

  data() {
    return {
      slide: "style",
      pages: [
        {
          p: 1,
          content: "SightSeeing為您節省規劃旅程的時間下一頁為您介紹本系統功能",
          img: "~assets/time.png"
        },
        {
          p: 2,
          content: "SightSeeing-您的旅遊小幫手2",
          img: "~assets/time.png"
        }
      ]
    };
  },

  watch: {
    vertical(val) {
      this.navPos = val === true ? "right" : "bottom";
    }
  }
};
</script>
