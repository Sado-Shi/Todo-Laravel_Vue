<template>
  <div class="flex items-center justify-center w-full mb-12">
    <label for="toggle" class="flex items-center cursor-pointer">
      <div class="relative">
        <input
          type="checkbox"
          id="toggle"
          class="sr-only"
          :value="modelValue"
          @click="$emit('update:modelValue', $event.target.value)"
        />
        <div
          class="block bg-zinc-400 w-14 h-8 rounded-full"
          :class="{ 'bg-sky-500': modelValue }"
        ></div>
        <div
          class="dot absolute left-1 top-1 bg-white w-6 h-6 rounded-full transition"
        ></div>
      </div>
    </label>
  </div>
</template>

<script setup lang="ts">
const props = defineProps<{
  modelValue: {
    type: Boolean;
    default: false;
  };
}>();

const emit = defineEmits<{
  (e: "update:modelValue"): void;
}>();
</script>

<style scoped>
input:checked ~ .dot {
  transform: translateX(100%);
  background-color: #ffffff;
}
</style>
