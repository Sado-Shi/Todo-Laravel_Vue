<script lang="ts" setup>
import { Inertia } from "@inertiajs/inertia";
import axios from "axios";
import { ref } from "vue";

const emit = defineEmits<{
  (e: "loadStart"): void;
  (e: "loadComplete", data): void;
}>();

let qu = ref("");

async function exe() {
  emit("loadStart");
  const { data } = await axios.get(
    `https://qiita.com/api/v2/users/${qu.value}/items`
  );
  console.log(data);
  emit("loadComplete", data);
}
</script>

<template>
  <div>
    <input type="text" v-model="qu" @keyup.enter="exe" />
    <input type="submit" value="APIcall" @click="exe" />
  </div>
</template>
