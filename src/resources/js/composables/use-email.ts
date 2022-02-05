// import { reactive } from "vue";
// import { required } from "@vuelidate/validators";
// import useVuelidate from "@vuelidate/core";

// export default function useEmail() {
//   // 状態
//   const statement = reactive<{
//     email: string;
//   }>({
//     email: "aaa",
//     email2: 'bbb'
//   });

//   function test(value) {
//     console.log(value);
//   }

//   // ロジック
//   const rules = {
//     email: { required },
//     email2: { test },
//   };

//   const v$ = useVuelidate(rules, statement);

//   return {
//     statement,
//     rules,
//     v$
//   };
// }

// // 追加
// export type EmailStore = ReturnType<typeof useEmail>;
