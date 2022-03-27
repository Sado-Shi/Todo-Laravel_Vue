<script setup lang="ts">
import { computed } from "vue";

const props = defineProps<{
  post: {
    id: number;
    text: string;
    user_id: number;
  };
  likes: {
    id: number;
    user_id: number;
    post_id: number;
    user: {
      id: number;
      account_name: string;
      body: string;
      profile_image: string;
    };
  }[];
}>();
</script>

<template>
  <ul>
    <li v-for="likedUser in likes">
      {{ likedUser.user.account_name }}
    </li>
  </ul>
</template>
