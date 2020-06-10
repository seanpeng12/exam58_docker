<template>
  <!-- 懶人包 -->
  <div class="q-pa-none doc-container">
    <!-- 標題 -->
    <div class="gt-xs q-pa-lg q-ma-sm column text-black bg-blue-grey-1" style="height: auto;">
      <div class="col">
        <div class="img_background">
          <div>
            <p style="font-size: 26px;font-weight:bold;font-family: Microsoft JhengHei;">
              {{ prosConsSelected_site }}的優點
              <slot name="addToSchedule"></slot>
              <slot name="text_ProsExplain"></slot>
              <!-- <q-chip>
                <q-avatar color="green-8" text-color="white" size="15px"></q-avatar>
                <span style="font-size: 15px;">
                  <b>顏色越深，好評中提及該關鍵字的人數越多</b>
                </span>
              </q-chip>-->
            </p>
            <div>
              <q-scroll-area
                style="height: 200px; max-width: auto;font-family: Microsoft JhengHei;"
              >
                <q-chip size="md" v-for="(a,index) in prosData.data" :key="a.id">
                  <div v-if="index == 0">
                    <q-avatar icon="fas fa-crown" color="green-8" text-color="yellow-4"></q-avatar>
                    <b>{{ a.segment }}</b>
                    <q-tooltip anchor="bottom middle" self="center middle">{{a.degree}}人給評</q-tooltip>
                  </div>
                  <div v-else-if="index == 1">
                    <q-avatar icon="fas fa-crown" color="green-8" text-color="yellow-2"></q-avatar>
                    <b>{{ a.segment }}</b>
                    <q-tooltip anchor="bottom middle" self="center middle">{{a.degree}}人給評</q-tooltip>
                  </div>
                  <div v-else-if="index == 2">
                    <q-avatar icon="fas fa-crown" color="green-8" text-color="yellow-1"></q-avatar>
                    <b>{{ a.segment }}</b>
                    <q-tooltip anchor="bottom middle" self="center middle">{{a.degree}}人給評</q-tooltip>
                  </div>

                  <div v-if="a.degree >= 30 && index != 0 && index != 1 && index != 2">
                    <q-avatar icon="thumb_up_alt" color="green-8" text-color="white"></q-avatar>
                    <b>{{ a.segment }}</b>
                    <q-tooltip anchor="bottom middle" self="center middle">{{a.degree}}人給評</q-tooltip>
                  </div>
                  <div
                    v-else-if="a.degree < 30 && a.degree >= 20 && index != 0 && index != 1 && index != 2"
                  >
                    <q-avatar icon="thumb_up_alt" color="green-7" text-color="white"></q-avatar>
                    <b>{{ a.segment }}</b>
                    <q-tooltip anchor="bottom middle" self="center middle">{{a.degree}}人給評</q-tooltip>
                  </div>
                  <div
                    v-else-if="a.degree < 20 && a.degree >= 10 && index != 0 && index != 1 && index != 2"
                  >
                    <q-avatar icon="thumb_up_alt" color="green-6" text-color="white"></q-avatar>
                    <b>{{ a.segment }}</b>
                    <q-tooltip anchor="bottom middle" self="center middle">{{a.degree}}人給評</q-tooltip>
                  </div>
                  <div
                    v-else-if="a.degree < 10 && a.degree >= 5 && index != 0 && index != 1 && index != 2"
                  >
                    <q-avatar icon="thumb_up_alt" color="green-5" text-color="white"></q-avatar>
                    {{ a.segment }}
                    <q-tooltip anchor="bottom middle" self="center middle">{{a.degree}}人給評</q-tooltip>
                  </div>
                  <div
                    v-else-if="a.degree < 5 && a.degree > 1 && index != 0 && index != 1 && index != 2"
                  >
                    <q-avatar icon="thumb_up_alt" color="green-4" text-color="white"></q-avatar>
                    {{ a.segment }}
                    <q-tooltip anchor="bottom middle" self="center middle">{{a.degree}}人給評</q-tooltip>
                  </div>
                  <div v-else-if="a.degree === 1 && index != 0 && index != 1 && index != 2">
                    <q-avatar icon="thumb_up_alt" color="green-3" text-color="white"></q-avatar>
                    {{ a.segment }}
                    <q-tooltip anchor="bottom middle" self="center middle">{{a.degree}}人給評</q-tooltip>
                  </div>
                </q-chip>
              </q-scroll-area>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="gt-xs q-pa-lg q-ma-sm column text-white bg-blue-grey-6" style="height: auto;">
      <div class="col">
        <div class="img_background">
          <div>
            <p style="font-size: 26px;font-weight:bold;font-family: Microsoft JhengHei;">
              {{ prosConsSelected_site }}的缺點
              <slot name="text_ConsExplain"></slot>
            </p>
            <div>
              <q-scroll-area
                style="height: 210px; max-width: auto;font-family: Microsoft JhengHei;"
              >
                <q-chip size="md" v-for="(a,index) in consData.data" :key="a.id">
                  <div v-if="index == 0">
                    <q-avatar icon="fas fa-frown" color="red-8" text-color="white"></q-avatar>
                    <b>{{ a.segment }}</b>
                    <q-tooltip anchor="bottom middle" self="center middle">{{a.degree}}人給評</q-tooltip>
                  </div>
                  <div v-else-if="index == 1">
                    <q-avatar icon="fas fa-frown" color="red-8" text-color="white"></q-avatar>
                    <b>{{ a.segment }}</b>
                    <q-tooltip anchor="bottom middle" self="center middle">{{a.degree}}人給評</q-tooltip>
                  </div>
                  <div v-else-if="index == 2">
                    <q-avatar icon="fas fa-frown" color="red-8" text-color="white"></q-avatar>
                    <b>{{ a.segment }}</b>
                    <q-tooltip anchor="bottom middle" self="center middle">{{a.degree}}人給評</q-tooltip>
                  </div>
                  <div v-if="a.degree >= 30 && index != 0 && index != 1 && index != 2">
                    <q-avatar icon="thumb_down_alt" color="red-8" text-color="white"></q-avatar>
                    <b>{{ a.segment }}</b>
                    <q-tooltip anchor="bottom middle" self="center middle">{{a.degree}}人給評</q-tooltip>
                  </div>
                  <div
                    v-else-if="a.degree < 30 && a.degree >= 20 && index != 0 && index != 1 && index != 2"
                  >
                    <q-avatar icon="thumb_down_alt" color="red-7" text-color="white"></q-avatar>
                    <b>{{ a.segment }}</b>
                    <q-tooltip anchor="bottom middle" self="center middle">{{a.degree}}人給評</q-tooltip>
                  </div>
                  <div
                    v-else-if="a.degree < 20 && a.degree >= 10 && index != 0 && index != 1 && index != 2"
                  >
                    <q-avatar icon="thumb_down_alt" color="red-6" text-color="white"></q-avatar>
                    <b>{{ a.segment }}</b>
                    <q-tooltip anchor="bottom middle" self="center middle">{{a.degree}}人給評</q-tooltip>
                  </div>
                  <div
                    v-else-if="a.degree < 10 && a.degree >= 5 && index != 0 && index != 1 && index != 2"
                  >
                    <q-avatar icon="thumb_down_alt" color="red-5" text-color="white"></q-avatar>
                    {{ a.segment }}
                    <q-tooltip anchor="bottom middle" self="center middle">{{a.degree}}人給評</q-tooltip>
                  </div>
                  <div
                    v-else-if="a.degree < 5 && a.degree > 1 && index != 0 && index != 1 && index != 2"
                  >
                    <q-avatar icon="thumb_down_alt" color="red-4" text-color="white"></q-avatar>
                    {{ a.segment }}
                    <q-tooltip anchor="bottom middle" self="center middle">{{a.degree}}人給評</q-tooltip>
                  </div>
                  <div v-else-if="a.degree === 1 && index != 0 && index != 1 && index != 2">
                    <q-avatar icon="thumb_down_alt" color="red-3" text-color="white"></q-avatar>
                    {{ a.segment }}
                    <q-tooltip anchor="bottom middle" self="center middle">{{a.degree}}人給評</q-tooltip>
                  </div>
                </q-chip>
              </q-scroll-area>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!--  -->
</template>

<script>
import { mapGetters } from "vuex";
import { mapActions } from "vuex";

export default {
  data() {
    return {
      tab: "mails"
    };
  },
  computed: {
    // 取得vuex state值
    ...mapGetters("proscons", [
      "run_index",
      "data_index",
      "prosData",
      "consData",
      "prosConsSelected_site"
    ])
  },
  methods: {},
  watch: {
    data_index(val) {
      console.log("偵測到data_index改變：取得val", val);
    }
  }
};
</script>
