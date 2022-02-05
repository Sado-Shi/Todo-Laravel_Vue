<!-- <template>
  <div class="p-8">
    testProvider
    <form>
      <label for="test">Email </label>
      <input type="email" id="test" v-model="v.$model" />
    <div
        class="input-errors"
        v-for="error of v.$errors"
        :key="error.$uid"
      >
        <div class="error-msg">{{ error.$message }}</div>
      </div>
    </form>
  </div>
</template>

<script setup lang="ts">
import { inject } from "vue";
import { EmailStore } from "@/composables/use-email";
import EmailKey from "@/composables/use-email-key";

const props = defineProps<{
  v: {
    email: string;
  };
}>();

const { statement, v$, rules } = inject<EmailStore>(EmailKey);
</script> -->
