<!-- <template>
  <div class="p-8">
    <form>
      <label for="test">Email </label>
      <input type="email" id="test" v-model="user.email" />
    </form>
  </div>
</template>

<script setup lang="ts">
import { watchEffect } from "vue";

interface Emits {
  (event: "input", value: string): void;
}

const props = defineProps<{
  errors: {
    text: string;
  };
  user: {
    id: number;
    email: string;
  };
}>();

const emit = defineEmits<Emits>();

watchEffect((event) => {
  emit("input", props.user.email);
});
</script> -->
