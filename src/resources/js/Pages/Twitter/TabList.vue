<template>
  <!-- ナビゲーション -->
  <nav class="max-w-7xl mr-auto ml-auto">
    <ul class="px-16 flex items-center justify-between">
      <li
        v-for="{ label, id } in labels"
        :key="id"
        @click="current = id; focusTab(id)"
        class="cursor-pointer flex-1 text-center py-4 hover:bg-gray-300"
      >
        <a :class="{'font-bold': isActive === id }">{{ label }}</a>
        <div
          v-if="isActive === id"
          class="bg-cyan-500 h-1 w-32 mx-auto mt-2"
        ></div>
      </li>
    </ul>
  </nav>

  <!-- コンテンツ -->
  <section class="p-4">
    <slot :key="current" :name="current"></slot>
  </section>
</template>

<script setup lang="ts">
import { ref } from "vue";

// type Post = {
//   id: number;
//   text: string;
// };

const props = defineProps<{
  // user: {
  //   id: number;
  //   account_name: string;
  //   body: string;
  //   profile_image: string;
  // };
  labels: {
    label: string;
    id: string;
  }[];
  // posts: Post[];
}>();

const current = ref(props.labels[0].id);

const isActive = ref(null);

function focusTab(id) {
  isActive.value = id;
}

</script>
