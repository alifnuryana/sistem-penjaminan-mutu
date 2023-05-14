<template>
    <p class="text-xs text-red-600 mt-2" :id="`${id}-error`">
        <slot/>
    </p>
</template>

<script setup>
defineProps({
    id: {
        type: String,
        required: true
    },
});
</script>
