<script setup lang="ts">
import { Inertia } from "@inertiajs/inertia";
import { ref } from "vue";
import { Icon as Iconify } from "@iconify/vue";
import crossIcon from "@iconify-icons/charm/cross";
import Icon from "@/Common/Icon.vue";
import route from "../../../../vendor/tightenco/ziggy/src/js";

type CurrentUser = {
  id: number;
  account_name: string;
  body: string;
  profile_image: string;
};

const props = defineProps<{
  currentUser: CurrentUser;
}>();

const modalOpen = ref(false);

// 双方向バインディングで、モーダル入力中に変わってしまうため
const accountName = ref(props.currentUser.account_name);
const body = ref(props.currentUser.body);

function saveProfile() {
  Inertia.put(
    route("twitter.profile.update"),
    {
      account_name: accountName.value,
      body: body.value,
    },
    {
      preserveScroll: true,
    }
  );

  modalOpen.value = false;
  document.querySelector("body")!.style.overflow = "visible";
  document.querySelector("body")!.style.paddingRight = "0";
}

function isVisible(bool) {
  modalOpen.value = bool;
  if (bool === true) {
    document.querySelector("body")!.style.overflow = "hidden";
    document.querySelector("body")!.style.paddingRight = "15px";
    document.querySelector("body")!.style.background = "#E8E9EC";
  } else {
    document.querySelector("body")!.style.overflow = "visible";
    document.querySelector("body")!.style.paddingRight = "0";
  }
}

const fileInfo = ref("");

const fileSelected = (event) => {
  fileInfo.value = event.target.files[0];
};

function fileUpload() {
  if (fileInfo.value) {
    const formData = new FormData();

    formData.append("file", this.fileInfo);

    Inertia.post(route("twitter.fileupload"), formData);
  }
}
</script>

<template>
  <div>
    <button
      @click="isVisible(true)"
      type="button"
      class="px-2 py-1 itext-gray-800 bg-white border border-gray-300 shadow-sm hover:text-gray-600 rounded-full overflow-hidden"
    >
      <span class="text-sm font-bold text-blue-400 mx-3 my-1">
        <slot></slot>
      </span>
    </button>

    <!-- モーダル表示 -->
    <teleport to="body">
      <div
        v-if="modalOpen"
        class="fixed top-0 left-0 bottom-0 right-0 flex items-center justify-center w-full h-full bg-black/30"
      >
        <div class="bg-white rounded">
          <header class="flex items-center">
            <button @click="isVisible(false)">
              <Iconify class="text-gray-500 text-2xl" :icon="crossIcon" />
            </button>

            <h6 class="ml-2">プロフィールを編集</h6>
            <button @click="saveProfile()" class="ml-auto">保存</button>
          </header>

          <button>
            <Icon class="w-24 h-24" :src="currentUser.profile_image" />
            <input type="file" @change="fileSelected" />
          </button>
          <button type="button" @click="fileUpload()">
            プロフィール写真をアップロード
          </button>

          <div>
            <label>
              <span>名前</span>
              <textarea
                rows="1"
                cols="25"
                type="text"
                v-model="accountName"
              ></textarea>
            </label>
          </div>

          <div>
            <label>
              <span>自己紹介</span>
              <textarea
                rows="3"
                cols="25"
                type="text"
                v-model="body"
              ></textarea>
            </label>
          </div>
        </div>
      </div>
    </teleport>
  </div>
</template>
