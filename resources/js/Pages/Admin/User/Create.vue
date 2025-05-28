<script setup>
import {Head} from "@inertiajs/vue3";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import {useForm} from "@inertiajs/vue3";
import useToast from "@/composables/toast.js";
import TextInput from "@/Components/TextInput.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import GeneratePassword from "@/Components/GeneratePassword.vue";

defineProps({
    title: {
        type: String,
        required: true,
    },
});

const form = useForm({
    'name': null,
    'email': null,
    'password': null,
});

const toast = useToast();

const generatedPassword = (value) => {
    form.password = value;
}
const  submit = () => {
    form.post(route('users.store'), {
        onSuccess: () => {
            toast('Користувач додан');
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
                    Дані нового користувача
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

                    <!-- Password -->
                    <div>
                        <InputLabel for="password" value="Пароль" />
                        <div class="flex gap-3 items-start mt-2">
                            <TextInput
                                id="password"
                                type="text"
                                class="w-full"
                                v-model="form.password"
                                required
                                autocomplete="password"
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
                            Додати
                        </PrimaryButton>
                    </div>
                </form>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

