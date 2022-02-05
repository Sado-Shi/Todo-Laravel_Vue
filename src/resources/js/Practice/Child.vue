<template>
  <h1>Child</h1>
  <div>
    <div class="flex" v-for="item in itemList" :key="item.name">
      <p>{{ item.name }}</p>
      <p>{{ item.price }}円</p>
      <button class="border-black" @click="addItemToCart(item)">追加</button>
    </div>
  </div>
</template>
<script lang="ts" setup>
import { useCartStore } from "@/store/store";
import { Item } from "@/models/item.model";
import { ref } from "vue";

const {addItemToCart} = useCartStore();

const itemList = ref<Item[]>([
  {
    name: "りんご",
    price: 100
  },
  {
    name: "バナナ",
    price: 50
  }
])
</script>
