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
    <Head :title="title"/>
    <AuthenticatedLayout>
        <template #header>
            <h2
                class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200"
            >
                {{ title }}
            </h2>
        </template>
        <div class="py-12">
            <div class="mx-auto max-w-7xl  sm:px-6 lg:px-8 flex justify-center  flex-col gap-10 items-stretch h-full md:flex-row">
                <div class="bg-white p-4 shadow sm:rounded-lg sm:p-8 w-lg ">

                    <form class="flex flex-col gap-6" @submit.prevent="submit">
                        <div class="w-full">
                            <InputLabel for="name" value="Ім'я" />

                            <TextInput
                                id="name"
                                type="text"
                                class="mt-1 block w-full"
                                v-model="form.name"
                                required
                                autofocus
                                autocomplete="name"
                            />

                            <InputError class="mt-2" :message="form.errors.name" />
                        </div>
                        <div class="w-full">
                            <InputLabel for="email" value="Email" />

                            <TextInput
                                id="email"
                                type="email"
                                class="mt-1 block w-full"
                                v-model="form.email"
                                required
                                autocomplete="email"
                            />

                            <InputError class="mt-2" :message="form.errors.email" />
                        </div>
                        <div class="w-full">
                            <InputLabel for="password" value="Пароль" />
                            <div class="flex flex-row gap-2">
                                <TextInput
                                    id="password"
                                    type="text"
                                    class="mt-1 block w-full"
                                    v-model="form.password"
                                    required
                                    autocomplete="password"
                                />
                                <GeneratePassword @generated="generatedPassword" />
                            </div>
                            <InputError class="mt-2" :message="form.errors.password" />

                        </div>
                        <div class="flex justify-end">
                            <PrimaryButton :disabled="form.processing">
                                Додати
                            </PrimaryButton>
                            <Transition
                                enter-active-class="transition ease-in-out"
                                enter-from-class="opacity-0"
                                leave-active-class="transition ease-in-out"
                                leave-to-class="opacity-0"
                            >
                            </Transition>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<style scoped>

</style>
