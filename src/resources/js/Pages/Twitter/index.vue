<template>
  <app-layout title="Twitter">
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Twitter Top
      </h2>
    </template>

    <div>
      <h1>アカウント名</h1>
      <p>{{ user.account_name }}</p>
      <h2>自己紹介</h2>
      <p>{{ user.body }}</p>
    </div>

    <div>
      <Link :href="route('twitter.create')">
        <jet-button class="bg-blue-300 hover:bg-blue-400 text-base"
          >ツイートへ</jet-button
        >
      </Link>
    </div>

    <div>
      <h2>ツイート一覧</h2>

      <ul>
        <li v-for="post in posts" :key="post.id">
          {{ post.text }}

          <Link :href="route('twitter.edit', post.id)">
            <button>詳細</button>
          </Link>

          <button @click="deleteTweet(post.id)">削除</button>
        </li>
      </ul>
    </div>
  </app-layout>
</template>

<script setup lang="ts">
import { Inertia } from "@inertiajs/inertia";
import AppLayout from "@/Layouts/AppLayout.vue";
import JetButton from "@/Jetstream/Button";
import { Link } from "@inertiajs/inertia-vue3";
import route from "../../../../vendor/tightenco/ziggy/src/js";

const props = defineProps<{
  user: {
    id: number;
    account_name: string;
    body: string;
  };
  posts: {
    id: number;
    text: string;
  };
}>();

function deleteTweet(id): void {
  Inertia.delete(route("twitter.destroy", id), {
    preserveScroll: true,
  });
}
</script>
