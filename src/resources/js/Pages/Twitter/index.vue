<script setup lang="ts">
import AppLayout from "@/Layouts/AppLayout.vue";
import ProfileEdit from "./ProfileEdit.vue";
import TabList from "./Tab/TabList.vue";
import TweetList from "./Tab/TweetList.vue";
import Icon from "@/Common/Icon.vue";
import JetButton from "@/Jetstream/Button";
import { Link } from "@inertiajs/inertia-vue3";
import route from "../../../../vendor/tightenco/ziggy/src/js";
import TimeLine from "./Tab/TimeLine.vue";
import LikeList from "./Tab/LikeList.vue";

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

type CurrentUser = {
  id: number;
  account_name: string;
  body: string;
  profile_image: string;
};

const props = defineProps<{
  current_user: CurrentUser;
  posts: Post[];
}>();

const labels = [
  { label: "ツイート", id: "tweets" },
  { label: "ツイートと返信", id: "comments" },
  { label: "いいね", id: "likes" },
  { label: "タイムライン", id: "timelines" },
];
</script>

<template>
  <app-layout title="Twitter">
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Twitter Top
      </h2>
    </template>

    <div class="p-8 max-w-7xl mr-auto ml-auto">
      <div class="flex items-center justify-between">
        <Icon class="w-24 h-24" :src="current_user.profile_image" />
        <profile-edit :currentUser="current_user">
          プロフィールを編集
        </profile-edit>
      </div>

      <div class="py-4">
        <h1>
          <strong>{{ current_user.account_name }}</strong>
        </h1>
        <p>{{ current_user.body }}</p>
      </div>

      <div class="pb-4">
        <Link :href="route('twitter.create')">
          <jet-button class="bg-[#3296CE] hover:bg-blue-400 text-base"
            >ツイートへ</jet-button
          >
        </Link>
      </div>

      <TabList :labels="labels">
        <template #tweets>
          <TweetList :currentUser="current_user" :posts="posts" />
        </template>
        <template #comments> ツイートとコメント </template>
        <template #likes>
          <LikeList :currentUser="current_user" :posts="posts" />
        </template>
        <template #timelines>
          <TimeLine :currentUser="current_user" :posts="posts" />
        </template>
      </TabList>
    </div>
  </app-layout>
</template>
