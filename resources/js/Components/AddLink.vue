<script setup>
import {Link} from "@inertiajs/vue3";

defineProps({
    href: {
        type: String,
        required: true,
    },
});
</script>

<template>
    <Link
        :href="href"
        class="bg-sky-500 text-white py-2 px-3 rounded-lg my-4 max-w-3xs"
    >
        <slot />
    </Link>
</template>

<style scoped>

</style>
