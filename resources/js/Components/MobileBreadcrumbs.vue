<template>
    <ol class="ml-3 flex items-center whitespace-nowrap min-w-0" aria-label="Breadcrumb">
        <Link as="button" v-for="(item, index) in breadcrumbs" :key="item"
              :href="item['link']"
              class="flex items-center text-sm text-gray-800 dark:text-gray-400">
            {{ item['text'] }}
            <ChevronRightIcon v-if="index < breadcrumbs.length - 1"
                              class="flex-shrink-0 mx-3 overflow-visible h-2.5 w-2.5 text-gray-400 dark:text-gray-600"/>
        </Link>
    </ol>
</template>

<script setup>
import {usePage, Link} from "@inertiajs/vue3";
import {ChevronRightIcon} from "@heroicons/vue/24/outline/index.js";

const breadcrumbs = usePage().props.breadcrumbs;
</script>
