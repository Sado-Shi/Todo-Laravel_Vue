<template>
  <app-layout title="Tweet">
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        ツイート入力
      </h2>
    </template>

    <form-section @submitted="createTweet">
      <template #title>Tweet</template>
      <template #description>ここで入力してつぶやきます</template>
      <template #form>
        <!-- サーバーバリデーション -->
        <p class="text-red-500">{{ $props.errors.text }}</p>

        <textarea
          placeholder="ツイートを入力"
          name="tweet"
          rows="5"
          cols="25"
          type="text"
          v-model="v$.text.$model"
        ></textarea>

        <!-- フロントバリデーション -->
<div :class="{ error: v$.text.$errors.length }">
  <div class="input-errors" v-for="error of v$.text.$errors" :key="error.$uid">
    <div v-if="error.$validator == 'required'">入力してください</div>
    <div v-if="error.$validator == 'maxLength'">140文字以下で入力して下さい</div>
  </div>
</div>
      </template>

      <template #actions>
        <jet-button class="bg-blue-300 hover:bg-blue-400 text-base">
          ツイートする
        </jet-button>
      </template>
    </form-section>

    <Link :href="route('twitter.index')">
      <jet-button class="bg-blue-300 hover:bg-blue-400 text-base">
        <p>戻る</p>
      </jet-button>
    </Link>

    <!-- <email-test @input="emailValidate" :user="user"></email-test>
    <p class="text-red-500">{{ errors.email }}</p> -->

    <!-- <email-test-two :user="user"> </email-test-two>
    <div
      class="input-errors"
      v-for="error of v$.email.$errors"
      :key="error.$uid"
    >
      <div class="error-msg">{{ error.$message }}</div>
    </div>

    <div :class="{ error: v$.email.$errors.length }">
      <input type="text" v-model="v$.email.$model" />
      <div
        class="input-errors"
        v-for="error of v$.email.$errors"
        :key="error.$uid"
      >
        <div class="error-msg">{{ error.$message }}</div>
      </div>
    </div> -->

    <!-- <EmailProvider :v="v$.email" />
    <EmailProvider :v="v$.email2" /> -->
  </app-layout>
</template>

<script setup lang="ts">
import { Inertia } from "@inertiajs/inertia";
import { reactive, provide } from "vue";
import useVuelidate from "@vuelidate/core";
import { required, maxLength } from "@vuelidate/validators";
// import { useField, useForm } from "vee-validate";
// import * as yup from "yup";
import AppLayout from "@/Layouts/AppLayout.vue";
import JetButton from "@/Jetstream/Button";
import FormSection from "@/Common/FormSection.vue";
// import EmailTest from "@/Common/EmailTest.vue";
import { Link } from "@inertiajs/inertia-vue3";
import route from "../../../../vendor/tightenco/ziggy/src/js";
// import EmailProvider from "@/components/EmailProvider.vue";
// import EmailKey from "@/composables/use-email-key";
// import useEmail from "@/composables/use-email";

const emit = defineEmits(["createTweet"]);

const props = defineProps<{
  errors: {
    text: string;
    // email: string;
  };
}>();

// const schema = yup.object({
//   text: yup
//     .string()
//     .required("入力必須項目です")
//     .max(140, "文字数は140字以内で入力してください"),
//   email: yup.string().required("入力必須").email("emailの形式で入力して下さい"),
// });

// const { errors } = useForm({
//   validationSchema: schema,
// });

// const { value: text } = useField<string>("text");
// const { value: email } = useField<string>("email");

const state = reactive({
  text: "",
});

const rules = {
  text: {
    required,
    maxLength: maxLength(140)
  },
};

const v$ = useVuelidate(rules, state);

function createTweet(): void {
  Inertia.post(route("twitter.store"), state);
}

// function emailValidate(input: string): void {
//   email.value = input;
// }

// const useemail = useEmail();
// const { statement, v$, rules } = useemail;

// provide(EmailKey, useemail);
</script>
