<template>
    <Link as="button"
          :class="linkClass"
          :href="href">
        <slot/>
    </Link>
</template>

<script setup>
import {Link} from "@inertiajs/vue3";
import {reactive} from "vue";

const props = defineProps({
    href: {
        required: true,
        type: String,
    },
    active: {
        type: Boolean,
        default: false,
    },
});

const linkClass = reactive({
    'flex w-full items-center gap-x-3.5 py-2 px-2.5 text-slate-700 text-sm rounded-md hover:bg-gray-100 dark:hover:bg-gray-900 dark:text-slate-400 dark:hover:text-slate-300': true,
    'bg-gray-100 hover:bg-gray-100 dark:bg-gray-900 dark:text-white': props.active,
});
</script>
