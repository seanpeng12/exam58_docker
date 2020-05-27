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
            <div class="row">
              <div class="col-3 q-ml-md">
                <q-icon name="fas fa-circle" style="color: #ffcc33"
                  ><span style="color:black; margin-left:2px">
                    起點</span
                  ></q-icon
                >
              </div>
              <div class="col-5">
                <q-icon name="fas fa-circle" style="margin:4px;color:#699c4c"
                  ><span style="color:black;margin-left:2px">
                    路線順序第二的景點</span
                  ></q-icon
                >
              </div>
              <div class="col">
                <q-icon name="fas fa-circle" style="margin:4px;color:#0066cc"
                  ><span style="color:black;margin-left:2px">
                    路線順序第三的景點</span
                  ></q-icon
                >
              </div>
            </div>
            <br />
            <div class="row">
              <span style="margin-left:10px"
                >1.<q-icon
                  name="fas fa-circle"
                  style="color: #ffcc33"
                  class="q-mx-xs"
                />(起點)與<q-icon
                  name="fas fa-circle"
                  style="color:#699c4c"
                  class="q-mx-xs"
                />(第二景點)的連線表示，其他使用者在去過起始點後會前往的景點，<span
                  style="font-weight:bold"
                  >線條越粗</span
                >表示越多人有同樣的安排
              </span>
              <br />
            </div>
            <div class="row">
              <span style="margin-left:10px"
                >2. 以此類推，當選定<q-icon
                  name="fas fa-circle"
                  style="color:#699c4c"
                  class="q-mx-xs"
                />(第二個景點)，那麼<q-icon
                  name="fas fa-circle"
                  style="color:#0066cc"
                  class="q-mx-xs"
                />為<q-icon
                  name="fas fa-circle"
                  style="color:#699c4c"
                  class="q-mx-xs"
                />的下一個景點(第三個景點)</span
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
