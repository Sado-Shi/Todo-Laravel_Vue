<template>
  <div>
    <img
      :src="src"
      class="w-24 h-24 rounded-full"
    />
  </div>
</template>

<script setup lang="ts">
const props = defineProps<{
  src: string;
}>();
</script>
