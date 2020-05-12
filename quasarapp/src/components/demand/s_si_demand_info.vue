<template>
  <div>
    <q-btn
      class=""
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
            為您找出你喜愛類型的景點
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
            <p>Step2. 選擇兩種你有興趣的類型</p>
            <p>Step3. 按下分析鈕</p>
            <p>Step4. 左下為分析圖</p>
            <p>
              Step5.
              右下為分析圖裡的景點，依序分為包含同時擁有兩類型的景點、單一類型的景點
            </p>
            <p>Step6. 喜歡的話，一鍵加入您的景點收藏(登入才能使用)</p>
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
            <div class="row">
              <div class="col">
                <q-icon name="fas fa-circle" color="primary"
                  ><span style="color:black; margin-left:10px">
                    表示景點</span
                  ></q-icon
                >
              </div>
              <div class="col">
                <q-icon name="fas fa-square" color="red-6" style="margin:5px"
                  ><span style="color:black;margin-left:10px">
                    表示景點類型</span
                  ></q-icon
                >
              </div>
            </div>
            <br />
            <div class="row">
              <span style=""
                >1.
                <q-icon
                  name="fas fa-circle"
                  color="primary"
                  class="q-mx-xs"
                />(景點)與<q-icon
                  name="fas fa-square"
                  color="red-6"
                  class="q-mx-xs"
                />(景點類型) 連成線，表示該景點的類型屬於<q-icon
                  name="fas fa-square"
                  color="red-6"
                  class="q-mx-xs"
                />(類型)</span
              >
              <br />
            </div>
            <div class="row">
              <span style=""
                >2. 如果<q-icon
                  name="fas fa-circle"
                  color="primary"
                  class="q-mx-xs"
                />(景點) 與兩個<q-icon
                  name="fas fa-square"
                  color="red-6"
                  class="q-mx-xs"
                />(類型) 相連，表示該景點同時擁有2種類型</span
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
