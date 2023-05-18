<template>
    <div class="bg-white border rounded-md shadow p-4 dark:bg-gray-800 dark:border-gray-700" role="alert">
        <div class="flex">
            <div class="flex-shrink-0">
                <InformationCircleIcon class="h-5 w-5 text-blue-500 mt-0.5"/>
            </div>
            <div class="ml-4">
                <h3 class="text-gray-800 font-semibold dark:text-white">
                    <slot name="title"/>
                </h3>
                <p class="mt-2 text-sm text-gray-700 dark:text-gray-400">
                    <slot name="messages"/>
                </p>
            </div>
        </div>
    </div>
</template>

<script setup>
import {InformationCircleIcon} from "@heroicons/vue/24/outline/index.js";
</script>
