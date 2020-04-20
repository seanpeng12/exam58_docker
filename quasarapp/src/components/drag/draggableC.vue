<template>
  <div class="text-black">
    <q-btn
      push
      dense
      color="warning"
      icon="add"
      @click="addDay()"
      label=""
      class="absolute-top-right"
      style="margin-right:4px"
      flat
    />

    <q-btn
      push
      dense
      color="warning"
      icon="remove"
      @click="deleteDay"
      label=""
      class="absolute-top"
      style="margin-left:140px"
      flat
    />

    <div class="col-4">
      <!-- <p class="weekday"></p> -->
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
        :move="checkMove"
        @start="dragging = true"
        @end="(dragging = false), storeEverydaySites()"
        group="site"
        :options="{ group: { pull: true, put: true }, animation: 20 }"
      >
        <!-- <q-btn
          color="black"
          v-for="(site, key) in siteGroup"
          :key="key"
          :label="site"
          style="margin-bottom: 3px; margin-left:4px; margin-top:3px"
          unelevated
        /> -->

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
        <!-- 刪除提醒 -->

        <!-- 刪除提醒 end -->
      </draggable>
    </div>
  </div>
</template>
<script>
import draggable from "vuedraggable";
import { mapGetters, mapActions } from "vuex";
var moment = require("moment");
export default {
  props: ["date", "dateKey", "index", "id"],
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
    add: function() {
      this.list.push({ name: "Juan " + id, id: id++ });
    },
    replace: function() {
      this.list = [{ name: "Edgard", id: id++ }];
    },
    checkMove: function(e) {
      // window.console.log("Future index: " + e.draggedContext.futureIndex);
    },
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
      this.$store.dispatch("travel/fbDeleteEveryday", {
        scheduleId: this.id,
        id: moment(this.date).format("YYYY-MM-DD")
      });
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
