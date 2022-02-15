<template>
  <app-layout title="Practice">
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        TypeScript Top
      </h2>
    </template>
  </app-layout>
</template>

<script setup lang="ts">
import AppLayout from "@/Layouts/AppLayout.vue";
import { toUpper } from "lodash";

let hasValue = true;
let count: number = 10;
const float: number = 3.45;
const back: string = `aaa`;

const person = {
  name: {
    first: "nonnpi",
    last: "sonoda",
  },
  age: 27,
};

// ユニオン型 or any型
let fruits = ["banana", "grape", "apple", 1];

// tuple型
const book: [string, number, boolean] = ["business", 1700, true];

// Enum(列挙型)
enum PokemonType {
  HI,
  MIZU,
  KAMINARI,
  POISON,
}

const pokemon = {
  type: PokemonType.POISON,
  sex: "men",
};

pokemon.type = PokemonType.HI;

// any型
let anything: any = true;
anything = "hello";

let union: string | number = "string";
let unions: (string | number)[] = ["string"];

console.log(union.toUpperCase());

let abc: 'aaa' | 'bbb' | 'ccc' = 'bbb'

type size = 'aaa' | 'bbb' | 'ccc';
let test: size ='aaa'

function add(num1: number,  num2: number): number {
  return num1 + num2;
}

console.log(add(1, 1));

const none: null = undefined;

const anotherAdd: (n1: number, n2: number) => number = add

function pokemonNumber(n1: number, cb: (num: number) => void):void {
  const doublePokemon = cb(n1 * 2);
  console.log(doublePokemon);
}

pokemonNumber(2, doublePokemon => {
  return doublePokemon;
})

let unknownInput: unknown = 'aa'

let text: string = "aaa";
if (typeof unknownInput === 'string') {
  text = unknownInput;
  console.log(text);
}

let hello = "hello";
console.log(hello.toUpperCase());

// test追加aaa
</script>
