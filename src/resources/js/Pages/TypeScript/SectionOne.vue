<script setup lang="ts">
import { ref } from "vue";

const props = defineProps<{
  open?: boolean;
}>();

const open = ref(props.open);

// 開くとき
async function enter(el: Element, done: () => void) {
  el.classList.add("overflow-hidden");

  await el.animate(
    [
      {
        height: 0,
      },
      {
        height: `${(el as HTMLElement).offsetHeight}px`,
      },
    ],
    {
      duration: 500,
      easing: "ease-out",
    }
  ).finished;

  el.classList.remove("overflow-hidden");

  done();
}

// 閉まるとき
async function leave(el: Element, done: () => void) {
  el.classList.add("overflow-hidden");

  await el.animate(
    [
      {
        height: `${(el as HTMLElement).offsetHeight}px`,
      },
      {
        height: 0,
      },
    ],
    {
      duration: 100,
      easing: "ease-out",
    }
  ).finished;

  el.classList.remove("overflow-hidden");

  done();
}
</script>

<template>
  <section>
    <button class="bg-gray-300 rounded p-4 mb-5" @click="open = !open">
      開閉ボタン
    </button>
    <transition @enter="enter" @leave="leave">
      <div v-if="open">
        <p class="bg-blue-100 p-10">open</p>
      </div>
      <div v-else></div>
    </transition>
  </section>
</template>
