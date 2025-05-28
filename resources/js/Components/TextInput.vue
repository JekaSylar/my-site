<script setup>
import { onMounted, ref } from 'vue';

const model = defineModel();

const input = ref(null);

onMounted(() => {
    if (input.value.hasAttribute('autofocus')) {
        input.value.focus();
    }
});

defineExpose({ focus: () => input.value.focus() });
</script>

<template>
    <input
        class="block w-full rounded-md bg-white dark:bg-gray-900 px-3 py-1.5 text-base text-gray-900 dark:text-gray-300 outline-1 -outline-offset-1 outline-gray-300 dark:outline-gray-700 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-sky-600 dark:focus:outline-indigo-600 sm:text-sm/6"
        v-model="model"
        ref="input"
    />
</template>
