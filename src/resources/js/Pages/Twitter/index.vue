<template>
  <app-layout title="Twitter">
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Twitter Top
      </h2>
    </template>

    <div class="p-8 max-w-7xl mr-auto ml-auto">
      <div class="flex items-center justify-between">
        <Icon class="w-24 h-24" :src="user.profile_image" />
        <profile-edit type="button"> プロフィールを編集 </profile-edit>
      </div>

      <div class="py-4">
        <h1>
          <strong>{{ user.account_name }}</strong>
        </h1>
        <p>{{ user.body }}</p>
      </div>

      <div class="pb-4">
        <Link :href="route('twitter.create')">
          <jet-button class="bg-[#3296CE] hover:bg-blue-400 text-base"
            >ツイートへ</jet-button
          >
        </Link>
      </div>

      <TabList :labels="labels" :posts="posts" :user="user">
        <!-- // TODO ここに各コンテンツを入れて渡す-->
        <template #tweets> <TweetList :user="user" :posts="posts" /> </template>
        <template #comments> bbbb </template>
        <template #likes> ccc </template>
        <template #timelines> ddd </template>
      </TabList>
    </div>
  </app-layout>
</template>

<script setup lang="ts">
import AppLayout from "@/Layouts/AppLayout.vue";
import ProfileEdit from "@/Common/ProfileEdit.vue";
import TabList from "./TabList.vue";
import TweetList from "./TweetList.vue";
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

const labels = [
  { label: "ツイート", id: "tweets" },
  { label: "ツイートと返信", id: "comments" },
  { label: "いいね", id: "likes" },
  { label: "タイムライン", id: "timelines" },
];
</script>
