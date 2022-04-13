<template>
  <div>
    <div class="item"></div>
  </div>
</template>

<style scoped>
.item {
  width: 50px;
  height: 50px;
  position: absolute;
  top: 0;
  right: 0;
  bottom: 0;
  left: 0;
  margin: auto;
  border: 3px solid #42b883;
  border-top-color: transparent;
  border-radius: 50%;
  animation: spin 0.75s infinite linear;
}

.item::after {
  content: "";
  position: absolute;
  top: -3px;
  left: -3px;
  width: inherit;
  height: inherit;
  border: inherit;
  border-radius: inherit;
  transform: rotate(60deg);
}

@keyframes spin {
  from {
    transform: rotate(0deg);
  }

  to {
    transform: rotate(360deg);
  }
}
</style>
