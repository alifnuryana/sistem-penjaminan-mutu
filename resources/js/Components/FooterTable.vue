<template>
    <div
        class="px-6 py-4 grid gap-3 md:flex md:justify-between md:items-center border-t border-gray-200 dark:border-gray-700">
        <div>
            <p class="text-sm text-gray-600 dark:text-gray-400">
                Total
                <span class="font-semibold text-gray-800 dark:text-gray-200">
                    {{ meta.from }}
                </span>
                -
                <span class="font-semibold text-gray-800 dark:text-gray-200">
                    {{ meta.to }}
                </span>
                dari
                <span
                    class="font-semibold text-gray-800 dark:text-gray-200">
                    {{ meta.total }}
                </span>
                hasil.
            </p>
        </div>

        <div>
            <div class="inline-flex gap-x-2">
                <Link
                    v-if="links.prev"
                    type="button"
                    :href="links.prev"
                    class="py-2 px-3 inline-flex justify-center items-center gap-2 rounded-md border font-medium bg-white text-gray-700 shadow-sm align-middle hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-white focus:ring-blue-600 transition-all text-sm dark:bg-slate-900 dark:hover:bg-slate-800 dark:border-gray-700 dark:text-gray-400 dark:hover:text-white dark:focus:ring-offset-gray-800">
                    <ChevronLeftIcon class="w-4 h-4"/>
                    Sebelumnya
                </Link>

                <Link v-if="links.next"
                      type="button"
                      :href="links.next"
                      class="py-2 px-3 inline-flex justify-center items-center gap-2 rounded-md border font-medium bg-white text-gray-700 shadow-sm align-middle hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-white focus:ring-blue-600 transition-all text-sm dark:bg-slate-900 dark:hover:bg-slate-800 dark:border-gray-700 dark:text-gray-400 dark:hover:text-white dark:focus:ring-offset-gray-800">
                    Selanjutnya
                    <ChevronRightIcon class="w-4 h-4"/>
                </Link>
            </div>
        </div>
    </div>
</template>

<script setup>
import {Link} from "@inertiajs/vue3";
import {ChevronRightIcon, ChevronLeftIcon} from "@heroicons/vue/24/solid/index.js";

defineProps({
    links: {
        required: true,
        type: Object
    },
    meta: {
        required: true,
        type: Object
    }
})
</script>
