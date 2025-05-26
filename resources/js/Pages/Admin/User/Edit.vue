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
            <div
                class="mx-auto max-w-7xl  sm:px-6 lg:px-8 flex justify-center  flex-col gap-10 items-stretch h-full md:flex-row">
                <div class="bg-white p-4 shadow sm:rounded-lg sm:p-8 w-lg ">

                    <form class="flex flex-col gap-6" @submit.prevent="submit">
                        <div class="w-full">
                            <InputLabel for="name" value="Ім'я"/>

                            <TextInput
                                id="name"
                                type="text"
                                class="mt-1 block w-full"
                                v-model="form.name"
                                required
                                autofocus
                                autocomplete="name"
                            />

                            <InputError class="mt-2" :message="form.errors.name"/>
                        </div>
                        <div class="w-full">
                            <InputLabel for="email" value="Email"/>
                            <div class="flex flex-row gap-2">
                                <TextInput
                                    id="email"
                                    type="email"
                                    class="mt-1 block w-full"
                                    v-model="form.email"
                                    required
                                    autocomplete="email"
                                />

                            </div>
                            <InputError class="mt-2" :message="form.errors.email"/>
                        </div>
                        <div class="flex flex-row gap-2">


                        </div>
                        <div class="w-full">
                            <InputLabel for="password" value="Пароль"/>
                            <div class="flex flex-row gap-2">
                                <TextInput
                                    id="password"
                                    type="text"
                                    class="mt-1 block w-full"
                                    v-model="form.password"
                                    autocomplete="password"
                                />
                                <GeneratePassword @generated="generatedPassword"/>
                            </div>
                            <InputError class="mt-2" :message="form.errors.password"/>

                        </div>


                        <div class="flex justify-end">
                            <PrimaryButton :disabled="form.processing">
                                Змінити
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
