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
          <!-- <q-item-section avatar></q-item-section> -->
          <q-item-section>
            <div class="row ">
              <q-chip icon="bookmark" style="font-weight:bold">優點</q-chip>
            </div>
            <div class="row q-mt-md">
              1. 評論被提到頻率:
              <div class="col q-ml-xl">
                <q-icon name="fas fa-circle" style="margin:5px;color:green"
                  ><span style="color:black; "> 曾被提及 </span></q-icon
                >
              </div>
              <div class="col q-ml-md">
                <q-icon name="fas fa-circle" style="color:#33FF66"
                  ><span style="color:black; margin-left:5px">
                    最常被提及
                  </span></q-icon
                >
              </div>
              <div class="col q-ml-md">
                <q-icon name="fas fa-circle" style="margin:5px;color:#33FFCC"
                  ><span style="color:black;margin-left:5px">
                    經常被提及
                  </span></q-icon
                >
              </div>
            </div>
            <div class="row">
              2.
              <q-icon name="fas fa-circle" class="q-ml-xs q-mr-xs"></q-icon
              >(圓點)間的相連表示容易被同時提到
            </div>
            <div class="row q-mt-md">
              <q-chip
                icon="bookmark"
                color="blue-grey-6"
                text-color="white"
                style="font-weight:bold"
                >缺點</q-chip
              >
            </div>

            <div class="row q-mt-md">
              1. 評論被提到次數為:
              <div class="col q-ml-xl">
                <q-icon name="fas fa-circle" style="color:#E6B7BE"
                  ><span style="color:black; "> 曾被提及</span></q-icon
                >
              </div>
              <div class="col q-ml-md">
                <q-icon name="fas fa-circle" style="color:#C42A56"
                  ><span style="color:black; margin-left:5px">
                    最常被提及</span
                  ></q-icon
                >
              </div>
              <div class="col q-ml-md">
                <q-icon name="fas fa-circle" style="margin:5px;color:#D6727C"
                  ><span style="color:black;margin-left:5px">
                    經常被提及</span
                  ></q-icon
                >
              </div>
            </div>
            <div class="row">
              2.
              <q-icon name="fas fa-circle" class="q-ml-xs q-mr-xs"></q-icon
              >(圓點)間的相連表示容易被同時提到
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
