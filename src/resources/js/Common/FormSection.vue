<template>
  <div>
    <jet-section-title>
      <template #title>
        <slot name="title"></slot>
      </template>

      <template #description>
        <slot name="description"></slot>
      </template>
    </jet-section-title>

    <div>
      <form @submit.prevent="$emit('submitted')">
        <div>
          <slot name="form"></slot>
        </div>

        <div>
          <slot name="action"></slot>
        </div>
      </form>
    </div>
  </div>
</template>

<script setup lang="ts">
import JetSectionTitle from "@/Common/TitleSection.vue";
</script>
