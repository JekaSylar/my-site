<script setup>
import { ref } from 'vue';
import { router } from '@inertiajs/vue3';
import useToast from '@/composables/toast.js';
import DateInput from '@/Components/DateInput.vue';
import { vOnClickOutside } from '@vueuse/components';

const props = defineProps({
    user: {
        type: Object,
        required: true
    }
});

const toast = useToast();

// Controls whether the block date input is visible
const isBlocking = ref(false);

// Two-way bound value for the block-until date
const blockedUntilDate = defineModel();

// Send request to unblock the user
const unblockUser = () => {
    router.post(route('users.change.block', props.user), {
        blocked_until: null,
    }, {
        onSuccess: () => {
            toast('Користувача розблоковано');
            isBlocking.value = false;
        }
    });
};

// Reset input state and hide date input
const clearBlockState = () => {
    isBlocking.value = false;
    blockedUntilDate.value = null;
};

// Send request to block the user until selected date
const blockUser = () => {
    router.post(route('users.change.block', props.user), {
        blocked_until: blockedUntilDate.value
    }, {
        onSuccess: () => {
            toast('Користувача заблоковано');
        }
    });
};

// Hide the block date input (e.g., when clicking outside)
const closeBlockInput = () => {
    isBlocking.value = false;
};
</script>

<template>
    <!-- If user is currently blocked -->
    <div
        v-if="user.blocked_until"
        @click="unblockUser"
        class="flex items-center justify-between gap-2 cursor-pointer w-full"
    >
        <span class="text-sm">{{ user.blocked_until }}</span>
        <div>
            <svg
                class="w-5 fill-green-500"
                xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 576 512"
            >
                <path
                    d="M352 144c0-44.2 35.8-80 80-80s80 35.8 80 80l0 48c0 17.7 14.3 32 32 32s32-14.3 32-32l0-48C576 64.5 511.5 0 432 0S288 64.5 288 144l0 48L64 192c-35.3 0-64 28.7-64 64L0 448c0 35.3 28.7 64 64 64l320 0c35.3 0 64-28.7 64-64l0-192c0-35.3-28.7-64-64-64l-32 0 0-48z"
                />
            </svg>
        </div>
    </div>

    <!-- If user is not blocked -->
    <div
        v-else
        class="flex items-center justify-between gap-2 cursor-pointer w-full"
        v-on-click-outside="closeBlockInput"
    >
        <div v-if="isBlocking" class="flex items-center gap-2 w-full justify-between">
            <DateInput
                v-model="blockedUntilDate"
                :min-date="new Date()"
                :enable-time-picker="true"
                @cleared="clearBlockState"
            />
            <svg
                v-if="blockedUntilDate"
                @click="blockUser"
                class="w-5 fill-green-500"
                xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 448 512"
            >
                <path
                    d="M438.6 105.4c12.5 12.5 12.5 32.8 0 45.3l-256 256c-12.5 12.5-32.8 12.5-45.3 0l-128-128c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0L160 338.7 393.4 105.4c12.5-12.5 32.8-12.5 45.3 0z"
                />
            </svg>
        </div>
        <div v-else class="flex justify-end w-full">
            <svg
                class="w-5 fill-red-600"
                @click="isBlocking = true"
                xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 448 512"
            >
                <path
                    d="M144 144l0 48 160 0 0-48c0-44.2-35.8-80-80-80s-80 35.8-80 80zM80 192l0-48C80 64.5 144.5 0 224 0s144 64.5 144 144l0 48 16 0c35.3 0 64 28.7 64 64l0 192c0 35.3-28.7 64-64 64L64 512c-35.3 0-64-28.7-64-64L0 256c0-35.3 28.7-64 64-64l16 0z"
                />
            </svg>
        </div>
    </div>
</template>
