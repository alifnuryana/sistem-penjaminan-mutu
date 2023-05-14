<template>
    <!-- TODO : terdapat bug, megenerate dua kali di halaman dashboard cek SharedData pada inertia -->
    <ol class="flex items-center whitespace-nowrap min-w-0 mb-5" aria-label="Breadcrumb">
        <li class="text-sm" v-for="(item, index) in breadcrumbs" :key="item">
            <Link as="button" class="flex items-center text-gray-500 hover:text-blue-600" :href="item['link']">
                {{ item['text'] }}
                <ChevronRightIcon
                    v-if="index < breadcrumbs.length - 1"
                    class="flex-shrink-0 mx-3 overflow-visible h-2.5 w-2.5 text-gray-400 dark:text-gray-600"/>
            </Link>
        </li>
    </ol>
</template>

<script setup>
import {ChevronRightIcon} from "@heroicons/vue/24/outline/index.js";
import {usePage, Link} from "@inertiajs/vue3";

const breadcrumbs = usePage().props.breadcrumbs;
</script>
