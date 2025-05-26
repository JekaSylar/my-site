<script setup>
import Pagination from "@/Components/Pagination.vue";
import Delete from "@/Components/Delete.vue";
import EditLink from "@/Components/EditLink.vue";
import EmailVerified from "@/Pages/Admin/User/Partials/EmailVerified.vue";
import GoogleBadge from "@/Pages/Admin/User/Partials/GoogleBadge.vue";
import BlockUser from "@/Pages/Admin/User/Partials/BlockUser.vue";
import {router} from "@inertiajs/vue3";
import useToast from "@/composables/toast.js";

defineProps({
    users: {
        type: Object,
        required: true,
    }
});

const toast = useToast();

const handlerRemove = (user) => {
    router.delete(route('users.destroy', user), {
        onSuccess: () => {
            toast('Користувач видалений');
        }
    });
}

</script>

<template>
    <div class="overflow-x-auto" v-if="users.data.length">
        <table class="min-w-full divide-y divide-gray-200 text-sm">
            <thead class="bg-gray-50">
            <tr>
                <th class="px-4 py-2 text-left text-gray-900 font-semibold border border-gray-300">ID</th>
                <th class="px-4 py-2 text-left text-gray-900 font-semibold border border-gray-300">Ім'я</th>
                <th class="px-4 py-2 text-left text-gray-900 font-semibold border border-gray-300">Email</th>
                <th class="px-4 py-2 text-left text-gray-900 font-semibold border border-gray-300">Дата реєстрації</th>
                <th class="px-4 py-2 text-left text-gray-900 font-semibold border border-gray-300">Блокування</th>
                <th class="px-4 py-2 text-left text-gray-900 font-semibold border border-gray-300">Дії</th>
            </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
            <tr v-for="user in users.data" :key="user.id" :class="{ 'bg-rose-300': user.blocked_until }">
                <td class="px-4 py-2 border border-gray-300 ">{{ user.id }}</td>
                <td class="px-4 py-2 border border-gray-300">{{ user.name }}</td>
                <td class="px-4 py-2 border border-gray-300">
                   <div class="flex flex-row justify-between">
                       {{ user.email }}
                       <div class="flex flex-row gap-2">
                           <GoogleBadge :is-google="user.google_id" />
                           <EmailVerified :user="user" />
                       </div>
                   </div>
                </td>
                <td class="px-4 py-2 border border-gray-300">{{ user.register_date }}</td>
                <td class="px-4 py-2 border border-gray-300">
                    <BlockUser :user="user" />

                </td>
                <td class="px-4 py-2 border border-gray-300">
                    <div class="flex flex-row items-center">
                        <EditLink :href="route('users.edit', user)" />
                        <Delete :text="`Видалиться користувач ${user.name}`" @remove="handlerRemove(user)" />
                    </div>
                </td>
            </tr>
            </tbody>
        </table>
        <Pagination v-if="users" :links="users.meta.links" />
    </div>
</template>

<style scoped>

</style>
