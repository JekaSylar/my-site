<script setup>
import {router} from "@inertiajs/vue3";
import useToast from "@/composables/toast.js";

const props = defineProps({
    user: {
      type: Object,
      required: true,
    },

});

const toast = useToast();
const handlerVerified = () => {
    router.post(route('users.change.email.verified', props.user), {
            email_verified_at: true,
    }, {
            onSuccess: () => {
                toast('Email верифіковано');
            }
    }
    );
}

</script>

<template>
    <div v-if="user.email_verified_at" class="flex flex-row gap-2 items-center">

    <svg

        class="w-5 fill-green-500"
        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM369 209L241 337c-9.4 9.4-24.6 9.4-33.9 0l-64-64c-9.4-9.4-9.4-24.6 0-33.9s24.6-9.4 33.9 0l47 47L335 175c9.4-9.4 24.6-9.4 33.9 0s9.4 24.6 0 33.9z"/></svg>

    </div>
    <div v-else class="flex flex-row gap-2 items-center cursor-pointer" @click="handlerVerified">
        <svg class="w-5 fill-red-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM175 175c9.4-9.4 24.6-9.4 33.9 0l47 47 47-47c9.4-9.4 24.6-9.4 33.9 0s9.4 24.6 0 33.9l-47 47 47 47c9.4 9.4 9.4 24.6 0 33.9s-24.6 9.4-33.9 0l-47-47-47 47c-9.4 9.4-24.6 9.4-33.9 0s-9.4-24.6 0-33.9l47-47-47-47c-9.4-9.4-9.4-24.6 0-33.9z"/></svg>

    </div>
</template>

<style scoped>

</style>
