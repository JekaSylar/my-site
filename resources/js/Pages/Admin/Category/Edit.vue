<script setup>
import {Head} from "@inertiajs/vue3";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import {useForm} from "@inertiajs/vue3";
import useToast from "@/composables/toast.js";
import TextInput from "@/Components/TextInput.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextareaInput from "@/Components/TextareaInput.vue";

const props = defineProps({
    title: {
        type: String,
        required: true,
    },
    category: {
        type: Object,
        required: true
    }
});

const toast = useToast();

const form = useForm({
    'name': props.category.data.name,
    'description': props.category.data.description,
    'meta_description': props.category.data.meta_description,
    'meta_keywords': props.category.data.meta_keywords,
    'slug': props.category.data.slug
});

const submit = () => {
    form.put(route('category.update', props.category.data), {
        onSuccess: () => {
            toast('Категорія змінно');
        }
    })
}

</script>

<template>
    <Head :title="title" />
    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-2xl font-bold text-gray-900 dark:text-white">
                {{ title }}
            </h2>
        </template>

        <div class="py-10">
            <div class="max-w-6xl mx-auto px-4">
                <div class="bg-white dark:bg-gray-800 shadow-lg rounded-2xl p-8">
                    <form @submit.prevent="submit" class="grid grid-cols-1 lg:grid-cols-2 gap-8">


                        <div class="space-y-6">
                            <h3 class="text-lg font-semibold text-gray-800 dark:text-white border-b pb-2">
                                Основні дані
                            </h3>

                            <div>
                                <InputLabel for="name" value="Назва категорії" />
                                <TextInput
                                    id="name"
                                    type="text"
                                    v-model="form.name"
                                    class="mt-2 w-full"

                                />
                                <InputError :message="form.errors.name" class="mt-2 text-sm text-red-600" />
                            </div>

                            <div>
                                <InputLabel for="name" value="Slug" />
                                <TextInput
                                    id="slug"
                                    type="text"
                                    v-model="form.slug"
                                    class="mt-2 w-full"

                                />
                                <InputError :message="form.errors.slug" class="mt-2 text-sm text-red-600" />
                            </div>

                            <div>
                                <InputLabel for="description" value="Опис" />
                                <TextareaInput
                                    id="description"
                                    v-model="form.description"
                                    class="mt-2 w-full min-h-[120px]"

                                />
                                <InputError :message="form.errors.description" class="mt-2 text-sm text-red-600" />
                            </div>
                        </div>


                        <div class="space-y-6">
                            <h3 class="text-lg font-semibold text-gray-800 dark:text-white border-b pb-2">
                                SEO Параметри
                            </h3>

                            <div>
                                <InputLabel for="meta_keywords" value="SEO Keywords" />
                                <TextInput
                                    id="meta_keywords"
                                    type="text"
                                    v-model="form.meta_keywords"
                                    class="mt-2 w-full"

                                />
                                <InputError :message="form.errors.meta_keywords" class="mt-2 text-sm text-red-600" />
                            </div>

                            <div>
                                <InputLabel for="meta_description" value="SEO Опис" />
                                <TextareaInput
                                    id="meta_description"
                                    row="9"
                                    v-model="form.meta_description"
                                    class="mt-2 w-full min-h-[100px]"

                                />
                                <InputError :message="form.errors.meta_description" class="mt-2 text-sm text-red-600" />
                            </div>
                        </div>


                        <div class="lg:col-span-2 flex justify-end pt-4">
                            <PrimaryButton :disabled="form.processing" class="px-6 py-2">
                                Змінити
                            </PrimaryButton>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>



