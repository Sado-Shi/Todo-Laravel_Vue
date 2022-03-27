<script setup lang="ts">
import { Inertia } from "@inertiajs/inertia";
import useVuelidate from "@vuelidate/core";
import AppLayout from "@/Layouts/AppLayout.vue";
import JetButton from "@/Jetstream/Button";
import { Link } from "@inertiajs/inertia-vue3";
import { ref, reactive } from "vue";
import { required, maxLength } from "@vuelidate/validators";
import route from "../../../../vendor/tightenco/ziggy/src/js";
import CountLike from "./Components/CountLike.vue";

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
  likes: {
    id: number;
    user_id: number;
    post_id: number;
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
      <h2>{{ user.account_name }}</h2>

      <!-- サーバーバリデーション -->
      <p class="text-red-500">{{ $props.errors.text }}</p>

      <div v-if="edit">
        <p>{{ post.text }}</p>
        <button @click="activeEdit(false)">編集</button>
        <button @click="deleteTweet(post.id)">削除</button>

        <CountLike :likes="likes" :post="post" />
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
    </div>
  </app-layout>
</template>
