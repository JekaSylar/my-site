<script setup>
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Link, useForm, usePage } from '@inertiajs/vue3';
import useToast from "@/composables/toast.js";

defineProps({
    mustVerifyEmail: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});
const toast = useToast();
const user = usePage().props.auth.user;

const form = useForm({
    name: user.name,
    email: user.email,
});

const submit = () => {
    form.patch(route('profile.update'), {
        onSuccess: () => {
            toast('Данні зміненно');
        }
    })
}


</script>

<template>
    <section>
        <header>
            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                Інформація про профіль
            </h2>
        </header>

        <form
            @submit.prevent="submit"
            class="mt-6 space-y-6 "
        >
            <div>
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

            <div>
                <InputLabel for="email" value="Email" />

                <TextInput
                    id="email"
                    type="email"
                    class="mt-1 block w-full bg-gray-100 text-gray-500 cursor-not-allowed"
                    v-model="form.email"
                    required
                    readonly="true"
                    autocomplete="username"
                />

                <InputError class="mt-2" :message="form.errors.email" />
            </div>



            <div class="flex items-center gap-4">
                <PrimaryButton :disabled="form.processing">
                    Оновити
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
    </section>
</template>
