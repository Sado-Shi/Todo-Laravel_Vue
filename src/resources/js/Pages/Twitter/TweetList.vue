<template>
  <ul>
    <li class="flex mb-8" v-for="post in posts" :key="post.id">
      <Icon class="w-16 h-16" :src="user.profile_image" />

      <div class="ml-4 w-full">
        <div class="flex justify-between">
          <div>
            <strong>{{ user.account_name }}</strong>
          </div>

          <div class="flex">
            <Link :href="route('twitter.edit', post.id)">
              <Iconify
                icon="bx:bx-comment-detail"
                class="mr-2"
                color="#afafaf"
                width="24"
                height="24"
              />
            </Link>

            <Iconify
              icon="fluent:delete-20-regular"
              class="cursor-pointer mr-2"
              color="#afafaf"
              width="24"
              height="24"
              @click="deleteTweet(post.id)"
            />
          </div>
        </div>

        <div>
          <p>{{ post.text }}</p>
        </div>
      </div>
    </li>
  </ul>
</template>

<script setup lang="ts">
import { Icon as Iconify } from "@iconify/vue";
import { Inertia } from "@inertiajs/inertia";
import Icon from "@/Common/Icon.vue";
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
