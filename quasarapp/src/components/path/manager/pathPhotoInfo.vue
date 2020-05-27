<template>
  <div>
    <q-btn
      class="q-ma-md"
      dense
      icon="help"
      label="點我說明"
      color="negative"
      size="10px"
      @click="sliders = true"
    />
    <q-dialog v-model="sliders">
      <q-card style="width:500px" class="q-px-sm q-pb-md">
        <q-item-label header style="color:#57a5ba"
          ><q-icon name="multiline_chart" style="color:#57a5ba" size="20px" /><b
            >分析圖式說明</b
          ></q-item-label
        >
        <q-item dense>
          <q-item-section>
            <!-- <div class="row"> -->
            <div class="row q-ml-md" style="margin-left:22px">
              <q-icon name="fas fa-circle" style="margin:4px;color: #ffcc33"
                >:
                <span style="color:black; margin-left:2px">
                  您的商家</span
                ></q-icon
              >
            </div>
            <div class="row" style="margin-left:75px">
              <q-icon name="fas fa-circle" style="margin:4px;color:#699c4c"
                >:
                <span style="color:black;">
                  去過<q-icon
                    name="fas fa-circle"
                    style="margin:4px;color: #ffcc33"
                  />後會再去的旅遊點</span
                ></q-icon
              >
            </div>
            <div class="row" style="margin-left:76px">
              <q-icon name="fas fa-circle" style="margin:4px;color:#0066cc"
                >:
                <span style="color:black;margin-left:2px">
                  去過<q-icon
                    name="fas fa-circle"
                    style="margin:4px;color:#699c4c"
                  />會繼續去的旅遊點</span
                ></q-icon
              >
            </div>
            <!-- </div> -->
            <br />
            <div class="row">
              <span style="margin-left:10px"
                >1.<q-icon
                  name="fas fa-circle"
                  style="color: #ffcc33"
                  class="q-mx-xs"
                />(您的商家)與<q-icon
                  name="fas fa-circle"
                  style="color:#699c4c"
                  class="q-mx-xs"
                />(第二景點)的連線表示，其他旅客在去完您的商家後的下個前往旅遊底，<span
                  style="font-weight:bold"
                  >線條越粗</span
                >表示越多旅客有同樣的安排，您可以和考慮那個商家做合作，創造出雙贏的結果！
              </span>
              <br />
            </div>
            <div class="row">
              <span style="margin-left:10px"
                >2. 以此類推，當選定<q-icon
                  name="fas fa-circle"
                  style="color:#699c4c"
                  class="q-mx-xs"
                />(旅客去完您的商店的下個旅遊點)，那麼<q-icon
                  name="fas fa-circle"
                  style="color:#0066cc"
                  class="q-mx-xs"
                />為<q-icon
                  name="fas fa-circle"
                  style="color:#699c4c"
                  class="q-mx-xs"
                />的下一個景點(第三個景點)，您可以再和此商家合作。</span
              >
            </div>
          </q-item-section>
        </q-item>
      </q-card>
    </q-dialog>
  </div>
</template>
<script>
export default {
  data() {
    return {
      sliders: false
    };
  }
};
</script>
