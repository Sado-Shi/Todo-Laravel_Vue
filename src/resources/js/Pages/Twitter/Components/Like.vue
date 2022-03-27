<script setup lang="ts">
import likeIcon from "@iconify-icons/wpf/like";
import { Icon as Iconify } from "@iconify/vue";

import route from "../../../../../vendor/tightenco/ziggy/src/js";

import { Inertia } from "@inertiajs/inertia";

type Post = {
  id: number;
  user_id: number;
  text: string;
  count: number;
  is_liked: number;
  user: {
    account_name: string;
    profile_image: String;
  };
};

const props = defineProps<{
  post: Post;
}>();

function activeLike(id: number): void {
  Inertia.post(route("twitter.like", id), undefined, {
    preserveScroll: true,
  });
}

function activeUnLike(id: number): void {
  Inertia.delete(route("twitter.unlike", id), {
    preserveScroll: true,
  });
}
</script>

<template>
  <button
    v-if="post.is_liked"
    :key="post.id"
    :class="{ 'text-red-600 text-2xl ml-3 ': post.is_liked }"
  >
    <Iconify @click="activeUnLike(post.id)" :icon="likeIcon" />
  </button>
  <button v-else class="text-2xl ml-3 text-[#c0c4cc]">
    <Iconify @click="activeLike(post.id)" :icon="likeIcon" :key="post.id" />
  </button>
</template>
