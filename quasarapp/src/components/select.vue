<template>
  <!-- 下拉式選單 -->
<div class="q-pa-md">
  <div class="q-gutter-md row">
    <q-select
      filled
      v-model="selected_p"
      v-on:change="onProductChange"
      use-input
      hide-selected
      fill-input
      input-debounce="0"
      :options="Object.values(citys).map(city => city.city_name)"
      @filter="filterFn"
      hint="請選擇城市"
      style="width: 250px; padding-bottom: 32px"
    >
      <template v-slot:no-option>
        <q-item>
          <q-item-section class="text-grey">沒有結果</q-item-section>
        </q-item>
      </template>
    </q-select>
  </div>
</div>

</template>

<script>
export default {
  props: ["citys"],
  data(){
    return{
      citys = this.citys
    };
  },
}
</script>>
