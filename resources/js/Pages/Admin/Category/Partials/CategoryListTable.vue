<script setup>
import useToast from "@/composables/toast.js";
import Pagination from "@/Components/Pagination.vue";
import EditLink from "@/Components/EditLink.vue";
import Delete from "@/Components/Delete.vue";
import {router} from "@inertiajs/vue3";

const props = defineProps({
    categories: {
        type: Object,
        required: true
    }
});
const toast = useToast();
const handlerRemove = (category) => {
    router.delete(route('category.destroy', category), {
        onSuccess: () => {
            toast('Категорію видаленно');
        }
    });
}
</script>


<template>
    <div class="mt-8">

        <div class="overflow-x-auto rounded-xl border border-gray-200 shadow-sm">
            <table class="min-w-full text-sm text-gray-700 bg-white">
                <thead class="bg-gray-100 text-xs uppercase text-gray-600">
                <tr>
                    <th class="px-6 py-4 text-left">№</th>
                    <th class="px-6 py-4 text-left">Назва</th>
                    <th class="px-6 py-4 text-left">Посилання</th>
                    <th class="px-6 py-4 text-left">Опис</th>
                    <th class="px-6 py-4 text-left">Дії</th>
                </tr>
                </thead>
                <tbody>
                <tr
                    v-for="(category, index) in categories.data"
                    :key="category.id"
                    class="border-t border-gray-100 hover:bg-gray-50 transition"
                >
                    <td class="px-6 py-4 font-medium text-gray-800">
                        {{ categories.meta.from + index }}
                    </td>
                    <td class="px-6 py-4">{{ category.name }}</td>
                    <td class="px-6 py-4 text-blue-600">{{ category.slug }}</td>
                    <td class="px-6 py-4 text-gray-600">{{ category.description }}</td>
                    <td class="px-6 py-4">
                        <div class="flex gap-2">
                            <EditLink :href="route('category.edit', category)" />
                            <Delete
                                :text="`Видалити категорію ${category.name}`"
                                @remove="handlerRemove(category)"
                            />
                        </div>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>


        <div class="mt-4">
            <Pagination v-if="categories" :links="categories.meta.links" />
        </div>
    </div>
</template>



