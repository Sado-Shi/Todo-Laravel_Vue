<script setup lang="ts">
import { ref } from "vue";
import AppLayout from "@/Layouts/AppLayout.vue";
import Result from "./Result.vue";
import APIcall from "./APIcall.vue";

let items = ref([]);
let loadProgress = false;

function onLoadStart() {
  loadProgress = true;
}

function onLoadComplete(results) {
  items.value = results;
  loadProgress = false;
  console.log(results);
}
</script>

<template>
  <app-layout title="Practice">
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Practice Top
      </h2>
    </template>

    <div>
      <APIcall @loadStart="onLoadStart" @loadComplete="onLoadComplete" />
      <Result :items="items" :loadProgress="loadProgress" />
    </div>
  </app-layout>
</template>
