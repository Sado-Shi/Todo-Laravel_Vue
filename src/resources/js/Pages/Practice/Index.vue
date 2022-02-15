<template>
  <app-layout title="Practice">
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Practice Top
      </h2>
    </template>

    <Desktop1 />

    <Toggle v-model="isPractice" />

    <ToggleSignal />

    <Checkbox></Checkbox>
  </app-layout>
</template>

<script setup lang="ts">
import Desktop1 from "@/Components/Desktop1.vue";
import Toggle from "@/Components/Toggle.vue";
import ToggleSignal from "@/Components/ToggleSignal.vue";
import Checkbox from "@/Components/Checkbox.vue";

import { ref } from "vue";
import AppLayout from "@/Layouts/AppLayout.vue";

const isPractice = ref(false);

console.log(isPractice.value);
</script>
