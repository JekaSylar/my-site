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
    <div v-if="clickableLinks.length > 1" class="flex items-center justify-between  bg-white mt-4 px-4 py-3 sm:px-6" >

        <div class="flex flex-1 items-center justify-center">

            <div>
                <nav class="isolate inline-flex -space-x-px rounded-md shadow-sm" aria-label="Pagination">

                    <Link v-for="(link, index) in clickableLinks"
                       :key="index"
                        :href="link.url"
                       v-html="link.label"
                          :class="[
                                      'relative inline-flex items-center px-4 py-2 text-sm font-semibold focus:z-20 focus:outline-offset-0',
                                      link.active
                                        ? 'z-10 bg-sky-500 text-white focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-sky-500'
                                        : 'text-gray-900 ring-1 ring-inset ring-gray-300 hover:bg-gray-50'
                                 ]"
                    >

                    </Link>

                </nav>

            </div>
        </div>
    </div>

</template>

<style scoped>

</style>
