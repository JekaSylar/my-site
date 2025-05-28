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
    <div class="mt-8">

        <div class="overflow-x-auto rounded-xl border border-gray-200 shadow-sm">
            <table class="min-w-full text-sm text-gray-700 bg-white">
                <thead class="bg-gray-100 text-xs uppercase text-gray-600">
                <tr>
                    <th class="px-6 py-4 text-left">№</th>
                    <th class="px-6 py-4 text-left">Ім'я</th>
                    <th class="px-6 py-4 text-left">Email</th>
                    <th class="px-6 py-4 text-left">Дата реєстрації</th>
                    <th class="px-6 py-4 text-left">Блокування</th>
                    <th class="px-6 py-4 text-left">Дії</th>
                </tr>
                </thead>
                <tbody>
                <tr
                    v-for="(user, index) in users.data"
                    :key="user.id"
                    :class="[
                            'border-t border-gray-100 hover:bg-gray-50 transition',
                            user.blocked_until ? 'bg-red-100' : ''
                        ]"
                >
                    <td class="px-6 py-4 font-medium text-gray-800">
                        {{ users.meta.from + index }}
                    </td>
                    <td class="px-6 py-4">{{ user.name }}</td>
                    <td class="px-6 py-4">
                        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-1 sm:gap-2">
                            <span>{{ user.email }}</span>
                            <div class="flex gap-2">
                                <GoogleBadge :is-google="user.google_id" />
                                <EmailVerified :user="user" />
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 text-gray-600">{{ user.register_date }}</td>
                    <td class="px-6 py-4">
                        <BlockUser :user="user" />
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex gap-2">
                            <EditLink :href="route('users.edit', user)" />
                            <Delete
                                :text="`Видалитися користувач ${user.name}`"
                                @remove="handlerRemove(user)"
                            />
                        </div>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>


        <div class="mt-4">
            <Pagination v-if="users" :links="users.meta.links" />
        </div>
    </div>
</template>


