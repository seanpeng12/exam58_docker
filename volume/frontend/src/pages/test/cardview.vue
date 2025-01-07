<template>
  <div class="row section-card q-ma-sm">
      <div class="col-12 q-pa-sm" ><b class="title">本月最精選</b></div>
      <template  v-for="post in posts">
        <div class="col-lg-3 col-sm-6 col-xs-12" :key="post.id">
          <Lcard :post="post" :src="src"></Lcard>
        </div>
      </template>
      <div class="q-pa-lg">
        <b>顯示getSiteData取得的sitedata資料</b>
        <div v-for="(a,key) in getSiteData" :key="key">
          <p>{{a.name}} {{ key }}</p>
          <q-btn @click="updateTask({ id:key,updates:{ completed:!getSiteData.completed }})">確定</q-btn>
          <q-btn @click="fetchPosts()">取得資料</q-btn>
        </div>

      </div>
  </div>
</template>
<script>
import { mapGetters } from 'vuex'
import { mapActions } from 'vuex'
export default {
  computed:{
    ...mapGetters('sitedata',['getSiteData']),
    // 取得posts 與 post
    ...mapGetters('sitedata',['posts']),
    ...mapGetters('sitedata',['post']),

    // ...mapActions('sitedata',['fetchPosts']),
  },
  data() {
    return {
      src:{ go :"https://www.travellingaround.org/wp-content/uploads/2015/06/brooklyn-bridge-768668_960_720-500x500.jpg"},
    };
  },
  components: {
    Lcard: require("components/test/Lcard.vue").default
  },

  methods: {
    // init: function() {
    //   let self = this;
    //   this.$axios
    //     .get("http://127.0.0.1:80/api/site_data")
    //     .then(function(response) {
    //       self.posts = response.data;
    //       console.log("成功接到值");
    //     })
    //     .catch(function(response) {
    //       console.log(response);
    //     });
    // },
    ...mapActions('sitedata',['updateTask']),
    // 執行axios注入資料(posts)
    ...mapActions('sitedata',['fetchPosts']),
  },

  mounted: function() {
    // 載入時跑vuex action -> fetchPosts()
    this.fetchPosts();
  }
}
</script>
<style lang="stylus">
  .section-card
    margin-right 5%
    margin-left 5%

  .title
    font-size 24px

  .q-card-title
    font-size 16px
    line-height 24px

  .q-card-media
    max-height 200px
</style>
