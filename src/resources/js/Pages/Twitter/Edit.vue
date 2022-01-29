<template>
  <app-layout title="Tweet - Detail">
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        ツイート
      </h2>
    </template>

    <div>
      <h2>{{ user.account_name }}</h2>
      <div v-if="edit">
        <p>{{ post.text }}</p>
        <button @click="activeEdit(false)">編集</button>
        <button @click="deleteTweet(post.id)">削除</button>
      </div>
      <div v-else>
        <textarea
          rows="5"
          cols="25"
          type="text"
          v-model="post.text"
        ></textarea>
        <button @click="activeEdit(true)">更新</button>
        <button @click="activeEdit(null)">キャンセル</button>
      </div>
    </div>
  </app-layout>
</template>

<script setup lang="ts">
import { Inertia } from "@inertiajs/inertia";
import AppLayout from "@/Layouts/AppLayout.vue";
import JetButton from "@/Jetstream/Button";
import { Link } from "@inertiajs/inertia-vue3";
import { ref, reactive } from "vue";
import route from "../../../../vendor/tightenco/ziggy/src/js";

const props = defineProps<{
  post: {
    id: number;
    text: string;
  };
  user: {
    id: number;
    account_name: string;
    text: string;
  };
}>();

const edit = ref(true);
let cancelText = ref("");

function deleteTweet(id): void {
  Inertia.delete(route("twitter.destroy", id), {
    preserveScroll: true,
  });
}

function activeEdit(bool): void {
  if (bool === false) {
    cancelText.value = props.post.text;
    edit.value = bool;
  }

  if (bool === true) {
    Inertia.put(route("twitter.update", props.post.id), props.post);
    edit.value = true;
  }

  if (bool === null) {
    props.post.text = cancelText.value;
    edit.value = true;
  }
}
</script>
