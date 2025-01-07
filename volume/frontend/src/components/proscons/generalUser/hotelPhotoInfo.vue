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
        <q-item-label header style="color:#57a5ba"
          ><q-icon name="multiline_chart" style="color:#57a5ba" size="20px" /><b
            >分析圖示說明</b
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
                <q-icon name="fas fa-circle" style="margin:5px;color:#33FF66"
                  ><span style="color:black; "> 最常被提及 </span></q-icon
                >
              </div>
              <div class="col q-ml-md">
                <q-icon name="fas fa-circle" style="color:#33FFCC"
                  ><span style="color:black; margin-left:5px">
                    經常被提及
                  </span></q-icon
                >
              </div>
              <div class="col q-ml-md">
                <q-icon name="fas fa-circle" style="margin:5px;color:green"
                  ><span style="color:black;margin-left:5px">
                    曾被提及
                  </span></q-icon
                >
              </div>
            </div>
            <div class="row">
              2.
              <!-- <q-icon name="fas fa-circle" class="q-ml-xs q-mr-xs"></q-icon
              > -->
              圓點間的相連表示容易在評論中被同時提到
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
                <q-icon name="fas fa-circle" style="color:#C42A56"
                  ><span style="color:black; "> 最常被提及</span></q-icon
                >
              </div>
              <div class="col q-ml-md">
                <q-icon name="fas fa-circle" style="color:#D6727C"
                  ><span style="color:black; margin-left:5px">
                    經常被提及</span
                  ></q-icon
                >
              </div>
              <div class="col q-ml-md">
                <q-icon name="fas fa-circle" style="margin:5px;color:#E6B7BE"
                  ><span style="color:black;margin-left:5px">
                    曾被提及
                  </span></q-icon
                >
              </div>
            </div>
            <div class="row">
              2.
              <!-- <q-icon
                name="fas fa-circle"
                class="q-ml-xs q-mr-xs"
              /> -->
              圓點間的相連表示缺點有其相關性。
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
