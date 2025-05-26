<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import UpdatePasswordForm from './Partials/UpdatePasswordForm.vue';
import UpdateProfileInformationForm from './Partials/UpdateProfileInformationForm.vue';
import { Head } from '@inertiajs/vue3';



defineProps({
    mustVerifyEmail: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});


</script>

<template>
    <Head title="Профіль" />

    <AuthenticatedLayout>
        <template #header>
            <h2
                class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200"
            >
                Профіль
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl  sm:px-6 lg:px-8 flex  flex-col gap-10 items-stretch h-full md:flex-row" >
                <div
                    class=" bg-white p-4 shadow sm:rounded-lg sm:p-8 dark:bg-gray-800 w-full md:w-1/2 "
                >
                    <UpdateProfileInformationForm
                        :must-verify-email="mustVerifyEmail"
                        :status="status"
                    />
                </div>

                <div
                    class=" bg-white p-4 shadow sm:rounded-lg sm:p-8 dark:bg-gray-800 w-full md:w-1/2 "
                >
                    <UpdatePasswordForm  />
                </div>


            </div>
        </div>
    </AuthenticatedLayout>
</template>
