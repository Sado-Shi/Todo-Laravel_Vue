<script setup lang="ts">
defineProps<{
  open?: boolean;
}>();

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
      duration: 200,
      easing: "ease-out",
    }
  ).finished;

  el.classList.remove("overflow-hidden");

  done();
}

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
    <slot name="summary"></slot>
    <transition @enter="enter" @leave="leave">
      <div v-if="open">
        <slot></slot>
      </div>
    </transition>
  </section>
</template>
