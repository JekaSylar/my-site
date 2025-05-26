<script setup>
import {ref} from 'vue';
import {router} from "@inertiajs/vue3";
import Search from "@/Components/Search.vue";

const search = route().params.search;
const modal = ref(search ?? '');

const handleSearch = () => {
  router.get(route('users.search', {
        search: modal.value,
    }));
}
const handleClear = () => {
    router.get(route('users.index'));
}
</script>

<template>
<Search v-model="modal" @search="handleSearch" @clear="handleClear" />
</template>

