<template>
  <app-layout title="Tweet">
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        ツイート入力
      </h2>
    </template>

    <form-section>
      <template #title>Tweet</template>
      <template #description>ここで入力してつぶやきます</template>
      <template #form>
        <div>
          <textarea placeholder="ツイートを入力" name="tweet" rows="5" cols="25" v-model="tweetBody"></textarea>
        </div>
      </template>
    </form-section>

    <Link :href="route('twitter.store')">
      <jet-button class="bg-blue-300 hover:bg-blue-400 text-base"
        >ツイートする
      </jet-button>
    </Link>
  </app-layout>
</template>

<script setup lang="ts">
import { ref } from 'vue';
import AppLayout from "@/Layouts/AppLayout.vue";
import JetButton from "@/Jetstream/Button";
import FormSection from "@/Common/FormSection.vue";
import { Link } from "@inertiajs/inertia-vue3";

const props = defineProps<{
  users: Object;
}>();

const tweetBody = ref('');
</script>
