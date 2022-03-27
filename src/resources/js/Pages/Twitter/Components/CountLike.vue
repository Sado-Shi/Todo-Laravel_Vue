<script setup lang="ts">
import { Link } from "@inertiajs/inertia-vue3";
import route from "../../../../../vendor/tightenco/ziggy/src/js";

const props = defineProps<{
  post: {
    id: number;
    text: string;
  };
  likes: {
    id: number;
    user_id: number;
    post_id: number;
  }[];
}>();
</script>

<template>
  <Link :href="route('twitter.likes', post.id)">
    <button class="ml-2">
      <strong>{{ likes.length }}</strong> いいね
    </button>
  </Link>
</template>
