<template>
  <div class="q-pa-md doc-container text-center" style="max-width: 1500px">
    <div>
      {{this.txtinfo}}
      {{this.name}} {{this.c1}} {{this.c20}}
    </div>
    <q-form
      @submit="onSubmit"
      @reset="onReset"
      class="q-gutter-md"
    >
      <q-input
        filled
        v-model="name"
        label="輸入台北 *"
        hint="必填"
        lazy-rules
        :rules="[ val => val && val.length > 0 || 'Please type something']"
      />

      <q-input
        filled
        v-model="c1"
        label="博物館 *"
        hint="必填"
        lazy-rules
        :rules="[ val => val && val.length > 0 || 'Please type something']"
      />


      <q-input
        filled
        v-model="c20"
        label="特色博物館 *"
        hint="必填"
        lazy-rules
        :rules="[ val => val && val.length > 0 || 'Please type something']"
      />

      <q-toggle v-model="accept" label="I accept the license and terms" />
      <q-toggle v-model="accept" label="接收最新資訊與最新發展動向" />
      <div>
        <q-btn v-on:click="upload" label="Submit" type="submit" color="primary"/>
        <q-btn label="Reset" type="reset" color="primary" flat class="q-ml-sm" />
      </div>
    </q-form>

 <!-- iframe -->
    <div class="gt-xs  center">

        <iframe
          style="height: 602px;width:1000px"

          frameborder="0"
          id="myFrame"
          :src="src"
          class="frameStyle"
        ></iframe>



    </div>
     <!--  -->

  </div>


</template>
<script>

export default {

  data () {
    return {
      name: null,
      c1: null,
      c20: null,
      accept : false,
      txtinfo : "debug顯示區域：",
      src: "./statics/between_relationship.html",


      Rdata: {
        name: "",
        c1: "",
        c20: "",
      },
    }
  },

  methods: {
    onSubmit () {
      if (this.accept !== true) {
        this.$q.notify({
          color: 'red-5',
          textColor: 'white',
          icon: 'warning',
          message: '您需要先勾選政策條款'
        })
      }
      else {
        this.$q.notify({
          color: 'green-4',
          textColor: 'white',
          icon: 'cloud_done',
          message: '載入中...'
        }),
        txtinfo = ""
      }

    },

    onReset () {
      this.name = null
      this.c1 = null
      this.c20 = null
      this.accept = false
    },


    changeSrc(){
      document.getElementById("myFrame").contentWindow.location.reload(true);
      document.getElementById("myFrame").src="./statics/between_relationship.html";
      // this.src = "./statics/between_relationship.html";
      this.txtinfo = "載入完成!";
    },


    upload (){
      this.txtinfo = "載入中...";
      document.getElementById("myFrame").src="./statics/images/loader.gif";
      let self = this;
      this.$axios
      .post('http://127.0.0.1:80/api/runR_twoC', {
        name: this.name,
        c1: this.c1,
        c20: this.c20,
      })
      .then((response) =>{
          self.Rdata = response.data;
          this.changeSrc();
          // console.log("資料為：" + this.$refs.iframe);
          this.src = "./statics/between_relationship.html";
          console.log("成功!");
        })
        .catch(function (response) {
          console.log(response);
        });
    }
  }
}
</script>
<style>
.center {
text-align:center;
}
</style>


