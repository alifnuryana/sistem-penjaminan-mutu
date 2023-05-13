<template>
    <div class="relative">
        <input :type="type" :id="id" :name="name"
               :class="inputClass"
               :value="modelValue"
               @input="$emit('update:modelValue', $event.target.value)"
               required :aria-describedby="`${id}-error`">
        <div
            :class="validationClass">
            <ExclamationCircleIcon class="h-5 w-5 text-red-500"/>
        </div>
    </div>
</template>

<script setup>
import {ExclamationCircleIcon} from "@heroicons/vue/24/outline/index.js";
import {reactive} from "vue";

defineEmits(['update:modelValue']);
const props = defineProps({
    id: {
        type: String,
        required: true,
    },
    name: {
        type: String,
        required: true,
    },
    type: {
        type: String,
        default: 'text',
    },
    modelValue: {
        type: String,
        default: '',
    },
    error: {
        type: Boolean,
        default: false,
    }
});

const inputClass = reactive({
    'py-3 px-4 block w-full rounded-md text-sm dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400': true,
    'border-gray-200 focus:border-blue-500 focus:ring-blue-500': !props.error,
    'border-red-500 focus:border-red-500 focus:ring-red-500': props.error,
});

const validationClass = reactive({
    'absolute inset-y-0 right-0 flex items-center pointer-events-none pr-3': true,
    'hidden': !props.error,
});
</script>
