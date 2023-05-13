<template>
    <div id="application-sidebar"
         class="hs-overlay hs-overlay-open:translate-x-0 -translate-x-full transition-all duration-300 transform hidden fixed top-0 left-0 bottom-0 z-[60] w-64 bg-white border-r border-gray-200 pt-7 pb-10 overflow-y-auto scrollbar-y lg:block lg:translate-x-0 lg:right-auto lg:bottom-0 dark:scrollbar-y dark:bg-gray-800 dark:border-gray-700">
        <div class="px-6">
            <Link as="button" class="flex-none text-xl font-semibold dark:text-white" :href="route('dashboard')"
                  aria-label="SPM Widyatama">SPM Widyatama
            </Link>
        </div>

        <nav class="hs-accordion-group p-6 w-full flex flex-col flex-wrap" data-hs-accordion-always-open>
            <ul class="space-y-1.5">
                <li>
                    <Navlink :href="route('dashboard')" :active="route().current('dashboard')">
                        <HomeIcon class="w-3.5 h-3.5"/>
                        Dashboard
                    </Navlink>
                </li>

                <li>
                    <Navlink href="#" :active="false">
                        <DocumentIcon class="w-3.5 h-3.5"/>
                        Akreditasi
                    </Navlink>
                </li>

                <li>
                    <Navlink href="#" :active="false">
                        <BellAlertIcon class="w-3.5 h-3.5"/>
                        Notifikasi
                    </Navlink>
                </li>

                <li class="hs-accordion" id="master-data-accordion">
                    <a
                        class="hs-accordion-toggle flex items-center gap-x-3.5 py-2 px-2.5 hs-accordion-active:text-blue-600 hs-accordion-active:hover:bg-transparent text-sm text-slate-700 rounded-md hover:bg-gray-100 dark:bg-gray-800 dark:hover:bg-gray-900 dark:text-slate-400 dark:hover:text-slate-300 dark:hs-accordion-active:text-white"
                        href="javascript:;">
                        <CircleStackIcon class="w-3.5 h-3.5"/>
                        Master Data

                        <ChevronUpIcon
                            class="hs-accordion-active:block ml-auto hidden w-3 h-3 text-gray-600 group-hover:text-gray-500 dark:text-gray-400"/>
                        <ChevronDownIcon
                            class="hs-accordion-active:hidden ml-auto block w-3 h-3 text-gray-600 group-hover:text-gray-500 dark:text-gray-400"/>
                    </a>

                    <div id="master-data-accordion-child"
                         class="hs-accordion-content w-full overflow-hidden transition-[height] duration-300 hidden">
                        <ul class="pt-2 pl-2">
                            <li>
                                <Navlink :href="route('data.units.index')"
                                         :active="route().current('data.units.index')">
                                    Unit
                                </Navlink>
                            </li>
                        </ul>
                    </div>
                </li>
            </ul>
        </nav>
    </div>
</template>

<script setup>
import {Link} from "@inertiajs/vue3";
import {
    HomeIcon,
    CircleStackIcon,
    DocumentIcon,
    BellAlertIcon,
    ChevronUpIcon,
    ChevronDownIcon
} from "@heroicons/vue/24/outline/index.js";
import Navlink from "../../Navlink.vue";
</script>
