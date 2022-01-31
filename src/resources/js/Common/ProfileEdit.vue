<template>
  <div>
    <button
      :type="type"
      class="px-2 py-1 itext-gray-800 bg-white border border-gray-300 shadow-sm hover:text-gray-600 rounded-full"
    >
      <span class="text-sm font-bold text-blue-400 mx-3 my-1"><slot></slot></span>
    </button>
  </div>
</template>

<script setup lang="ts">
const props = defineProps<{
  type: "button" | "submit" | "reset" | undefined;
}>();
</script>

<style scoped>

</style>
