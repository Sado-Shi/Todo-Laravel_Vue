<template>
    <img
      :src="src"
      class="rounded-full"
    />
</template>

<script setup lang="ts">
const props = defineProps<{
  src: string;
}>();
</script>
