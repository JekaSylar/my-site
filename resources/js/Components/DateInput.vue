<script setup>
import { ref, watch } from 'vue';
import formatDate from "@/utils/formatDate.js";
import VueDatePicker from '@vuepic/vue-datepicker';
import '@vuepic/vue-datepicker/dist/main.css';


const props = defineProps({
    currentDate: {
        type: [String, Date],
        default:  new Date(),
    },
    enableTimePicker: {
        type: Boolean,
        default: false
    },
    minDate: {
        type: [String, Date],
        default: false
    }
});


const emit = defineEmits(['selectDate', 'cleared']);

const date = ref(new Date(props.currentDate));

watch(() => props.currentDate, (newVal) => {
    date.value = new Date(newVal);
});


const format = (date) => formatDate(date, 'DD.MM.YYYY - H:mm');

const handleDate = () => {
    emit('selectDate', date.value);
};

const handleClosed = () => {
    emit('cleared')
}

</script>

<template>
    <VueDatePicker
        v-model="date"
        :min-date="minDate"
        :locale="'uk'"
        :format="format"
        :enable-time-picker="enableTimePicker"
        cancelText="Відміна"
        selectText="Вибрати"
        @update:model-value="handleDate"
        @cleared="handleClosed"
    />
</template>

<style >
.dp__input {
    padding-bottom: 0;
    padding-top: 0;

}

</style>
