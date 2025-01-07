<template>
  <div class="text-black">
    <div class="row">
      <div class="col-2"></div>
      <div class="col">
        <q-btn
          push
          dense
          round
          color="light-blue-9"
          icon="add"
          @click="addDay()"
          class="absolute-top-right q-mr-sm q-mt-sm q-mb-xs"
          size="10px"
        />
      </div>
      <div class="col">
        <q-btn
          push
          round
          dense
          color="light-blue-9"
          icon="remove"
          @click="deleteDay()"
          class="absolute-top-right q-mr-xl q-mt-sm q-mb-xs"
          style=""
          size="10px"
        />
      </div>
    </div>

    <div class="col-4">
      <q-chip
        outline
        color="primary"
        text-color="white"
        icon="event"
        size="1.1rem"
      >
        {{ date }}
        &emsp;&emsp;&emsp;&emsp;&emsp;
      </q-chip>
      <draggable
        v-model="siteGroup"
        :disabled="!enabled"
        class="list-group "
        ghost-class="ghost"
        @start="dragging = true"
        @end="(dragging = false), storeEverydaySites()"
        group="site"
        :options="{ group: { pull: true, put: true }, animation: 20 }"
      >
        <q-item
          bordered
          dense
          v-ripple
          v-for="(site, key) in siteGroup"
          :key="key"
        >
          <q-item-section side style="margin-left:0px">
            <q-btn flat dense color="black" icon="drag_handle" />
          </q-item-section>
          <q-item-section>
            <q-item-label lines="5">{{ site }}</q-item-label>
            <!-- <q-item-label caption>February 22nd, 2019</q-item-label> -->
          </q-item-section>

          <q-item-section side>
            <q-btn
              flat
              dense
              round
              color="red"
              icon="delete"
              @click="promptToDelete({ site: site, date: date })"
            />
          </q-item-section>
        </q-item>
      </draggable>
    </div>
  </div>
</template>
<script>
import draggable from "vuedraggable";
import { mapGetters, mapActions } from "vuex";
var moment = require("moment");
export default {
  props: ["date", "dateKey", "index", "id", "startDate"],
  data() {
    return {
      enabled: true
    };
  },
  components: {
    draggable
  },
  computed: {
    ...mapGetters("travel", ["everydaySites"]),
    siteGroup: {
      get() {
        var date = this.date;
        return this.everydaySites[date];
      },
      set(value) {
        // 修改state
        // this.$store.commit("travel/setDragGroup", {
        //   value,
        //   key: this.date
        // });
        // 存進資料庫
        this.$store.dispatch("travel/fbUpdateEverySiteData", {
          value,
          key: this.date,
          id: this.id
        });
        // console.log("value:", value, " key: ", this.date);
      }
    }
  },
  methods: {
    ...mapActions("travel", ["storeEverydaySites", "deleteEveryDaySite"]),
    // 增加日期
    addDay() {
      console.log(
        "addDay",
        moment(this.date)
          .add(1, "d")
          .format("YYYY-MM-DD")
      );
      this.$store.dispatch("travel/fbAddEverySiteDay", {
        scheduleId: this.id,
        id: moment(this.date)
          .add(1, "d")
          .format("YYYY-MM-DD"),
        everyday: []
      });
    },
    deleteDay() {
      if (this.date == this.startDate) {
        this.$q.dialog({
          title: "此操作無法執行",
          message: "排程表中至少要有一天",

          persistent: true
        });
      } else {
        this.$q
          .dialog({
            title: this.date + "這天將被刪除",
            message: "刪除本天，您所納進的景點也會跟著一並刪除唷!",
            cancel: true,
            persistent: true
          })
          .onOk(() => {
            this.$store.dispatch("travel/fbDeleteEveryday", {
              scheduleId: this.id,
              id: moment(this.date).format("YYYY-MM-DD")
            });
          });
      }

      //
    },
    promptToDelete(value) {
      this.$q
        .dialog({
          title: "Confirm",
          message: "確定要刪除嗎?",
          cancel: true,
          persistent: true
        })
        .onOk(() => {
          this.$store.dispatch("travel/deleteEveryDaySite", {
            value,
            id: this.id
          });
          // this.deleteEveryDaySite(value);
        });
    }
  }
};
</script>
