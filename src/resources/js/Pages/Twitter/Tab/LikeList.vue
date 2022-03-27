<template>
  <ul>
    <li
      class="flex mb-8 first:pt-0 pt-8 border-t first:border-0"
      v-for="post in sortedByPosts"
    >
      <Icon class="w-16 h-16" :src="post.user.profile_image" />

      <div class="ml-4 w-full">
        <div class="flex justify-between">
          <div>
            <strong>{{ post.user.account_name }}</strong>
          </div>

          <div class="flex">
            <Link :href="route('twitter.edit', post.id)">
              <button class="flex items-center">
                <Iconify
                  v-if="post.user_id === currentUser.id"
                  icon="bx:bx-comment-detail"
                  color="#afafaf"
                  height="24"
                />
              </button>
            </Link>

            <button class="flex items-center ml-2">
              <Iconify
                v-if="post.user_id === currentUser.id"
                icon="fluent:delete-20-regular"
                color="#afafaf"
                height="24"
                @click="deleteTweet(post.id)"
              />
            </button>
          </div>
        </div>

        <div>
          <p>{{ post.text }}</p>
        </div>

        <!-- リプライ -->
        <button><Iconify class="text-2xl" :icon="commentIcon" /></button>
        <!-- リツイート -->
        <button class="ml-3">
          <Iconify class="text-2xl" :icon="retweetIcon" />
        </button>

        <Like :post="post" />

        <span class="ml-1">{{ post.count }}</span>
      </div>
    </li>
  </ul>
</template>

<script setup lang="ts">
import { Icon as Iconify } from "@iconify/vue";
import { Inertia } from "@inertiajs/inertia";
import Icon from "@/Common/Icon.vue";
import { Link } from "@inertiajs/inertia-vue3";
import route from "../../../../../vendor/tightenco/ziggy/src/js";

import commentIcon from "@iconify-icons/ei/comment";
import retweetIcon from "@iconify-icons/system-uicons/retweet";
import { computed } from "vue";
import Like from "../Components/Like.vue";

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
  currentUser: CurrentUser;
  posts: Post[];
}>();

function deleteTweet(id: number): void {
  if (confirm("削除してよろしいですか？")) {
    Inertia.delete(route("twitter.destroy", id), {
      preserveScroll: true,
    });
  }
}

const sortedByPosts = computed(() => {
  const likedPost = props.posts.filter((post) => post.is_liked === 1);
  return likedPost.sort((a, b) => {
    return b.id - a.id;
  });
});
</script>
