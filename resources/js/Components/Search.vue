<script setup>
import {ref, watch} from 'vue';

const emits = defineEmits(['search', 'clear']);
const modal = defineModel();

const isSearch = ref(true);
const handleSearch = () => {
    if (modal.value?.trim()) {
        emits('search');
        isSearch.value = true;
    } else {
        isSearch.value = false;
    }
};

const handleClear = () => {
    isSearch.value = true;
    emits('clear');
}

watch(modal, (newVal) => {
    if (newVal?.trim()) {
        isSearch.value = true;
    }
});

</script>

<template>
    <div class="w-3xs my-2">
        <div
            :class="[
                      'flex bg-white border-2 rounded-md',
                      isSearch ? 'border-gray-300 focus-within:border-sky-600' : 'border-red-500'
                    ]"
            class="outline-1 -outline-offset-1 focus-within:outline-2 focus-within:-outline-offset-2 outline-gray-300 focus-within:outline-sky-600"
        >
            <input
                v-model="modal"
                @keydown.enter="handleSearch"
                type="text"
                name="search"
                class="block min-w-0 grow px-3 py-1.5 text-base text-gray-900 placeholder:text-gray-400 focus:outline-none sm:text-sm/6"
                required
                placeholder="Пошук..."/>

            <div class="flex items-center py-1.5 pr-1.5">
                <svg
                    v-if="modal"
                    @click="handleClear"
                    class="w-5 cursor-pointer fill-red-500"
                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path d="M342.6 150.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L192 210.7 86.6 105.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L146.7 256 41.4 361.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L192 301.3 297.4 406.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L237.3 256 342.6 150.6z"/></svg>
                <svg
                    @click="handleSearch"
                    class="w-5 h-5 cursor-pointer"
                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                    <path
                        d="M416 208c0 45.9-14.9 88.3-40 122.7L502.6 457.4c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L330.7 376c-34.4 25.2-76.8 40-122.7 40C93.1 416 0 322.9 0 208S93.1 0 208 0S416 93.1 416 208zM208 352a144 144 0 1 0 0-288 144 144 0 1 0 0 288z"/>
                </svg>
            </div>
        </div>
    </div>
</template>
