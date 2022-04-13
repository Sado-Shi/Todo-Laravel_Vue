<script setup lang="ts">
import { Icon as Iconify } from "@iconify/vue";
import retweetIcon from "@iconify-icons/system-uicons/retweet";

import { Inertia } from "@inertiajs/inertia";
import { ref, reactive } from "vue";
import route from "../../../../vendor/tightenco/ziggy/src/js";
import useVuelidate from "@vuelidate/core";
import { required, maxLength } from "@vuelidate/validators";

import AppLayout from "@/Layouts/AppLayout.vue";
import CountLike from "./Components/CountLike.vue";
import Icon from "@/Common/Icon.vue";
import Like from "./Components/Like.vue";
import PostCommentDisplay from "./Components/PostCommentDisplay.vue";
import CommentDisplay from "./Components/CommentDisplay.vue";

const props = defineProps<{
  post: {
    id: number;
    text: string;
    user_id: number;
    count: number;
    is_liked: number;
    user: {
      account_name: string;
      profile_image: String;
    };
  };
  user: {
    id: number;
    account_name: string;
    body: string;
    profile_image: String;
  };
  likes: {
    id: number;
    user_id: number;
    post_id: number;
  }[];
  comments: {
    id: number;
    user_id: number;
    post_id: number;
    text: string;
    user_name: string;
    user_image: string;
  }[];
  errors: {
    text: string;
  };
}>();

const edit = ref<boolean>(true);

function deleteTweet(id: number): void {
  Inertia.delete(route("twitter.destroy", id), {
    preserveScroll: true,
  });
}

function activeEdit(bool: boolean | null): void {
  if (bool === false) {
    v$.value.text.$model = props.post.text;
    edit.value = bool;
  }

  if (bool === true) {
    Inertia.put(route("twitter.update", props.post.id), {
      text: v$.value.text.$model,
    });
    edit.value = true;
  }

  if (bool === null) {
    edit.value = true;
  }
}

const state = reactive({
  text: "",
});

const rules = {
  text: {
    required,
    maxLength: maxLength(140),
  },
};

const v$ = useVuelidate(rules, state);
</script>

<template>
  <app-layout title="Tweet - Detail">
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        ツイート
      </h2>
    </template>

    <div>
      <Icon class="w-24 h-24" :src="post.user.profile_image" />
      <h2>{{ post.user.account_name }}</h2>

      <!-- サーバーバリデーション -->
      <p class="text-red-500">{{ $props.errors.text }}</p>

      <div v-if="edit">
        <p>{{ post.text }}</p>
        <button v-if="post.user_id === user.id" @click="activeEdit(false)">
          編集
        </button>
        <button v-if="post.user_id === user.id" @click="deleteTweet(post.id)">
          削除
        </button>

        <div class="flex">
          <!-- 投稿に対するリプライ -->
          <PostCommentDisplay :user="user" :post="post" />
          {{ comments.length }}
          <!-- リツイート -->
          <button class="ml-3">
            <Iconify class="text-2xl" :icon="retweetIcon" />
          </button>

          <Like :post="post" />
          <CountLike :likes="likes" :post="post" />
        </div>
      </div>
      <div v-else>
        <textarea
          rows="5"
          cols="25"
          type="text"
          v-model="v$.text.$model"
        ></textarea>
        <button :disabled="v$.$invalid" @click="activeEdit(true)">更新</button>
        <button @click="activeEdit(null)">キャンセル</button>
      </div>

      <!-- フロントバリデーション -->
      <div v-if="{ error: v$.text.$errors.length }">
        <div
          class="input-errors"
          v-for="error of v$.text.$errors"
          :key="error.$uid"
        >
          <div v-if="error.$validator == 'required'">入力してください</div>
          <div v-if="error.$validator == 'maxLength'">
            140文字以下で入力して下さい
          </div>
        </div>
      </div>

      <div v-if="comments">
        <ul v-for="comment of comments" :key="comment.id">
          <Icon class="w-24 h-24" :src="comment.user_image" />
          <li>{{ comment.user_name }}</li>
          <h4>返信先: {{ post.user.account_name }}さん</h4>
          <li>{{ comment.text }}</li>
          <div class="flex">
            <!-- コメントに対するリプライ -->
            <!-- <CommentDisplay :user="user" :post="post" :comment="comment" /> -->
          </div>
        </ul>
      </div>
    </div>
  </app-layout>
</template>
