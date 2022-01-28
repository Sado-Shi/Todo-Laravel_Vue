<template>
  <div>
    <title-section>
      <template #title>
        <slot name="title"></slot>
      </template>

      <template #description>
        <slot name="description"></slot>
      </template>
    </title-section>

    <div>
      <form @submit.prevent="$emit('submitted')">
        <div>
          <slot name="form"></slot>
        </div>

        <div>
          <slot name="actions"></slot>
        </div>
      </form>
    </div>
  </div>
</template>

<script setup lang="ts">
import TitleSection from "@/Common/TitleSection.vue";
</script>
