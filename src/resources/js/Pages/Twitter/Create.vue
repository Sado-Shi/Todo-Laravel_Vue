<template>
  <app-layout title="Tweet">
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        ツイート入力
      </h2>
    </template>

    <form-section @submitted="createTweet">
      <template #title>Tweet</template>
      <template #description>ここで入力してつぶやきます</template>
      <template #form>
        <!-- サーバーバリデーション -->
        <p class="text-red-500">{{ $props.errors.text }}</p>

        <textarea
          placeholder="ツイートを入力"
          name="tweet"
          rows="5"
          cols="25"
          type="text"
          v-model="text"
        ></textarea>

        <!-- フロントバリデーション -->
        <p class="text-red-500">{{ errors.text }}</p>
      </template>

      <template #actions>
        <jet-button class="bg-blue-300 hover:bg-blue-400 text-base">
          ツイートする
        </jet-button>
      </template>
    </form-section>

    <Link :href="route('twitter.index')">
      <jet-button class="bg-blue-300 hover:bg-blue-400 text-base">
        <p>戻る</p>
      </jet-button>
    </Link>
  </app-layout>
</template>

<script setup lang="ts">
import { Inertia } from "@inertiajs/inertia";
import { useField, useForm } from "vee-validate";
import * as yup from "yup";
import AppLayout from "@/Layouts/AppLayout.vue";
import JetButton from "@/Jetstream/Button";
import FormSection from "@/Common/FormSection.vue";
import { Link } from "@inertiajs/inertia-vue3";
import route from "../../../../vendor/tightenco/ziggy/src/js";

const emit = defineEmits(["createTweet"]);

const props = defineProps<{
  errors: {
    text: string;
  };
}>();

const schema = yup.object({
  text: yup
    .string()
    .required("入力必須項目です")
    .max(140, "文字数は140字以内で入力してください"),
});

const { errors } = useForm({
  validationSchema: schema,
});

const { value: text } = useField<string>("text");

function createTweet(): void {
  Inertia.post(route("twitter.store"), { text: text.value });
}
</script>
