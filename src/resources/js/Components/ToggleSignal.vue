<template>
  <div class="flex items-center justify-center w-full mb-12">
    <label for="toggle-signal" class="flex items-center cursor-pointer">
      <div class="relative">
        <input type="checkbox" id="toggle-signal" class="sr-only" v-model="value" />
        <div
          class="block bg-zinc-400 w-14 h-8 rounded-full"
          :class="{ 'bg-sky-500': value }"
        ></div>
        <div
          class="dot absolute left-1 top-1 bg-white w-6 h-6 rounded-full transition"
        ></div>
      </div>
    </label>
  </div>
</template>

<script setup lang="ts">
import { ref } from "vue";

const value = ref(false);

// emits: ['update:checked']

// const props = defineProps<{
//     checked: {
//         type: [Array, Boolean],
//         default: false,
//     },
//     value: {
//         default: null,
//     },
// }>();

// computed: {
//     proxyChecked: {
//         get() {
//             return this.checked;
//         },

//         set(val) {
//             this.$emit("update:checked", val);
//         },
//     },
// },
</script>

<style scoped>
input:checked ~ .dot {
  transform: translateX(100%);
  background-color: #ffffff;
}
</style>
