<template>
  <app-layout title="Twitter">
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Twitter Top
      </h2>
    </template>

    <div class="p-8 max-w-7xl mr-auto ml-auto">
      <div class="flex items-center justify-between">
        <Icon :src="user.profile_image" />
        <profile-edit type="button"> プロフィールを編集 </profile-edit>
      </div>

      <div class="py-4">
        <h1><strong>{{ user.account_name }}</strong></h1>
        <p>{{ user.body }}</p>
      </div>

      <div>
        <Link :href="route('twitter.create')">
          <jet-button class="bg-blue-300 hover:bg-blue-400 text-base"
            >ツイートへ</jet-button
          >
        </Link>
      </div>

      <div class="py-4">
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
    </div>
  </app-layout>
</template>

<script setup lang="ts">
import { Inertia } from "@inertiajs/inertia";
import AppLayout from "@/Layouts/AppLayout.vue";
import ProfileEdit from "@/Common/ProfileEdit.vue";
import Icon from "@/Common/Icon.vue";
import JetButton from "@/Jetstream/Button";
import { Link } from "@inertiajs/inertia-vue3";
import route from "../../../../vendor/tightenco/ziggy/src/js";

type Post = {
  id: number;
  text: string;
};

const props = defineProps<{
  user: {
    id: number;
    account_name: string;
    body: string;
    profile_image: string;
  };
  posts: Post[];
}>();

function deleteTweet(id: number): void {
  Inertia.delete(route("twitter.destroy", id), {
    preserveScroll: true,
  });
}
</script>

<style scoped></style>
