<script setup>
import {Head, useForm} from "@inertiajs/vue3";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import InputLabel from "@/Components/InputLabel.vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import InputError from "@/Components/InputError.vue";
import GeneratePassword from "@/Components/GeneratePassword.vue";
import useToast from "@/composables/toast.js";


const props = defineProps({
    title: {
        type: String,
        required: true,
    },
    user: {
        type: Object,
        required: true,
    }
});

const toast = useToast();

const form = useForm({
    'name': props.user.data.name,
    'email': props.user.data.email,
    'password': null,
    'is_admin': props.user.data.is_admin,
    'google_id': props.user.data.google_id,
    'email_verified_at': props.user.data.email_verified_at

});

const generatedPassword = (value) => {
    form.password = value;
}
console.log(props.user.data)
const submit = () => {
    form.put(route('users.update', props.user.data), {
        onSuccess: () => {
            toast('Користувач змінений');
        }
    })
}
</script>


<template>
    <Head :title="title" />
    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-2xl font-bold text-gray-800 dark:text-white">
                {{ title }}
            </h2>
        </template>

        <div class="py-10 px-4 md:px-6 lg:px-8 max-w-3xl mx-auto">
            <div class="bg-white dark:bg-gray-900 shadow-lg rounded-xl p-8 border border-gray-200 dark:border-gray-700">
                <h3 class="text-xl font-semibold text-gray-700 dark:text-white mb-6">
                    Зміна даних користувача
                </h3>

                <form class="grid gap-6" @submit.prevent="submit">
                    <!-- Name -->
                    <div>
                        <InputLabel for="name" value="Ім'я" />
                        <TextInput
                            id="name"
                            type="text"
                            class="mt-2 w-full"
                            v-model="form.name"
                            required
                            autofocus
                            autocomplete="name"
                        />
                        <InputError class="mt-1" :message="form.errors.name" />
                    </div>

                    <!-- Email -->
                    <div>
                        <InputLabel for="email" value="Email" />
                        <TextInput
                            id="email"
                            type="email"
                            class="mt-2 w-full"
                            v-model="form.email"
                            required
                            autocomplete="email"
                        />
                        <InputError class="mt-1" :message="form.errors.email" />
                    </div>

                    <!-- Password (optional) -->
                    <div>
                        <InputLabel for="password" value="Новий пароль (за бажанням)" />
                        <div class="flex gap-3 items-start mt-2">
                            <TextInput
                                id="password"
                                type="text"
                                class="w-full"
                                v-model="form.password"
                                autocomplete="new-password"
                            />
                            <GeneratePassword
                                @generated="generatedPassword"
                                class="shrink-0 mt-1"
                            />
                        </div>
                        <InputError class="mt-1" :message="form.errors.password" />
                    </div>

                    <!-- Submit -->
                    <div class="flex justify-end">
                        <PrimaryButton :disabled="form.processing">
                            Змінити
                        </PrimaryButton>
                    </div>
                </form>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

