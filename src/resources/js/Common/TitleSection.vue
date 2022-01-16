<template>
  <div class="md:col-span-1 flex justify-between">
    <div class="px-4 sm:px-0">
      <h2 class="text-lg font-medium text-blue-500">
        <slot name="title"></slot>
      </h2>

      <p class="mt-1 text-sm text-blue-500">
        <slot name="description"></slot>
      </p>
    </div>
  </div>
</template>
