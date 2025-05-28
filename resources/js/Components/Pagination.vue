<script setup>
import { Link } from '@inertiajs/vue3'

const props =  defineProps({
    links: {
        type: Array,
        required: true,
    }
});

const clickableLinks = props.links.filter(link => link.url !== null);

</script>

<template>
    <div
        v-if="clickableLinks.length > 1"
        class="mt-6 flex justify-center">
        <nav
            class="inline-flex gap-1 "
            aria-label="Pagination">
            <Link
                v-for="(link, index) in clickableLinks"
                :key="index"
                :href="link.url"
                v-html="link.label"
                :class="[
                    'px-3 py-1.5 text-sm font-medium rounded-md transition',
                    link.active
                        ? 'bg-sky-500 text-white shadow-sm'
                        : 'text-gray-700 hover:bg-gray-100 hover:text-black'
                ]"/>
        </nav>
    </div>
</template>


<style scoped>

</style>
