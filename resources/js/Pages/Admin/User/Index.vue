<script setup>
import {Head} from "@inertiajs/vue3";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import UserListTable from "@/Pages/Admin/User/Partials/UserListTable.vue";
import AddLink from "@/Components/AddLink.vue";
import SearchUser from "@/Pages/Admin/User/Partials/SearchUser.vue";

defineProps({
    title: {
        type: String,
        required: true,
    },
    users: {
        type: Object,
        required: true,
    }
});

</script>

<template>
    <Head :title="title" />
    <AuthenticatedLayout>
        <template #header>
            <h2
                class="text-xl font-semibold leading-tight text-gray-800 "
            >
                {{ title }}
            </h2>
        </template>
        <div class="py-12">
            <div class="mx-auto max-w-7xl  sm:px-6 lg:px-8 flex  flex-col gap-10 items-stretch h-full md:flex-row" >
                <div class="bg-white p-4 shadow sm:rounded-lg sm:p-8  w-full">
                    <div class="flex flex-row justify-between items-center">
                       <AddLink :href="route('users.create')">
                           Додати користувача
                       </AddLink>
                        <SearchUser />
                    </div>
                    <UserListTable v-if="users.data.length" :users="users" />
                    <p v-else class="flex justify-center font-bold ">Пошук не дав результату ... </p>
                </div>
            </div>
        </div>
        </AuthenticatedLayout>
</template>

<style scoped>

</style>
