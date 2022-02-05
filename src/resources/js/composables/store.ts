import { ref } from "vue";
import { defineStore } from "pinia";
import { generateFakeData, Item } from "@/models/item.model";

export const useCartStore = defineStore("cart", () => {
  // state
  const cart = ref<Item[]>([]);

  // getters
  const getCartItems = () => cart.value;

  const getTotalFee = () =>
    cart.value.reduce((sum, item) => sum + item.price, 0);

  // setters
  const addItemToCart = (item: Item) => cart.value.push(item);

  return {
    getCartItems,
    getTotalFee,
    addItemToCart,
  };
});
