<template>
  <app-layout title="Practice">
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        TypeScript Top
      </h2>
    </template>
    <!-- <SectionOne :open="open" /> -->

    <div class="m-5">
      <label class="inline-flex items-center">
        <input v-model="isCheck" type="checkbox" class="peer sr-only" />
        <span
          class="block w-[2em] cursor-pointer bg-gray-500 rounded-full p-[1px] after:block after:h-[1em] after:w-[1em] after:rounded-full after:bg-white after:transition peer-checked:bg-blue-500 peer-checked:after:translate-x-[calc(100%-2px)]"
        >
        </span>
        {{ isCheck }}
      </label>

      <label class="inline-flex items-center">
        <input v-model="isCheck2" type="checkbox" class="peer sr-only" />
        <span
          class="block w-[2em] cursor-pointer bg-gray-500 rounded-full p-[1px] after:block after:h-[1em] after:w-[1em] after:rounded-full after:bg-white after:transition peer-checked:bg-blue-500 peer-checked:after:translate-x-[calc(100%-2px)]"
        >
        </span>
        {{ isCheck2 }}
      </label>
    </div>
  </app-layout>
</template>

<script setup lang="ts">
import AppLayout from "@/Layouts/AppLayout.vue";
import { first } from "lodash";
import SectionOne from "./SectionOne.vue";

import { ref } from "vue";

const open = ref(true);

const isCheck = ref(false);
const isCheck2 = ref(false);
// type Pokemon = {
//   name: string;
//   age: number;
//   weight: Number;
//   type: string;
//   skill: (action: string) => void;
// };

// interface Pokemon {
//   name: string;
//   age: number;
//   weight: Number;
//   type: string;
//   skill(act: string): void;
// }

// const pokemon = {
//   name: "kabigon",
//   age: 40,
//   weight: 500,
//   type: "normal",
//   skill(action: string = "add") {
//
//     const act = action;
//   },
// };

// pokemon.skill("initial");

type Engineer = {
  name: string;
  role: string;
  afaf: string;
};

type Blogger = {
  name: string;
  follower: number;
};

type EngineerBlogger = Engineer & Blogger;
const Quill: EngineerBlogger = {
  name: "Quill",
  role: "front-end",
  follower: 45,
};

// タイプガード①
function toUpperCase(x: string | number) {
  if (typeof x === "string") {
    x.toUpperCase();
  }
  return "";
}

type NomadWorker = Blogger | Engineer;
function describeProfile(nomadWorker: NomadWorker) {
  nomadWorker.name;
  // タイプガード②
  if ("afaf" in nomadWorker) {
    nomadWorker.role;
  }
  if ("follower" in nomadWorker) {
    nomadWorker.follower;
  }
}

// タイプガード③ = instanceOf

type DownloadData = {
  id: number;
  user?: {
    name?: {
      first: string;
      last: string;
    };
  };
};

const downloadData: DownloadData = {
  id: 1,
};

console.log(downloadData.user?.name?.first);
const userData = downloadData.user ?? "no-user";

type test = DownloadData["id" | "user"];

function advancedFn(...args: [number, string, boolean?, ...number[]]) {}

advancedFn(1, "hi");

const pokemon = ["pika", "zeni"] as const;

type PokemonType = typeof pokemon;

// ジェネリクス
function copy<T>(value: T): T {
  return value;
}
console.log(copy<string>("a"));

interface Todo {
  title: string;
  text: string;
}

// 全部オプショナルにしてくれる
type Todoable = Partial<Todo>;
// 全部readonlyに
type ReadTodo = Readonly<Todo>;
</script>
