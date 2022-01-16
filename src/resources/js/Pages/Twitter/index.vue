<template>
  <app-layout title="Twitter">
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Twitter Top
      </h2>
    </template>
    <div>
      <Link :href="route('twitter.create')">
        <jet-button class="bg-blue-300 hover:bg-blue-400 text-base"
          >ツイートへ</jet-button
        >
      </Link>
    </div>
  </app-layout>
</template>

<script setup lang="ts">
import AppLayout from "@/Layouts/AppLayout.vue";
import JetButton from "@/Jetstream/Button";
import { Link } from '@inertiajs/inertia-vue3'

const props = defineProps<{
  users: Object;
}>();
</script>
