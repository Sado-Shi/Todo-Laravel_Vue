<!-- <template>
  <app-layout title="Practice">
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Practice Top
      </h2>
    </template>

    <div class="p-8 max-w-7xl mr-auto ml-auto">

      <h1>Parent</h1>
      <div class="flex" v-for="item in getCartItems()" :key="item.name">
        <p>{{ item.name }}</p>
        <p>{{ item.price }}円</p>
      </div>
      <p>合計{{ getTotalFee() }}円</p>
      <Child></Child>

    </div>
  </app-layout>
</template>

<script setup lang="ts">
import { useCartStore } from "@/composables/store";
import Child from "@/Practice/Child.vue"
import { Inertia } from "@inertiajs/inertia";
import AppLayout from "@/Layouts/AppLayout.vue";
import Icon from "@/Common/Icon.vue";
import JetButton from "@/Jetstream/Button";
import { Link } from "@inertiajs/inertia-vue3";
import route from "../../../../vendor/tightenco/ziggy/src/js";

const {getCartItems,getTotalFee} =useCartStore()
</script>

<style scoped></style> -->

<!-- <template>
    <div>
        <p>counter: {{counter}}</p>
        <p>doubleCount: {{doubleCount}}</p>
        <button type="button" @click="increment">increment</button>

        <button type="button" @click="test.decrement()">decrement</button>
    </div>
</template>

<script setup lang="ts">
import {useTestStore} from '@/store/test'
import {storeToRefs} from 'pinia'

export default {
    setup()
    {
        // ストアの呼び出し
        const test = useTestStore()

        // ストアプロパティの取得
        // toRefsだとreactivityが壊れるので注意
        const {counter, doubleCount} = storeToRefs(test)

        // ストアアクションの取得
        const increment = () => {
            test.increment()
        };

        return {
            test,
            counter,
            doubleCount,
            increment,
        }
    },
}
</script> -->
