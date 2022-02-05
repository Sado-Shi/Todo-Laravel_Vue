// defineStoreをインポート
import { defineStore } from "pinia";

// defineStore`でストアを定義
// 第一引数はアプリケーション内でユニークなキー
export const useTestStore = defineStore("test", {
  // state -> ストアの初期状態を定義
  state: () => ({
    counter: 0,
  }),

  // getters -> 状態を取得するgetter（computedに相当）
  getters: {
    doubleCount: (state) => state.counter * 2,
  },

  // actions -> 状態を変更するaction(methodsに相当)
  actions: {
    increment() {
      this.counter++;
    },
    decrement() {
      this.counter--;
    },
  },
});
