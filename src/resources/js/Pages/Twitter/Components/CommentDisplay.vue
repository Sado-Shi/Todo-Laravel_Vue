<script setup lang="ts">
import { Icon as Iconify } from "@iconify/vue";
import commentIcon from "@iconify-icons/ei/comment";
import crossIcon from "@iconify-icons/charm/cross";

import { Inertia } from "@inertiajs/inertia";
import { computed, ref } from "vue";
import route from "../../../../../vendor/tightenco/ziggy/src/js";

import FormSection from "@/Common/FormSection.vue";
import JetButton from "@/Jetstream/Button";
import Icon from "@/Common/Icon.vue";

type User = {
  id: number;
  account_name: string;
  body: string;
  profile_image: String;
};

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

type Comment = {
  id: number;
  user_id: number;
  post_id: number;
  text: string;
  user_name: string;
  user_image: string;
};

const props = defineProps<{
  user: User;
  post: Post;
  comment: Comment;
}>();

console.log(props.comment.user_name);
const commentValue = ref("");
const modalOpen = ref(false);

function isVisible(bool) {
  modalOpen.value = bool;
  if (bool === true) {
    document.querySelector("body")!.style.overflow = "hidden";
    document.querySelector("main")!.style.paddingRight = "15px";
    document.querySelector("body")!.style.background = "#E8E9EC";
  } else {
    document.querySelector("body")!.style.overflow = "visible";
    document.querySelector("main")!.style.paddingRight = "0";
  }
}

function stopEvent(e) {
  e.stopPropagation();
}

function createComment(): void {
  Inertia.post(route("twitter.comment.store"), {
    post_id: props.post.id,
    comment: commentValue.value,
    user_id: props.user.id,
  });
  modalOpen.value = false;
  document.querySelector("body")!.style.overflow = "visible";
}

function inputComment(e): void {
  if (e.target) {
    commentValue.value = e.target.value;
  }
}
</script>

<template>
  <div class="flex">
    <button @click="isVisible(true)">
      <Iconify class="text-2xl" :icon="commentIcon" />
    </button>

    <!-- モーダル表示 -->
    <teleport to="body">
      <div
        @click="isVisible(false)"
        v-if="modalOpen"
        class="fixed top-0 left-0 bottom-0 right-0 flex items-center justify-center w-full h-full bg-black/30"
      >
        <div class="bg-white rounded p-2" @click="stopEvent">
          <header class="flex items-center">
            <button @click="isVisible(false)">
              <Iconify class="text-gray-500 text-2xl" :icon="crossIcon" />
            </button>
          </header>

          <div>
            <Icon class="w-24 h-24" :src="comment.user_image" />
            <h2>{{ comment.user_name }}</h2>
            <p>{{ comment.text }}</p>
          </div>

          <div class="w-1 h-8 bg-slate-500 ml-11"></div>

          <form-section @submitted="createComment()">
            <template #form>
              <div class="mt-4">
                <Icon class="w-24 h-24" :src="user.profile_image" />
                <textarea
                  @input="inputComment($event)"
                  rows="5"
                  cols="25"
                  type="text"
                  placeholder="コメントを投稿する"
                ></textarea>
              </div>
            </template>
            <template #actions>
              <jet-button class="bg-blue-300 hover:bg-blue-400 text-base">
                コメントする
              </jet-button>
            </template>
          </form-section>
        </div>
      </div>
    </teleport>
  </div>
</template>
