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
        <q-card-section>
          <div class="text-h6">
            <b>使用說明</b>
          </div>
        </q-card-section>

        <q-item-label header style="color:#57a5ba">
          <q-icon
            name="assignment_turned_in"
            style="color:#57a5ba"
            size="20px"
          /><b>目的</b></q-item-label
        >
        <q-item dense>
          <q-item-section avatar> </q-item-section>
          <q-item-section>
            為您找出景點綜合評論，讓您不用花大把時間在網路上爬文
          </q-item-section>
        </q-item>

        <q-item-label header style="color:#57a5ba"
          ><q-icon name="help" style="color:#57a5ba" size="20px" /><b
            >使用說明</b
          ></q-item-label
        >
        <q-item dense>
          <q-item-section avatar> </q-item-section>
          <q-item-section>
            <p>Step1. 選擇您所要到達的城市</p>
            <p>Step2. 選擇您想知道評論的景點</p>
            <p>Step3. 按下分析鈕</p>
            <p>Step4.左下為景點的優缺點綜合評論</p>
            <p>Step5. 右下為分析圖</p>
            <p>Step6. 喜歡的話，一鍵加入排程</p>
          </q-item-section>
        </q-item>
        <q-item-label header style="color:#57a5ba"
          ><q-icon name="multiline_chart" style="color:#57a5ba" size="20px" /><b
            >分析圖式說明</b
          ></q-item-label
        >
        <q-item dense>
          <q-item-section avatar> </q-item-section>
          <q-item-section>
            <q-slider color="teal" :step="0" />
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
